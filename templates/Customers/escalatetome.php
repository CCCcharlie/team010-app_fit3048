
<?php
?>

<!doctype html>
<html lang="en">


<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Escalated Customers</title>
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

<div class="customers  content">
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
                            <li class="breadcrumb-item"><a href="/customers" class="breadcrumb-link">View all customer</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Escalate to me</li>
                        </ol>
                    </nav>
                </div>
                <!-- To obtain the identity, use $identity = $this->request->getAttribute('authentication')->getIdentity(); to find the currently logged in entity
to get the name or any value in the staff table, use the get and then the name of the attribute $identity->get('staff_fname')-->
                <?php $identity = $this->request->getAttribute('authentication')->getIdentity();
                //                        debug($identity->get('f_name'));
                //                        exit();
                ?>
                <!--                                <h2 class="pageheader-title" style="color: lightslategrey">Welcome, --><?php //= $identity->get('f_name'); ?><!--</h2>-->

                <!-- Can you add login user to name here if you get chance Bryan?  -->
                <!-- Sure Alex-->

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
                <h3 class="section-title" style="color: midnightblue">Escalated Customers</h3>
                <p style ="color: midnightblue"> List of customers with tickets escalated.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Customers', 'action' => 'index'], 'type' => 'get', 'class' => 'form-inline']) ?>
            <div class="form-group mr-2" >
                <?= $this->Form->input('search', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Search...',
                    'value' => isset($_GET['search']) ? $_GET['search'] : '']) ?>
                <!--                                    check whether a search parameter exist in url / if true get the value / flase return ' '-->
            </div>
            <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>


            <?= $this->Form->end() ?>


            <br>
            <h6 style ="color: midnightblue" class="section-title"> Sort by:



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
                            <img src="<?= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>" alt="Down Arrow">
                        <?php else : ?>
                            <img src="<?= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>" alt="Up Arrow">
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
                            <img src="<?= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>" alt="Down Arrow">
                        <?php else : ?>
                            <img src="<?= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>" alt="Up Arrow">
                        <?php endif; ?>
                    <?php endif; ?>
                    |
                </th>

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
                <!--                                            <img src="--><?php //= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Down Arrow">-->
                <!--                                        --><?php //else : ?>
                <!--                                            <img src="--><?php //= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?><!--" alt="Up Arrow">-->
                <!--                                        --><?php //endif; ?>
                <!--                                    --><?php //endif; ?>
                <!--                                    |-->
                <!--                                </th>-->

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
                            <img src="<?= $this->Url->image('arrow-down.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>" alt="Down Arrow">
                        <?php else : ?>
                            <img src="<?= $this->Url->image('arrow-up.png', ['fullBase' => true, 'webroot' => 'img/', 'width' => 10]) ?>" alt="Up Arrow">
                        <?php endif; ?>
                    <?php endif; ?>
            </h6>
                </th>
            </tr>

            <br>
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


        <?php foreach ($escalatedCustomers as $customer): ?>
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
                        <button id="undobutton-<?= $customer->id ?>"  class="btn btn-primary" style="margin-left: 2vw">Unescalate the customer</button>
                        <script>
                            document.getElementById("undobutton-<?= $customer->id ?>").addEventListener('click', function () {
                                // Get the customer ID
                                var customerId = '<?= $customer->id ?>';
                                // console.log(customerId)

                                // Construct the URL with the customer ID as a parameter
                                var url = '/tickets/descalate?customerId=' + customerId;
                                // var url = '/team010-app_fit3048/tickets/descalate?customerId=' + customerId;


                                // Redirect to Descalate action with the customer ID parameter
                                window.location.href = url;
                            });



                        </script>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
        <?php if (count($escalatedCustomers)==0): ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
                <p>No escalated customers found.</p>

            </div>


        <?php endif; ?>

    </div>

    <!--                        <a href="javascript: " id="return-to-top"><i class="icon-chevron-up"></i></a>-->
    <!--                    <div class = "card-footer-item" >-->
    <!---->
    <!---->
    <!---->
    <!--                        <div class="pagination-controls">-->
    <!--                            <p class="pagination-counter">-->
    <!--                            <form class="pagination-goto">-->
    <!--                                <label for="goto-page">Go to page:</label>-->
    <!---->
    <!--                                <input type="text" id="goto-page" name="page">-->
    <!--                                <button class="btn btn-primary" type="submit">Go</button>-->
    <!---->
    <!--                            </form>-->
    <!--                        </div>-->
    <!--                        <p class="pagination-counter">--><?php //= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?><!--</p>-->
    <!--                    </div>-->




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
<!--<script>-->
<!--    // JavaScript-->
<!--    document.getElementById('changeStaffButton').addEventListener('click', function () {-->
<!---->
<!--    });-->
<!--</script>-->


</body>
</html>
