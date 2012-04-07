<div class="sses index">
	<h2><?php echo __('Sses');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
                        <th>Image</th>
			<th><?php echo $this->Paginator->sort('name_en');?></th>
			<th><?php echo $this->Paginator->sort('name_pl');?></th>
			<th><?php echo $this->Paginator->sort('desc_pl');?></th>
			<th><?php echo $this->Paginator->sort('desc_en');?></th>
			<th><?php echo $this->Paginator->sort('lv');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($sses as $ss): ?>
        <?$img_url = $this->Thumb->Dehumanize($ss['Ss']['name_en'])?>
	<tr>
		<td><?php echo h($ss['Ss']['id']); ?>&nbsp;</td>
                <td><img src="<?=$this->base?>/img/lol/ss/<?=$img_url?>.png" alt="<?=$ss['Ss']['name_en']?>"/></td>
		<td><?php echo h($ss['Ss']['name_en']); ?>&nbsp;</td>
		<td><?php echo h($ss['Ss']['name_pl']); ?>&nbsp;</td>
		<td><?php echo h($ss['Ss']['desc_pl']); ?>&nbsp;</td>
		<td><?php echo h($ss['Ss']['desc_en']); ?>&nbsp;</td>
		<td><?php echo h($ss['Ss']['lv']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ss['Ss']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ss['Ss']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ss['Ss']['id']), null, __('Are you sure you want to delete # %s?', $ss['Ss']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Ss'), array('action' => 'add')); ?></li>
	</ul>
</div>
