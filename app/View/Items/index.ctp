
	<h2><?php echo __('Items'); ?></h2>

    <div id="sort">Sort by:
        <?php echo $this->Paginator->sort('name'); ?>&nbsp;
        <?php echo $this->Paginator->sort('price'); ?>
    </div>
        <!-- limit items to 4 culomns -->
    <div id="items" style="-webkit-columns: 200px 4;
                            -moz-columns: 200px 4;
                            columns: 200px 4;">
        <?php foreach ($items as $item): ?>

        <table>
        <tr>
            <td colspan="2"><?php echo $this->Html->link(
                    $this->Html->image($item['Item']['image'],array('alt'=>$item['Item']['name'],'width'=>'219px')),
                    array('action'=>'view',$item['Item']['id']),array('escape' => false))    ;?></td>
        <tr>
            <td><?php echo $this->Html->link($item['Item']['name'], array('controller'=>'items','action' => 'view', $item['Item']['id'])); ?></td>
           <!-- <td rowspan="2" align="right"><button>add to cart</button></td> -->
        </tr>
        <tr>
            <td><?php echo h($item['Item']['price']); ?> &euro;</td></tr>
    </table>

    <?php endforeach; ?>
</div>
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

