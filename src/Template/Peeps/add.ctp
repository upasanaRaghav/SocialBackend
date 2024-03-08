<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Peep $peep
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Peeps'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="peeps form large-9 medium-8 columns content">
    <?= $this->Form->create($peep) ?>
    <fieldset>
        <legend><?= __('Add Peep') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('repeatPass');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
