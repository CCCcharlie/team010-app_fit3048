<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ticket> $tickets
 */
?>

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
