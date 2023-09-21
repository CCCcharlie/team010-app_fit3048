<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */

//$this->disableAutoLayout();
// Test.
?>

<!doctype html>
<html lang="en">


<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Tickets</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min',]) ?>
    <?= $this->Html->css(['style', 'error',]) ?>
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

</head>

<body>

<div class="tickets add content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
            </div>
            <div class="card">
                <h5 class="card-header">
                    <legend><?= __('Add Ticket for customer: ' . $fullName) ?></legend>
                </h5>
                <div class="card-body">
                    <div class="column-responsive column-80">
                        <div class="tickets form content">
                            <?= $this->Form->create($ticket) ?>
                            <fieldset>
                                <div class="form-group">
                                    <?= $this->Form->label('title', 'Title', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('title', [
                                        'class' => 'form-control',
                                        'maxlength' => 50, // Maximum of 50 characters
                                        'placeholder' => 'e.g. MacOS Update issue',
                                        'required' => true,
                                        'title' => 'Please enter a title (maximum 50 characters)',
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Title cannot start with a space" : "")',
                                    ]) ?>
                                    ]) ?>
                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('title'); ?>

                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('type', 'Type', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->input('type', [
                                        'class' => 'form-control',
                                        'maxlength' => 30, // Maximum of 30 characters
                                        'placeholder' => 'e.g. Update Issues',
                                        'required' => true,
                                        'title' => 'Please enter a type (maximum 30 characters)',
                                        'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Type cannot start with a space" : "")',
                                    ]) ?>
                                    <!-- Display validation error for the 'f_name' field -->
                                    <?= $this->Form->error('type'); ?>

                                </div>
                                <!-- Uncomment and style the following controls as needed -->
                                <!--
    <div class="form-group">
        <?= $this->Form->label('createtime', 'Create Time', ['class' => 'col-form-label']) ?>
        <?= $this->Form->input('createtime', ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->label('closetime', 'Close Time', ['class' => 'col-form-label']) ?>
        <?= $this->Form->input('closetime', ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->label('closed', 'Closed', ['class' => 'col-form-label']) ?>
        <?= $this->Form->input('closed', ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->label('cust_id', 'Customer', ['class' => 'col-form-label']) ?>
        <?= $this->Form->input('cust_id', ['class' => 'form-control', 'options' => $customers]) ?>
    </div>
    -->
                                <div class="form-group">
                                    <?= $this->Form->label('staff_id', 'Staff', ['class' => 'col-form-label']) ?>
                                    <?php echo $this->Form->control('staff_id', ['options' => $users, 'label' => false]); ?>
                                </div>
                            </fieldset>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <?= $this->Form->create(null, ['url' => ['controller' => 'Customers', 'action' => 'view', $custId]]) ?>
                                <?= $this->Html->link(__('Return to Customer'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-secondary']) ?>
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        Copyright © GamBlock®. All rights reserved. This site is for access by GamBlock® Staff Only.
                        Template by <a href="https://colorlib.com/wp/">Colorlib</a>.
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <!--                                        <div class="text-md-right footer-links d-none d-sm-block">-->
                        <!--                                            <a href="javascript: void(0);">Documentation</a>-->
                        <!--                                            <a href="javascript: void(0);">Contact Points</a>-->
                        <!--                                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
<?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>
</html>
