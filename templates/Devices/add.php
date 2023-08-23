<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */
$this->disableAutoLayout();
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
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top" style="display: flex; justify-content: space-between;">
            <a class="navbar-brand" href="/">
                <?= $this->Html->image('cake-logo.png', ['alt' => 'GamBlock Logo', 'class' => 'navbar-b;and', 'style' => 'width: 225px; height: auto;']); ?>
            </a>

            <?php
            $identity = $this->request->getAttribute('authentication')->getIdentity();
            ?>

            <div class="row" style="padding: 10px;">
                <div class="col-md-6 text-right">
                    <p style="margin-right: 10px;">Welcome, <?= $identity->get('f_name'); ?></p>
                </div>
                <div class="col-md-6">
                    <a href="#" class="text-right">
                        <i class="fas fa-power-off" style="margin-right: 2px;"></i>
                        <?php echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout'], ['style' => 'padding-right: 40px;']); ?>
                    </a>
                </div>

<!--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"-->
<!--                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
<!--                <span class="navbar-toggler-icon"></span>-->
<!--            </button>-->

<!--            <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
<!--                <ul class="navbar-nav ml-auto navbar-right-top">-->
<!---->
<!--                    <li class="nav-item dropdown nav-user">-->
<!--                        <a class="nav-link nav-user-file" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"-->
<!--                           aria-haspopup="true" aria-expanded="false"><img src="../assets/images/avatar-1.jpg" alt=""-->
<!--                                                                           class="user-avatar-md rounded-circle"></a>-->
<!--                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"-->
<!--                             aria-labelledby="navbarDropdownMenuLink2">-->
<!--                            <div class="nav-user-info">-->
<!--                                <h5 class="mb-0 text-white nav-user-name">-->
<!--                                    Example User</h5>-->
<!--                            </div>-->
<!--                            <a class="dropdown-item" href="#"><i-->
<!--                                    class="fas fa-power-off mr-2"></i> --><?php //echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout']); ?>
<!--                            </a>-->
<!--                        </div>-->
<!--                    </li>-->
    <!--                </ul>-->
    <!--            </div>-->
        </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Customer View</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="true"
                               data-target="#submenu-1" aria-controls="submenu-1"><i
                                    class="fa fa-fw fa-user-circle"></i>Customer Management <span
                                    class="badge badge-success">6</span></a>
                            <div id="submenu-1" class="submenu show" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers/assigntome">Assigned Customers</a>

                                        <!-- Change my link to assigned to me page when done. -->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers">View All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers/add">Add a Customer
                                            Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-divider">
                            Admin Features
                            <!-- Change to me admin only visible. -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="true" data-target="#submenu-6" aria-controls="submenu-6"><i class="fa-solid fa-user-tie"></i>Staff Management</a>
                            <div id="submenu-6" class="submenu show" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/Users/">View All Staff Accounts</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end left sidebar -->


    <!-- ============================================================== -->

    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- Flash rendering -->
            <!-- ============================================================== -->
            <?php
            // Check if the flash message exists and has content
            $flashMessage = $this->Flash->render();
            if (!empty($flashMessage)) {
                ?>
                <!-- Flash message, ONLY shows up if ticket is successfully opened/closed -->
                <div class="alert alert-success" role="alert">
                    <?= $flashMessage; ?>
                </div>
                <?php
            }
            ?>
            <!-- ============================================================== -->
            <!-- Flash rendering -->
            <?php
            // Check if the flash message exists and has content
            $flashMessage = $this->Flash->render();
            if (!empty($flashMessage)) {
                ?>
                <!-- Flash message, ONLY shows up if ticket is successfully opened/closed -->
                <div class="alert alert-success" role="alert">
                    <?= $flashMessage; ?>
                </div>
                <?php
            }
            ?>

            <div class="container-fluid dashboard-content">


                <div class="column-responsive column-80">
                    <div class="commdetails form content">
                        <div class="card">

                            <h5 class="card-header"> <legend><?= __('Add Device details for: ' . $fullName) ?></legend></h5>
                            <?= $this->Form->create($device) ?>
                            <div class="card-body">
                                <fieldset>
                                    <div class="form-group">
                                        <?= $this->Form->label('transactionid', 'Transaction ID', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->input('transactionid', ['class' => 'form-control', 'required' => true, 'maxlength' => 7, 'placeholder' => 'Transaction ID']) ?>
                                        <!-- Display validation error for the field -->
                                        <?= $this->Form->error('transactionid'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $this->Form->label('device_model', 'Device Model', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->input('device_model', ['class' => 'form-control', 'required' => true, 'maxlength' => 54, 'placeholder' => 'eg. Samsung Galaxy S9']) ?>
                                        <!-- Display validation error for the field -->
                                        <?= $this->Form->error('device_model'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $this->Form->label('sessionid', 'Session ID', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->input('sessionid', ['class' => 'form-control', 'required' => true, 'maxlength' => 23, 'placeholder' => 'Session ID']) ?>
                                        <!-- Display validation error for the field -->
                                        <?= $this->Form->error('sessionid'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $this->Form->label('technical_details', 'Technical Details', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->input('technical_details', ['class' => 'form-control', 'required' => true, 'maxlength' => 150, 'placeholder' => 'eg. Android 13 API 33']) ?>
                                        <!-- Display validation error for the field -->
                                        <?= $this->Form->error('technical_details'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $this->Form->label('platform', 'Platform', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->input('platform', ['class' => 'form-control', 'required' => true, 'maxlength' => 20, 'placeholder' => 'eg. Android/IOS/MacOS Windows']) ?>
                                        <!-- Display validation error for the field -->
                                        <?= $this->Form->error('platform'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $this->Form->label('gamblock_ver', 'GamBlock Version', ['class' => 'col-form-label']) ?>
                                        <?= $this->Form->input('gamblock_ver', ['class' => 'form-control', 'required' => true, 'maxlength' => 30, 'placeholder' => 'eg. Ver 1.1']) ?>
                                        <!-- Display validation error for the field -->
                                        <?= $this->Form->error('gamblock_ver'); ?>
                                    </div>
                                </fieldset>
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <?= $this->Html->link(__('Return to Customer'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-secondary']) ?>
                                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                                </div>
                                <?= $this->Form->end() ?>
                            </div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        Copyright ©  GamBlock®. All rights reserved. This site is for access by GamBlock® Staff Only. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.
                    </div>
<!--                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">-->
<!--                        <div class="text-md-right footer-links d-none d-sm-block">-->
<!--                            <a href="javascript: void(0);">Documentation</a>-->
<!--                            <a href="javascript: void(0);">Contact Points</a>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
        </div>

        <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
        <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>


    </div>
</div>
