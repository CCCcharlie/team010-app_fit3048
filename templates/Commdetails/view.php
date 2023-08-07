<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commdetail $commdetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Commdetail'), ['action' => 'edit', $commdetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Commdetail'), ['action' => 'delete', $commdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commdetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Commdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Commdetail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="commdetails view content">
            <h3><?= h($commdetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($commdetail->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Link') ?></th>
                    <td><?= h($commdetail->link) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $commdetail->has('customer') ? $this->Html->link($commdetail->customer->id, ['controller' => 'Customers', 'action' => 'view', $commdetail->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($commdetail->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
