<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 * @var string[]|\Cake\Collection\CollectionInterface $users
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
                        <h5 class="card-header"><legend><?= __('Edit Ticket for customer: ' . $fullName) ?></legend></h5>
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
                                                'title' => 'Please enter a title (maximum 50 characters)',
                                                'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Title cannot start with a space" : "")',
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
                                                'title' => 'Please enter a type (maximum 30 characters)',
                                                'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Type cannot start with a space" : "")',
                                            ]) ?>
                                            <!-- Display validation error for the 'type' field -->
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
                                            <?= $this->Form->label('staff_id', 'Staff*', ['class' => 'col-form-label']) ?>
                                            <?php echo $this->Form->control('staff_id', ['options' => $users, 'label'=>false]); ?>
                                        </div>
                                    </fieldset>
                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <?= $this->Html->link(__('Return to Customer'), isset($custId)
                                            ? ['controller' => 'Customers', 'action' => 'view', $custId]
                                            : ['controller' => 'Tickets', 'action' => 'unassigned'],
                                            ['class' => 'btn btn-rounded btn-secondary']) ?>

                                        <div class="d-flex">
                                            <div class="row">
                                                <div class ="col-6">
                                                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary', 'style' => 'width: 100px; margin-right: 30px; margin-left: 90px']) ?>
                                                </div>
<!--                                                <div class = "col-6">-->
<!--                                                    --><?php //= $this->Html->link(__('Undo Changes'), ['action' => 'undo', $ticket->id, '?' => ['originalData' => $originalData]], ['class' => 'btn btn-warning', 'style' => 'width: 150px; margin-top: 20px']); ?>
<!--                                                </div>-->
        <!--              undo originalData not passing            debug($originalData);           -->
        <!--                                      --><?php //=  $this->getRequest()->getSession()->write('originalData', $originalData);?>

                                            </div>
                                    </div>
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
