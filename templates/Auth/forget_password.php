<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'login';
$this->assign('title', 'Forget Password');
?>

<div class="splash-container login">
    <div class="card">
        <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="/img/cake-logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>

        <div class="column column-50 column-offset-25">

            <div class="card-body">
                <div class="form-group">
                <?= $this->Form->create() ?>

                <fieldset>

                    <legend>Forget Password</legend>

                    <?= $this->Flash->render() ?>

                    <p>Enter your email address registered with our system below to reset your password: </p>

                    <?php
                    echo $this->Form->control('email', [
                        'type' => 'email',
                        'required' => true,
                        'autofocus' => true,
                        'label' => false,
                         'class' => 'form-control form-control-lg'
                    ]);
                    ?>

                </fieldset>

                <?= $this->Form->button('Send verification email',['class' => 'btn btn-primary btn-lg btn-block']) ?>
                <?= $this->Form->end() ?>

                <hr class="hr-between-buttons">

                <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline']) ?>

            </div>
            </div>
        </div>
    </div>
</div>
