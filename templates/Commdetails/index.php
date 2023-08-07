<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Commdetail> $commdetails
 */
?>
<div class="commdetails index content">
    <?= $this->Html->link(__('New Commdetail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Commdetails') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('link') ?></th>
                    <th><?= $this->Paginator->sort('cust_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commdetails as $commdetail): ?>
                <tr>
                    <td><?= $this->Number->format($commdetail->id) ?></td>
                    <td><?= h($commdetail->type) ?></td>
                    <td><?= h($commdetail->link) ?></td>
                    <td><?= $commdetail->has('customer') ? $this->Html->link($commdetail->customer->id, ['controller' => 'Customers', 'action' => 'view', $commdetail->customer->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $commdetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $commdetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $commdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commdetail->id)]) ?>
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
