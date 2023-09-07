<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$debug = Configure::read('debug');

$this->layout = 'login';
$this->assign('title', 'Login');
?>

<style>
    /*<!-- This line of code is what is responsible for shrinking the image based on size -->*/
    img {
        max-width: 100%;
        height: auto;
        width: auto\9; /* ie8 */
    }
</style>

<div class="splash-container login">
    <!-- ============================================================== -->
    <!-- Flash rendering -->
    <!-- ============================================================== -->
    <?php
    // Check if the flash message exists and has content
    $flashMessage = $this->Flash->render();
    if (!empty($flashMessage)) {
        ?>
        <!-- Flash message, ONLY shows up if ticket is successfully opened/closed -->
        <?= $flashMessage; ?>
        <?php
    }
    ?>
    <!-- ============================================================== -->

    <div class="card" style="width: 100%; height: 100%">

        <div class="card-header text-center" style="height: 150%"><img class="logo-img" src="/img/cake-logo.png" alt="logo"><span class="splash-description">Please enter your user information.</span></div>
        <title>GamBlock® - Customer Management</title>

        <div class="card-body">
<!--    <div class="row">-->
<!--        <div class="column column-50 column-offset-25">-->
            <div class=" form-group">


                <?= $this->Form->create(null, ['id' => 'login']); ?>

                <fieldset>
                    <legend>GamBlock® Login</legend>

                    <?= $this->Flash->render() ?>

                    <?php
                    // Display the login form
                    echo $this->Form->create(null, ['id' => 'login']);
                    $lockoutEndTime = $this->request->getSession()->read('login_timeout_end');
                    $currentTime = time();

                    if ($lockoutEndTime && $lockoutEndTime > $currentTime) {
                        // If the user is locked out, display a message and hide the form fields
                        echo '<p>Too many unsuccessful attempts. You are locked out for a while.</p>';
                        echo '<p id="countdown"></p>';
                        echo $this->Form->hidden('email', ['value' => '']); // Hide email input
                        echo $this->Form->hidden('password', ['value' => '']); // Hide password input

                        // Add the "Forgot Password?" link
                        echo $this->Html->link('Forgot password?', ['controller' => 'Auth', 'action' => 'forgetPassword'], ['class' => 'button button-outline']);
                    } else {
                        // If not locked out or lockout period has expired, display the form fields and the login button
                        echo $this->Form->control('email', [
                            'type' => 'email',
                            'required' => true,
                            'maxlength' => 320,
                            'autofocus' => true,
                            'value' => $debug ? "test@example.com" : "",
                            'class' => 'form-control form-control-lg'
                        ]);
                        echo $this->Form->control('password', [
                            'type' => 'password',
                            'required' => true,
                            'class' => 'form-control form-control-lg',
                            'value' => $debug ? 'password' : '',
                            'maxlength' => 124,
                        ]);

                        if (!$lockoutEndTime || $lockoutEndTime <= $currentTime) {
                            // Display the login button if not locked out or lockout period has expired
                            echo $this->Form->button('Login', [
                                'class' => 'btn btn-primary btn-lg btn-block g-recaptcha',
                                'data-sitekey' => '6LcY690nAAAAAI-KdpmOX7CKkwjXw-8Eg5pvNmlN',
                                'data-callback' => 'onSubmit',
                                'data-action' => 'submit'
                            ]);
                        }
                    }
                    echo $this->Form->end();
                    ?>

                    <!-- Display the countdown timer -->


                    <script>
                        // Function to update the countdown timer and refresh the page when it reaches 0
                        function updateCountdown() {
                            const countdownElement = document.getElementById('countdown');
                            const lockoutEndTime = <?= json_encode($lockoutEndTime) ?>;
                            const currentTime = Math.floor(Date.now() / 1000); // Get current time in seconds

                            if (lockoutEndTime && lockoutEndTime > currentTime) {
                                const remainingTime = lockoutEndTime - currentTime;
                                const minutes = Math.floor(remainingTime / 60);
                                const seconds = remainingTime % 60;
                                countdownElement.innerHTML = `Remaining lockout time: ${minutes}m ${seconds}s`;
                            } else {
                                countdownElement.innerHTML = 'Refreshing page...'; // Display a message
                                clearInterval(countdownInterval); // Stop the countdown interval
                                setTimeout(() => {
                                    location.href = location.href; // Refresh the page after a delay
                                }, 2000); // Adjust the delay (in milliseconds) as needed
                            }
                        }

                        // Call the updateCountdown function initially and every second using setInterval
                        const countdownInterval = setInterval(updateCountdown, 1000); // Update every second
                    </script>




                </fieldset>

                <hr class="hr-between-buttons">

<!--                --><?php //= $this->Html->link('Register new user', ['controller' => 'Auth', 'action' => 'register'], ['class' => 'button button-clear']) ?>
<!--                --><?php //= $this->Html->link('Go to Homepage', '/', ['class' => 'button button-clear']) ?>

    </div>


</div>
       <?php $this->start('footer_script'); ?>

        <?= $this->Html->script('jquery-3.3.1.min.js', ['block' => true]) ?>
        <?= $this->Html->script('bootstrap.bundle.js', ['block' => true]) ?>

<script src="https://www.google.com/recaptcha/api.js"></script>


<script>
    function onSubmit(token) {
        document.getElementById('login').submit();
    }
</script>


<?php $this->end(); ?>

