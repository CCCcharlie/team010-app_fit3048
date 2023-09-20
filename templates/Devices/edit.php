<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 * @var string[]|\Cake\Collection\CollectionInterface $customers
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

                <div class="column-responsive column-80">
                    <div class="commdetails form content">
                        <div class="card">

                            <h5 class="card-header"> <legend><?= __('Add Device Details details for: ' . $fullName) ?></legend></h5>
                            <?= $this->Form->create($device) ?>
                            <div class="card-body">
                                <p> No fields here are mandatory.</p>
                                <fieldset>
                                    <div class="form-group">
                                        <?= $this->Form->label('transactionid', 'Transaction ID', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->control('transactionid', ['class' => 'form-control',  'maxlength' => 19, 'label' => false, 'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Transaction ID cannot start with a space" : "")']) ?>
                                        <!-- Display validation error for the 'f_name' field -->
                                        <?= $this->Form->error('transactionid'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $this->Form->label('device_model', 'Device Model', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->control('device_model', ['class' => 'form-control',  'maxlength' => 54, 'label' => false, 'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Device Model cannot start with a space" : "")']) ?>
                                        <!-- Display validation error for the 'f_name' field -->
                                        <?= $this->Form->error('device_model'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $this->Form->label('technical_details', 'Technical Details', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->control('technical_details', ['class' => 'form-control',  'maxlength' => 150, 'label' => false, 'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Technical Details cannot start with a space" : "")']) ?>
                                        <!-- Display validation error for the 'f_name' field -->
                                        <?= $this->Form->error('technical_details'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $this->Form->label('platform', 'Platform', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->control('platform', ['class' => 'form-control',  'maxlength' => 20, 'label' => false, 'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "Platform cannot start with a space" : "")']) ?>
                                        <!-- Display validation error for the 'f_name' field -->
                                        <?= $this->Form->error('platform'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $this->Form->label('gamblock_ver', 'GamBlock Version', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->control('gamblock_ver', ['class' => 'form-control',  'maxlength' => 30, 'label' => false, 'oninput' => 'this.setCustomValidity(this.value.charAt(0) === " " ? "GamBlock Version cannot start with a space" : "")']) ?>
                                        <!-- Display validation error for the 'f_name' field -->
                                        <?= $this->Form->error('gamblock_ver'); ?>
                                    </div>
                                </fieldset>
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <?= $this->Html->link(__('Return to Customer'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-secondary']) ?>
                                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                                </div>
                                <?= $this->Form->end() ?>
                            </div>
                            </div>
                    </div>
                </div>



        <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
        <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>

</body>

</html>
<!--    <div class="column-responsive column-80">-->
<!--        <div class="devices form content">-->
<!--            --><?php //= $this->Form->create($device) ?>
<!--            <fieldset>-->
<!--                <legend>--><?php //= __('Edit Device for customer: ' . $fullName ) ?><!--</legend>-->
<!--                --><?php
//                    echo $this->Form->control('transactionid');
//                    echo $this->Form->control('device_model');
//                    echo $this->Form->control('sessionid');
//                    echo $this->Form->control('technical_details');
//                    echo $this->Form->control('platform');
//                    echo $this->Form->control('gamblock_ver');
////                    echo $this->Form->control('cust_id', ['options' => $customers]);
//                ?>
<!--            </fieldset>-->
<!--            --><?php //= $this->Form->button(__('Submit')) ?>
<!--            --><?php //= $this->Form->end() ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
