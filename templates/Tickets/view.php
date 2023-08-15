<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ticket'), ['action' => 'edit', $ticket->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ticket'), ['action' => 'delete', $ticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tickets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ticket'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tickets view content">
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
            <div class="related">
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
