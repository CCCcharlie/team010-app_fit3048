<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */

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

    <style>
        /*insert style here*/
    </style>

</head>

<body>
<div class="tickets edit contents">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
            </div>
            <div class="card">
                <h5 class="card-header">
                    <legend><?= __('Edit Ticket for customer: ' . $fullName) ?></legend>
                </h5>
                <div class="card-body">
                    <div class="column-responsive column-80">
                        <div class="tickets form content">
                            <?= $this->Form->create($ticket) ?>
                            <fieldset>

                                <div class="form-group">
                                    <?= $this->Form->label('title', 'Title*', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->control('title', [
                                        'label' => false, // Prevent default label from appearing again
                                        'class' => 'form-control',
                                        'maxlength' => 50, // Maximum of 50 characters
                                        'placeholder' => 'e.g. MacOS Update issue',
                                        'required' => true,
                                        'title' => 'Please enter a title (maximum 50 characters)'
                                    ]) ?>
                                    <!-- Display validation error for the 'title' field -->
                                    <?= $this->Form->error('title'); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('type', 'Type*', ['class' => 'col-form-label']) ?>
                                    <?= $this->Form->control('type', [
                                        'label' => false, // Prevent default label from appearing again
                                        'class' => 'form-control',
                                        'maxlength' => 30, // Maximum of 30 characters
                                        'placeholder' => 'e.g. Update Issues',
                                        'required' => true,
                                        'title' => 'Please enter a type (maximum 30 characters)'
                                    ]) ?>
                                    <!-- Display validation error for the 'type' field -->
                                    <?= $this->Form->error('type'); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->label('staff_id', 'Staff*', ['class' => 'col-form-label']) ?>
                                    <?php echo $this->Form->control('staff_id', ['options' => $users, 'label' => false]); ?>
                                </div>
                            </fieldset>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <?= $this->Html->link(__('Return to Customer'), isset($custId)
                                    ? ['controller' => 'Customers', 'action' => 'view', $custId]
                                    : ['controller' => 'Tickets', 'action' => 'unassigned'],
                                    ['class' => 'btn btn-rounded btn-secondary']) ?>

                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                                <?= $this->Html->link(__('Undo Changes'), ['action' => 'undo', $ticket->id, '?' => ['originalData' => $originalData]], ['class' => 'btn btn-warning']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
