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
    <title>GamBlock® - Customer Management: Archived Customers</title>
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
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Home</a></li>
                <li class="breadcrumb-item"><a href="/customers" class="breadcrumb-link">Customers</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Archived Customer</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="F">
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
            <div class="section-block" style=" margin-top: -5vh;" id="cardaction">
                <h3 class="section-title" style="color: midnightblue; ">Archived Customer View</h3>
                <p style="color: midnightblue"> This page shows all archived profiles. </p>
            </div>
        </div>
        </di>
        <div class="row">
            <div class="col-md-12">
                <!--     button for changing view    -->


                <!--                            -->
                <br>
                <div class="row">
                    <div class="col-md-6 ">


                    </div>
                </div>
            </div>

            </tr>


            <br>
            <br>


            <!-- Space reserver -->
            <div id="filtered-content">
                <!-- content show for assign to me -->
            </div>


            <!--table view option-->
            <table class="table table-hover table-striped" id="customers-table" style="margin-left: 150px">
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
                            <?php if (!empty($customer->notes)) : ?>
                                <p><?= h($customer->notes) ?></p>
                            <?php else : ?>
                                No notes have been provided about the customer.
                            <?php endif; ?>
                        </td>
                        <td style="width: 200px">
                            <div style="display: flex; flex-direction: column;">
                                <?= $this->Form->postLink(
                                    __('Delete Profile'),
                                    ['action' => 'deleteWithContents', $customer->id],
                                    [
                                        'class' => 'btn btn-danger',
                                        'confirm' => __('Are you sure you want to delete this customer profile and its associated contents? This process is irreversible!'),
                                        'style' => 'min-width: 65%;'
                                    ]
                                ) ?>
                                <?= $this->Html->link(__('View Profile'), ['action' => 'view', $customer->id], ['class' => 'btn btn-primary', 'style' => 'min-width: 65%;']) ?>
                            </div>
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
    </div>
</div>
</div>
<div class="card-footer-item">
    <div class="pagination-controls">
        <p class="pagination-counter">
        <form class="pagination-goto">
            <label for="goto-page">Go to page:</label>
            <input type="text" id="goto-page" name="page">
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        </p>
    </div>
    <p class="pagination-counter"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
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
        // the style display of the customer
        tableViewBtn.addEventListener('click', function () {
            customersList.style.display = 'none';
            customersTable.style.display = 'table';
        });
    });
</script>


</body>

</html>

