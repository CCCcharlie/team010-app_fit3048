<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commdetail $commdetail
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */$this->disableAutoLayout();
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
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">






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


            <div>
            <a href="#"><i class="fas fa-power-off mr-2"></i> <?php echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout'] ,['style' => 'padding-right: 40px']); ?></a>
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
                                        <a class="nav-link" href="/customers/assigntome>Assigned Customers</a>

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
                <div class="alert alert-danger" role="alert">
                    <?= $flashMessage; ?>
                </div>
                <?php
            }
            ?>
            <!-- ============================================================== -->
            <!-- End Flash rendering -->
            <!-- ============================================================== -->

                <div class="container-fluid dashboard-content">


                    <div class="column-responsive column-80">
                        <div class="commdetails form content">
                            <div class="card">

                                <h5 class="card-header"> <legend><?= __('Add Communication details for: ' . $fullName) ?></legend></h5>
                            <?= $this->Form->create($commdetail) ?>
                                <div class="card-body">
                            <fieldset>

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
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
<!--                            <div class="text-md-right footer-links d-none d-sm-block">-->
<!--                                <a href="javascript: void(0);">Documentation</a>-->
<!--                                <a href="javascript: void(0);">Contact Points</a>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
            </div>

            <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
            <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>


        </div>
    </div>
