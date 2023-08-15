<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commdetail $commdetail
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Commdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="commdetails form content">
            <?= $this->Form->create($commdetail) ?>
            <fieldset>
                <legend><?= __('Add Commdetail') ?></legend>
                <?php
                echo $this->Form->control('type');
                echo $this->Form->control('link');

                // Hidden input field to pre-fill customer ID
                echo $this->Form->hidden('cust_id', ['value' => $customerId]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
