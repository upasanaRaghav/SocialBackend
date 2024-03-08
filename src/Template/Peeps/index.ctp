<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Peep[]|\Cake\Collection\CollectionInterface $peeps
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Peep'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="peeps index large-9 medium-8 columns content">
    <h3><?= __('Peeps') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('repeatPass') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peeps as $peep): ?>
            <tr>
                <td><?= $this->Number->format($peep->id) ?></td>
                <td><?= h($peep->name) ?></td>
                <td><?= h($peep->email) ?></td>
                <td><?= h($peep->password) ?></td>
                <td><?= h($peep->repeatPass) ?></td>
                <td><?= h($peep->created) ?></td>
                <td><?= h($peep->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $peep->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $peep->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $peep->id], ['confirm' => __('Are you sure you want to delete # {0}?', $peep->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
