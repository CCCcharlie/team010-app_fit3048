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

//$this->disableAutoLayout();

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

    <style>
        td {
            max-width: 80px;
            /*width: 200px;*/
            overflow-wrap: break-word;
        }
    </style>

</head>

<body>

<div class="customers view content">
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
                <!--                        <h2 class="pageheader-title" style="color:lightslategrey">Welcome, -->
                <?php //= $identity->get('f_name'); ?><!--</h2>-->

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
            <!--                    <div style="position: sticky; top: 0px; float: right; background-color: #f5f5f5; padding: 10px; width: 200px;">-->
            <!--                        <h4 style="margin-bottom: 5px; font-size: 14px;">Actions:</h4>-->
            <!--                        <ul style="padding: 0; margin: 0; list-style: none; font-size: 12px;">-->
            <!--                            <li style="margin-bottom: 3px;">-->
            <!--                                --><?php //= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id], ['style' => 'display: block; text-decoration: none; color: #333;']) ?>
            <!--                            </li>-->
            <!--                            <li>-->
            <?php //= $this->Form->postLink(__('> Delete'), [ 'action' => 'delete', $customer->id], ['style' => 'display: block; padding: 10px 0; text-decoration: none; color: #333; border: 1px solid transparent; transition: border-color 0.3s ease;', 'confirm' => __('Are you sure you want to delete customer: {0} {1} ?', $customer->f_name, $customer->l_name)]); ?><!-- </li>-->
            <!--                            <li>-->
            <?php //= $this->Form->postLink(__('> Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id), 'style' => 'display: block; padding: 10px 0; text-decoration: none; color: #333; border: 1px solid transparent; transition: border-color 0.3s ease;']) ?><!--</li>-->
            <!--                        </ul>-->
            <!--                    </div>-->

            </aside>
            <div class="row">
                <!-- ============================================================== -->
                <!-- profile -->
                <!-- ============================================================== -->
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
                    <!-- ============================================================== -->
                    <!-- card profile -->
                    <!-- ============================================================== -->
                    <div class="card" style="min-height: 500px">
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

                        <div>
                            <?php if ($customer->archive == 0): ?>
                            <?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id], ['class' => 'btn btn-primary', 'style' => 'justify-content: center; display: flex']) ?>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if ($customer->archive == 0): ?>
                                <!-- Show the "Archive Profile" link if archive is 0 -->
                                <?= $this->Html->link(
                                    __('Archive Profile'),
                                    ['action' => 'archive', $customer->id],
                                    [
                                        'class' => 'btn btn-secondary',
                                        'style' => 'justify-content: center; display: flex',
                                        'confirm' => __('Are you sure you want to archive the status for: {0} {1}? Archiving a profile will close all tickets and make the profile no longer editable until it has been unarchived.', $customer->f_name, $customer->l_name)
                                    ]
                                ) ?>
                            <?php else: ?>
                                <!-- Show the "Unarchive Profile" link if archive is 1 -->
                                <?= $this->Html->link(
                                    __('Unarchive Profile'),
                                    ['action' => 'archive', $customer->id],
                                    [
                                        'class' => 'btn btn-success',
                                        'style' => 'justify-content: center; display: flex',
                                        'confirm' => __('Are you sure you want to unarchive the status for: {0} {1}? Unarchiving a profile will make it editable again.', $customer->f_name, $customer->l_name)
                                    ]
                                ) ?>
                            <?php endif; ?>

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
                                <a class="nav-link active" id="pills-campaign-tab" data-toggle="pill"
                                   href="#pills-campaign" role="tab" aria-controls="pills-campaign"
                                   aria-selected="true">Tickets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-packages-tab" data-toggle="pill"
                                   href="#pills-packages" role="tab" aria-controls="pills-packages"
                                   aria-selected="false">Contact Points</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-review-tab" data-toggle="pill"
                                   href="#pills-review" role="tab" aria-controls="pills-review"
                                   aria-selected="false">Technical Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-consellor-tab" data-toggle="pill"
                                   href="#pills-consellor" role="tab" aria-controls="pills-consellor"
                                   aria-selected="false">Consellor</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-campaign" role="tabpanel"
                                 aria-labelledby="pills-campaign-tab">
                                <div>
                                    <div class="card">
                                        <!-- Header buttons -->
                                        <div class="card-header">
                                            <div
                                                style="display: flex; justify-content: space-between; margin: 10px">
                                                <div class="btn-group btn-group-toggle"
                                                     data-toggle="buttons" style="padding-right: 10px">
                                                    <label class="btn btn-primary active">
                                                        <input type="radio" name="options"
                                                               id="showallticket" checked> All
                                                    </label>
                                                    <label class="btn btn-primary">
                                                        <input type="radio" name="options"
                                                               id="showcloseticket"> Closed
                                                    </label>
                                                    <label class="btn btn-primary">
                                                        <input type="radio" name="options"
                                                               id="showopenticket"> Open
                                                    </label>
                                                </div>
                                                <?php if ($customer->archive == 0): ?>
                                                    <?= $this->Html->link(__('Create Ticket +'), ['controller' => 'Tickets', 'action' => 'add',
                                                        '?' => [
                                                            'f_name' => $customer->f_name,
                                                            'l_name' => $customer->l_name,
                                                            'cust_id' => $customer->id
                                                        ],
                                                    ], ['class' => 'btn btn-success mt-3']); ?>
                                                <?php endif; ?>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Header buttons -->
                                    <div id="allticket">
                                        <div class="card">
                                            <p>            <!-- Cards section -->
                                                <?php foreach ($tickets

                                                as $ticket): ?>
                                            <div class="col-xl-12 col-lg-12 col-md-12col-sm-12 col-12">
                                                <div class="card">
                                                    <?php if ($ticket->closed == true) : ?>
                                                    <div class="card-header d-flex"
                                                         style="background-color: lightgray">
                                                        <?php elseif ($ticket->closed == false) : ?>
                                                        <div class="card-header d-flex"
                                                             style="background-color: #50C878">
                                                            <?php endif; ?>
                                                            <div>
                                                                <h4 class="card-header-title">
                                                                    Title: <?= h($ticket->title) ?></h4>
                                                                <h5> Type: <?= h($ticket->type) ?> </h5>
                                                                <?php if ($ticket->closed == true) : ?>
                                                                    <h6> Status: Closed </h6>
                                                                <?php elseif ($ticket->closed == false) : ?>
                                                                    <h6> Status: Open </h6>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if ($customer->archive == 0): ?>
                                                                <div class="toolbar ml-auto">
                                                                    <?php
                                                                    //if true means it is closed. Allow option to open ticket
                                                                    if ($ticket->closed) {
                                                                        echo $this->Form->postLink(__('Open ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-primary', 'confirm' => __("Are you sure you want to Reopen ticket ID: {0} \n Customer: {1} {2} ", $ticket->id, $customer->f_name, $customer->l_name)]);
                                                                    } else {
                                                                        echo $this->Form->postLink(__('Close ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-close', 'confirm' => __("Are you sure you want to Close ticket ID: {0} \n Customer: {1} {2} ", $ticket->id, $customer->f_name, $customer->l_name)]);
                                                                    }
                                                                    ?>
                                                                </div>
                                                            <?php endif; ?>

                                                        </div>


                                                        <div class="card-body">

                                                            <div class="card-text">
                                                                <p><span
                                                                        class="card-info">Ticket ID:</span> <?= h($ticket->id) ?>
                                                                </p>
                                                                <p><span
                                                                        class="card-info">Customer:</span> <?= h($customer->f_name) ?>
                                                                </p>
                                                                <p><span
                                                                        class="card-info">Assigned staff:</span>

                                                                    <?php
                                                                    if ($ticket->staff_id !== null) {
                                                                        echo $this->Html->link(__($ticket->user->f_name), ['controller' => 'Users', 'action' => 'view', $ticket->staff_id]);
                                                                    } else {
                                                                        echo 'No staff assigned';
                                                                    }
                                                                    ?>
                                                                </p>
                                                                <p><span
                                                                        class="card-info">Create time:</span> <?= $ticket->createtime->i18nFormat('yyyy-MM-dd HH:mm:ss', 'Australia/Sydney') ?>
                                                                </p>
                                                                <br>
                                                            </div>
                                                            <div
                                                                style="display: flex; justify-content: space-between">
                                                                <a class="btn btn-primary"
                                                                   data-toggle="collapse"
                                                                   href="#collapseExample<?= $ticket->id ?>"
                                                                   role="button" aria-expanded="false"
                                                                   aria-controls="collapseExample">
                                                                    Expand Attachments
                                                                </a>
                                                                <span>
                                                        <?php if ($this->Identity->get('role') == 'root' || $this->Identity->get('role') == 'admin'): ?>
                                                                    <?php if ($customer->archive == 0): ?>
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
                                                            <?php endif; ?>
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
                                                        <div class="collapse"
                                                             id="collapseExample<?= $ticket->id ?>">
                                                            <div class="card card-body">
                                                                <!-- Because contents is already asked in Customers controller in this query

                                                                        $tickets = $this->Customers->Tickets->find('all')
                                                                        ->where(['cust_id' => $customer->id])
                                                                        ->contain(['Users', 'Contents']) // I want to retrieve the name of the staff (users) & contents, so this is added so I can reference it
                                                                        ->toArray();

                                                                      We can reiterate contents for that ticket here as follows
                                                                -->

                                                                <!-- In order to pass a query to a controller, must add the '?'. Can be obtained via key value pair in the controller -->
                                                                <?php if ($customer->archive == 0): ?>
                                                                    <?= $this->Html->link(__('Add Attachments +'), ['controller' => 'Contents', 'action' => 'add',
                                                                        '?' => [
                                                                            'ticket_id' => $ticket->id,
                                                                            'f_name' => $customer->f_name,
                                                                            'l_name' => $customer->l_name,
                                                                            'cust_id' => $customer->id
                                                                        ],
                                                                    ], ['class' => 'btn btn-success mt-3', 'style' => 'margin: 10px']); ?>
                                                                <?php endif; ?>


                                                                <?php if ($ticket->contents) : ?>
                                                                    <?php foreach ($ticket->contents as $content): ?>
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">
                                                                                    Attachment
                                                                                    Type: <?= $content->content_type ?></h5>
                                                                                <h6 class="card-title">
                                                                                    Create
                                                                                    date: <?= $content->createtime ?></h6>
                                                                                <p class="card-text"><?= h($content->content) ?></p>
                                                                                <!-- Why urlencode? because since im storing images as "conversation/image.png", passing $content->content as it is would only pass
                                                                                     "conversation", not good. As such, as it is passed to download, you must decode it-->
                                                                                <div
                                                                                    style="display: flex; justify-content: space-between">
                                                                                    <?= $this->Html->link('Download Attachment', ['controller' => 'Contents', 'action' => 'download', urlencode($content->content)], ['class' => 'btn btn-primary card__button']) ?>
                                                                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contents', 'action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete this file?'), 'class' => 'btn btn-rounded btn-danger']) ?>
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
                                                                    ], ['class' => 'btn btn-success mt-3', 'style' => 'margin: 10px']); ?>
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
                                            <?php if (empty(array_filter($tickets, function ($ticket) {
                                                return $ticket->closed == true;
                                            }))) : ?>
                                                <div class="alert alert-primary" role="alert">
                                                    <p>No Closed tickets found.</p>
                                                </div>
                                            <?php else : ?>
                                                <p>            <!-- Cards section -->
                                                <?php foreach ($tickets as $ticket): ?>
                                                    <div
                                                        class="col-xl-12 col-lg-12 col-md-12col-sm-12 col-12">
                                                        <?php if ($ticket->closed == true) : ?>
                                                            <div class="card">
                                                                <div class="card-header d-flex"
                                                                     style="background-color: lightgray">
                                                                    <div>
                                                                        <h4 class="card-header-title">
                                                                            Title: <?= h($ticket->title) ?></h4>
                                                                        <h5>
                                                                            Type: <?= h($ticket->type) ?> </h5>
                                                                        <?php if ($ticket->closed == true) : ?>
                                                                            <h6> Status: Closed </h6>
                                                                        <?php elseif ($ticket->closed == false) : ?>
                                                                            <h6> Status: Open </h6>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="toolbar ml-auto">
                                                                        <?php if ($customer->archive == 0): ?>
                                                                            <?php
                                                                            //if true means it is closed. Allow option to open ticket
                                                                            if ($ticket->closed) {
                                                                                echo $this->Form->postLink(__('Open ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-primary', 'confirm' => __("Are you sure you want to Reopen ticket ID: {0} \n Customer: {1} {2} ", $ticket->id, $customer->f_name, $customer->l_name)]);
                                                                            } else {
                                                                                echo $this->Form->postLink(__('Close ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-primary', 'confirm' => __("Are you sure you want to Close ticket ID: {0} \n Customer: {1} {2} ", $ticket->id, $customer->f_name, $customer->l_name), 'style' => 'background-color: #E3242B; color: #FFFFFF;']);
                                                                            }
                                                                            ?>
                                                                        <?php endif; ?>


                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="card-text">
                                                                        <p><span class="card-info">Ticket ID:</span> <?= h($ticket->id) ?>
                                                                        </p>
                                                                        <p><span
                                                                                class="card-info">Customer:</span> <?= h($customer->f_name) ?>
                                                                        </p>
                                                                        <p><span class="card-info">Assigned staff:</span> <?= $this->Html->link(__($ticket->user->f_name), ['controller' => 'Users', 'action' => 'view', $ticket->staff_id]) ?>
                                                                        </p>
                                                                        <p><span class="card-info">Create time:</span> <?= h($ticket->createtime) ?>
                                                                        </p>
                                                                        <br>
                                                                    </div>
                                                                    <!--                                                                            <a href="#" class="btn btn-primary card__button" id="showButton">Go somewhere</a>-->
                                                                    <a class="btn btn-primary"
                                                                       data-toggle="collapse"
                                                                       href="#collapseShowCloseTicket<?= $ticket->id ?>"
                                                                       role="button" aria-expanded="false"
                                                                       aria-controls="collapseExample">
                                                                        Expand Attachments
                                                                    </a>
                                                                </div>
                                                                <!-- In order to show unique collapse for each class, its id must be different. -->
                                                                <div class="collapse"
                                                                     id="collapseShowCloseTicket<?= $ticket->id ?>">
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
                                                                        ], ['class' => 'btn btn-success mt-3', 'style' => 'margin: 10px']); ?>

                                                                        <?php if ($ticket->contents) : ?>
                                                                            <?php foreach ($ticket->contents as $content): ?>
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">
                                                                                            Attachment
                                                                                            Type: <?= $content->content_type ?></h5>
                                                                                        <h6 class="card-title">
                                                                                            Create
                                                                                            date: <?= $content->createtime ?></h6>
                                                                                        <p class="card-text"><?= h($content->content) ?></p>
                                                                                        <!-- Why urlencode? because since im storing images as "conversation/image.png", passing $content->content as it is would only pass
                                                                                             "conversation", not good. As such, as it is passed to download, you must decode it-->
                                                                                        <div
                                                                                            style="display: flex; justify-content: space-between">
                                                                                            <?= $this->Html->link('Download Attachment', ['controller' => 'Contents', 'action' => 'download', urlencode($content->content)], ['class' => 'btn btn-primary card__button']) ?>
                                                                                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contents', 'action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete this file?'), 'class' => 'btn btn-rounded btn-danger']) ?>
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
                                                                            ], ['class' => 'btn btn-success mt-3', 'style' => 'margin: 10px']); ?>
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
                                                        <?php elseif ($ticket->closed == true) : ?>
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
                                            <?php if (empty(array_filter($tickets, function ($ticket) {
                                                return $ticket->closed == false;
                                            }))) : ?>
                                                <div class="alert alert-primary" role="alert">
                                                    <p>No Open tickets found.</p>
                                                </div>
                                            <?php else : ?>
                                                <p>            <!-- Cards section -->
                                                <?php foreach ($tickets as $ticket): ?>
                                                    <div
                                                        class="col-xl-12 col-lg-12 col-md-12col-sm-12 col-12">
                                                        <?php if ($ticket->closed == false) : ?>
                                                            <div class="card">
                                                                <div class="card-header d-flex"
                                                                     style="background-color: #50C878">
                                                                    <div>
                                                                        <h4 class="card-header-title">
                                                                            Title: <?= h($ticket->title) ?></h4>
                                                                        <h5>
                                                                            Type: <?= h($ticket->type) ?> </h5>
                                                                        <?php if ($ticket->closed == true) : ?>
                                                                            <h6> Status: Closed </h6>
                                                                        <?php elseif ($ticket->closed == false) : ?>
                                                                            <h6> Status: Open </h6>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <?php if ($customer->archive == 0): ?>
                                                                        <div class="toolbar ml-auto">
                                                                            <?php
                                                                            //if true means it is closed. Allow option to open ticket
                                                                            if ($ticket->closed) {
                                                                                echo $this->Form->postLink(__('Open ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-primary', 'confirm' => __("Are you sure you want to Reopen ticket ID: {0} \n Customer: {1} {2} ", $ticket->id, $customer->f_name, $customer->l_name)]);
                                                                            } else {
                                                                                echo $this->Form->postLink(__('Close ticket'), ['controller' => 'Tickets', 'action' => 'update_ticket', $ticket->id], ['class' => 'btn btn-close', 'confirm' => __("Are you sure you want to Close ticket ID: {0} \n Customer: {1} {2} ", $ticket->id, $customer->f_name, $customer->l_name)]);
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="card-text">
                                                                        <p><span class="card-info">Ticket ID:</span> <?= h($ticket->id) ?>
                                                                        </p>
                                                                        <p><span
                                                                                class="card-info">Customer:</span> <?= h($customer->f_name) ?>
                                                                        </p>
                                                                        <p><span class="card-info">Assigned staff:</span>

                                                                            <?php
                                                                            if ($ticket->staff_id !== null) {
                                                                                echo $this->Html->link(__($ticket->user->f_name), ['controller' => 'Users', 'action' => 'view', $ticket->staff_id]);
                                                                            } else {
                                                                                echo 'No staff assigned';
                                                                            }
                                                                            ?>
                                                                        </p>
                                                                        <p><span class="card-info">Create time:</span> <?= $ticket->createtime->i18nFormat('yyyy-MM-dd HH:mm:ss', 'Australia/Sydney') ?>
                                                                        </p>
                                                                        <p><span class="card-info">Create time:</span> <?= h($ticket->createtime) ?>
                                                                        </p>
                                                                        <br>
                                                                    </div>
                                                                    <!--                                                                            <a href="#" class="btn btn-primary card__button" id="showButton">Go somewhere</a>-->
                                                                    <a class="btn btn-primary"
                                                                       data-toggle="collapse"
                                                                       href="#collapseShowOpenTicket<?= $ticket->id ?>"
                                                                       role="button" aria-expanded="false"
                                                                       aria-controls="collapseExample">
                                                                        Expand Attachments
                                                                    </a>
                                                                </div>
                                                                <!-- In order to show unique collapse for each class, its id must be different. -->
                                                                <div class="collapse"
                                                                     id="collapseShowOpenTicket<?= $ticket->id ?>">
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
                                                                        ], ['class' => 'btn btn-success mt-3', 'style' => 'margin: 10px']); ?>

                                                                        <?php if ($ticket->contents) : ?>
                                                                            <?php foreach ($ticket->contents as $content): ?>
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">
                                                                                            Attachment
                                                                                            Type: <?= $content->content_type ?></h5>
                                                                                        <h6 class="card-title">
                                                                                            Create
                                                                                            date: <?= $content->createtime ?></h6>
                                                                                        <p class="card-text"><?= h($content->content) ?></p>
                                                                                        <!-- Why urlencode? because since im storing images as "conversation/image.png", passing $content->content as it is would only pass
                                                                                             "conversation", not good. As such, as it is passed to download, you must decode it-->
                                                                                        <div
                                                                                            style="display: flex; justify-content: space-between">
                                                                                            <?= $this->Html->link('Download Attachment', ['controller' => 'Contents', 'action' => 'download', urlencode($content->content)], ['class' => 'btn btn-primary card__button']) ?>
                                                                                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contents', 'action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete this file?'), 'class' => 'btn btn-rounded btn-danger']) ?>
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
                                                                            ], ['class' => 'btn btn-success mt-3', 'style' => 'margin: 10px']); ?>
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
                                                        <?php elseif ($ticket->closed == false) : ?>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach ?>
                                                <!-- End card section -->
                                            <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-packages" role="tabpanel"
                                     aria-labelledby="pills-packages-tab">
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

                                            // Check if the user is archived (assuming $customer->archive indicates the archived status)
                                            if ($customer->archive == 0) {
                                                // User is not archived, so display the Edit and Delete buttons
                                                echo $this->Html->link(__('Edit'), ['controller' => 'Commdetails', 'action' => 'edit', $commdetail->id,
                                                    '?' => [
                                                        'f_name' => $customer->f_name,
                                                        'l_name' => $customer->l_name,
                                                        'cust_id' => $customer->id
                                                    ],
                                                ], ['class' => 'btn btn-primary']);

                                                echo $this->Form->postLink(__('Delete'), ['controller' => 'Commdetails', 'action' => 'delete', $commdetail->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete this device?')]);
                                            }

                                            echo '</li>';
                                        }


                                        echo '</ul>';
                                        echo '</div>';
                                        echo '</div>';
                                    } else {
                                        echo '<p>No other contact methods were found</p>';
                                    }

                                    if ($customer->archive == 0) {
                                        echo $this->Html->link(__('Add another communication detail'), ['controller' => 'Commdetails', 'action' => 'add',
                                            '?' => [
                                                'f_name' => $customer->f_name,
                                                'l_name' => $customer->l_name,
                                                'cust_id' => $customer->id
                                            ],
                                        ], ['class' => 'btn btn-success mt-3']);
                                    }
                                    ?>


                                </div>
                                <div class="tab-pane fade" id="pills-review" role="tabpanel"
                                     aria-labelledby="pills-review-tab">
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
                                            if ($customer->archive == 0) {
                                                // Display "Edit" and "Delete" buttons if the customer is not archived
                                                echo $this->Html->link(__('Edit'), ['controller' => 'Devices', 'action' => 'edit', $device->id,
                                                    '?' => [
                                                        'f_name' => $customer->f_name,
                                                        'l_name' => $customer->l_name,
                                                        'cust_id' => $customer->id
                                                    ],
                                                ], ['class' => 'btn btn-primary']);
                                                echo ' ';
                                                echo $this->Form->postLink(__('Delete'), ['controller' => 'Devices', 'action' => 'delete', $device->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete this device?')]);
                                            } else {
                                                // Display a message if the customer is archived
                                                echo 'Actions are not available in archive mode.';
                                            }

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

                                </div>
                                <div class="tab-pane fade" id="pills-consellor" role="tabpanel"
                                     aria-labelledby="pills-consellor-tab">
                                    <?php
                                    if (!empty($customer->counsellors)) {
                                        echo '<table class="table table-bordered">';
                                        echo '<thead><tr><th scope="col">First Name</th><th scope="col">Last Name</th><th scope="col">Notes</th><th scope="col">Contact</th><th scope="col">Actions</th></tr></thead>';
                                        echo '<tbody>';

                                        foreach ($customer->counsellors as $counsellor) {
                                            echo '<tr>';
                                            echo '<td>' . h($counsellor->f_name) . '</td>';
                                            echo '<td>' . h($counsellor->l_name) . '</td>';
                                            echo '<td>' . h($counsellor->notes) . '</td>';
                                            echo '<td>' . h($counsellor->contact) . '</td>';

                                            // Actions column with View, Edit, and Delete buttons
                                            echo '<td>';

                                            if ($customer->archive == 0) {
                                                // Display "Edit" and "Delete" buttons if the customer is not archived
                                                echo $this->Html->link(__('Edit'), ['controller' => 'Counsellors', 'action' => 'edit', $counsellor->id], ['class' => 'btn btn-primary']);
                                                echo ' ';
                                                echo $this->Form->postLink(__('Delete'), ['controller' => 'Counsellors', 'action' => 'delete', $counsellor->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete this counsellor?')]);
                                            } else {
                                                // Display a message if the customer is archived
                                                echo 'Actions are not available in archive mode.';
                                            }

                                            echo '</td>';

                                            echo '</tr>';
                                        }

                                        echo '</tbody>';
                                        echo '</table>';
                                    } else {
                                        echo '<p>No counsellors associated with this customer.</p>';
                                    }
                                    ?>

                                    <?php if ($customer->archive == 0): ?>
                                        <?php echo $this->Html->link(__('Add New Counsellor'), ['controller' => 'Counsellors', 'action' => 'add',
                                            '?' => [
                                                'f_name' => $customer->f_name,
                                                'l_name' => $customer->l_name,
                                                'cust_id' => $customer->id
                                            ],
                                        ], ['class' => 'btn btn-success mt-3']); ?>
                                    <?php endif; ?>



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
    </div>
</div>


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
    $(document).ready(function () {
        // Initial state setup
        $("#allticket").show();
        $("#closeticket").hide();
        $("#openticket").hide();


        $("input[name='options']").change(function () {
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
