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
        <?= $this->Html->link(__('Go back'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-primary']) ?>
    </aside>
    <div class="column-responsive column-80">
        <div class="commdetails form content">
            <?= $this->Form->create($commdetail) ?>
            <fieldset>
                <legend><?= __('Add Communication details for: ' . $fullName) ?></legend>
                <?php
                    echo $this->Form->control('type');
                    echo $this->Form->control('link');
//                    echo $this->Form->control('cust_id', ['options' => $customers]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
