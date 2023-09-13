<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cb $cb
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Cb'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cb form content">
            <?= $this->Form->create($cb) ?>
            <fieldset>
                <legend><?= __('Add Cb') ?></legend>
                <?php
                    echo $this->Form->control('hint');
                    echo $this->Form->control('content_type');
                    echo $this->Form->control('content_value');
                    echo $this->Form->control('previous_value');
                    echo $this->Form->control('content_description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
