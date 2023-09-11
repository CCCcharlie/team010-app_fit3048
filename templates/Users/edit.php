<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

//$this->disableAutoLayout();

?>

<!doctype html>
<html lang="en">


<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Customers</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min',]) ?>
    <?= $this->Html->css(['style', 'error',]) ?>
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>





</head>

<body>
    <div class="users edit content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="section-block" id="basicform">
                </div>
                <div class="card">
                    <h5 class="card-header">Edit User</h5>
                    <div class="card-body">
                        <?= $this->Form->create($user) ?>
                        <fieldset>
                            <legend><?= __('Edit User') ?></legend>
                            <div class="form-group">
                                <?= $this->Form->label('f_name', 'First Name', ['class' => 'col-form-label']) ?>
                                <?= $this->Form->input('f_name', [
                                    'class' => 'form-control',
                                    'maxlength' => 32,
                                    'required' => true,
                                    'title' => 'Please enter the first name using letters apostrophes and hyphens only',
                                    'pattern' => '^[A-Za-z-]+$'
                                ]) ?>
                                <!-- Display validation error for the 'f_name' field -->
                                <?= $this->Form->error('f_name'); ?>

                                <small class="form-text text-muted">Letters and hyphens only.</small>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->label('l_name', 'Last Name', ['class' => 'col-form-label']) ?>
                                <?= $this->Form->input('l_name', [
                                    'class' => 'form-control',
                                    'maxlength' => 32,
                                    'required' => true,
                                    'title' => 'Please enter the last name using letters, apostrophes and hyphens only',
                                    'pattern' => '^[A-Za-z-]+$'
                                ]) ?>
                                <!-- Display validation error for the 'f_name' field -->
                                <?= $this->Form->error('l_name'); ?>

                                <small class="form-text text-muted">Letters and hyphens only.</small>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->label('email', 'Email Address') ?>
                                <?= $this->Form->input('email', [
                                    'class' => 'form-control',
                                    'placeholder' => 'name@mail.com',
                                    'type' => 'email',
                                    'required' => true,
                                    'title' => 'Please enter a valid email address',
                                    'maxlength' => 320
                                ]) ?>
                                <!-- Display validation error for the 'f_name' field -->
                                <?= $this->Form->error('email'); ?>

                                <small class="form-text text-muted">Please enter a valid email address.</small>
                            </div>
                            <div class="form-group">
                                <?= $this->Html->link(__('Send forget password e-mail'), ['controller' => 'Auth', 'action' => 'forget_Password'], ['class' => 'btn btn-primary']) ?>
                            </div>

<!--                                <div class="form-group" style="display: flex; align-items: center;">-->
<!--                                    --><?php //= $this->Form->label('Set User As Admin?', null, ['class' => 'col-form-label', 'style' => 'margin-right: 10px;']) ?>
<!--                                    --><?php //= $this->Form->control('admin_status', ['label' => false, 'class' => 'form-control']) ?>
<!--                                </div>-->

                            <div class="form-group" style="display: flex; align-items: center;">
                                <?= $this->Form->label('Staff Role Privileges', null, ['class' => 'col-form-label', 'style' => 'margin-right: 10px;']) ?>
                                <?=
                                $this->Form->control('role', [
                                    'type' => 'select',
                                    'options' => $role_choice,
                                    'label' => false,
                                ]); ?>
                            </div>

                        </fieldset>
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
    <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>

</body>
</html>
