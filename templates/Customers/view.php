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
                    <a href="#"><i class="fas fa-power-off mr-2"></i> <?php echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout']); ?></a>
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
                                            <li class="mb-2"><?= h($customer->email) ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Notes:</h3>
                                    <p class="mb-0"><?= h($customer->notes) ?></>
                                </div>
                                <!--                                <div class="card-body border-top">-->
                                <!--                                    <h3 class="font-16">Counsellor :</h3>-->
                                <!--                                    <p class="mb-0">-->
                                <!--                                    <table class="table table-bordered">-->
                                <!--                                        <thead>-->
                                <!--                                        <tr>-->
                                <!--                                            <th scope="col">Name</th>-->
                                <!--                                            <th scope="col">Contact</th>-->
                                <!--                                            <th scope="col">Notes</th>-->
                                <!--                                            <th scope="col">Actions</th>-->
                                <!--                                        </tr>-->
                                <!--                                        </thead>-->
                                <!--                                        <tbody>-->
                                <!--                                        --><?php
                                //                                        //Because the counsellors query is picked up in the view:
                                //
                                ////                                        $counsellors = $this->Customers->Counsellors->find('all')
                                ////                                            ->where(['cust_id' => $customer->id])
                                ////                                            ->contain(['Customers'])
                                ////                                            ->toArray();
                                ////
                                //                                        //Means that $counsellors is how we access counsellors for a customer
                                //                                        if (!empty($counsellors)) {
                                //                                            foreach ($counsellors as $counsellor) {
                                //                                                echo '<tr>';
                                //                                                echo '<td>' . h($counsellor->f_name . ' ' . $counsellor->l_name) . '</td>';
                                //                                                echo '<td>' . h($counsellor->contact) . '</td>';
                                //                                                echo '<td>' . h($counsellor->notes) . '</td>';
                                //
                                //                                                // Actions column with Edit and Delete buttons
                                //                                                echo '<td>';
                                //                                                echo $this->Html->link(__('Edit'), ['controller' => 'Counsellors', 'action' => 'edit', $counsellor->id], ['class' => 'btn btn-primary']);
                                //                                                echo ' ';
                                //                                                echo $this->Form->postLink(__('Delete'), ['controller' => 'Counsellors', 'action' => 'delete', $counsellor->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete this counselor?')]);
                                //                                                echo '</td>';
                                //
                                //                                                echo '</tr>';
                                //                                            }
                                //                                        } else {
                                //                                            echo '<tr><td colspan="4">No Counsellors have been assigned to this customer.</td></tr>';
                                //                                        }
                                //                                        ?>
                                <!--                                        </tbody>-->
                                <!--                                    </table>-->
                                <!--                                    --><?php //echo $this->Html->link(__('Add New Counsellor'), ['controller' => 'Counsellors', 'action' => 'add', 'customer_id' => $customer->id], ['class' => 'btn btn-success mt-3']); ?>
                                <!--                                    </p>-->
                                <!--                                </div>-->

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
                                        <a class="nav-link" id="pills-packages-tab" data-toggle="pill" href="#pills-packages" role="tab" aria-controls="pills-packages" aria-selected="false">Alt. Communcation Methods</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-selected="false">Technical Details</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-campaign" role="tabpanel" aria-labelledby="pills-campaign-tab">
                                        <div>
                                            <div class="card">
                                                <!-- Header buttons -->
                                                <div class="card-header">
                                                    <div style="display: flex; justify-content: space-between; margin: 10px">
                                                        <div class="btn-group btn-group-toggle" data-toggle="buttons" style="padding-right: 10px">
                                                            <label class="btn btn-primary active">
                                                                <input type="radio" name="options" id="showallticket" checked>All
                                                            </label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="options" id="showcloseticket"> Closed
                                                            </label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="options" id="showopenticket"> Open
                                                            </label>
                                                        </div>
                                                        <?= $this->Html->link(__('Create Ticket +'), ['controller' => 'Tickets', 'action' => 'add',
                                                            '?' => [
                                                                'f_name' => $customer->f_name,
                                                                'l_name' => $customer->l_name,
                                                                'cust_id' => $customer->id
                                                            ],
                                                        ], ['class' => 'btn btn-rounded btn-primary']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End of Header buttons -->
                                            <div id="allticket">
                                                <div class="card">
                                                    <p>            <!-- Cards section -->
                                                        <?php foreach ($tickets as $ticket): ?>
                                                    <div class="col-xl-12 col-lg-12 col-md-12col-sm-12 col-12">
                                                        <div class="card">
                                                            <?php if($ticket->closed == true) : ?>
                                                            <div class="card-header d-flex" style="background-color: lightcoral">
                                                                <?php elseif($ticket->closed == false) : ?>
                                                                <div class="card-header d-flex" style="background-color: lightgreen">
                                                                    <?php endif; ?>
                                                                    <h4 class="card-header-title">Title:  <?= h($ticket->title) ?> | Type: <?= h($ticket->type) ?></h4>
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
                                                                        <p><span class="card-info">Ticket ID:</span> <?= h($ticket->id) ?></p>
                                                                        <p><span class="card-info">Customer:</span> <?= h($customer->f_name) ?></p>
                                                                        <p><span class="card-info">Assigned staff:</span> <?= $this->Html->link(__($ticket->user->f_name), ['controller' => 'Users', 'action' => 'view', $ticket->staff_id]) ?></p>
                                                                        <p><span class="card-info">Create time:</span> <?= h($ticket->createtime) ?></p>
                                                                        <br>
                                                                    </div>
                                                                    <div style="display: flex; justify-content: space-between">
                                                                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample<?= $ticket->id ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Expand Attachments
                                                                    </a>
                                                                        <span>
                                                                    <?php if ($this->Identity->get('admin_status') == 1): ?>
                                                                        <?php echo $this->Html->link(__('Edit'), ['controller' => 'Tickets', 'action' => 'edit', $ticket->id,
                                                                            '?' => [
                                                                                'f_name' => $customer->f_name,
                                                                                'l_name' => $customer->l_name,
                                                                                'cust_id' => $customer->id,
//                                                                                'ticket_closed' => $ticket->closed
                                                                            ],
                                                                        ], ['class' => 'btn btn-primary']);

                                                                        //Removed delete for now, it breaks if try to delete with an attachment present inside

                                                                        ?>
<!--                                                                        --><?php //= $this->Form->postLink(__('Delete'), ['controller' => 'Tickets', 'action' => 'delete', $ticket->id], [
//                                                                            'class' => 'btn btn-danger',
//                                                                            'confirm' => __('Are you sure you want to delete Ticket title:  {0} \n From customer {1} {2}?', $ticket->title , $customer->f_name, $customer->l_name)
//                                                                        ]) ?>
                                                                    <?php else: ?>
                                                                    <?php endif; ?>
                                                                        </span>
                                                                    </div>
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
                                                                                'l_name' => $customer->l_name,
                                                                                'cust_id' => $customer->id
                                                                            ],
                                                                        ], ['class' => 'btn btn-rounded btn-primary', 'style' => 'margin: 10px']); ?>

                                                                        <?php if($ticket->contents) : ?>
                                                                            <?php foreach ($ticket->contents as $content): ?>
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">Attachment Type: <?= $content->content_type?></h5>
                                                                                        <h6 class="card-title">Create date: <?= $content->createtime?></h6>
                                                                                        <p class="card-text"><?= h($content->content) ?></p>
                                                                                        <!-- Why urlencode? because since im storing images as "conversation/image.png", passing $content->content as it is would only pass
                                                                                             "conversation", not good. As such, as it is passed to download, you must decode it-->
                                                                                        <div style="display: flex; justify-content: space-between">
                                                                                            <?= $this->Html->link('Download Attachment', ['controller' => 'Contents', 'action' => 'download', urlencode($content->content)], ['class' => 'btn btn-primary card__button']) ?>
                                                                                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contents', 'action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete # {0}?', $content->id), 'class' => 'btn btn-rounded btn-danger']) ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                            <!-- In order to pass a query to a controller, must add the '?'. Can be obtained via key value pair in the controller -->
                                                                            <?= $this->Html->link(__('Add Attachments +'), ['controller' => 'Contents', 'action' => 'add',
                                                                                '?' => ['ticket_id' => $ticket->id,
                                                                                    'f_name' => $customer->f_name,
                                                                                    'l_name' => $customer->l_name,
                                                                                    'cust_id' => $customer->id
                                                                                ],
                                                                            ], ['class' => 'btn btn-rounded btn-primary', 'style' => 'margin: 10px']); ?>
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
                                                        <!-- End card section -->
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="closeticket" style="display: none;">
                                                <div class="card">
                                                    <!-- Checks first whether or not there are any tickets that are closed. If so, say that there
                                                    are no closed tickets (same is applied for open tickets-->
                                                    <?php if (empty(array_filter($tickets, function($ticket) {
                                                        return $ticket->closed == true;
                                                    }))) : ?>
                                                        <div class="alert alert-primary" role="alert">
                                                            <p>No Closed tickets found.</p>
                                                        </div>
                                                    <?php else : ?>
                                                        <p>            <!-- Cards section -->
                                                        <?php foreach ($tickets as $ticket): ?>
                                                            <div class="col-xl-12 col-lg-12 col-md-12col-sm-12 col-12">
                                                                <?php if($ticket->closed == true) : ?>
                                                                    <div class="card">
                                                                        <div class="card-header d-flex" style="background-color: lightcoral">
                                                                            <h4 class="card-header-title">Title:  <?= h($ticket->title) ?> | Type: <?= h($ticket->type) ?></h4>
                                                                            <div class="toolbar ml-auto">
                                                                                <?php
                                                                                //if true means it is closed. Allow option to open ticket
                                                                                if ($ticket->closed) {
                                                                                    echo $this->Form->postLink(__('Open ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-primary', 'confirm' => __("Are you sure you want to close: {0} \n Customer: {1} {2}'s ticket?",  $customer->f_name, $customer->l_name)]);
                                                                                } else {
                                                                                    echo $this->Form->postLink(__('Close ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-primary', 'confirm' => __("Are you sure you want to Re-open ticket ID: {0} \n Customer: {1} {2}'s ticket ", $customer->f_name, $customer->l_name)]);
                                                                                }


                                                                                ?>

                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="card-text">
                                                                                <p><span class="card-info">Ticket ID:</span> <?= h($ticket->id) ?></p>
                                                                                <p><span class="card-info">Customer:</span> <?= h($customer->f_name) ?></p>
                                                                                <p><span class="card-info">Assigned staff:</span> <?= $this->Html->link(__($ticket->user->f_name), ['controller' => 'Users', 'action' => 'view', $ticket->staff_id]) ?></p>
                                                                                <p><span class="card-info">Create time:</span> <?= h($ticket->createtime) ?></p>
                                                                                <br>
                                                                            </div>
                                                                            <a href="#" class="btn btn-primary card__button" id="showButton">Go somewhere</a>
                                                                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseShowCloseTicket<?= $ticket->id ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                                Expand Attachments
                                                                            </a>
                                                                        </div>
                                                                        <!-- In order to show unique collapse for each class, its id must be different. -->
                                                                        <div class="collapse" id="collapseShowCloseTicket<?= $ticket->id ?>">
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
                                                                                        'l_name' => $customer->l_name,
                                                                                        'cust_id' => $customer->id
                                                                                    ],
                                                                                ], ['class' => 'btn btn-rounded btn-primary', 'style' => 'margin: 10px']); ?>

                                                                                <?php if($ticket->contents) : ?>
                                                                                    <?php foreach ($ticket->contents as $content): ?>
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <h5 class="card-title">Attachment Type: <?= $content->content_type?></h5>
                                                                                                <h6 class="card-title">Create date: <?= $content->createtime?></h6>
                                                                                                <p class="card-text"><?= h($content->content) ?></p>
                                                                                                <!-- Why urlencode? because since im storing images as "conversation/image.png", passing $content->content as it is would only pass
                                                                                                     "conversation", not good. As such, as it is passed to download, you must decode it-->
                                                                                                <div style="display: flex; justify-content: space-between">
                                                                                                    <?= $this->Html->link('Download Attachment', ['controller' => 'Contents', 'action' => 'download', urlencode($content->content)], ['class' => 'btn btn-primary card__button']) ?>
                                                                                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contents', 'action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete: {0}?', $content->content), 'class' => 'btn btn-rounded btn-danger']) ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endforeach; ?>
                                                                                    <!-- In order to pass a query to a controller, must add the '?'. Can be obtained via key value pair in the controller -->
                                                                                    <?= $this->Html->link(__('Add Attachments +'), ['controller' => 'Contents', 'action' => 'add',
                                                                                        '?' => ['ticket_id' => $ticket->id,
                                                                                            'f_name' => $customer->f_name,
                                                                                            'l_name' => $customer->l_name,
                                                                                            'cust_id' => $customer->id
                                                                                        ],
                                                                                    ], ['class' => 'btn btn-rounded btn-primary', 'style' => 'margin: 10px']); ?>
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
                                                                <?php elseif($ticket->closed == true) : ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endforeach ?>
                                                        <!-- End card section -->
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div id="openticket" style="display: none;">
                                                <div class="card">
                                                    <?php if (empty(array_filter($tickets, function($ticket) {
                                                        return $ticket->closed == false;
                                                    }))) : ?>
                                                        <div class="alert alert-primary" role="alert">
                                                            <p>No Open tickets found.</p>
                                                        </div>
                                                    <?php else : ?>
                                                        <p>            <!-- Cards section -->
                                                        <?php foreach ($tickets as $ticket): ?>
                                                            <div class="col-xl-12 col-lg-12 col-md-12col-sm-12 col-12">
                                                                <?php if($ticket->closed == false) : ?>
                                                                    <div class="card">
                                                                        <div class="card-header d-flex" style="background-color: lightgreen">
                                                                            <h4 class="card-header-title">Title:  <?= h($ticket->title) ?> | Type: <?= h($ticket->type) ?></h4>
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
                                                                                <p><span class="card-info">Ticket ID:</span> <?= h($ticket->id) ?></p>
                                                                                <p><span class="card-info">Customer:</span> <?= h($customer->f_name) ?></p>
                                                                                <p><span class="card-info">Assigned staff:</span> <?= $this->Html->link(__($ticket->user->f_name), ['controller' => 'Users', 'action' => 'view', $ticket->staff_id]) ?></p>
                                                                                <p><span class="card-info">Create time:</span> <?= h($ticket->createtime) ?></p>
                                                                                <br>
                                                                            </div>
                                                                            <a href="#" class="btn btn-primary card__button" id="showButton">Go somewhere</a>
                                                                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseShowOpenTicket<?= $ticket->id ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                                Expand Attachments
                                                                            </a>
                                                                        </div>
                                                                        <!-- In order to show unique collapse for each class, its id must be different. -->
                                                                        <div class="collapse" id="collapseShowOpenTicket<?= $ticket->id ?>">
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
                                                                                        'l_name' => $customer->l_name,
                                                                                        'cust_id' => $customer->id
                                                                                    ],
                                                                                ], ['class' => 'btn btn-rounded btn-primary', 'style' => 'margin: 10px']); ?>

                                                                                <?php if($ticket->contents) : ?>
                                                                                    <?php foreach ($ticket->contents as $content): ?>
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <h5 class="card-title">Attachment Type: <?= $content->content_type?></h5>
                                                                                                <h6 class="card-title">Create date: <?= $content->createtime?></h6>
                                                                                                <p class="card-text"><?= h($content->content) ?></p>
                                                                                                <!-- Why urlencode? because since im storing images as "conversation/image.png", passing $content->content as it is would only pass
                                                                                                     "conversation", not good. As such, as it is passed to download, you must decode it-->
                                                                                                <div style="display: flex; justify-content: space-between">
                                                                                                    <?= $this->Html->link('Download Attachment', ['controller' => 'Contents', 'action' => 'download', urlencode($content->content)], ['class' => 'btn btn-primary card__button']) ?>
                                                                                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contents', 'action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete # {0}?', $content->id), 'class' => 'btn btn-rounded btn-danger']) ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endforeach; ?>
                                                                                    <!-- In order to pass a query to a controller, must add the '?'. Can be obtained via key value pair in the controller -->
                                                                                    <?= $this->Html->link(__('Add Attachments +'), ['controller' => 'Contents', 'action' => 'add',
                                                                                        '?' => ['ticket_id' => $ticket->id,
                                                                                            'f_name' => $customer->f_name,
                                                                                            'l_name' => $customer->l_name,
                                                                                            'cust_id' => $customer->id
                                                                                        ],
                                                                                    ], ['class' => 'btn btn-rounded btn-primary', 'style' => 'margin: 10px']); ?>
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
                                                                <?php elseif($ticket->closed == false) : ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endforeach ?>
                                                        <!-- End card section -->
                                                    <?php endif; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-packages" role="tabpanel" aria-labelledby="pills-packages-tab">
                                            <?php
                                            if (!empty($customer->commdetails)) {
                                                echo '<div class="card">';
                                                echo '<h5 class="card-header">Primary E-mail: ' . h($customer->email) . '</h5>';
                                                echo '<div class="card-body">';
                                                echo '<ul class="list-group list-group-flush">';

                                                foreach ($customer->commdetails as $commdetail) {
                                                    // Output a list item for each communication detail
                                                    echo '<li class="list-group-item">';
                                                    echo '<h5>' . h($commdetail->type) . ': ' . h($commdetail->link) . '</h5>';

                                                    // Add an Edit button with a link to the edit page
                                                    echo $this->Html->link(__('Edit'), ['controller' => 'Commdetails', 'action' => 'edit', $commdetail->id,
                                                        '?' => [
                                                            'f_name' => $customer->f_name,
                                                            'l_name' => $customer->l_name,
                                                            'cust_id' => $customer->id
                                                        ],
                                                    ], ['class' => 'btn btn-primary']);

                                                    echo $this->Form->postLink(__('Delete'), ['controller' => 'Commdetails', 'action' => 'delete', $commdetail  ->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete this device?')]);


                                                    echo '</li>';
                                                }

                                                echo '</ul>';
                                                echo '</div>';
                                                echo '</div>';
                                            } else {
                                                echo '<p>No other contact methods were found</p>';
                                            }

                                            echo $this->Html->link(__('Add another communication detail'), ['controller' => 'Commdetails', 'action' => 'add',
                                                '?' => [
                                                    'f_name' => $customer->f_name,
                                                    'l_name' => $customer->l_name,
                                                    'cust_id' => $customer->id
                                                ],
                                            ], ['class' => 'btn btn-success mt-3']);
                                            ?>


                                        </div>
                                        <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                                            <h4>Devices</h4>
                                            <?php
                                            if (!empty($customer->devices)) {
                                                echo '<table class="table table-bordered">';
                                                echo '<thead><tr><th scope="col">Device Model</th><th scope="col">Technical Details</th><th scope="col">Session ID</th><th scope="col">Transaction ID</th><th scope="col">Platform</th><th scope="col">Gamblock Ver.</th><th scope="col">Actions</th></tr></thead>';
                                                echo '<tbody>';

                                                foreach ($customer->devices as $device) {
                                                    echo '<tr>';
                                                    echo '<td>' . h($device->device_model) . '</td>';
                                                    echo '<td>' . h($device->technical_details) . '</td>';
                                                    echo '<td>' . h($device->sessionid) . '</td>';
                                                    echo '<td>' . h($device->transactionid) . '</td>';
                                                    echo '<td>' . h($device->platform) . '</td>';
                                                    echo '<td>' . h($device->gamblock_ver) . '</td>';


                                                    // Actions column with Edit and Delete buttons
                                                    echo '<td>';
                                                    echo $this->Html->link(__('Edit'), ['controller' => 'Devices', 'action' => 'edit', $device->id,
                                                        '?' => [
                                                            'f_name' => $customer->f_name,
                                                            'l_name' => $customer->l_name,
                                                            'cust_id' => $customer->id
                                                        ],
                                                    ], ['class' => 'btn btn-primary']);
                                                    echo ' ';
                                                    echo $this->Form->postLink(__('Delete'), ['controller' => 'Devices', 'action' => 'delete', $device->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete this device?')]);
                                                    echo '</td>';

                                                    echo '</tr>';
                                                }

                                                echo '</tbody>';
                                                echo '</table>';
                                            } else {
                                                echo '<p>No devices associated with this customer.</p>';
                                            }
                                            ?>



                                            <?php echo $this->Html->link(__('Add New Device'), ['controller' => 'Devices', 'action' => 'add',
                                                '?' => [
                                                    'f_name' => $customer->f_name,
                                                    'l_name' => $customer->l_name,
                                                    'cust_id' => $customer->id
                                                ],
                                            ], ['class' => 'btn btn-success mt-3']); ?>

                                        </div
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
                        <!--                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">-->
                        <!--                        <div class="text-md-right footer-links d-none d-sm-block">-->
                        <!--                            <a href="javascript: void(0);">Documentation</a>-->
                        <!--                            <a href="javascript: void(0);">Contact Points</a>-->
                        <!--                        </div>-->
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
<?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>

<script>
    //Script I came up to show tickets based on whether its open or not, the if function exists
    //in php form for that to happen
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
