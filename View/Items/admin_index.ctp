<div class="items index">
	<h2><?php echo __('Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
                        <th>Image</th>
			<th><?php echo $this->Paginator->sort('name_en');?></th>
			<th><?php echo $this->Paginator->sort('name_pl');?></th>
			<th><?php echo $this->Paginator->sort('price1');?></th>
			<th><?php echo $this->Paginator->sort('price2');?></th>
			<th><?php echo $this->Paginator->sort('desc_pl');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($items as $item): ?>
        <?$img_url = $this->Thumb->Dehumanize($item['Item']['name_en'])?>
	<tr>
		<td><?php echo h($item['Item']['id']); ?>&nbsp;</td>
                <td><img src="<?=$this->base?>/img/lol/items/<?=$img_url?>.gif" alt="<?=$item['Item']['name_en']?>"/></td>
		<td><?php echo h($item['Item']['name_en']); ?>&nbsp;</td>
                <td><?php echo h($item['Item']['name_pl']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['price1']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['price2']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['desc_pl']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $item['Item']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
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
		<li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?></li>
	</ul>
</div>
