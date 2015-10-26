<div class="items view">
    <h2><?php echo __('Item'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($item['Item']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($item['Item']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Description'); ?></dt>
        <dd>
            <?php echo h($item['Item']['description']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Price'); ?></dt>
        <dd>
            <?php echo h($item['Item']['price']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Image'); ?></dt>
        <dd>
            <?php echo $this->Html->image($item['Item']['image'], array('alt'=>$item['Item']['image'], 'width'=>'300px')); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($item['Item']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($item['Item']['modified']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Item'), array('action' => 'edit', 'admin'=>'true', $item['Item']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Item'),
                array('action' => 'delete', $item['Item']['id']),
                array(), __('Are you sure you want to delete  %s?', $item['Item']['name'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?> </li>
    </ul>
</div>
