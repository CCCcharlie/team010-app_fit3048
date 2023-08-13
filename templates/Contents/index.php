<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Content> $contents
 */
?>
<div class="contents index content">
    <?= $this->Html->link(__('New Content'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Contents') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('content') ?></th>
                    <th><?= $this->Paginator->sort('createtime') ?></th>
                    <th><?= $this->Paginator->sort('ticket_id') ?></th>
                    <th><?= $this->Paginator->sort('content_type') ?></th>
                    <th><?= $this->Paginator->sort('content image') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contents as $content): ?>
                <tr>
                    <td><?= $this->Number->format($content->id) ?></td>
                    <td><?= h($content->content) ?></td>
                    <td><?= h($content->createtime) ?></td>
                    <td><?= $content->has('ticket') ? $this->Html->link($content->ticket->id, ['controller' => 'Tickets', 'action' => 'view', $content->ticket->id]) : '' ?></td>
                    <td><?= h($content->content_type) ?></td>
                    <td><?= @$this->Html->image($content->content) ?> </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $content->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $content->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete # {0}?', $content->id)]) ?>
                        <!-- Why urlencode? because since im storing images as "conversation/image.png", passing $content->content as it is would only pass
                             "conversation", not good. As such, as it is passed to download, you must decode it-->
                        <?= $this->Html->link('Download content', ['action' => 'download', urlencode($content->content)]) ?>
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
