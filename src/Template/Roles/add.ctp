
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>

<div class="roles form large-9 medium-8 columns content">
    <?= $this->Form->create($role) ?>
    <fieldset>
        <legend><?= __('Account Visibility Preference') ?></legend>
        <p>
            Welcome! Please choose your account visibility preference. This will determine who can see your photos.
        </p>
        <div class="radio">
            <?= $this->Form->radio('visibility', [
                ['value' => 'public', 'text' => 'Public'],
                ['value' => 'private', 'text' => 'Private'],
         
            ]); ?>
                 <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('visibility');
        ?>
        </div>
        <div class="hint">
        <h5 style="font-weight: bold;">Note:</h5>
            <p>
                Public accounts make your photos visible to all users.<br>
                Private accounts restrict visibility to yourself only.
            </p>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
