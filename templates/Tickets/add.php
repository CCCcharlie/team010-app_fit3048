<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tickets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tickets form content">
            <?= $this->Form->create($ticket) ?>
            <fieldset>
                <legend><?= __('Add Ticket') ?></legend>
                <?php
                    echo $this->Form->control('type');
                    echo $this->Form->control('createtime');
                    echo $this->Form->control('closetime', ['empty' => true]);
                    echo $this->Form->control('closed');
                    echo $this->Form->control('cust_id', ['options' => $customers]);
                    echo $this->Form->control('staff_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
