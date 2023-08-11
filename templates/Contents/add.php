<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Content $content
 * @var \Cake\Collection\CollectionInterface|string[] $tickets
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Contents'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contents form content">
            <?= $this->Form->create($content, ['type'=> 'file']) ?>
            <fieldset>
                <legend><?= __('Add Content') ?></legend>
                <?php
                    echo $this->Form->control('content');
//                    echo $this->Form->control('createtime');
                    echo $this->Form->control('ticket_id', ['options' => $tickets]);
                    echo $this->Form->control('content_type', [
                        'type' => 'select',
                        'options' => $content_types,
                    ]);
                    echo $this->Form->control('file', ['type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
