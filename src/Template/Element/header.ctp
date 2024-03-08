<style>
  body {
    background-image: url('https://source.unsplash.com/LAaSoL0LrYs/1920x1080');
  }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top custom-navbar">
        <div class="container">
            <?= $this->Html->link('Notes', ['controller' => 'Users', 'action' => 'main'], ['class' => 'navbar-brand']) ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <?= $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'signup'], ['class' => 'nav-link']) ?>
                    </li>


                    <li class="nav-item">
                        <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
                    </li>
                </ul>
            </div>
        </div>
</nav>

</body>

