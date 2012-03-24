<div class="builds index">
	<h2><?php echo __('Builds');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
                        <th>Image</th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('champion_id');?></th>
			<th><?php echo $this->Paginator->sort('masteries');?></th>
			<th><?php echo $this->Paginator->sort('ss');?></th>
			<th><?php echo $this->Paginator->sort('runes');?></th>
			<th><?php echo $this->Paginator->sort('items');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($builds as $build): ?>
        <?$img_url = $this->StrChanger->Dehumanize($build['Champion']['name'])?>
	<tr>
		<td><?php echo h($build['Build']['id']); ?>&nbsp;</td>
                <td><img src="<?=$this->base?>/img/lol/champions/<?=$img_url?>/<?=$img_url?>.png" alt="<?=$build['Champion']['name']?>"/></td>
		<td><?php echo h($build['Build']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($build['Champion']['name'], array('controller' => 'champions', 'action' => 'view', $build['Champion']['id'])); ?>
		</td>
		<td><?php echo h($build['Build']['masteries']); ?>&nbsp;</td>
		<td><?php echo h($build['Build']['ss']); ?>&nbsp;</td>
		<td><?php echo h($build['Build']['runes']); ?>&nbsp;</td>
		<td><?php echo h($build['Build']['items']); ?>&nbsp;</td>
		<td><?php echo h($build['Build']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($build['User']['username'], array('controller' => 'users', 'action' => 'view', $build['User']['id'])); ?>
		</td>
		<td><?php echo h($build['Build']['created']); ?>&nbsp;</td>
		<td><?php echo h($build['Build']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $build['Build']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $build['Build']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $build['Build']['id']), null, __('Are you sure you want to delete # %s?', $build['Build']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Build'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Champions'), array('controller' => 'champions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Champion'), array('controller' => 'champions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
