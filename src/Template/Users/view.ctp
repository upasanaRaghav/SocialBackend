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
        width: 150px;
        height: 150px;
        border: 2px solid #03b1ce;
        border-radius: 50%;
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

    .box-info {
        background-color: #f8f8f8;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .box-info .title {
        font-size: 16px;
        font-weight: bold;
    }

    .box-info .info-value {
        font-size: 16px;
        margin-top: 5px;
    }

    .profile-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .profile-section h4 {
        color: #f9b015;
        font-size: 45px;
    }

    .profile-section img {
        border: 2px solid #03b1ce;
        border-radius: 50%;
        width: 150px;
        height: 150px;
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
            <?php if ($auth && isset($auth['User']['id']) && $auth['User']['id'] === $user->id) : ?>
                <li class="nav-item"><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'nav-link']) ?> </li>
                <li class="nav-item"><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'nav-link']) ?> </li>
            <?php endif; ?>
            <li class="nav-item"><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item">
                <a class="nav-link" href="/Notes/users/logout" onclick="return confirmLogout()">Logout</a>
            </li>
        </ul>
    </div>
</nav>


<div class="card">
    <div class="card-body">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-section">
                        <div>
                            <h4><?= h(ucwords(strtolower($user->name))) ?></h4>
                        </div>
                        <div>
                            <?= $this->Html->image($user->image, ['id' => 'profile-image1', 'class' => 'img-circle img-responsive']) ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <hr style="margin: 5px 0 5px 0;">

                    <div class="box-info">
                        <div class="box-body">
                            <div class="title">Name:</div>
                            <div class="info-value"><?= ucfirst(h($user->name)) ?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="title">Email:</div>
                            <div class="info-value"><?= h($user->email) ?></div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                        

                            <div class="title">Created:</div>
                            <div class="info-value">
                                <?= $this->Time->timeAgoInWords($user->created, ['accuracy' => ['days' => 'days', 'hours' => 'hours']]); ?>
                            </div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="title">Modified:</div>
                            <div class="info-value">
                                <?= $this->Time->timeAgoInWords($user->modified, ['accuracy' => ['days' => 'days', 'hours' => 'hours']]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }

    $(function () {
        $('#profile-image1').on('click', function () {
            $('#profile-image-upload').click();
        });
    });
</script>
