<style>

body {
        background-image: url('https://source.unsplash.com/LAaSoL0LrYs/1920x1080');

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
            <li class="nav-item"><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
            <li class="nav-item"><?= $this->Html->link(__('My Views'), ['controller' => 'Users', 'action' => 'myViews'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item">
                <a class="nav-link" href="/Notes/users/logout" onclick="return confirmLogout()">Logout</a>
                <script>
                    function confirmLogout() {
                        return confirm("Are you sure you want to log out?");
                    }
                </script>
            </li>
        </ul>
    </div>
</nav>

<fieldset>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <legend><?= __('Add More Images') ?></legend>
                                <?= $this->Form->create(null, ['type' => 'file']) ?>

                                <?= $this->Form->control('name', ['label' => ['text' => 'Caption of Image', 'class' => 'font-weight-bold'], 'class' => 'form-control']); ?>
                          
                                <?= $this->Form->control('image', ['type' => 'file']); ?>

                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <?= $this->Form->button('Submit') ?>
                                </div>

                                <?= $this->Form->end() ?>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <?= $this->Html->image(
                                    'draw1.webp',
                                    [
                                        'class' => 'img-fluid',
                                        'alt' => 'Sample image',
                                    ]
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
