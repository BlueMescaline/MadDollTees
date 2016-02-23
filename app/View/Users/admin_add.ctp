<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
        echo $this->Form->input('password_confirmation',array('type'=>'password'));
        echo $this->Form->input('status', array('options'=>array('active'=>'active','inactive'=>'inactive')));
        echo $this->Form->input('email');
        echo $this->Form->input('firstname');
		echo $this->Form->input('lastname');
        echo $this->Form->input('birthdate', array(
            'label' => 'Date of birth',
            'dateFormat' => 'DMY',
            'minYear' => date('Y') - 5,
            'maxYear' => date('Y') - 50,
            'default'=>'minYear',)
        );
        echo $this->Form->input('user_type', array('options' => array('0'=>'User', '1'=>'Admin', ))); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
