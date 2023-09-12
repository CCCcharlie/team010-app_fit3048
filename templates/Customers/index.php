<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Customer> $customers
 *
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
        td {
            max-width: 200px;
            /*width: 200px;*/
            overflow-wrap: break-word;
        }

        .device-details {
            margin-bottom: 10px;
        }

        .separator {
            height: 3px;
            background-color: #ccc; /* Change this to your preferred color */
            margin: 10px 0; /* Adjust the margin as needed for spacing */
        }

        .pagination-counter {
            margin-top: 10px;
        }

        .custom-button {
            margin-right: 2px;
        }
    </style>


</head>

<body>

        <div class="customers index content">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="F">
                    <div class="page-header" id="top">

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">View all customers</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- To obtain the identity, use $identity = $this->request->getAttribute('authentication')->getIdentity(); to find the currently logged in entity
to get the name or any value in the staff table, use the get and then the name of the attribute $identity->get('staff_fname')-->
                        <?php $identity = $this->request->getAttribute('authentication')->getIdentity();
                        //                        debug($identity->get('f_name'));
                        //                        exit();
                        ?>
                        <!--                                <h2 class="pageheader-title" style="color: lightslategrey">Welcome, -->
                        <?php //= $identity->get('f_name'); ?><!--</h2>-->

                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->

            <div class="customers index content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="cardaction">
                            <h3 class="section-title" style="color: midnightblue">Archived Customer View</h3>
                            <p style="color: midnightblue"> These profiles have been archived for a period longer than </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!--     button for changing view    -->


                        <!--                            -->
                        <br>
                        <div class="row">
                            <div class="col-md-6 ">
                                <h3 style="color: midnightblue"> Filter: </h3>
                                <?= $this->Form->create(null, ['url' => ['controller' => 'Customers', 'action' => 'index'], 'type' => 'get', 'class' => 'form-inline']) ?>
                                <div class="form-group mr-2">
                                    <?= $this->Form->input('search', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Search by name']) ?>
                                </div>
                                <div class="btn-group ml-2">
                                    <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary custom-button']) ?>
                                    <?= $this->Form->end() ?>

                                    <button id="table-view-btn" type="button" class="btn btn-primary custom-button">
                                        Table View
                                    </button>
                                    <button id="list-view-btn" type="button" class="btn btn-primary custom-button">List
                                        View
                                    </button>

                                </div>
                            </div>
                        </div>
                        <!--                            <tr>-->
                        <!--                                <th>-->
                        <!--                                    --><?php
                        //                                    $sortField = 'f_name';
                        //                                    $sortDir = 'asc';
                        //                                    if ($this->Paginator->sortKey() === $sortField) {
                        //                                        $sortDir = ($this->Paginator->sortDir() === 'asc') ? 'desc' : 'asc';
                        //                                    }
                        //                                    ?>
                        <!--                                    --><?php //= $this->Paginator->sort('f_name', 'First Name', ['direction' => $sortDir]) ?>
                        <!--                                    --><?php //if ($this->Paginator->sortKey() === 'f_name') : ?>
                        <!--                                        --><?php //if ($sortDir === 'asc') : ?>
                        <!--                                            <img src="-->
                        <?php //= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Down Arrow">-->
                        <!--                                        --><?php //else : ?>
                        <!--                                            <img src="-->
                        <?php //= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Up Arrow">-->
                        <!--                                        --><?php //endif; ?>
                        <!--                                    --><?php //endif; ?>
                        <!--                                    |-->
                        <!--                                </th>-->
                        <!---->
                        <!--                                <th>-->
                        <!--                                    --><?php
                        //                                    $sortField = 'l_name';
                        //                                    $sortDir = 'asc';
                        //                                    if ($this->Paginator->sortKey() === $sortField) {
                        //                                        $sortDir = ($this->Paginator->sortDir() === 'asc') ? 'desc' : 'asc';
                        //                                    }
                        //                                    ?>
                        <!--                                    --><?php //= $this->Paginator->sort('l_name', 'Last Name', ['direction' => $sortDir]) ?>
                        <!--                                    --><?php //if ($this->Paginator->sortKey() === 'l_name') : ?>
                        <!--                                        --><?php //if ($sortDir === 'asc') : ?>
                        <!--                                            <img src="-->
                        <?php //= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Down Arrow">-->
                        <!--                                        --><?php //else : ?>
                        <!--                                            <img src="-->
                        <?php //= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Up Arrow">-->
                        <!--                                        --><?php //endif; ?>
                        <!--                                    --><?php //endif; ?>
                        <!--                                    |-->
                        <!--                                </th>-->

                        <!--                                <th>-->
                        <!--                                    --><?php
                        //                                    $sortField = 'age';
                        //                                    $sortDir = 'asc';
                        //                                    if ($this->Paginator->sortKey() === $sortField) {
                        //                                        $sortDir = ($this->Paginator->sortDir() === 'asc') ? 'desc' : 'asc';
                        //                                    }
                        //                                    ?>
                        <!--                                    --><?php //= $this->Paginator->sort('age', 'Age', ['direction' => $sortDir]) ?>
                        <!--                                    --><?php //if ($this->Paginator->sortKey() === 'age') : ?>
                        <!--                                        --><?php //if ($sortDir === 'asc') : ?>
                        <!--                                            <img src="-->
                        <?php //= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Down Arrow">-->
                        <!--                                        --><?php //else : ?>
                        <!--                                            <img src="-->
                        <?php //= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Up Arrow">-->
                        <!--                                        --><?php //endif; ?>
                        <!--                                    --><?php //endif; ?>
                        <!--                                    |-->
                        <!--                                </th>-->

                        <!--                                <th>-->
                        <!--                                    --><?php
                        //                                    $sortField = 'email';
                        //                                    $sortDir = 'asc';
                        //                                    if ($this->Paginator->sortKey() === $sortField) {
                        //                                        $sortDir = ($this->Paginator->sortDir() === 'asc') ? 'desc' : 'asc';
                        //                                    }
                        //                                    ?>
                        <!--                                    --><?php //= $this->Paginator->sort('email', 'Email', ['direction' => $sortDir]) ?>
                        <!--                                    --><?php //if ($this->Paginator->sortKey() === 'email') : ?>
                        <!--                                        --><?php //if ($sortDir === 'asc') : ?>
                        <!--                                            <img src="-->
                        <?php //= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Down Arrow">-->
                        <!--                                        --><?php //else : ?>
                        <!--                                            <img src="-->
                        <?php //= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Up Arrow">-->
                        <!--                                        --><?php //endif; ?>
                        <!--                                    --><?php //endif; ?>
                        <!--                                </th>-->
                        </tr>
                        <?= $this->Html->link(__('New Customer'), ['action' => 'add'], ['class' => 'btn btn-success float-right', 'style' => 'padding-bottom : 5px']) ?>

                        <br>
                        <br>


                        <!-- Space reserver -->
                        <div id="filtered-content">
                            <!-- content show for assign to me -->
                        </div>

                        <!-- view option list-->

                        <div class="row" id="customers-list" style="display: none;">
                            <?php foreach ($customers as $customer): ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header d-flex">
                                            <h4 class="card-header-title"><?= h($customer->f_name) ?> <?= h($customer->l_name) ?></h4>
                                            <div class="toolbar card-toolbar-tabs ml-auto">
                                                <ul class="nav nav-pills" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active"
                                                           id="pills-home-tab-<?= $customer->id ?>" data-toggle="pill"
                                                           href="#pills-home-<?= $customer->id ?>" role="tab"
                                                           aria-controls="pills-home" aria-selected="true">Home</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="pills-profile-tab-<?= $customer->id ?>"
                                                           data-toggle="pill" href="#pills-profile-<?= $customer->id ?>"
                                                           role="tab" aria-controls="pills-profile"
                                                           aria-selected="false">Technical Details</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="pills-contact-tab-<?= $customer->id ?>"
                                                           data-toggle="pill" href="#pills-contact-<?= $customer->id ?>"
                                                           role="tab" aria-controls="pills-contact"
                                                           aria-selected="false">Contact Methods</a>
                                                    </li>
                                                    <!--                                                    <li class="nav-item">-->
                                                    <!--                                                        <a class="nav-link" id="pills-contact-tab--->
                                                    <?php //= $customer->id ?><!--" data-toggle="pill" href="#pills-consellors--->
                                                    <?php //= $customer->id ?><!--" role="tab" aria-controls="pills-consellors-" aria-selected="false">Consellors-</a>-->
                                                    <!--                                                    </li>-->
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content mb-3" id="pills-tabContent-<?= $customer->id ?>">
                                                <div class="tab-pane fade show active"
                                                     id="pills-home-<?= $customer->id ?>" role="tabpanel"
                                                     aria-labelledby="pills-home-tab-<?= $customer->id ?>">

                                                    <br> Status: <?= h($customer->status) ?>
                                                    <br> Notes: <?= h($customer->notes) ?>

                                                </div>
                                                <div class="tab-pane fade" id="pills-profile-<?= $customer->id ?>"
                                                     role="tabpanel"
                                                     aria-labelledby="pills-profile-tab-<?= $customer->id ?>">
                                                    <?php
                                                    if (!empty($customer->devices)) {
                                                        foreach ($customer->devices as $device) {
                                                            echo '<p>Device Model: ' . h($device->device_model) . '</p>';
                                                            echo '<p>Technical Details: ' . h($device->technical_details) . '</p>';
                                                            echo '<p>Session ID: ' . h($device->session_id) . '</p>';
                                                            echo '<p>Transaction ID: ' . h($device->transaction_id) . '</p>';

                                                        }
                                                    } else {
                                                        echo '<p>No devices associated with this customer.</p>';
                                                    }
                                                    ?>
                                                </div>


                                                <div class="tab-pane fade" id="pills-contact-<?= $customer->id ?>"
                                                     role="tabpanel"
                                                     aria-labelledby="pills-contact-tab-<?= $customer->id ?>">
                                                    <br>Primary E-mail: <?= h($customer->email) ?>
                                                    <?php
                                                    if (!empty($customer->commdetails)) {
                                                        foreach ($customer->commdetails as $commdetail) {
                                                            echo '<p>Alternate Contact: ' . h($commdetail->link) . '</p>';
                                                        }
                                                    } else {
                                                        echo '<p>No other contact methods were found</p>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?= $this->Html->link(__('View Full Profile'), ['action' => 'view', $customer->id], ['class' => 'btn btn-primary']) ?>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; ?>

                            <?php if ($this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) === 'Page 1 of 0, showing 0 record(s) out of 0 total'): ?>
                                <p>No results found.</p>
                            <?php endif; ?>


                        </div>

                        <!--table view option-->
                        <table class="table table-hover table-striped" id="customers-table">
                            <thead>
                            <tr>
                                <th class="col-md-1">
                                    <div class="sorting-header">
                                        <?= $this->Paginator->sort(
                                            'f_name',
                                            'First Name',
                                            ['escape' => false]
                                        ) ?>
                                        <?php if ($this->Paginator->sortKey() === 'f_name') : ?>
                                            <div class="sorting-icon">
                                                <?php if ($this->Paginator->sortDir() === 'asc') : ?>
                                                    <img
                                                        src="<?= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                                        alt="Down Arrow">
                                                <?php else : ?>
                                                    <img
                                                        src="<?= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                                        alt="Up Arrow">
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </th>
                                <th class="col-md-2">
                                    <div class="sorting-header">
                                        <?= $this->Paginator->sort(
                                            'l_name',
                                            'Last Name',
                                            ['escape' => false]
                                        ) ?>
                                        <?php if ($this->Paginator->sortKey() === 'l_name') : ?>
                                            <div class="sorting-icon">
                                                <?php if ($this->Paginator->sortDir() === 'asc') : ?>
                                                    <img
                                                        src="<?= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                                        alt="Down Arrow">
                                                <?php else : ?>
                                                    <img
                                                        src="<?= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                                        alt="Up Arrow">
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </th>
                                <th class="col-md-1">
                                    <div class="sorting-header">
                                        <?= $this->Paginator->sort(
                                            'status',
                                            'Status',
                                            ['escape' => false]
                                        ) ?>
                                        <?php if ($this->Paginator->sortKey() === 'status') : ?>
                                            <div class="sorting-icon">
                                                <?php if ($this->Paginator->sortDir() === 'asc') : ?>
                                                    <img
                                                        src="<?= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                                        alt="Down Arrow">
                                                <?php else : ?>
                                                    <img
                                                        src="<?= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                                        alt="Up Arrow">
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </th>
                                <th class="col-md-5">
                                    <div class="sorting-header">
                                        Device Information
                                    </div>
                                </th>
                                <th class="col-md-5">
                                    <div class="sorting-header">
                                        Notes
                                    </div>
                                </th>


                                <th class="col-md-2 actions">
                                    <?= __('Actions') ?>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($customers as $customer): ?>
                                <tr>
                                    <td><?= h($customer->f_name) ?> </td>
                                    <td><?= h($customer->l_name) ?></td>
                                    <td><?= h($customer->status) ?></td>
                                    <td>
                                        <?php if (!empty($customer->devices)) : ?>
                                            <?php $deviceCount = count($customer->devices); ?>
                                            <?php foreach ($customer->devices as $key => $device) : ?>
                                                <div class="device-details">
                                                    <div>
                                                        <strong>Platform: </strong><?= !empty($device->platform) ? h($device->platform) : 'No information found' ?>
                                                    </div>
                                                    <strong>Transaction
                                                        ID:</strong> <?= !empty($device->transactionid) ? h($device->transactionid) : 'No information found' ?>
                                                    <div>
                                                        <strong>Session
                                                            ID:</strong> <?= !empty($device->sessionid) ? h($device->sessionid) : 'No information found' ?>
                                                    </div>
                                                </div>
                                                <?php if ($deviceCount > 1 && $key < ($deviceCount - 1)) : ?>
                                                    <div class="separator"></div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <p>No device details found for this user. Please add some via clicking <a
                                                    href="<?= $this->Url->build(['action' => 'view', $customer->id]) ?>">View
                                                    Full Profile</a> on the right.</p>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($customer->notes)) : ?>
                                            <p> <?= h($customer->notes) ?> </p>
                                        <?php else : ?>
                                            No notes have been provided about the customer.
                                        <?php endif; ?>
                                    </td>
                                    <!--                                    consellor-->



                                    <td style="width: 200px">
                                        <?= $this->Html->link(__('View Full Profile'), ['action' => 'view', $customer->id], ['class' => 'btn btn-primary']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if ($this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) === 'Page 1 of 0, showing 0 record(s) out of 0 total'): ?>
                                <tr>
                                    <td colspan="5">No results found.</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!--                        <a href="javascript: " id="return-to-top"><i class="icon-chevron-up"></i></a>-->
                    <div class="card-footer-item">


                        <div class="pagination-controls">
                            <p class="pagination-counter">
                            <form class="pagination-goto">
                                <label for="goto-page">Go to page:</label>

                                <input type="text" id="goto-page" name="page">
                                <button class="btn btn-primary" type="submit">Go</button>

                            </form>
                        </div>
                        <p class="pagination-counter"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                    </div>
                </div>
            </div>
        </div>

<!---->
<!--                    EXPLAINING THE SCRIPTS -->
<!--                    Concept - Template-->
<!--                    SlimScroll - JS Plugin. Allows for any div to be scrollable.-->
<!--                    Jquery  - Essential Javascript library-->
<!--                    Add any explinations here for any scripts you add. - Alex-->


<?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
<?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js', 'gototoparrow.js']) ?>

<!--script for switching view method-->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const listViewBtn = document.getElementById('list-view-btn');
        const tableViewBtn = document.getElementById('table-view-btn');
        const customersList = document.getElementById('customers-list');
        const customersTable = document.getElementById('customers-table');

        listViewBtn.addEventListener('click', function () {
            customersList.style.display = 'flex';
            customersTable.style.display = 'none';
        });
        // the styple display of the customer
        tableViewBtn.addEventListener('click', function () {
            customersList.style.display = 'none';
            customersTable.style.display = 'table';
        });
    });
</script>


</body>

</html>

