<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Client;


/**
 * Auth Controller
 *
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class AuthController extends AppController {

    /**
     * @var \App\Model\Table\UsersTable $Users
     */
    private $Users;

    /**
     * Controller initialize override
     *
     * @return void
     */
    public function initialize(): void {
        parent::initialize();

        // By default, CakePHP will (sensibly) default to preventing users from accessing any actions on a controller.
        // These actions, however, are typically required for users who have not yet logged in.
        $this->Authentication->allowUnauthenticated(['login', 'forgetPassword', 'resetPassword']);

        $this->Users = $this->fetchTable('Users');

        //Now I know duplicate code fragments is bad practice and makes it hard to maintain, but I have no Idea why contentBlocks was not being retrieved from
        // AppController.php as login function seems to execute first before beforerender of AppController is called
        // Load keys from ContentBlocks
        $this->contentBlocks = $this
            ->fetchTable('Cb')
            ->find('list', [
                'keyField' => 'hint',
                'valueField' => 'content_value'
            ])
            ->toArray();
    }

    /**
     * Register method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function register() {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('You have been registered. Please log in. ');

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('The user could not be registered. Please, try again.');
        }
        $this->set(compact('user'));
    }

    /**
     * Forget Password method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful email send, renders view otherwise.
     */
    public function forgetPassword() {
        if ($this->request->is('post')) {
            // Retrieve the user entity by provided email address
            $user = $this->Users->findByEmail($this->request->getData('email'))->first();
            if ($user) {
                // Set nonce and expiry date
                $user->nonce = Security::randomString(128);
                $user->nonce_expiry = new FrozenTime('7 days');
                if ($this->Users->save($user)) {
                    // Now let's send the password reset email
                    $mailer = new Mailer('default');

                    // email basic config
                    $mailer
                        ->setEmailFormat('both')
                        ->setTo($user->email)
                        ->setSubject('Reset your account password');

                    // select email template
                    $mailer
                        ->viewBuilder()
                        ->setTemplate('reset_password');

                    // transfer required view variables to email template
                    $mailer
                        ->setViewVars([
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'nonce' => $user->nonce,
                            'email' => $user->email
                        ]);

                    //Send email
                    if (!$mailer->deliver()) {
                        // Just in case something goes wrong when sending emails
                        $this->Flash->error('We have encountered an issue when sending you emails. Please try again. ');
                        return $this->render();  // Skip the rest of the controller and render the view
                    }
                } else {
                    // Just in case something goes wrong when saving nonce and expiry
                    $this->Flash->error('We are having issue to reset your password. Please try again. ');
                    return $this->render();  // Skip the rest of the controller and render the view
                }
            }

            /*
             * **This is bit of a special design**
             * We don't tell the user if their account exists, or if the email has been sent,
             * because it may be used by someone with malicious intent. We only need to tell
             * the user that they'll get an email.
             */
            $this->Flash->success('If your e-mail has been found in the database, an e-mail will be sent. Please check your inbox (or spam folder) for an email regarding how to reset your account password. ');
            return $this->redirect(['action' => 'login']);

        }
    }

    /**
     * Reset Password method
     *
     * @param string|null $nonce Reset password nonce
     * @return \Cake\Http\Response|null|void Redirects on successful password reset, renders view otherwise.
     */
    public function resetPassword($nonce = null) {
        $user = $this->Users->findByNonce($nonce)->first();

        // If nonce cannot find the user, or nonce is expired, prompt for re-reset password
        if (!$user || $user->nonce_expiry < FrozenTime::now()) {
            $this->Flash->error('Your link is invalid or expired. Please try again.');
            return $this->redirect(['action' => 'forgetPassword']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Used a different validation set in Model/Table file to ensure both fields are filled
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'resetPassword']);

            // Also clear the nonce-related fields on successful password resets.
            // This ensures that the reset link can't be used a second time.
            $user->nonce = null;
            $user->nonce_expiry = null;

            if ($this->Users->save($user)) {
                $this->Flash->success('Your password has been successfully reset. Please login with new password. ');
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('The password cannot be reset. Please try again.');
        }

        $this->set(compact('user'));
    }

    /**
     * Change Password method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePassword($id = null) {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Used a different validation set in Model/Table file to ensure both fields are filled
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'resetPassword']);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The user could not be saved. Please, try again.');
        }
        $this->set(compact('user'));
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|void|null Redirect to location before authentication
     */
    public function login() {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // Access ContentBlocks from the initialize function
        $contentBlocks = $this->contentBlocks;

        // Note: theres a strange bug that maxAttemptTimeOut to be +2 of what it should be, so If it is set to 5,
        // instead it locks out at 7
        $maxAttemptTimeOut = (int)$contentBlocks['security_max_attempts_timeout'];
        $timeMultiplyFactor = (int)$contentBlocks['security_time_multiply_factor'];
        $maxTimeoutDuration = (int)$contentBlocks['security_max_timeout_duration'];

        //Set default conditions for CB values if they do not exist, preferably it should never be deleted at this moment
        if($maxAttemptTimeOut === 0) {
            $maxAttemptTimeOut = 3;
        } else {
            $maxAttemptTimeOut -= 2;
        }
        if($timeMultiplyFactor === 0) {
            $timeMultiplyFactor = 2;
        }
        if($maxTimeoutDuration === 0) {
            //Convert minutes to seconds, we will store security_max_timeout_duration as minutes instead of seconds
            $maxTimeoutDuration = $maxTimeoutDuration * 60;
        } else {

        }

        // Define maximum number of consecutive unsuccessful attempts before imposing timeouts. Put a CB on me when making a CMS
        $maxAttemptsBeforeTimeout = $maxAttemptTimeOut;

        // Define initial timeout duration (in seconds) and doubling factor. Put CB on me when making a CMS
        $timeoutDoublingFactor = $timeMultiplyFactor;

        // Get stored attempt count and timestamp from session
        $loginAttempts = $this->request->getSession()->read('login_attempts') ?? ['count' => 0, 'last_attempt_time' => 0];
        $lastAttemptTime = $loginAttempts['last_attempt_time'];

        // Get current timestamp.
        $currentTime = time();

        // Retrieve the initialTimeout from the session
        $initialTimeout = $this->request->getSession()->read('login_timeout_duration') ?? 15;

        // Calculate the total number of consecutive unsuccessful attempts
        $totalAttempts = $loginAttempts['count'];

        // Check if enough time has passed since the last attempt to reset the attempt count
        if ($lastAttemptTime && ($currentTime - $lastAttemptTime) > $initialTimeout) {
            $totalAttempts = 0;
            // Set the lockout end time in the session to 0
            $this->request->getSession()->write('login_timeout_end', 0);
        }

        // Double the timeout for each subsequent lockout
        if ($totalAttempts > $maxAttemptsBeforeTimeout) {
            // User has reached the maximum attempts before timeout, lock them out
            $initialTimeout *= $timeoutDoublingFactor;

            // Update the initialTimeout in the session for the current request
            $this->request->getSession()->write('login_timeout_duration', $initialTimeout);

            // Set the lockout end time in the session
            $this->request->getSession()->write('login_timeout_end', $currentTime + $initialTimeout);
        }

        // Verify reCAPTCHA response
        $recaptchaResponse = $this->request->getData('g-recaptcha-response');
        $secretKey = '6LcY690nAAAAAAgBR_vLBrAoKqH5XmYgfvJcYzwf'; // Remember me.

        // Send a POST request to reCAPTCHA verification endpoint
        $http = new Client();
        $response = $http->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $recaptchaResponse
        ]);

        $recaptchaResult = $response->getJson();

        // if the user passes authentication and reCAPTCHA verification, grant access to the system
        if ($result && $result->isValid() && $recaptchaResult['success']) {
            // Reset the login attempts and reCAPTCHA-related data on successful login
            $this->request->getSession()->delete('login_attempts');
            $this->request->getSession()->delete('login_timeout_duration');

            // Set a fallback location in case the user logged in without triggering 'unauthenticatedRedirect'
            $fallbackLocation = ['controller' => 'Customers', 'action' => 'index'];

            // Redirect the user to the location they're trying to access
            // Because assigntome is available to all, to prevent unecessary flash errors, redirect them there

            return $this->redirect(['controller' => 'Customers', 'action' => 'assigntome']);
        }

        // Display an error if the user submitted their credentials but authentication or reCAPTCHA failed
        if ($this->request->is('post') && (!$result->isValid() || !$recaptchaResult['success'])) {
            $totalAttempts++;

            // Update the total lockout count in the cookie
            $this->setResponse($this->getResponse()->withCookie(new Cookie('total_lockout', (string)($totalAttempts))));

            // Check if timeout duration exceeds a maximum limit (optional)
            $maxTimeout = $maxTimeoutDuration; // Maximum timeout duration (24 hours). Let it be changeable. ie. CB Me
            if ($initialTimeout > $maxTimeout) {
                $initialTimeout = $maxTimeout;
            }

            // Update session data with the new attempt count and timestamp
            $this->request->getSession()->write('login_attempts', ['count' => $totalAttempts, 'last_attempt_time' => $currentTime]);

            // Display the appropriate error message
            if ($totalAttempts > $maxAttemptsBeforeTimeout + 2) {
                $this->Flash->error("Too many unsuccessful attempts. You are locked out.");
            } elseif (!$recaptchaResult['success']) {
                $this->Flash->error('reCAPTCHA verification failed. Please try again.');
            } else {
                $this->Flash->error('Email address and/or Password is incorrect. Please try again.');
            }
        }
    }


    /**
     * Logout method
     *
     * @return \Cake\Http\Response|void|null
     */
    public function logout() {
        // We only need to log out a user when they're logged in
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $this->Authentication->logout();


        }

        // Otherwise just send them to the login page
        return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
    }

}

