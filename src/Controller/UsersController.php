<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Since theres a bug where doing before filter here does not redirect authentication properly to login, this is
        // more or less a bandaid fix, this should be included in every beforeFilter code of controller where there is
        // a need of user privileges, example below:
        if($this->checkLoggedIn() === null){
            return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
        }

        // Check if user is not an admin and redirect to index
        $adminRole = $this->Authentication->getIdentity()->role;

        // Check if user is not an admin and redirect to index
        $loggedId = $this->Authentication->getIdentity()->id;

//        debug($adminRole);
//        debug($adminRole !== 'root');
//        debug($adminRole !== 'admin');

//        debug($this->request);

        $userId = null;
        $userRole = null;

        $parameters = $this->request->getParam('pass');
        if (count($parameters) == 2) {
            $userId = $parameters[0];
            $userRole = $parameters[1];
        }

//        debug($parameters);
//        debug($userId);
//        debug($userRole);

    //        debug(($userId !== null && $userRole !== null));

//        debug($userRole);
//        exit;

        // Stop staff/regular users attempting to delete any staff member
        if (($this->request->getParam('action') === 'edit' || $this->request->getParam('action') === 'delete') && ($adminRole === 'staff' || $adminRole === 'user')) {
            $this->Flash->error(__('WARNING, ATTEMPTING TO ACCESS EDIT/DELETE WITHOUT PRIVILEGES IS STRICTLY PROHIBITED'));

            return $this->redirect(['action' => 'index']);
        }

        // Dont let admin edit other admin/root, only allow themselves
        // Scenario 1:
        // Admin attempting to edit Other admin (not his) or root

//        debug($adminRole === 'admin');
//        debug($userRole !== 'admin' && $userRole !== 'root');
//        debug($loggedId !== $userId);
//
//        debug($adminRole === 'admin' && $userRole !== 'admin' && $userRole !== 'root' && $loggedId !== $userId);
//
//
//        debug($userRole === 'admin' || $userRole === 'root');
//        debug($adminRole === 'admin' && ($userRole === 'admin' || $userRole === 'root') && $loggedId !== $userId);
//
//        debug($userRole);
//        debug(!in_array($userRole, ['user', 'staff']));
//        exit;

//        debug($this->request->getParam('action') === 'edit' || $this->request->getParam('action'));
//        debug($adminRole === 'admin' || $adminRole === 'root');
//        debug(count($parameters) == 2);
//        debug(($this->request->getParam('action') === 'edit' || $this->request->getParam('action') === 'delete' && ($adminRole === 'admin' || $adminRole === 'root') && count($parameters) == 2));
//        exit;

        //Fabulous logic for mostly admin access
        $action = $this->request->getParam('action');

//        debug($action);
//        exit;

        if ($action === 'edit' || $action === 'delete') {
            if ($adminRole === 'admin' || $adminRole === 'root') {
                if (count($parameters) == 2) {
                    // Valid action, admin role, and parameters
                    if ($action === 'edit') {
                        if (
                            ($adminRole === 'admin' && !in_array($userRole, ['user', 'staff']) && $loggedId !== $userId) ||
                            ($adminRole === 'admin' && ($userRole === 'admin' || $userRole === 'root') && $loggedId !== $userId)
                        ) {
                            $this->Flash->error(__('You cannot edit other admins/root silly'));

                            return $this->redirect(['action' => 'index']);
                        }
                    } elseif ($action === 'delete') {
                        if (!in_array($userRole, ['user', 'staff']) && ($adminRole === 'admin' && $userRole !== 'admin' && $userRole !== 'root')) {
                            $this->Flash->error(__('You cannot delete other admins/root silly'));

                            return $this->redirect(['action' => 'index']);
                        }
                    }
                } else {
                    // Invalid number of parameters
                    $this->Flash->error(__('Invalid arguments'));

                    return $this->redirect(['action' => 'index']);
                }
            } else {
                // Invalid admin role
                $this->Flash->error(__('Invalid, no access'));

                return $this->redirect(['action' => 'index']);
            }
        } elseif ($action === 'index' || (($action === 'add' && $adminRole === 'root') || ($action === 'add' && $adminRole === 'admin'))) {
            // No action needed for 'index' or root attempting to add
        } else {


            // Invalid action
            $this->Flash->error(__('Invalid action'));

            return $this->redirect(['action' => 'index']);
        }

        //Attempting to edit without parameter "role"
//        if(empty($parameters[1]) && $adminRole === 'admin'){
//            $this->Flash->error(__('Nice try'));
//            return $this->redirect(['action' => 'index']);
//        }
    }

    public function initialize(): void
    {
        parent::initialize();

        $this->set('role_choice', [
            'root' => 'Root',
            'admin' => 'Admin',
            'staff' => 'Staff',
            'user' => 'User',
        ]);
    }

    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

//            debug($user);
//            exit;

            /////////////////////////////
            // Generate the unique id  //
            /////////////////////////////

            // Call the generate id function in the AppController.php

            $identifier = 'STF';
            $generateId = $this->generateId($identifier, $user->f_name, $user->l_name);

            $user->id = $generateId;

            ////////////////////////////////
            // End Generate the unique id //
            ////////////////////////////////

            if ($this->Users->save($user)) {
                $this->Flash->success(__('You have successfully added the following account: {0} {1}', $user->f_name, $user->l_name));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $role = null)
    {
        if ($role === null) {
            return $this->redirect(['action' => 'index']);
        }
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $role = null)
    {
        if ($role === null) {
            return $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        // Unassign assigned tickets
        $numTickets = $this->unassignedTickets($user);

        //Delete the user
        if ($this->Users->delete($user)) {
            if ($numTickets > 0) {
                $this->Flash->success(__('You have successfully deleted the following account: {0} {1}, #{2} tickets unassiged', $user->f_name, $user->l_name, $numTickets));
            } else {
                $this->Flash->success(__('You have successfully deleted the following account: {0} {1}, No tickets were assigned to this user', $user->f_name, $user->l_name));
            }
        } else {
            $this->Flash->error(__('There was an error deleting the following account: {0} {1}. If the issue persists please contact your network administrator.', $user->f_name, $user->l_name));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Unassign tickets method
     *
     * @param \App\Controller\User|null $user User id.
     * @return \App\Controller\amount of tickets
     * @throws N/A
     */
    public function unassignedTickets($user = null)
    {
//        debug($user);

        // Get all tickets related to the user about to be deleted
        $tickets = $this->Users->Tickets->find()
            ->where([
                'Tickets.staff_id' => $user->id,
            ])
            ->all();

//        debug($tickets);

        //Checks first if the query returns any result and if so:
        //Loop through the tickets array object, change ticket to null, save it.
        if (count($tickets) > 0) {
            foreach ($tickets as $ticket) {
                $ticket->staff_id = null;
                $this->Users->Tickets->save($ticket);
            }
        } else {
            //No tickets
            return 0;
        }

        return count($tickets);
//        debug($tickets);
//        exit;
    }
}
