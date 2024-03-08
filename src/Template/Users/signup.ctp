<?php
echo $this->element("header");
?>
<?= $this->Form->create($user, ['type' => 'file']) ?>

<fieldset>
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <?= $this->Form->control('name', [
                  'label' => [
                    'class' => 'fas fa-lock fa-lg me-3 fa-fw',
                    'style' => 'width: 200px; height: auto;'
                  ],
                  'placeholder' => 'Enter your name',

                  'class' => 'form-outline flex-fill mb-0'
                ]) ?>

                <?= $this->Form->control('email', [
                  'label' => [

                    'class' => 'fas fa-lock fa-lg me-3 fa-fw',
                    'style' => 'width: 200px; height: auto;'
                  ],
                  'placeholder' => 'Enter your Email',
                  'class' => 'form-outline flex-fill mb-0'
                ]) ?>

                <?= $this->Form->control('password', [
                  'type' => 'password',
                  'label' => [

                    'class' => 'fas fa-lock fa-lg me-3 fa-fw',
                    'style' => 'width: 200px; height: auto;'
                  ],
                  'placeholder' => 'Enter your Password',
                  'class' => 'form-outline flex-fill mb-0'
                ]) ?>

                <?= $this->Form->control('image_file', ['type' => 'file']) ?>

                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <?= $this->Form->button('Sign Up') ?>
                </div>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <?= $this->Html->image(
                  'draw1.webp',
                  [
                    'class' => 'img-fluid',
                    'alt' => 'Sample image',
                    'url' => [
                      'controller' => 'Users',
                      'action' => 'signup'
                    ]
                  ]
                ) ?>
</fieldset>
<?= $this->Form->end() ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>