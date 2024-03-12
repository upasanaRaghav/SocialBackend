

<div class="roles form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Account Visibility Preference') ?></legend>
        <p>
            Welcome! Please choose your account visibility preference. This will determine who can see your photos.
        </p>
        <div class="radio">
            <?= $this->Form->radio('visibility', [
                ['value' => 'Public', 'text' => 'Public'],
                ['value' => 'Private', 'text' => 'Private'],
            ]); ?>
        </div>
        <div class="hint">
        <h5 style="font-weight: bold;">Note:</h5>
            <p>
                Public accounts make your photos visible to all users.<br>
                Private accounts restrict visibility to yourself only.
            </p>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
