<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */


//$this->disableAutoLayout();
?>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

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
        .actions a {
             color: #ffffff;
        }
    </style>
</head>

<body>
        <div class="users index content">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Views All Staffs</li>
                            </ol>
                        </nav>
                    </div>

                    <?php if (isset($successMessage)): ?>
                        <div class="p-3 mb-2 bg-success text-white"><?= h($successMessage) ?></div>
                    <?php endif; ?>

                    <div class="page-header" id="top">
                        <!-- To obtain the identity, use $identity = $this->request->getAttribute('authentication')->getIdentity(); to find the currently logged in entity
to get the name or any value in the staff table, use the get and then the name of the attribute $identity->get('staff_fname')-->
                        <?php $identity = $this->request->getAttribute('authentication')->getIdentity();
                        //                        debug($identity->get('f_name'));
                        //                        exit();
                        ?>
                        <?php
                        /*
                        <h2 class="pageheader-title">Welcome, <?= $identity->get('f_name'); ?></h2> */
                        ?>

                        <!-- Can you add login user to name here if you get chance Bryan?  -->
                        <!-- Sure Alex-->
                        <p class="pageheader-text"></p>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
<!--<div class="users index content">-->
<div class="section-block" id="cardaction">
<h3 class="section-title" style="color: midnightblue"><?= __('Staff Accounts') ?></h3>

<?php if ($this->Identity->get('role') == 'root' || $this->Identity->get('role') == 'admin'): ?>
    <?= $this->Html->link(__('Add a Staff Member'), ['action' => 'add'], ['class' => 'float-right btn btn-success' , 'style' => 'margin-top: -50px; margin-right: 10px; margin-bottom: 5px;' ]) ?>
<?php endif; ?>
</div>

<div class="table-responsive">
<table class="table table-hover custom-table">
    <thead>
    <tr>
        <th style="font-family: 'Arial'; font-weight: normal;"><?= $this->Paginator->sort('f_name', 'First Name') ?></th>
        <th style="font-family: 'Arial'; font-weight: normal;"><?= $this->Paginator->sort('l_name', 'Last Name') ?></th>
        <th style="font-family: 'Arial'; font-weight: normal;"><?= $this->Paginator->sort('email', 'E-mail') ?></th>
<!--                <th style="font-family: 'Arial'; font-weight: normal;">--><?php //= $this->Paginator->sort('admin_status', 'Is he an admin?') ?><!--</th>-->
        <th style="font-family: 'Arial'; font-weight: normal;"><?= $this->Paginator->sort('role', 'Role') ?></th>
        <th class="actions" style="font-family: 'Arial'; font-weight: normal;"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= h($user->f_name) ?></td>
        <td><?= h($user->l_name) ?></td>
        <td><?= h($user->email) ?></td>
        <td><?= h($user->role) ?></td>
        <td class="actions">
            <?php if ($this->Identity->get('role') == 'root' || $this->Identity->get('role') == 'admin'): ?>
                <!------------------->
                <!--Root role rules-->
                <!------------------->
                <?php if ($this->Identity->get('role') == 'root'): ?>

                    <!-- Allow editing/delete of profiles: Admin, Staff & User -->
                    <?php if ($user->role != 'root'): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id, $user->role], ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id, $user->role], [
                            'class' => 'btn btn-danger',
                            'confirm' => __('Are you sure you want to delete {0} {1}?' . "\n\n" . 'WARNING: THIS PROCESS IS IRREVERSIBLE', $user->f_name, $user->l_name)
                        ]) ?>
                        <!-- Allow editing of own profile -->
                    <?php elseif ($user->id === $this->Identity->get('id')): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id, $user->role], ['class' => 'btn btn-primary']) ?>
                    <?php else: ?>
                        <p>Actions Unavailable</p>
                    <?php endif; ?>
                    <!----------------------->
                    <!--End Root role rules-->
                    <!----------------------->

                    <!----------------------->
                    <!-- Admin roles rules -->
                    <!----------------------->
                <?php elseif ($this->Identity->get('role') == 'admin'): ?>
                    <?php if ($user->role != 'root' && $user->role != 'admin'): ?>
                        <!-- Allow editing/delete of profiles: Staff & User -->
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id, $user->role], ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id, $user->role], [
                            'class' => 'btn btn-danger',
                            'confirm' => __('Are you sure you want to delete {0} {1}?' . "\n\n" . 'WARNING: THIS PROCESS IS IRREVERSIBLE', $user->f_name, $user->l_name)
                        ]) ?>

                    <!-- Allow editing of own profile -->
                    <?php elseif ($user->id === $this->Identity->get('id')): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id, $user->role], ['class' => 'btn btn-primary']) ?>
                    <?php else: ?>
                        <p>Actions Unavailable</p>
                    <?php endif; ?>
                    <!----------------------->
                    <!--End Root role rules-->
                    <!----------------------->
                <?php endif; ?>
            <?php else: ?>
                <p>Please contact an Admin to edit me.</p>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<!--</div>-->

            <!--EXPLAINING THE SCRIPTS -->
            <!--Concept - Template-->
            <!--SlimScroll - JS Plugin. Allows for any div to be scrollable.-->
            <!--Jquery  - Essential Javascript library-->
            <!--Add any explinations here for any scripts you add. - Alex-->



            <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>

            <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js', 'gototoparrow.js']) ?>
    </div>
</body>

</html>
