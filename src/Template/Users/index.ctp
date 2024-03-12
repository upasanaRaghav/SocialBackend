
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <?php if ($auth && isset($auth['User']['id'])) : ?>
            <span class="navbar-text">
                Welcome, <?= h(ucwords(strtolower($auth['User']['name']))) ?>
            </span>
        <?php endif; ?>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item"><?= $this->Html->link(__('Add More Image'), ['controller' => 'Views', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>

<li class="nav-item"><?= $this->Html->link(__('My Views'), ['controller' => 'Users', 'action' => 'myViews'], ['class' => 'nav-link']) ?> </li>
<li class="nav-item"><?= $this->Html->link(__('Public View'), ['controller' => 'Users', 'action' => 'myImages'], ['class' => 'nav-link']) ?> </li>
<li class="nav-item"><?= $this->Html->link(__('Add Preference'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>

<li class="nav-item">
    <?= $this->Html->link(__('Change Password'), ['controller' => 'Users', 'action' => 'password'], ['class' => 'nav-link']) ?>
</li>


        <li class="nav-item">
                <a class="nav-link" href="/Notes/users/logout" onclick="return confirmLogout()">Logout</a>
                <script>

                    // this is the dialog box for logout confirmation,it will have ok and cancel option
                    function confirmLogout() {
                        return confirm("Are you sure you want to log out?");
                       
                    }
                </script>
            </li>
        </ul>
    </div>
</nav>

<div class="users index large-12 medium-8 columns content">
    <h3><?= __('') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-hover table-responsive">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>

                <th scope="col" class="actions" style= width:25%;><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                     <td><?= ucfirst(h($user->name)) ?></td>
                    <td><?= h($user->email) ?></td>
                  
                  <td><?= $this->Time->timeAgoInWords($user->created,
                     ['accuracy' => ['days' => 'days', 'hours' => 'hours']]); ?></td>
                    <td><?= $this->Html->image($user->image, ['width' => 100, 'height' => 100]) ?></td>
            
<td class="actions">
    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-primary']) ?>

    <?php
    // Check if the logged-in user is viewing their own profile
    $isOwnProfile = ($auth && isset($auth['User']['id']) && $auth['User']['id'] == $user->id);

    // Display "Edit" and "Delete" links only if it's the user's own profile
    if ($isOwnProfile) : ?>
        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-success']) ?>
        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], [
            'class' => 'btn btn-danger',
            'confirm' => __('Are you sure you want to delete # {0}?', $user->id),
        ]) ?>
    <?php endif; ?>
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