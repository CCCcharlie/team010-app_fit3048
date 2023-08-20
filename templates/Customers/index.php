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
    <?= $this->Html->css(['style', 'bootstrap.min', 'returntoparrow']) ?>

<!--    Relies on cdn and netdna, add to dependencies.-->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link href="https://cdn.datatables.net/v/bs4/fh-3.4.0/r-2.5.0/datatables.min.css" rel="stylesheet">






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
                                        <a class="nav-link" href="/customers?filter=assigned">Assigned Customers</a>

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
                            <div class="page-header" id="top">
                                <p class="pageheader-text"></p>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="section-block" id="cardaction">
                                <h3 class="section-title">Customer View</h3>
                                <p>Complete list of customers below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <?= $this->Form->end() ?>


                            <?= $this->Html->link(__('New Customer'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

<!--                            view changing button-->
                            <div class="view-options">
                                <button id="list-view-btn" class="btn btn-primary">List View</button>
                                <button id="table-view-btn" class="btn btn-primary">Table View</button>
                            </div>
                            <!--                        list view -->
                            <div  id="customers-list" style="display: none;" >
                                <div class="row">
                                    <?php foreach ($customers as $customer): ?>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="card">
                                                <div class="card-header d-flex">
                                                    <h4 class="card-header-title"><?= h($customer->f_name) ?> <?= h($customer->l_name) ?></h4>
                                                    <div class="toolbar card-toolbar-tabs ml-auto">
                                                        <ul class="nav nav-pills" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="pills-home-tab-<?= $customer->id ?>" data-toggle="pill" href="#pills-home-<?= $customer->id ?>" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="pills-profile-tab-<?= $customer->id ?>" data-toggle="pill" href="#pills-profile-<?= $customer->id ?>" role="tab" aria-controls="pills-profile" aria-selected="false">Technical Details</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="pills-contact-tab-<?= $customer->id ?>" data-toggle="pill" href="#pills-contact-<?= $customer->id ?>" role="tab" aria-controls="pills-contact" aria-selected="false">Contact Methods</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content mb-3" id="pills-tabContent-<?= $customer->id ?>">
                                                        <div class="tab-pane fade show active" id="pills-home-<?= $customer->id ?>" role="tabpanel" aria-labelledby="pills-home-tab-<?= $customer->id ?>">
                                                            <br> Status: <?= h($customer->status) ?>
                                                            <br> Notes: <?= h($customer->notes) ?>

                                                        </div>
                                                        <div class="tab-pane fade" id="pills-profile-<?= $customer->id ?>" role="tabpanel" aria-labelledby="pills-profile-tab-<?= $customer->id ?>">
                                                            <!-- Add stuff like technical details and devices. -->
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

                                                        <div class="tab-pane fade" id="pills-contact-<?= $customer->id ?>" role="tabpanel" aria-labelledby="pills-contact-tab-<?= $customer->id ?>">
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


                            </div>

                            <br>
                            <br>



                        </div>

                    <br>


                    <style>
                        /* I know this is really bad coding practice, but short on time.*/
                        .nav-pills .nav-link.active {
                            font-weight: bolder;
                        }
                        .align-right{
                        right: 0px;
                        }
                    </style>
                        <!-- Space reserver -->
                        <div id="filtered-content">
                            <!-- content show for assign to me -->
                        </div>



<!--                        table view-->
                        <div class="row"  >
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  d-flex justify-content-right">
                                <div class="card mx-auto" id="customers-table">
                                    <div class="card-header">
                                        <h5 class="mb-0">Customer View - All Customers</h5>
                                    </div>
                                    <div class="card-body"  >
                                        <div class="table-responsive" >
                                            <table id="customers" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>E-Mail</th>
                                                    <th>Notes</th>
                                                    <th>Device Model</th>
                                                    <th>Technical Details</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($customers as $customer): ?>
                                                    <tr>
                                                        <td><?= h($customer->f_name) ?> <?= h($customer->l_name) ?></td>
                                                        <td><?= h($customer->email) ?></td>
                                                        <td><?= h($customer->notes) ?></td>
                                                        <td>
                                                            <?php if (!empty($customer->devices)) : ?>
                                                                <ul class="device-list">
                                                                    <?php foreach ($customer->devices as $index => $device) : ?>
                                                                        <li>
                                                                            <strong>Device <?= $index + 1 ?>:</strong>
                                                                            <div><?= h($device->device_model) ?></div>
                                                                            <div><?= h($device->technical_details) ?></div>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <div>No Device Models have been recorded for this customer.</div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <!-- No need for a separate check for devices here since it's the same structure as above -->
                                                            <?php if (!empty($customer->devices)) : ?>
                                                                <ul class="device-list">
                                                                    <?php foreach ($customer->devices as $index => $device) : ?>
                                                                        <li>
                                                                            <strong>Device <?= $index + 1 ?>:</strong>
                                                                            <div><?= h($device->technical_details) ?></div>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <div>No Technical Details have been recorded for this customer.</div>
                                                            <?php endif; ?>
                                                        </td>

                                                        <td>
                                                            <?= $this->Html->link(__('View Full Profile'), ['action' => 'view', $customer->id], ['class' => 'btn btn-primary']) ?>
                                        </div>
                                    </div>

                                    </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                        </div>


<!--                        <a href="javascript: " id="return-to-top"><i class="icon-chevron-up"></i></a>-->




                    </div>




                    <br>
                    <br>

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
<!--                                        <div class="text-md-right footer-links d-none d-sm-block">-->
<!--                                            <a href="javascript: void(0);">Documentation</a>-->
<!--                                            <a href="javascript: void(0);">Contact Points</a>-->
<!--                                        </div>-->
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
<!--                    FontAwesome Icons-->
<!--Data Tables, Cool tables that'll replace the cards!-->
                    <!--Add any explinations here for any scripts you add. - Alex-->




                    <?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
                    <?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js', 'gototoparrow.js']) ?>
                    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
                    <?= $this->Html->script('https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js'), ['crossorigin' => 'anonymous']?>
<!--             Download it all into things.-->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<!--                    This one adds responsive + fixed headers-->
                    <script src="https://cdn.datatables.net/v/bs4/fh-3.4.0/r-2.5.0/datatables.min.js"></script>
<!--                    Buttons + everything else.-->
                    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            var table = $('#customers').DataTable({
                                responsive: true,
                                fixedHeader: true,
                                dom: 'Bfrtip',
                                buttons: [
                                    {
                                        extend: 'copy',
                                        text: 'Copy',
                                        className: 'btn btn-primary',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        extend: 'excel',
                                        text: 'Excel',
                                        className: 'btn btn-primary',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        extend: 'pdf',
                                        text: 'PDF',
                                        className: 'btn btn-primary',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    }
                                ]
                            });

                            $('#customers tbody').on('click', 'td', function () {
                                var tr = $(this).closest('tr');
                                var row = table.row(tr);

                                if (row.child.isShown()) {
                                    row.child.hide();
                                    tr.removeClass('shown');
                                } else {
                                    var rowData = JSON.parse(tr.data('child-value'));
                                    var devicesHtml = '';
                                    if (rowData) {
                                        rowData.forEach(function (device) {
                                            devicesHtml += '<div>' + device.device_model + '</div>';
                                            devicesHtml += '<div>' + device.technical_details + '</div>';
                                        });
                                    }
                                    row.child(devicesHtml).show();
                                    tr.addClass('shown');
                                }
                            });
                        });
                    </script>


                    <style>
                        .device-list {
                            list-style-type: none;
                            padding-left: 0;
                        }

                        .device-list li {
                            margin-bottom: 10px;
                        }

                        .device-list li strong {
                            font-weight: bold;
                        }
                        /* I hate in-line styling but nothing else works >:*/
                        .dataTables_paginate .pagination {
                            display: flex;
                            justify-content: center;
                            gap: 0.5rem;
                            padding-top: 1rem;
                        }

                        .dataTables_paginate .paginate_button {
                            padding: 0.25rem 0.5rem;
                            border-radius: 0.25rem;
                            border: 1px solid #dee2e6;
                        }

                        .dataTables_paginate .paginate_button.active {
                            background-color: #007bff;
                            color: #fff;
                            border-color: #007bff;
                        }
                    </style>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const listViewBtn = document.getElementById('list-view-btn');
                    const tableViewBtn = document.getElementById('table-view-btn');
                    const customersList = document.getElementById('customers-list');
                    const customersTable = document.getElementById('customers-table');

                    listViewBtn.addEventListener('click', function() {
                        customersList.style.display = 'flex';
                        customersTable.style.display = 'none';
                    });

                    tableViewBtn.addEventListener('click', function() {
                        customersList.style.display = 'none';
                        customersTable.style.display = 'table';
                    });
                });

            </script>

</body>

</html>

