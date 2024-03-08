<style>
    body {
        background-image: url('https://source.unsplash.com/LAaSoL0LrYs/1920x1080');
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

    .additional-photo {
        width: 100px;
        height: 100px;
        margin: 5px;
        border: 2px solid #03b1ce;
    }
</style>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <?php if ($auth && isset($auth['User']['id'])) : ?>
            <span class="navbar-text">
                Welcome, <?= h(ucwords(strtolower($auth['User']['name']))) ?>
            </span>
        <?php endif; ?>
        <ul class="navbar-nav ml-auto">
           
            <li class="nav-item"><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item">
                <a class="nav-link" href="/Notes/users/logout" onclick="return confirmLogout()">Logout</a>
            </li>
        </ul>
    </div>
</nav>
