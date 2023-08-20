<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */


$this->disableAutoLayout();
?>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<!doctype html>
<html lang="en">

<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Users</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min', 'returntoparrow']) ?>
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
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="/">
                <?= $this->Html->image('cake-logo.png', ['alt' => 'GamBlock Logo', 'class' => 'navbar-brand', 'style' => 'width: 225px; height: auto;']); ?> -Staff Portal
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <a href="#"><i class="fas fa-power-off mr-2"></i> <?php echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout']); ?></a>
<!--                    <li class="nav-item dropdown nav-user">-->
<!--                        <a class="nav-link nav-user-file" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>-->
<!--                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">-->
<!--                            <div class="nav-user-info">-->
<!--                                <h5 class="mb-0 text-white nav-user-name">-->
<!--                                    Example User</h5>-->
<!--                            </div>-->
<!--                            <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i> --><?php //echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout']); ?><!--</a>-->
<!--                        </div>-->
<!--                    </li>-->
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
                                        <a class="nav-link" href="/customers?filter=assigned">Assigned Customers</a>

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
            <div class="row">
                <div class="col-xl-10">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <?php if (isset($successMessage)): ?>
                                <div class="p-3 mb-2 bg-success text-white"><?= h($successMessage) ?></div>
                            <?php endif; ?>

                            <div class="page-header" id="top">
                                <p class="pageheader-text"></p>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
<div class="users index content"><?php if ($this->Identity->get('admin_status') == 1): ?>

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
        <?= $this->Html->link(__('Add a Staff Member'), ['action' => 'add'], ['class' => 'float-right btn btn-success']) ?>
    <?php endif; ?>

    <h3><?= __('Users') ?></h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('f_name', 'First Name') ?></th>
                <th><?= $this->Paginator->sort('l_name', 'Last Name') ?></th>
                <th><?= $this->Paginator->sort('email', 'E-mail') ?></th>
                <th><?= $this->Paginator->sort('admin_status', 'Is user an admin?') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= h($user->f_name) ?></td>
                    <td><?= h($user->l_name) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->admin_status ? '✅' : '❌') ?></td>
                    <td class="actions">
                        <?php if ($this->Identity->get('admin_status') == 1): ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], [
                                'class' => 'btn btn-danger',
                                'confirm' => __('Are you sure you want to delete {0} {1}?', $user->f_name, $user->l_name)
                            ]) ?>
                        <?php else: ?>
                            <p>Please contact an Admin to edit me.</p>
                        <?php endif; ?>


                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
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
<!--                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">-->
<!--                                    <div class="text-md-right footer-links d-none d-sm-block">-->
<!--                                        <a href="javascript: void(0);">Documentation</a>-->
<!--                                        <a href="javascript: void(0);">Contact Points</a>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end footer -->
                    <!-- ============================================================== -->

                    <!--EXPLAINING THE SCRIPTS -->
                    <!--Concept - Template-->
                    <!--SlimScroll - JS Plugin. Allows for any div to be scrollable.-->
                    <!--Jquery  - Essential Javascript library-->
                    <!--Add any explinations here for any scripts you add. - Alex-->



                    <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>

                    <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js', 'gototoparrow.js']) ?>
</body>

</html>
