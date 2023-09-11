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
    <div class="container-fluid dashboard-content">
        <div class="counsellors form content">
            <div class="section-block">

            <?= $this->Form->create($counsellor) ?>
            <fieldset>
                <legend><?= __('Add Counsellor') ?></legend>
                <div class="card-body">
                <?php
                    echo $this->Form->control('f_name',['class' => 'form-control']);
                    echo $this->Form->control('l_name',['class' => 'form-control']);
                    echo $this->Form->control('notes',['class' => 'form-control']);
                    echo $this->Form->control('cust_id', ['options' => $customers, 'empty' => true,'class' => 'form-control']);
                echo $this->Form->control('contact',['class' => 'form-control']);
                ?>
                </div>
            </fieldset>
                <div class="form-group d-flex justify-content-between align-items-center">

                <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary ']) ?>
                </div>
            <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
