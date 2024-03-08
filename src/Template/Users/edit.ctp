<style>
    body {
        background-image: url('https://source.unsplash.com/LAaSoL0LrYs/1920x1080');
        overflow: hidden;
    }

    input.hidden {
        position: absolute;
        left: -9999px;
    }

    #profile-image1 {
        cursor: pointer;
        width: 100px;
        height: 100px;
        border: 2px solid #03b1ce;
    }

    .title {
        font-size: 18px;
        font-weight: bold;
    }

    .bot-border {
        border-bottom: 1px #f8f8f8 solid;
        margin: 5px 0 5px 0;
    }

    .navbar-text,
    .nav-link {
        font-size: 15px;
    }

    .card {
        border: 2px solid #03b1ce;
        width: 60%;
        margin: 50px auto; 
        padding: 20px;
        background-color: #fff;
        border-radius: 10px; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }

    .card legend {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .card-body {
        padding: 20px;
    }

    .form-control {
        margin-bottom: 15px;
    }

    .form-control label {
        font-weight: bold;
        font-size: 16px;
    }

    .form-control input[type="text"],
    .form-control input[type="email"],
    .form-control input[type="password"],
    .form-control input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-control button {
        background-color: #03b1ce;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
</style>



<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <?php if ($auth && isset($auth['User']['id'])) : ?>
            <span class="navbar-text">
                Welcome, <?= h(ucwords(strtolower($auth['User']['name']))) ?>
            </span>
        <?php endif; ?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item">
                <a class="nav-link" href="/Notes/users/logout" onclick="return confirmLogout()">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="card">
    <div class="card-body">
        <div class="users form">
            <?= $this->Form->create($user, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                <?php
                echo $this->Form->control('name', ['class' => 'form-control']);
                echo $this->Form->control('email', ['class' => 'form-control']);
                // echo $this->Form->control('password', ['class' => 'form-control']);
                echo $this->Form->control('image_file', ['type' => 'file', 'class' => 'form-control']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'form-control']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
