<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Device> $devices
 */
?>
<div class="devices index content">
    <?= $this->Html->link(__('New Device'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Devices') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('transactionid') ?></th>
                    <th><?= $this->Paginator->sort('device_model') ?></th>
                    <th><?= $this->Paginator->sort('sessionid') ?></th>
                    <th><?= $this->Paginator->sort('technical_details') ?></th>
                    <th><?= $this->Paginator->sort('platform') ?></th>
                    <th><?= $this->Paginator->sort('gamblock_ver') ?></th>
                    <th><?= $this->Paginator->sort('cust_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($devices as $device): ?>
                <tr>
                    <td><?= $this->Number->format($device->id) ?></td>
                    <td><?= h($device->transactionid) ?></td>
                    <td><?= h($device->device_model) ?></td>
                    <td><?= h($device->sessionid) ?></td>
                    <td><?= h($device->technical_details) ?></td>
                    <td><?= h($device->platform) ?></td>
                    <td><?= h($device->gamblock_ver) ?></td>
                    <td><?= $device->has('customer') ? $this->Html->link($device->customer->id, ['controller' => 'Customers', 'action' => 'view', $device->customer->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $device->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $device->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $device->id], ['confirm' => __('Are you sure you want to delete # {0}?', $device->id)]) ?>
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
