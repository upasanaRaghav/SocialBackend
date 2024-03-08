<style>

body{
    overflow:hidden;
}
.carousel-item {
  height: 10vh;
  min-height: 500px;
 
}
.custom-navbar {
    height: 50px; 
}

.content-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
}

</style>

<?php
    echo $this->element("header");
?>
<div class="users form medium-6 medium-12 columns content">
    <section class="vh-100">
        <div class="container h-40">
            <div class="row d-flex justify-content-center align-items-center h-100 ">
                <div class="col-md-8 col-md-11">
                    <div class="card text-black" style="border-radius: 50px; height: 100%;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center ">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"></p>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 ">
                                  
                                    <?= $this->Html->link(
    'Sign Up',
    ['controller' => 'Users', 'action' => 'signup'],
    ['class' => 'btn btn-primary btn-lg']
) ?>

<?= $this->Html->link(
    'Login',
    ['controller' => 'Users', 'action' => 'login'],
    ['class' => 'btn btn-primary btn-lg']
) ?>               
                                    </div>
                                    <?= $this->Form->end() ?>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <?= $this->Html->image('draw1.webp', ['alt' => 'profile_image', 'class' => 'img-fluid']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
echo $this->element("footer");
?>