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
                            <legend><?= __('Add Counsellor') ?></legend>
                        </h5>
                        <?= $this->Form->create($counsellor) ?>
                        <div class="card-body">
                            <fieldset>
                                <div class="form-group">
                                    <?= $this->Form->label('f_name', 'First Name', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('f_name', ['class' => 'form-control', 'maxlength' => 32,
                                        'placeholder' => 'First Name...',
                                        'required' => true,
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? First Name cannot start with a space" : "")']) ?>
                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('f_name'); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('l_name', 'Last Name', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('l_name', ['class' => 'form-control', 'maxlength' => 32,
                                        'placeholder' => 'Last name..',
                                        'required' => true,
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Last name cannot start with a space" : "")']) ?>
                                    <!-- Display validation error for the 'l_name' field -->
                                    <?= $this->Form->error('l_name'); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('notes', 'Notes', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('notes', ['class' => 'form-control', 'maxlength' => 150,
                                        'placeholder' => 'Notes...',
                                        'required' => false,
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? Notes cannot start with a space" : "")']) ?>
                                    <!-- Display validation error for the 'notes' field -->
                                    <?= $this->Form->error('notes'); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('contact', 'Contact Information', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('contact', ['class' => 'form-control', 'maxlength' => 500,
                                        'placeholder' => 'Phone, Email, etc.',
                                        'required' => false,
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? Notes cannot start with a space" : "")']) ?>
                                    <!-- Display validation error for the 'contact' field -->
                                    <?= $this->Form->error('contact'); ?>
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
