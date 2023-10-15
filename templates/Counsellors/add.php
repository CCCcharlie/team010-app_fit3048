<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Counsellor $counsellor
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */
?>
<div class="row">
    <aside class="column">
    </aside>
    <div class="container-fluid dashboard-content">
        <div class="counsellors form content">
            <?php
            /**
             * @var \App\View\AppView $this
             * @var \App\Model\Entity\Counsellor $counsellor
             * @var \Cake\Collection\CollectionInterface|string[] $customers
             */
            ?>

            <!doctype html>
            <html lang="en">

            <head>
                <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>GamBlock® - Customer Management: Counsellors</title>
                <!-- Bootstrap CSS -->
                <!-- In-built CSS -->
                <?= $this->Html->css(['style', 'bootstrap.min',]) ?>
                <?= $this->Html->css(['style', 'error',]) ?>
                <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>
                <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
            </head>

            <body>
            <div class="column-responsive column-80">
                <div class="counsellors form content">
                    <div class="card">
                        <h5 class="card-header">
                            <legend><?= __('Add Counsellor for customer: ' . $fullName) ?></legend>
                        </h5>
                        <?= $this->Form->create($counsellor) ?>
                        <div class="card-body">
                            <fieldset>
                                <div class="form-group">
                                    <?= $this->Form->label('f_name', 'First Name*', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('f_name', [
                                        'class' => '',
                                        'maxlength' => 32, // Maximum of 32 characters
                                        'size' => 32,
                                        'required' => true,
                                        'title' => 'Please enter your first name using letters and hyphens only',
                                        'pattern' => '^[A-Za-z-]+$',
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "First name cannot start with a space" : "")',
                                    ]) ?>

                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('f_name'); ?>

                                    <small class="form-text text-muted">Letters and hyphens only.</small>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('l_name', 'Last Name*', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('l_name', [
                                        'class' => '',
                                        'maxlength' => 32, // Maximum of 32 characters
                                        'size' => 32,
                                        'required' => true,
                                        'title' => 'Please enter your last name using letters and hyphens only',
                                        'pattern' => '^[A-Za-z-]+$',
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Last name cannot start with a space" : "")'
                                    ]) ?>
                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('l_name'); ?>

                                    <small class="form-text text-muted">Letters and hyphens only.</small>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('phone', 'Phone Number', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('phone', [
                                        'class' => '', 'maxlength' => 20,
                                        'size' => 20,
                                        'placeholder' => '(+61) 123-456-789',
                                        'pattern' => '\(\+\d{2}\) \d{3}-\d{3}-\d{3}', // Ensures its this format
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? Notes cannot start with a space" : "")'
                                    ]) ?>
                                    <!-- Display validation error for the 'contact' field -->
                                    <?= $this->Form->error('phone'); ?>
                                    <small class="form-text text-muted">Please follow the format: "(+61) 123-456-789"</small>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('email', 'Email Address', ['class' => 'blue-label-text']) ?>
                                    <?= $this->Form->input('email', [
                                        'class' => 'form-control',
                                        'placeholder' => 'name@mail.com',
                                        'type' => 'email',
                                        'pattern' => '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}',
                                        'title' => 'Please enter a valid email address with a domain (e.g., name@mail.com)',
                                        'maxlength' => 320, // Maximum of 320 characters
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Email cannot start with a space" : "")',
                                    ]) ?>
                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('email'); ?>
                                    <small class="form-text text-muted">Please enter a valid email address.</small>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('notes', 'Notes', ['class' => 'blue-label-text']) ?>
                                    <?= $this->Form->textarea(
                                        'notes',
                                        [
                                            'class' => 'form-control',
                                            'title' => 'Add any notes here',
                                            'placeholder' => 'e.g., Counsellor has ..... .',
                                            'maxlength' => 150,
                                            'rows' => 2, // Adjust the number of rows to control the initial height
                                            'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Notes cannot start with a space" : "")',
                                        ]
                                    ) ?>
                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('notes'); ?>
                                    <small class="form-text text-muted">500 Character limit. Not Required</small>
                                </div>
                            </fieldset>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <?= $this->Html->link(__('Go Back'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-secondary']) ?>
                                </div>
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>

            <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
            <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>

            </body>

            </html>
