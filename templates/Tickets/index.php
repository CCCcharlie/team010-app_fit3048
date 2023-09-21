<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ticket> $tickets
 */
?>
<!-- Bootstrap CSS -->
<!-- In-built CSS -->
<?= $this->Html->css(['style', 'bootstrap.min',]) ?>
<?= $this->Html->css(['style', 'error',]) ?>
<?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>
<div class="page-header" id="top">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Home</a></li>

                <li class="breadcrumb-item active" aria-current="page">View all tickets</li>
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

<div class="tickets index content">
    <?= $this->Html->link(__('New Ticket'), ['action' => 'add'], ['class' => 'button float-right']) ?>

    <h3><?= __('Tickets') ?></h3>
    <div class="table-responsive table table-hover table-striped">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('title') ?></th>

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
                <?php foreach ($tickets as $ticket): ?>
                <tr>
                    <td><?= h($ticket->title) ?></td>

                    <td><?= $this->Number->format($ticket->id) ?></td>
                    <td><?= h($ticket->type) ?></td>
                    <td><?= h($ticket->createtime) ?></td>
                    <td><?= !empty($ticket->closetime) ? h($ticket->closetime) : 'Not close' ?></td>

                    <td><?= $ticket->closed ? "Yes" : "No" ?></td>
                    <td><?= $ticket->has('customer') ? $this->Html->link($ticket->customer->id, ['controller' => 'Customers', 'action' => 'view', $ticket->customer->id]) : '' ?></td>
                    <td>
                        <?php
                        echo !empty($ticket->user) ? $this->Html->link($ticket->user->id, ['controller' => 'Users', 'action' => 'view', $ticket->user->id]) : 'Not available';
                        ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ticket->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ticket->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
    </div>
