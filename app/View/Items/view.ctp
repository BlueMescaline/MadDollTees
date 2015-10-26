<div class="items view">
<div id="image"><?php echo $this->Html->image($item['Item']['image'], array('alt'=>$item['Item']['image'])); ?></div>

<div id="itemDetails">
        <h2><?php echo h($item['Item']['name']); ?></h2>
        <h2 class="price">&euro; <?php echo h($item['Item']['price']); ?></h2>
        <hr/>

    <?php echo $this->Form->create('Cart',array('id'=>'add-form','url'=>array('controller'=>'carts','action'=>'add')));?>
    <?php echo $this->Form->hidden('item_id',array('value'=>$item['Item']['id']))?>
    <?php echo $this->Form->input('item_size',array('options'=>$sizes)); ?>
    <?php echo $this->Form->submit('Add to cart',array('class'=>'btn-success btn btn-lg'));?>
    <?php echo $this->Form->end();?>


</div>



    <hr id="itemDetails-other-hr"/>


    </div>
<div>
</div>
