<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Customer> $customers
 */
?>
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Not Found Exception'
    );
endif;


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
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <input class="form-control" type="text" placeholder="Search..">
                        </div>
                    </li>

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
                                        <a class="nav-link" href="/team010-app_fit3048/customers/">Assigned to me</a>
                                        <!--                                        Change my link to assigned to me page when done.-->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/team010-app_fit3048/customers">View All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/team010-app_fit3048/customers/add">Add a Customer
                                            Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Tag
                                Management</a>
                            <div id="submenu-2" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/team010-app_fit3048/Tags/index">View All Tags<span
                                                class="badge badge-secondary">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/team010-app_fit3048/Tags/add">Add some Tags<span
                                                class="badge badge-secondary">New</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-divider">
                            Admin Features
                            <!--                            Change to me admin only visable.-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-file"></i>Staff
                                Management</a>
                            <div id="submenu-6" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/team010-app_fit3048/Users/">View All Staff
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
                            <li><?= $this->Html->link(__('> Edit Customer'), ['action' => 'edit', $customer->id], ['style' => 'display: block; padding: 10px 0; text-decoration: none; color: #333; border: 1px solid transparent; transition: border-color 0.3s ease;']) ?></li>
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
                                    <div class="text-center">
                                        <h2 class="font-24 mb-0"><?= h($customer->f_name) ?> <?= h($customer->l_name) ?></h2>
                                        <p>Status: <?= h($customer->status) ?></p>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Main E-Mail:</h3>
                                    <div class="">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i><?= h($customer->email) ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Notes:</h3>
                                    <p class="mb-0"><?= h($customer->notes) ?></>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end card profile -->
                            <!-- ============================================================== -->
                        </div>
                        <!-- ============================================================== -->
                        <!-- end profile -->
                        <!-- ============================================================== -->
                        <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- campaign tab one -->
                            <!-- ============================================================== -->
                            <div class="influence-profile-content pills-regular">
                                <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-campaign-tab" data-toggle="pill" href="#pills-campaign" role="tab" aria-controls="pills-campaign" aria-selected="true">Tickets</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-packages-tab" data-toggle="pill" href="#pills-packages" role="tab" aria-controls="pills-packages" aria-selected="false">Alternative Communcation Methods</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-selected="false">Checklist</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-campaign" role="tabpanel" aria-labelledby="pills-campaign-tab">
                                        <p>Move Tickets in here</p>
                                    </div>
                                    <div class="tab-pane fade" id="pills-packages" role="tabpanel" aria-labelledby="pills-packages-tab">
                                        <p>Put Methods in here when they link properly.</p>
                                    </div>
                                    <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                                        <p>Low Priority: Checklist goes in here. </p>
                                    </div>



                                </div>
                            </div>
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
                <!-- tickets -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header"><?= $customer->f_name ?>'s Tickets</h5>
                        <?php foreach ($tickets as $ticket): ?>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                    <tr>
                                        <th><?= $this->Paginator->sort('id') ?></th>
                                        <th><?= $this->Paginator->sort('type') ?></th>
                                        <th><?= $this->Paginator->sort('createtime') ?></th>
                                        <th><?= $this->Paginator->sort('closetime') ?></th>
                                        <th><?= $this->Paginator->sort('closed') ?></th>
                                        <th><?= $this->Paginator->sort('cust_id') ?></th>
                                        <th><?= $this->Paginator->sort('staff_id') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="border-0">
                                        <td><?= $this->Number->format($ticket->id) ?></td>
                                        <td><?= h($ticket->type) ?></td>
                                        <td><?= h($ticket->createtime) ?></td>
                                        <td><?= h($ticket->closetime) ?></td>
                                        <td><?= $ticket->closed ? "✅" : "❌"?></td>
                                        <td><?= h($customer->f_name) ?></td>
                                        <td><?= $this->Html->link(__($ticket->user->f_name), ['controller' => 'Users', 'action' => 'view', $ticket->staff_id]) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('Ticket Details'), ['controller' => 'Tickets', 'action' => 'view', $ticket->id]) ?>
<!--                                            --><?php //= $this->Html->link(__('Edit'), ['action' => 'edit', $ticket->id]) ?>
<!--                                            --><?php //= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id)]) ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end recent orders  -->
            </div>

            <!-- Cards section -->
            <?php foreach ($tickets as $ticket): ?>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <?php if($ticket->closed == true) : ?>
                    <div class="card-header d-flex" style="background-color: lightcoral">
                    <?php elseif($ticket->closed == false) : ?>
                    <div class="card-header d-flex" style="background-color: lightgreen">
                    <?php endif; ?>
                        <h4 class="card-header-title">Ticket ID: <?= h($ticket->id) ?></h4>
                        <div class="toolbar ml-auto">
                                <?php
                                //if true means it is closed. Allow option to open ticket
                                if ($ticket->closed) {
                                    echo $this->Form->postLink(__('Open ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-primary', 'confirm' => __("Are you sure you want to close ticket ID: {0} \n Customer: {1} {2} ", $ticket->id, $customer->f_name, $customer->l_name)]);
                                } else {
                                    echo $this->Form->postLink(__('Close ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-primary', 'confirm' => __("Are you sure you want to Re-open ticket ID: {0} \n Customer: {1} {2} ", $ticket->id, $customer->f_name, $customer->l_name)]);
                                }
                                ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <p><span class="card-info">Customer:</span> <?= h($customer->f_name) ?></p>
                            <p><span class="card-info">Assigned staff:</span> <?= $this->Html->link(__($ticket->user->f_name), ['controller' => 'Users', 'action' => 'view', $ticket->staff_id]) ?></p>
                            <p><span class="card-info">Create time:</span> <?= h($ticket->createtime) ?></p>
                            <br>
                        </div>
                        <a href="#" class="btn btn-primary card__button" id="showButton">Go somewhere</a>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample<?= $ticket->id ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Expand Attachments
                        </a>
                    </div>
                    <!-- In order to show unique collapse for each class, its id must be different. -->
                    <div class="collapse" id="collapseExample<?= $ticket->id ?>">
                        <div class="card card-body">
                            <!-- Because contents is already asked in Customers controller in this query

                                    $tickets = $this->Customers->Tickets->find('all')
                                    ->where(['cust_id' => $customer->id])
                                    ->contain(['Users', 'Contents']) // I want to retrieve the name of the staff (users) & contents, so this is added so I can reference it
                                    ->toArray();

                                  We can reiterate contents for that ticket here as follows
                            -->

                            <!-- In order to pass a query to a controller, must add the '?'. Can be obtained via key value pair in the controller -->
                            <?= $this->Html->link(__('Add Attachments +'), ['controller' => 'Contents', 'action' => 'add',
                                '?' => ['ticket_id' => $ticket->id,
                                        'f_name' => $customer->f_name,
                                        'l_name' => $customer->l_name
                                ],
                            ], ['class' => 'btn btn-rounded btn-primary', 'style' => 'margin: 10px']); ?>

                            <?php if($ticket->contents) : ?>
                                <?php foreach ($ticket->contents as $content): ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Attachment Type: <?= $content->content_type?></h5>
                                            <p class="card-text"><?= h($content->content) ?></p>
                                            <!-- Why urlencode? because since im storing images as "conversation/image.png", passing $content->content as it is would only pass
                                                 "conversation", not good. As such, as it is passed to download, you must decode it-->
                                            <?= $this->Html->link('Download Attachment', ['controller' => 'Contents', 'action' => 'download', urlencode($content->content)], ['class' => 'btn btn-primary card__button', 'id' => 'showButton']) ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="card">
                                    <div class="card-body">
                                        <p> No attachments </p>
                                    </div>
                                </div>
                                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
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
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript: void(0);">Getting Started</a>
                            <a href="javascript: void(0);">Documentation</a>
                            <a href="javascript: void(0);">Contact Points</a>
                        </div>
                    </div>
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

</body>


</html>
