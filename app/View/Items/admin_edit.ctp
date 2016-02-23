<div class="items form">
<?php echo $this->Form->create('Item',array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('price');
        echo $this->Form->input('image', array('type' => 'file', 'required' => false ));
        echo 'Actual image:<br/>';
        echo $this->Html->image($pic, array('width' => '120px'));
                echo 'File path:<h1>'.WWW_ROOT.$pic.'</h1>';
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Item.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Item.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index', 'admin' => false)); ?></li>
	</ul>


