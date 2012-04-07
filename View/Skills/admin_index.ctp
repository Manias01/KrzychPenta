<div class="skills index">
	<h2><?php echo __('Skills');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('champion_id');?></th>
                        <th>Image</th>
			<th><?php echo $this->Paginator->sort('name_en');?></th>
			<th><?php echo $this->Paginator->sort('name_pl');?></th>
			<th><?php echo $this->Paginator->sort('desc_pl');?></th>
			<th><?php echo $this->Paginator->sort('cooldown');?></th>
			<th><?php echo $this->Paginator->sort('cost');?></th>
			<th><?php echo $this->Paginator->sort('range');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($skills as $skill): ?>
        <?$img_url = $this->Thumb->Dehumanize($skill['Skill']['name_en'])?>
	<tr>
		<td><?php echo h($skill['Skill']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($skill['Champion']['name'], array('controller' => 'champions', 'action' => 'view', $skill['Champion']['id'])); ?>
		</td>
                <td><img src="<?=$this->base?>/img/lol/champions/<?=$this->Thumb->Dehumanize($skill['Champion']['name'])?>/<?=$img_url?>_38.png" alt="<?=$skill['Skill']['name_en']?>"/></td>
		<td><?php echo h($skill['Skill']['name_en']); ?>&nbsp;</td>
                <td><?php echo h($skill['Skill']['name_pl']); ?>&nbsp;</td>
		<td><?php echo h($skill['Skill']['desc_pl']); ?>&nbsp;</td>
		<td><?php echo h($skill['Skill']['cooldown']); ?>&nbsp;</td>
		<td><?php echo h($skill['Skill']['cost']); ?>&nbsp;</td>
		<td><?php echo h($skill['Skill']['range']); ?>&nbsp;</td>
		<td><?php echo h($skill['Skill']['type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $skill['Skill']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $skill['Skill']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $skill['Skill']['id']), null, __('Are you sure you want to delete # %s?', $skill['Skill']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Skill'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Champions'), array('controller' => 'champions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Champion'), array('controller' => 'champions', 'action' => 'add')); ?> </li>
	</ul>
</div>
