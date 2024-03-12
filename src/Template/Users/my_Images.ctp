<style>
li {
    list-style-type: none;
}
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


<div class="container">
    <?php if (!empty($views)): ?>
     
            <?php foreach ($views as $view): ?>
             <li class="mb-4"><?= $this->Html->image('uploads/' . $view->image, 
                ['alt' => 'View Image',
                'class' => 'mx-auto d-block',
                'width' => '500px', 
                'height' => '100px', 
                
                ]) ?></li>
                 <p class="text-center custom-text" style="text-transform: capitalize; color:white;"><?= h($view->name) ?></p>
   
           
            <?php endforeach; ?>
    <?php else: ?>
        <p>No views found.</p>
    <?php endif; ?>
</div>
