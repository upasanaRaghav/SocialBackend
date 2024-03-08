<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\View $view
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit View'), ['action' => 'edit', $view->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete View'), ['action' => 'delete', $view->id], ['confirm' => __('Are you sure you want to delete # {0}?', $view->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Views'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New View'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="views view large-9 medium-8 columns content">
    <h3><?= h($view->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($view->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $view->has('user') ? $this->Html->link($view->user->name, ['controller' => 'Users', 'action' => 'view', $view->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($view->id) ?></td>
        </tr>
    </table>
</div>
