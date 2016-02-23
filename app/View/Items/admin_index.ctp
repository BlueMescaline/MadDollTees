<div class="items index">

    <h2><?php echo __('Items'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('description'); ?></th>
            <th><?php echo $this->Paginator->sort('price'); ?></th>
            <th><?php echo $this->Paginator->sort('image'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo h($item['Item']['id']); ?>&nbsp;</td>
                <td><?php echo h($item['Item']['name']); ?>&nbsp;</td>
                <td><?php echo h($item['Item']['description']); ?>&nbsp;</td>
                <td><?php echo h($item['Item']['price']); ?>&nbsp;</td>
                <td><?php echo $this->Html->image($item['Item']['image'],array('alt'=>$item['Item']['name'],'width'=>'100px')); ?>&nbsp;</td>
                <td><?php echo h($item['Item']['created']); ?>&nbsp;</td>
                <td><?php echo h($item['Item']['modified']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $item['Item']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $item['Item']['id'], 'admin' => true)); ?>
                    <?php echo $this->Form->postLink(__('Delete'),
                        array('action' => 'delete', $item['Item']['id'],'admin'=>true),
                        array(), __('Are you sure you want to delete  %s?', $item['Item']['name'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Item'), array('action' => 'add','admin'=>true)); ?></li>
    </ul>
</div>
