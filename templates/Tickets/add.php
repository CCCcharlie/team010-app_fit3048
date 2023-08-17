<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 * @var \Cake\Collection\CollectionInterface|string[] $users
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
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="/">
                <?= $this->Html->image('cake-logo.png', ['alt' => 'GamBlock Logo', 'class' => 'navbar-brand', 'style' => 'width: 225px; height: auto;']); ?> -Staff Portal
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">

                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-file" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name">
                                    Example User</h5>
                            </div>
                            <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i> <?php echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout']); ?></a>
                        </div>
                    </li>
                </ul>
            </div>
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
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Customer Management <span class="badge badge-success">6</span></a>
                            <div id="submenu-1" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/">Assigned to me</a>
                                        <!--                                        Change my link to assigned to me page when done.-->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers">View All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers/add">Add a Customer Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
<!--                        <li class="nav-item">-->
<!--                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa-solid fa-user-tag"></i>Tag Management</a>-->
<!--                            <div id="submenu-2" class="collapse submenu" style="">-->
<!--                                <ul class="nav flex-column">-->
<!--                                    <li class="nav-item">-->
<!--                                        <a class="nav-link" href="/Tags/index">View All Tags<span class="badge badge-secondary">New</span></a>-->
<!--                                    </li>-->
<!--                                    <li class="nav-item">-->
<!--                                        <a class="nav-link" href="/Tags/add">Add some Tags<span class="badge badge-secondary">New</span></a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </li>-->
                        <li class="nav-divider">
                            Admin Features
                            <!--                            Change to me admin only visable.-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fa-solid fa-user-tie"></i>Staff Management</a>
                            <div id="submenu-6" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/Users/">View All Staff Accounts </a>
                                    </li>

                                </ul>
                            </div>


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
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                    </div>
                    <div class="card">
                        <h5 class="card-header"><legend><?= __('Add Ticket for customer: ' . $fullName) ?></legend></h5>
                        <div class="card-body">
                            <div class="column-responsive column-80">
                                <div class="tickets form content">
                                    <?= $this->Form->create($ticket) ?>
                                    <fieldset>
                                    <p> You have the ability to make multiple tickets in a row here. Hit 'Return to Customer' when done.</p>
                                        <div class="form-group">
                                            <?= $this->Form->label('title', 'Title', ['class' => 'col-form-label']) ?>
                                            <?= $this->Form->input('title', [
                                                'class' => 'form-control',
                                                'maxlength' => 50, // Maximum of 50 characters
                                                'placeholder' => 'e.g. MacOS Update issue',
                                                'required' => true,
                                                'title' => 'Please enter a title (maximum 50 characters)'
                                            ]) ?>
                                        </div>
                                        <div class="form-group">
                                            <?= $this->Form->label('type', 'Type', ['class' => 'col-form-label']) ?>
                                            <?= $this->Form->input('type', [
                                                'class' => 'form-control',
                                                'maxlength' => 30, // Maximum of 30 characters
                                                'placeholder' => 'e.g. Update Issues',
                                                'required' => true,
                                                'title' => 'Please enter a type (maximum 30 characters)'
                                            ]) ?>
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
                                            <?php echo $this->Form->control('staff_id', ['options' => $users, 'label'=>false]); ?>
                                        </div>
                                    </fieldset>
                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <?= $this->Html->link(__('Return to Customer'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-secondary']) ?>
                                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

<!--Footer-->

        </div>
    </div>
