<?php
?>

<!doctype html>
<html lang="en">


<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Assigned Customers</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min',]) ?>
    <?= $this->Html->css(['style', 'error',]) ?>
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>


    <style>
        .paginator {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .pagination {
            list-style: none;
            display: flex;
            align-items: center;
            padding: 0;
        }

        .pagination-item {
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination-item:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination-counter {
            margin-top: 10px;
        }
    </style>
</head>

<body>


<div class="customers assigntome content">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header" id="top">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Home</a></li>
                            <li class="breadcrumb-item"><a href="/customers" class="breadcrumb-link">View all
                                    customer</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Assigned to me</li>
                        </ol>
                    </nav>
                </div>
                <!-- To obtain the identity, use $identity = $this->request->getAttribute('authentication')->getIdentity(); to find the currently logged in entity
to get the name or any value in the staff table, use the get and then the name of the attribute $identity->get('staff_fname')-->
                <?php $identity = $this->request->getAttribute('authentication')->getIdentity();
                //                        debug($identity->get('f_name'));
                //                        exit();
                ?>

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
                <h3 class="section-title" style="color: midnightblue; margin-top: -50px">Assigned Customers</h3>
                <p style="color: midnightblue"> List of customers with tickets assigned to you.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <br>
            <h6 style="color: midnightblue" class="section-title"> Sort by:


                <tr>
                    <th>
                        <?php
                        $sortField = 'f_name';
                        $sortDir = 'asc';
                        if ($this->Paginator->sortKey() === $sortField) {
                            $sortDir = ($this->Paginator->sortDir() === 'asc') ? 'desc' : 'asc';
                        }
                        ?>
                        <?= $this->Paginator->sort('f_name', 'First Name', ['direction' => $sortDir]) ?>
                        <?php if ($this->Paginator->sortKey() === 'f_name') : ?>
                            <?php if ($sortDir === 'asc') : ?>
                                <img
                                    src="<?= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                    alt="Down Arrow">
                            <?php else : ?>
                                <img
                                    src="<?= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                    alt="Up Arrow">
                            <?php endif; ?>
                        <?php endif; ?>
                        |
                    </th>

                    <th>
                        <?php
                        $sortField = 'l_name';
                        $sortDir = 'asc';
                        if ($this->Paginator->sortKey() === $sortField) {
                            $sortDir = ($this->Paginator->sortDir() === 'asc') ? 'desc' : 'asc';
                        }
                        ?>
                        <?= $this->Paginator->sort('l_name', 'Last Name', ['direction' => $sortDir]) ?>
                        <?php if ($this->Paginator->sortKey() === 'l_name') : ?>
                            <?php if ($sortDir === 'asc') : ?>
                                <img
                                    src="<?= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                    alt="Down Arrow">
                            <?php else : ?>
                                <img
                                    src="<?= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                    alt="Up Arrow">
                            <?php endif; ?>
                        <?php endif; ?>
                        |
                    </th>
                    <th>
                        <?php
                        $sortField = 'email';
                        $sortDir = 'asc';
                        if ($this->Paginator->sortKey() === $sortField) {
                            $sortDir = ($this->Paginator->sortDir() === 'asc') ? 'desc' : 'asc';
                        }
                        ?>
                        <?= $this->Paginator->sort('email', 'Email', ['direction' => $sortDir]) ?>
                        <?php if ($this->Paginator->sortKey() === 'email') : ?>
                            <?php if ($sortDir === 'asc') : ?>
                                <img
                                    src="<?= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                    alt="Down Arrow">
                            <?php else : ?>
                                <img
                                    src="<?= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>"
                                    alt="Up Arrow">
                            <?php endif; ?>
                        <?php endif; ?>
                    </th>
                </tr>

                <!--         Add the "Undo Changes" link with an ID -->
                <button id="undobutton" class="btn btn-primary" style="margin-left: 2vw">Undo previous escalation
                </button>


            </h6>

            <br>
            <br>


        </div>

        <br>


        <style>
            /* I know this is really bad coding practice, but short on time.*/
            .nav-pills .nav-link.active {
                font-weight: bolder;
            }

            .align-right {
                right: 0px;
            }
        </style>
        <!-- Space reserver -->
        <div id="filtered-content">
            <!-- content show for assign to me -->
        </div>


        <?php foreach ($assignedCustomers as $customer): ?>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h4 class="card-header-title"><?= h($customer->f_name) ?> <?= h($customer->l_name) ?></h4>
                        <div class="toolbar card-toolbar-tabs ml-auto">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab-<?= $customer->id ?>"
                                       data-toggle="pill" href="#pills-home-<?= $customer->id ?>" role="tab"
                                       aria-controls="pills-home" aria-selected="true">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab-<?= $customer->id ?>" data-toggle="pill"
                                       href="#pills-profile-<?= $customer->id ?>" role="tab"
                                       aria-controls="pills-profile" aria-selected="false">Technical Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab-<?= $customer->id ?>" data-toggle="pill"
                                       href="#pills-contact-<?= $customer->id ?>" role="tab"
                                       aria-controls="pills-contact" aria-selected="false">Contact Methods</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content mb-3" id="pills-tabContent-<?= $customer->id ?>">
                            <div class="tab-pane fade show active" id="pills-home-<?= $customer->id ?>" role="tabpanel"
                                 aria-labelledby="pills-home-tab-<?= $customer->id ?>">
                                <br> Status: <?= h($customer->status) ?>
                                <br> Notes: <?= h($customer->notes) ?>

                            </div>
                            <div class="tab-pane fade" id="pills-profile-<?= $customer->id ?>" role="tabpanel"
                                 aria-labelledby="pills-profile-tab-<?= $customer->id ?>">
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

                            <div class="tab-pane fade" id="pills-contact-<?= $customer->id ?>" role="tabpanel"
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

                            <?php echo $this->Html->link(
                                __('Escalate the customer'),
                                [
                                    'controller' => 'Tickets',
                                    'action' => 'updateEscalate',
                                    $customer->id
//                                    '?' => ['cust_id' => $ticket->customer->id] // assign cust id to checking variable
                                ],
                                [
                                    'class' => 'btn btn-primary ',
                                    'style' => 'margin-top:3vh',
                                    'id' => "navigate-button-<?= $customer->id ?>",
                                    'data-customer-id' => $customer->id,
                                    'confirm' => __('You are requesting to escalate: {0} {1}, you should escalate a customer if you want them to be seen by senior staff members, for example if they are verbally abusive. Escalating cannot be undone! Are you sure? ', $customer->f_name, $customer->l_name)

                                ]
                            ); ?>
                            <?php echo ' '; ?>


                            <!--                        -->


                        </div>

                        <?= $this->Html->link(__('View Full Profile'), ['action' => 'view', $customer->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
        <?php if (count($assignedCustomers) == 0): ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="color: midnightblue">
                <p>No assigned customers found.</p>

            </div>


        <?php endif; ?>


    </div>

</div>

<!--EXPLAINING THE SCRIPTS -->
<!--Concept - Template-->
<!--SlimScroll - JS Plugin. Allows for any div to be scrollable.-->
<!--Jquery  - Essential Javascript library-->
<!--Add any explinations here for any scripts you add. - Alex-->


<?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
<?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js', 'gototoparrow.js']) ?>


<!--    --><?php //if ($this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) === 'Page 1 of 0, showing 0 record(s) out of 0 total'): ?>
<!--        <p>No results found.</p>-->
<!--    --><?php //endif; ?>


<script>

    var selectedTicketId;

    // check the escalate action have been done
    var escalated = <?= json_encode($this->request->getSession()->read('escalated')); ?>;

    if (escalated == true) {
        //
        document.getElementById("undobutton").style.display = "inherit";
    } else {
        //
        document.getElementById("undobutton").style.display = "none";
    }

    document.getElementById('undobutton').addEventListener('click', function () {
        var url = '/tickets/undoEscalate/';
        window.location.href = url;
    });


</script>


</body>
</html>
