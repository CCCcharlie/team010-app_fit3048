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

            <div class="users add content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                        </div>
                        <div class="card">
                            <h5 class="card-header">Add a New User</h5>
                            <div class="card-body">
                                <?= $this->Form->create($user, ['onsubmit' => 'return validateEmail();']) ?>
                                <div class="form-group">
                                    <?= $this->Form->label('f_name', 'First Name', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('f_name', [
                                        'class' => 'form-control',
                                        'maxlength' => 32, // Maximum of 32 characters
                                        'required' => true,
                                        'title' => 'Please enter your first name using letters and hyphens only',
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
                                        'maxlength' => 32, // Maximum of 32 characters
                                        'required' => true,
                                        'title' => 'Please enter your last name using letters and hyphens only',
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
                                        'pattern' => '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}',
                                        'title' => 'Please enter a valid email address with a domain (e.g., name@mail.com)',
                                        'maxlength' => 320 // Maximum of 320 characters
                                    ]) ?>
                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('email'); ?>

                                    <small class="form-text text-muted">Please enter a valid email address.</small>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('password', 'Password') ?>
                                    <?= $this->Form->input('password', [
                                        'class' => 'form-control',
                                        'required' => true,
                                        'title' => 'Please enter a password (at least 8 characters with at least one number)',
                                        'maxlength' => 124, // Maximum of 124 characters
                                        'pattern' => '(?=.*\d).{8,}', // At least 8 characters with at least one number
                                    ]) ?>
                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('password'); ?>

                                    <small class="form-text text-muted">At least 8 characters with at least one number.</small>
                                </div>

                                <small class="text-muted" style="font-style: italic;">Please note: Setting a user to Admin will give them control over ALL other accounts. Including this one. Use this sparingly.</small>
<!--                                    <div class="form-group" style="display: flex; align-items: center;">-->
<!--                                        --><?php //= $this->Form->label('Set User As Admin?', null, ['class' => 'col-form-label', 'style' => 'margin-right: 10px;']) ?>
<!--                                        --><?php //= $this->Form->control('admin_status', ['label' => false, 'class' => 'form-control']) ?>
<!--                                    </div>-->

                                <div class="form-group" style="display: flex; align-items: center;">
                                    <?= $this->Form->label('Staff Role Privileges', null, ['class' => 'col-form-label', 'style' => 'margin-right: 10px;']) ?>
                                    <?=
                                    $this->Form->control('role', [
                                        'type' => 'select',
                                        'options' => $role_choice,
                                        'label' => false,
                                    ]); ?>
                                </div>

                                <h1> REMOVE ROOT OPTION FROM USERS (staff member) CONTROLLER WHEN WE ABOUT TO DEPLOY THIS, ALSO REMOVE THIS TEXT</h1>

                                <br>
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
                                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                                </div>
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
