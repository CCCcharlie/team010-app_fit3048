<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */

?>

<!doctype html>
<html lang="en">


<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Add Customers</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min',]) ?>
    <?= $this->Html->css(['style', 'error',]) ?>
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">




</head>

<body>

        </aside>
        <div class="customers add content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                    </div>
                    <div class="card">
                        <h5 class="card-header" style="color: midnightblue">Add a New Customer</h5>
                        <div class="card-body">
                            <?= $this->Form->create($customer, ['onsubmit' => 'return validateEmail();']) ?>
                            <div class="form-group">
                                <?= $this->Form->label('f_name', 'First Name*', ['class' => 'col-form-label blue-label-text']) ?>
                                <?= $this->Form->input('f_name', [
                                    'class' => 'form-control',
                                    'maxlength' => 32, // Maximum of 32 characters
                                    'required' => true,
                                    'title' => 'Please enter your first name using letters, hyphens and apostrophes only',
                                    'pattern' => '^[A-Za-z-]+$',
                                    'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "First name cannot start with a space" : "")',]) ?>
                                <!-- Display validation error for the 'f_name' field -->
                                <?= $this->Form->error('f_name'); ?>
                                <small class="form-text text-muted">Letters, hyphens and apostrophes only.</small>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->label('l_name', 'Last Name*', ['class' => 'col-form-label blue-label-text']) ?>
                                <?= $this->Form->input('l_name', [
                                    'class' => 'form-control',
                                    'maxlength' => 32, // Maximum of 32 characters
                                    'required' => true,
                                    'title' => 'Please enter your last name using letters and hyphens only',
                                    'pattern' => '^[A-Za-z-]+$',
                                'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Last name cannot start with a space" : "")',
                                ]) ?>
                                <!-- Display validation error for the 'f_name' field -->
                                <?= $this->Form->error('l_name'); ?>
                                <small class="form-text text-muted">Letters, hyphens and apostrophes only.</small>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->label('email', 'Email Address*', ['class' => 'blue-label-text']) ?>
                                <?= $this->Form->input('email', [
                                    'class' => 'form-control',
                                    'placeholder' => 'name@mail.com',
                                    'type' => 'email',
                                    'required' => true,
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
                                <?= $this->Form->label('status', 'Status*', ['class' => 'blue-label-text']) ?>
                                <div class="input-group">
                                    <?= $this->Form->select(
                                        'status',
                                        ['resolved' => 'Issue resolved', 'not_resolved' => 'Issue not resolved', 'no_issues' => 'No Issues Recorded'],
                                        [
                                            'class' => 'custom-select select-with-arrow', // Add 'select-with-arrow' class
                                            'label' => false
                                        ]
                                    ) ?>
                                </div>
                                <!-- Display validation error for the 'f_name' field -->
                                <?= $this->Form->error('status'); ?>
                                <small class="form-text text-muted">Required</small>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->label('notes', 'Notes', ['class' => 'blue-label-text']) ?>
                                <?= $this->Form->textarea(
                                    'notes',
                                    [
                                        'class' => 'form-control',
                                        'title' => 'Add any notes here',
                                        'placeholder' => 'e.g., Tendency to contact using FB and Instagram under different names.',
                                        'maxlength' => 500,
                                        'rows' => 5, // Adjust the number of rows to control the initial height
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Notes cannot start with a space" : "")',
                                    ]
                                ) ?>

                                <!-- Display validation error for the 'f_name' field -->
                                <?= $this->Form->error('notes'); ?>
                                <small class="form-text text-muted">500 Character limit. Not Required</small>
                            </div>


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


        <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
        <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>


</body>
