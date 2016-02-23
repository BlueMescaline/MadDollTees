<div class="users index">
    <h2><?php echo __('Addresses'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('email'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($newsletters as $newsletter): ?>
            <tr>
                <td><?php echo h($newsletter['Newsletter']['id']); ?>&nbsp;</td>
                <td><?php echo h($newsletter['Newsletter']['email']); ?>&nbsp;</td>
                <td><?php echo h($newsletter['Newsletter']['created']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Form->postLink(__('Delete'),
                        array('action' => 'delete', $newsletter['Newsletter']['id']),
                        array(), __('Are you sure you want to delete  %s?', $newsletter['Newsletter']['email'])); ?>
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

