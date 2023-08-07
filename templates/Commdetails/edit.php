<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commdetail $commdetail
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $commdetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $commdetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Commdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="commdetails form content">
            <?= $this->Form->create($commdetail) ?>
            <fieldset>
                <legend><?= __('Edit Commdetail') ?></legend>
                <?php
                    echo $this->Form->control('type');
                    echo $this->Form->control('link');
                    echo $this->Form->control('cust_id', ['options' => $customers]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
