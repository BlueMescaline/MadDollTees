<h2>Login</h2>
<table>
    <td>
<div class="users form">

    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Html->link('I forgot my password', array('action'=>'forgottenPass'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Login')); ?>


</div>
</td>
<td>
    <div class="users form">

   <h2><?php echo $this->Html->link('Register now!', array('controller'=>'users', 'action'=>'register'))?></h2>
        </div>
</td>
</table>
