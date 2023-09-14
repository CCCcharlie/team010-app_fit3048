<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Counsellor $counsellor
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Counsellors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
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
                                    <?= $this->Form->input('f_name', ['class' => 'form-control']) ?>
                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('f_name'); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('l_name', 'Last Name', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('l_name', ['class' => 'form-control']) ?>
                                    <!-- Display validation error for the 'l_name' field -->
                                    <?= $this->Form->error('l_name'); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('notes', 'Notes', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('notes', ['class' => 'form-control']) ?>
                                    <!-- Display validation error for the 'notes' field -->
                                    <?= $this->Form->error('notes'); ?>
                                </div>
                                <!-- Uncomment and style the following controls as needed -->
                                <!--
    <div class="form-group">
        <?= $this->Form->label('cust_id', 'Customer', ['class' => 'col-form-label']) ?>
        <?= $this->Form->input('cust_id', ['class' => 'form-control', 'options' => $customers]) ?>
    </div>
    -->
                                <div class="form-group">
                                    <?= $this->Form->label('contact', 'Contact', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('contact', ['class' => 'form-control']) ?>
                                    <!-- Display validation error for the 'contact' field -->
                                    <?= $this->Form->error('contact'); ?>
                                </div>
                            </fieldset>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <?= $this->Html->link(__('Return to Customers'), ['controller' => 'Customers', 'action' => 'index'], ['class' => 'btn btn-rounded btn-secondary']) ?>
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
