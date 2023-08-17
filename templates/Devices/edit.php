<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <!-- Hidden delete link -->
<!--            --><?php //= $this->Form->postLink(
//                __('Delete'),
//                ['action' => 'delete', $device->id],
//                ['confirm' => __('Are you sure you want to delete # {0}?', $device->id), 'class' => 'side-nav-item']
//            ) ?>
            <?= $this->Html->link(__('List Devices'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Return to Customer'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-primary']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="devices form content">
            <?= $this->Form->create($device) ?>
            <fieldset>
                <legend><?= __('Edit Device for customer: ' . $fullName ) ?></legend>
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
