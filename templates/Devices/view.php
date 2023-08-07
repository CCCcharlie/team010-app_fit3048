<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Device'), ['action' => 'edit', $device->transactionid], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Device'), ['action' => 'delete', $device->transactionid], ['confirm' => __('Are you sure you want to delete # {0}?', $device->transactionid), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Devices'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Device'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="devices view content">
            <h3><?= h($device->transactionid) ?></h3>
            <table>
                <tr>
                    <th><?= __('Transactionid') ?></th>
                    <td><?= h($device->transactionid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Device Model') ?></th>
                    <td><?= h($device->device_model) ?></td>
                </tr>
                <tr>
                    <th><?= __('Session Id') ?></th>
                    <td><?= h($device->session_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Technical Details') ?></th>
                    <td><?= h($device->technical_details) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $device->has('customer') ? $this->Html->link($device->customer->id, ['controller' => 'Customers', 'action' => 'view', $device->customer->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
