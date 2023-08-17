<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */

$this->disableAutoLayout();
?><!doctype html>
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
            <a class="navbar-brand" href="/home.php">
                <?= $this->Html->image('cake-logo.png', ['alt' => 'GamBlock Logo', 'class' => 'navbar-brand', 'style' => 'width: 225px; height: auto;']); ?>
                -Staff Portal
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">


                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-file" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"><img src="../assets/images/avatar-1.jpg" alt=""
                                                                           class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                             aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name">
                                    Example User</h5>
                            </div>
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-power-off mr-2"></i> <?php echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout']); ?>
                            </a>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-1" aria-controls="submenu-1"><i
                                    class="fa fa-fw fa-user-circle"></i>Customer Management <span
                                    class="badge badge-success">6</span></a>
                            <div id="submenu-1" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers/">Assigned to me</a>
                                        <!--                                        Change my link to assigned to me page when done.-->
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
<!--                        <li class="nav-item">-->
<!--                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"-->
<!--                               data-target="#submenu-2" aria-controls="submenu-2"><i class="fa-solid fa-user-tie"></i>Tag-->
<!--                                Management</a>-->
<!--                            <div id="submenu-2" class="collapse submenu" style="">-->
<!--                                <ul class="nav flex-column">-->
<!--                                    <li class="nav-item">-->
<!--                                        <a class="nav-link" href="/Tags/index">View All Tags<span-->
<!--                                                class="badge badge-secondary">New</span></a>-->
<!--                                    </li>-->
<!--                                    <li class="nav-item">-->
<!--                                        <a class="nav-link" href="/Tags/add">Add some Tags<span-->
<!--                                                class="badge badge-secondary">New</span></a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </li>-->
                        <li class="nav-divider">
                            Admin Features
                            <!--                            Change to me admin only visable.-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-6" aria-controls="submenu-6"><i class="fa-solid fa-user-tie"></i>Staff
                                Management</a>
                            <div id="submenu-6" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/Users">View All Staff
                                            Accounts </a>
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
    <!-- ============================================================== -->
    <!-- wrapper  -->
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
                        <h2 class="pageheader-title">Welcome, <?= $identity->get('f_name'); ?></h2>

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
                    <div style="position: sticky; top: 0px; float: right; background-color: #f5f5f5; padding: 20px; width: 250px;">
                        <ul style="padding: 0; margin: 0; list-style: none;">
                            <h4>Actions:</h4>
                            <li><?= $this->Form->postLink(__('> Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id), 'style' => 'display: block; padding: 10px 0; text-decoration: none; color: #333; border: 1px solid transparent; transition: border-color 0.3s ease;']) ?></li>
                        </ul>
                    </div>

                    </aside>
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- profile -->
                        <!-- ============================================================== -->
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- card profile -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar text-center d-block">
                                        <img src="/img/avatar-1.png" alt="User Avatar">
                                    </div>
                                    <?= $this->Form->create($customer) ?>
                                    <div class="text-center">
                                        <h2 class="font-24 mb-0"><?= $this->Form->control('f_name', ['class' => 'form-control', 'label' => false]) ?> <?= $this->Form->control('l_name', ['class' => 'form-control', 'label' => false]) ?></h2>
                                        <p>Status: <?= $this->Form->control('status', ['class' => 'form-control', 'label' => false]) ?></p>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Main E-Mail:</h3>
                                    <div class="">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><?= $this->Form->control('email', ['class' => 'form-control', 'label' => false]) ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Notes:</h3>
                                    <p class="mb-0"><?= $this->Form->control('notes', ['class' => 'form-control', 'label' => false]) ?></p>
                                </div>
                                <?= $this->Html->link(__('Return to Customer'), ['controller' => 'Customers', 'action' => 'view', $customer -> id], ['class' => 'btn btn-rounded btn-secondary']) ?>

                                <?= $this->Form->button(__('Submit' ),  ['class' => 'btn btn-rounded btn-primary']) ?>
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

                    <!-- end content -->
                    <!-- ============================================================== -->




                    <style>
                        ul li:hover {
                            background-color: #ddd;
                            border-color: #aaa;
                        }
                    </style>
                </div>


            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            Copyright © GamBlock®. All rights reserved. This site is for access by GamBlock® Staff Only.
                            Template by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
<!--                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">-->
<!--                            <div class="text-md-right footer-links d-none d-sm-block">-->
<!--                                <a href="javascript: void(0);">Documentation</a>-->
<!--                                <a href="javascript: void(0);">Contact Points</a>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end footer -->
    <!-- ============================================================== -->
</div>


<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
</div>

<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
<!-- SCRIPTS GO HERE -->


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

