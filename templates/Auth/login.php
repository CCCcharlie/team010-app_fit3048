<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$debug = Configure::read('debug');

$this->layout = 'login';
$this->assign('title', 'Login');
?>
<div class="splash-container login">

    <div class="card ">
        <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="/img/cake-logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
        <title>GamBlock® - Customer Management</title>
        <div class="card-body">
<!--    <div class="row">-->
<!--        <div class="column column-50 column-offset-25">-->
            <div class=" form-group">

                <?= $this->Form->create() ?>

                <fieldset>

                    <legend>GamBlock® Login</legend>

                    <?= $this->Flash->render() ?>

                    <?php
                    /*
                     * NOTE: regarding 'value' config in the login page form controls
                     * In this demo the email and password fields will be filled by demo account
                     * credentials when debug mode is on. You should NOT do that in your production
                     * systems. Also it's a good practice to clear (set password value to empty)
                     * in the view so when an error occurred with form validation, the password
                     * values are always cleared.
                     */
                    echo $this->Form->control('email', [
                        'type' => 'email',
                        'required' => true,
                        'autofocus' => true,
                        'value' => $debug ? "test@example.com" : "",
                        'class' => 'form-control form-control-lg'
                    ]);
                    echo $this->Form->control('password', [
                        'type' => 'password',
                        'required' => true,
                        'class' => 'form-control form-control-lg',
                        'value' => $debug ? 'password' : ''
                    ]);
                    ?>
                </fieldset>

                <?= $this->Form->button('Login',['class' => 'btn btn-primary btn-lg btn-block']) ?>
                <?= $this->Html->link('Forgot password?', ['controller' => 'Auth', 'action' => 'forgetPassword'], ['class' => 'button button-outline']) ?>
                <?= $this->Form->end() ?>

                <hr class="hr-between-buttons">

                <?= $this->Html->link('Register new user', ['controller' => 'Auth', 'action' => 'register'], ['class' => 'button button-clear']) ?>
                <?= $this->Html->link('Go to Homepage', '/', ['class' => 'button button-clear']) ?>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
        <?php $this->start('footer_script'); ?>
        <script>
            <script src="/webroot/js/jquery-3.3.1.min.js"></script>
        <script src="/webroot/js/bootstrap.bundle.js"></script>
        </script>
        <?php $this->end(); ?>

