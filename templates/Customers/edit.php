<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */

//$this->disableAutoLayout();
?><!doctype html>
<html lang="en">


<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Edit Customers</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min',]) ?>
    <?= $this->Html->css(['style', 'error',]) ?>
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <style>
        ul li:hover {
            background-color: #ddd;
            border-color: #aaa;
        }
    </style>
</head>

<body>

<div class="customers edit content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <!-- To obtain the identity, use $identity = $this->request->getAttribute('authentication')->getIdentity(); to find the currently logged in entity
                to get the name or any value in the staff table, use the get and then the name of the attribute $identity->get('staff_fname')-->
                <?php $identity = $this->request->getAttribute('authentication')->getIdentity();
                //                        debug($identity->get('f_name'));
                //                        exit();
                ?>
                <!-- Can you add login user to name here if you get chance Bryan?  -->
                <!-- Sure Alex-->

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding-bottom: 100px">
            <!--                    <div style="position: sticky; top: 0px; float: right; background-color: #f5f5f5; padding: 20px; width: 250px;">-->
            <!--                        <ul style="padding: 0; margin: 0; list-style: none;">-->
            <!--                            <h4>Actions:</h4>-->
            <!--                            <li>-->
            <?php //= $this->Form->postLink(__('> Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id), 'style' => 'display: block; padding: 10px 0; text-decoration: none; color: #333; border: 1px solid transparent; transition: border-color 0.3s ease;']) ?><!--</li>-->
            <!--                        </ul>-->
            <!--                    </div>-->

            </aside>
            <div class="row">
                <!-- ============================================================== -->
                <!-- profile -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- ============================================================== -->
                    <!-- card profile -->
                    <!-- ============================================================== -->
                    <div class="card">
                        <div class="card-body">
                            <div class="user-avatar text-center d-block">
                                <img src="/img/avatar-1.png" alt="User Avatar">
                            </div>
                            <?= $this->Form->create($customer) ?>
                            <div class="card-body border-top" style="">
                                <h3 class="font-16">Name:</h3>
                                <div class="text-center">

                                        <?= $this->Form->input('f_name', [
                                            'class' => '',
                                            'text-align' => 'center',
                                            'maxlength' => 32,
                                            'required' => true,
                                            'title' => 'Please enter your first name using letters, hyphens, and apostrophes only',
                                            'pattern' => '^(?! )[A-Za-z-]+$',
                                            'label' => 'First Name*',
                                            'label' => ['class' => 'col-form-label blue-label-text']
                                        ]) ?>

                                        <?= $this->Form->input('l_name', [
                                            'class' => '',
                                            'text-align' => 'center',
                                            'maxlength' => 32,
                                            'required' => true,
                                            'title' => 'Please enter your last name using letters and hyphens only',
                                            'pattern' => '^(?! )[A-Za-z-]+$',
                                            'label' => 'Last Name*',
                                            'label' => ['class' => 'col-form-label blue-label-text']
                                        ]) ?>
                                </div>
                            </div>

                            <div class="card-body border-top">
                                <h3 class="font-16">Status:</h3>
                                <div class="input-group">
                                    <?= $this->Form->select(
                                        'status',
                                        ['resolved' => 'Issue resolved', 'unresolved' => 'Issue unresolved', 'no_issues' => 'No Issues Recorded'],
                                        [
                                            'class' => 'custom-select select-with-arrow', // Add 'select-with-arrow' class
                                            'label' => false
                                        ]
                                    ) ?>
                                </div>
                            </div>


                            <!-- Email Address Field -->
                            <div class="card-body border-top">
                                <h3 class="font-16">Main E-Mail:</h3>
                                <div class="">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><?= $this->Form->input('email', [
                                                'class' => 'form-control',
                                                'label' => false,
                                                'placeholder' => 'name@mail.com',
                                                'type' => 'email',
                                                'required' => true,
                                                'pattern' => '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}',
                                                'title' => 'Please enter a valid email address with a domain (e.g., name@mail.com)',
                                                'maxlength' => 320
                                            ]) ?></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body border-top">
                                <h3 class="font-16">Notes:</h3>
                                <p class="mb-0"><?= $this->Form->input('notes', [
                                        'class' => 'form-control',
                                        'style' => 'height: 15rem',
                                        'type' => 'textarea',
                                        'label' => false,
                                        'title' => 'Add any notes here',
                                        'placeholder' => 'eg. Has 4 dogs.',
                                        'maxlength' => 500
                                    ]) ?></p>
                                <?= $this->Form->error('notes'); ?>
<!--                                <textarea name="notes" id="notes" class="form-control" title="Enter notes" placeholder="Notes go here.." maxlength="500" style="height: 150px;"></textarea>-->
                            </div>

                            <?= $this->Html->link(__('Return to Customer'), ['controller' => 'Customers', 'action' => 'view', $customer->id], ['class' => 'btn btn-rounded btn-secondary']) ?>

                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-rounded btn-primary', 'id' => 'submit-button']) ?>
                            <?= $this->Form->end() ?>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end card profile -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- end profile -->
                <!-- ============================================================== -->
            </div>
            <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
                <!-- ============================================================== -->
                <!-- campaign tab one -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- end data -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end content -->
    <!-- ============================================================== -->

</div>

<!--EXPLAINING THE SCRIPTS -->
<!--Concept - Template-->
<!--SlimScroll - JS Plugin. Allows for any div to be scrollable.-->
<!--Jquery  - Essential Javascript library-->
<!--Add any explinations here for any scripts you add. - Alex-->


<?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>
<?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>

<script>
    $(document).ready(function() {
        // Initial state setup
        $("#allticket").show();
        $("#closeticket").hide();
        $("#openticket").hide();


        $("input[name='options']").change(function() {
            if ($("#showallticket").is(":checked")) {
                $("#allticket").show();
                $("#closeticket").hide();
                $("#openticket").hide();
            } else if ($("#showcloseticket").is(":checked")) {
                $("#allticket").hide();
                $("#closeticket").show();
                $("#openticket").hide();
            } else if ($("#showopenticket").is(":checked")) {
                $("#allticket").hide();
                $("#closeticket").hide();
                $("#openticket").show();
            } else {
                $("#allticket").hide();
                $("#closeticket").hide();
                $("#openticket").hide();
            }
        });
    });






</script>

</body>


</html>

