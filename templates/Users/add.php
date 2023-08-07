<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('f_name');
                    echo $this->Form->control('l_name');
                    echo $this->Form->control('age');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('timezone');
                    echo $this->Form->control('admin_status');
                    echo $this->Form->control('nonce');
                    echo $this->Form->control('nonce_expiry');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
