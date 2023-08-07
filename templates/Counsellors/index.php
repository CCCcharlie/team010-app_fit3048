<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Counsellor> $counsellors
 */
?>
<div class="counsellors index content">
    <?= $this->Html->link(__('New Counsellor'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Counsellors') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('f_name') ?></th>
                    <th><?= $this->Paginator->sort('l_name') ?></th>
                    <th><?= $this->Paginator->sort('notes') ?></th>
                    <th><?= $this->Paginator->sort('cust_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($counsellors as $counsellor): ?>
                <tr>
                    <td><?= $this->Number->format($counsellor->id) ?></td>
                    <td><?= h($counsellor->f_name) ?></td>
                    <td><?= h($counsellor->l_name) ?></td>
                    <td><?= h($counsellor->notes) ?></td>
                    <td><?= $counsellor->has('customer') ? $this->Html->link($counsellor->customer->id, ['controller' => 'Customers', 'action' => 'view', $counsellor->customer->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $counsellor->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $counsellor->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $counsellor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $counsellor->id)]) ?>
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
