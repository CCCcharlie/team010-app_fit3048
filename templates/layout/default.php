<?php
/**
 * CakePHP(tm): The Rapid Development PHP Framework (https://cakephp.org)
 * Copyright(c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright(c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title needs to be changed so its more informative -->
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['bootstrap.min.css', 'style.css', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/webroot/css/bootstrap.min.css">
    <link href="/webroot/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/webroot/css/style.css">

</head>
<body>

<div class="dashboard-main-wrapper">

    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top" style="display: flex; justify-content: space-between;">
            <a class="navbar-brand" href="/">
                <?php $logo = $contentBlocks['navigation_header_logo']?>
                <?= $this->Html->image($logo, ['alt' => 'GamBlock Logo', 'class' => 'navbar-b;and', 'style' => 'width: auto; height: 70px;']); ?>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                                        <a class="nav-link" href="/customers">View All Customers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers/add">Add a Customer
                                            Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers/archiveindex"> View all archived profiles</a>
                                    </li>


                                </ul>
                            </div>
                        </li>
                        <li class="nav-divider">
                            Admin Features
                            <!-- Change to me admin only visible. -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="true"
                               data-target="#submenu-6" aria-controls="submenu-6"><i class="fa-solid fa-user-tie"></i>Staff
                                Management</a>
                            <div id="submenu-6" class="submenu show" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/Users/">View All Staff Accounts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/tickets/unassigned">View unassigned tickets</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers/escalatetome"> View the escalated customer  </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/cb"> Edit Contents  </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers/archiveddeleteprofiles"> View outdated profiles </a>
                                    </li>

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
                <div class="alert" role="alert">
                    <?= $flashMessage; ?>
                </div>
                <?php
            }
            ?>
            <!-- ============================================================== -->

            <!-- Main content -->
            <main class="main">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </main>
            <!-- end main content -->

            <!-- footer -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            Copyright © GamBlock®. All rights reserved. This site is for access by GamBlock® Staff Only.
                            Template by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <!--                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">-->
                        <!--                        <div class="text-md-right footer-links d-none d-sm-block">-->
                        <!--                            <a href="javascript: void(0);">Documentation</a>-->
                        <!--                            <a href="javascript: void(0);">Contact Points</a>-->
                        <!--                        </div>-->
                    </div>
                </div>
            </div>
            <!-- end footer -->

            </div>
        </div>
    </div>

</div>

<!--script-->
<script>
    // obtain the currently tile
    var pageTitle = document.title;

    // split the title
    var words = pageTitle.split(' ');

    // get the last word
    var lastWord = words[words.length - 1];
    // update the car
    var activeBreadcrumb = document.querySelector(".breadcrumb-item.active");
    activeBreadcrumb.textContent = lastWord;
</script>
</body>
</html>

