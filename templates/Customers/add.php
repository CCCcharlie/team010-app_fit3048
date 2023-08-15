<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Customers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="form-group splash-container ">
        <div class="add-from content">
            <?= $this->Form->create($customer) ?>
            <fieldset>
                <legend><?= __('Add Customer') ?></legend>
                <?php
                    echo $this->Form->control('f_name',['class' => 'form-control form-control-lg']);
                    echo $this->Form->control('l_name',['class' => 'form-control form-control-lg']);
                    echo $this->Form->control('age',['class' => 'form-control form-control-lg']);
                    echo $this->Form->control('email',['class' => 'form-control form-control-lg']);
                    echo $this->Form->control('status',['class' => 'form-control form-control-lg']);
                    echo $this->Form->control('notes',['class' => 'form-control form-control-lg']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary btn-lg btn-block']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
