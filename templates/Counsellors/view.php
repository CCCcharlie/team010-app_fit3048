<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Counsellor $counsellor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Counsellor'), ['action' => 'edit', $counsellor->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Counsellor'), ['action' => 'delete', $counsellor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $counsellor->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Counsellors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Counsellor'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="counsellors view content">
            <h3><?= h($counsellor->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('F Name') ?></th>
                    <td><?= h($counsellor->f_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('L Name') ?></th>
                    <td><?= h($counsellor->l_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Notes') ?></th>
                    <td><?= h($counsellor->notes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $counsellor->has('customer') ? $this->Html->link($counsellor->customer->id, ['controller' => 'Customers', 'action' => 'view', $counsellor->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($counsellor->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
