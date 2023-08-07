<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Counsellor $counsellor
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Counsellors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="counsellors form content">
            <?= $this->Form->create($counsellor) ?>
            <fieldset>
                <legend><?= __('Add Counsellor') ?></legend>
                <?php
                    echo $this->Form->control('f_name');
                    echo $this->Form->control('l_name');
                    echo $this->Form->control('notes');
                    echo $this->Form->control('cust_id', ['options' => $customers, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
