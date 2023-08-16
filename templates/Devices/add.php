<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Devices'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
        <?= $this->Html->link(__('Go back'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-primary']) ?>
    </aside>
    <div class="column-responsive column-80">
        <div class="devices form content">
            <?= $this->Form->create($device) ?>
            <fieldset>
                <legend><?= __('Add a Device for customer: ' . $fullName) ?></legend>
                <?php
                    echo $this->Form->control('transactionid');
                    echo $this->Form->control('device_model');
                    echo $this->Form->control('sessionid');
                    echo $this->Form->control('technical_details');
                    echo $this->Form->control('platform');
                    echo $this->Form->control('gamblock_ver');
//                    echo $this->Form->control('cust_id', ['options' => $customers]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
