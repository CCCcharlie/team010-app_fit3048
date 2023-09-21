<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 */
?>
<head>

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
<div class="page-header" id="top">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Home</a></li>
                    <li class="breadcrumb-item"><a href="/tickets" class="breadcrumb-link">View all tickets</a></li>

                    <li class="breadcrumb-item active" aria-current="page">Current tickets</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- To obtain the identity, use $identity = $this->request->getAttribute('authentication')->getIdentity(); to find the currently logged in entity
to get the name or any value in the staff table, use the get and then the name of the attribute $identity->get('staff_fname')-->
    <!--                                <h2 class="pageheader-title" style="color: lightslategrey">Welcome, --><?php //= $identity->get('f_name'); ?><!--</h2>-->

    <!-- Can you add login user to name here if you get chance Bryan?  -->
    <!-- Sure Alex-->

    <p class="pageheader-text"></p>
</div>

<div class="row">


    <aside class="column">
        <div class="side-nav" style="margin-left: 2vw">
            <h4 class="heading" ><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ticket'), ['action' => 'edit', $ticket->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ticket'), ['action' => 'delete', $ticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tickets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ticket'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="card tickets-view content">
            <h3><?= h($ticket->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($ticket->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $ticket->has('customer') ? $this->Html->link($ticket->customer->id, ['controller' => 'Customers', 'action' => 'view', $ticket->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $ticket->has('user') ? $this->Html->link($ticket->user->id, ['controller' => 'Users', 'action' => 'view', $ticket->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ticket->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createtime') ?></th>
                    <td><?= h($ticket->createtime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Closetime') ?></th>
                    <td><?= h($ticket->closetime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Closed') ?></th>
                    <td><?= $ticket->closed ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

            <div class=" card  related">
                <div class="card-body">
                <h4><?= __('Related Contents') ?></h4>
                <?php if (!empty($ticket->contents)) : ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('content') ?></th>
                            <th><?= $this->Paginator->sort('createtime') ?></th>
                            <th><?= $this->Paginator->sort('content_type') ?></th>
                            <th><?= $this->Paginator->sort('content image') ?></th>
                        </tr>
                        </thead>
                        <?php foreach ($ticket->contents as $content) : ?>
                            <tr>
                                <td><?= $this->Number->format($content->id) ?></td>
                                <td><?= h($content->content) ?></td>
                                <td><?= h($content->createtime) ?></td>
                                <td><?= h($content->content_type) ?></td>
                                <td><?= @$this->Html->image($content->content) ?> </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
