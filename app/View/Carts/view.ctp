<?php //session_destroy(); ?>
<?php echo $this->Html->link('Home','/');?>
			Cart
<?php echo $this->Form->create('Cart',array('url'=>array('action'=>'update')));?>
		<table width="100%">
			<thead>
				<tr>
					<th colspan="2">Product Name</th>
                    <th>Size</th>
                    <th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
                    <th>Remove</th>
                </tr>
			</thead>
			<tbody>
            <?php echo $this->Form->create('Cart',array('url'=>array('action'=>'update')));?>
            <?php $total=0; ?>
				<?php foreach ($items as  $item):
                    foreach($item as $item_size=>$item_details): ?>
                    <tr>
                        <td><?php echo $this->Html->link( $item_details['Item']['name'], array('controller' => 'items', 'action' => 'view', $item_details['Item']['id']));?>
                        <td><?php echo $this->Html->link(
                            $this->Html->image($item_details['Item']['image'], array('alt' => $item_details['Item']['name'], 'width' => '70px')),
                            array('controller' => 'items','action' => 'view',$item_details['Item']['id']),array('escape' => false)) ;?> </td>
                        <td> <?php echo $item_size;  ?></td>
                        <td>&euro; <?php echo $item_details['Item']['price'];?></td>
					    <td><div>
						    <?php echo $this->Form->hidden('item_id.',array('value' => $item_details['Item']['id']));?>
                            <?php echo $this->Form->hidden('item_size.',array('value' => $item_size));?>
                            <?php echo $this->Form->input('count.', array('type' => 'number', 'label' => false, 'value' => $item_details['Item']['count']));?>
						</div></td>
					    <td>&euro; <?php echo $item_details['Item']['count']*$item_details['Item']['price']; ?> </td>
                        <td> <?php echo $this->Html->link('Remove', array('action' => 'remove', $item_size, $item_details['Item']['id'])); ?> </td>
				    </tr>
				<?php $total = $total + ($item_details['Item']['count']*$item_details['Item']['price']);?>
                <?php CakeSession::write('total',$total); ?>
                <?php endforeach;?>
                <?php endforeach;?>

                <tr class="success">
					<td colspan=5></td>
					<td colspan="2">&euro; <?php echo $total;?>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="text-right">
            <?php if (!empty($items)){
			     echo $this->Form->submit('Update',array('class'=>'btn btn-warning','div'=>false));
            }?>
        </p>
<?php echo $this->Form->end();?>

            <?php echo $this->Form->create('OrderItem',array('url' => array('controller' => 'Shop', 'action' => 'checkOut')));?>
            <?php echo $this->Form->hidden('Cart',array('value'=>CakeSession::id())); ?>
            <?php echo $this->Form->submit('Check out');?>
            <?php echo $this->Form->end();?>

