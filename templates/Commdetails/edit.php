<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commdetail $commdetail
 * @var string[]|\Cake\Collection\CollectionInterface $customers
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
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


</head>

<body>
        <div class="column-responsive column-80">
            <div class="commdetails form content">
                <div class="card">

                    <h5 class="card-header"> <legend><?= __('Edit Communication details for: ' . $fullName) ?></legend></h5>
                    <?= $this->Form->create($commdetail) ?>
                    <div class="card-body">
                        <fieldset>
                            <p> You have the ability to make multiple Communication Details in a row here. Hit 'Return to Customer' when done.</p>


                            <div class="form-group">
                                <?= $this->Form->label('type', 'Type', ['class' => 'col-form-label']) ?>
                                <?= $this->Form->input('type', ['class' => 'form-control', 'maxlength' => 100, 'required' => true, 'placeholder' => 'e.g. Facebook, Instagram, Phone, Fax, E-mail...']) ?>
                                <!-- Display validation error for the 'f_name' field -->
                                <?= $this->Form->error('type'); ?>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->label('link', 'Link', ['class' => 'col-form-label']) ?>
                                <?= $this->Form->input('link', ['class' => 'form-control', 'maxlength' => 500, 'required' => true, 'placeholder' =>'e.g. https://www.facebook.com/GamBlock/']) ?>
                                <!-- Display validation error for the 'f_name' field -->
                                <?= $this->Form->error('link'); ?>
                            </div>
                            <!-- Uncomment and style the following controls as needed -->
                            <!--
            <div class="form-group">
                <?= $this->Form->label('cust_id', 'Customer', ['class' => 'col-form-label']) ?>
                <?= $this->Form->input('cust_id', ['class' => 'form-control', 'options' => $customers]) ?>
            </div>
            -->
                        </fieldset>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <?= $this->Html->link(__('Go Back'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-secondary']) ?>
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div></div>
            </div>
        </div>

        <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
        <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>

</body>
</html>
