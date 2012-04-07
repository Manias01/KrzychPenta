<div class="champions index">
	<h2><?php echo __('Champions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
                        <th>Image</th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('rp');?></th>
			<th><?php echo $this->Paginator->sort('ip');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($champions as $champion): ?>
        <?$img_url = $this->Thumb->Dehumanize($champion['Champion']['name'])?>
	<tr>
		<td><?php echo h($champion['Champion']['id']); ?>&nbsp;</td>
                <td><img src="<?=$this->base?>/img/lol/champions/<?=$img_url?>/<?=$img_url?>.png" alt="<?=$champion['Champion']['name']?>"/></td>
		<td><?php echo h($champion['Champion']['name']); ?>&nbsp;</td>
		<td><?php echo h($champion['Champion']['rp']); ?>&nbsp;</td>
		<td><?php echo h($champion['Champion']['ip']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $champion['Champion']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $champion['Champion']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $champion['Champion']['id']), null, __('Are you sure you want to delete # %s?', $champion['Champion']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Champion'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Skills'), array('controller' => 'skills', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Skill'), array('controller' => 'skills', 'action' => 'add')); ?> </li>
	</ul>
</div>
