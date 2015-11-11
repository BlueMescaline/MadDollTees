<div class="users form">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <?php
     echo $this->Session->flash();
     echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('password_confirmation',array('type'=>'password'));
        echo $this->Form->input('email');
        echo $this->Form->input('firstname');
        echo $this->Form->input('lastname');
        echo $this->Form->input('birthdate', array(
            'label' => 'Date of birth',
            'dateFormat' => 'DMY',
            'minYear' => date('Y') - 5,
            'maxYear' => date('Y') - 50,
            'default'=>'minYear',
        ));
        echo $this->Form->input('captcha');
        echo $this->Html->image(array('controller' => 'users', 'action' => 'get_captcha'),array('id' => 'captcha_image')).'</br>';
        echo $this->Html->link('Reload Captcha', 'javascript:void(0);',array('id' => 'reload'));
        ?>

    </fieldset>
    <?php echo $this->Form->end(__('Register')); ?>
    
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('#reload').click(function() {
            var captcha = $("#captcha_image");
            captcha.attr('src', captcha.attr('src')+'?'+Math.random());
            return false;
        });

    });
</script>
