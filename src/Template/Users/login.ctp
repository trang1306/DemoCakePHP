<div class="index large-4 large-offset-4 medium-offset-4 columns content">
    <div class="panel">
        <?= $this->Form->create(); ?>
        <div class="header-login">
            <h2 class="text-center">Login</h2>
        </div>
        <div class="username-form">
            <?= $this->Form->control('USERNAME', ['label' => 'USERNAME', 'placeholder' => 'Enter username', 'required', 'value' => $username]); ?>
        </div>
        <div class="password-form">
            <?= $this->Form->control('password', ['label' => 'PASSWORD', 'required', 'placeholder' => 'Enter password']); ?>
        </div>
        <div class="check-form">
            <?= $this->Form->control('remember_me', ['type' => 'checkbox', 'label' => 'Remember Me', 'checked' => $remember_me]); ?>
        <div>
        <?= $this->Form->submit('Login', array('class' => 'button')); ?>
        <?= $this->Form->end(); ?>
    </div>
</div>

<style>
    .panel {
        border-radius: 10px; 
    }

    .h2 {
        margin-bottom:30px; 
        font-weight:800; 
        font-size:30px; 
        color: #0069c0;
    }

    .header-login {
        border-bottom-style:solid;
        border-width: 3px;  
        border-bottom-color:#1798a5;
    }

    .username-form {
        padding-top: 6%;
    }

    .button {
        border-radius: 10px;
    }
</style>