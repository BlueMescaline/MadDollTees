<h2>Reset password</h2>
<p>Enter the new password!</p>
<?php echo $this->Form->create('User');
echo $this->Form->input('password');
echo $this->Form->input('password_confirmation',array('type'=>'password'));

 echo $this->Form->end(__('Save')); ?>




