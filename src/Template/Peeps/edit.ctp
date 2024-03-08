<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Peep $peep
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $peep->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $peep->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Peeps'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="peeps form large-9 medium-8 columns content">
    <?= $this->Form->create($peep) ?>
    <fieldset>
        <legend><?= __('Edit Peep') ?></legend>
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
