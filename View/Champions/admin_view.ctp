<div class="champions view">
<h2><?php  echo __('Champion');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($champion['Champion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($champion['Champion']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rp'); ?></dt>
		<dd>
			<?php echo h($champion['Champion']['rp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip'); ?></dt>
		<dd>
			<?php echo h($champion['Champion']['ip']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Champion'), array('action' => 'edit', $champion['Champion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Champion'), array('action' => 'delete', $champion['Champion']['id']), null, __('Are you sure you want to delete # %s?', $champion['Champion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Champions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Champion'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Skills'), array('controller' => 'skills', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Skill'), array('controller' => 'skills', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Skills');?></h3>
	<?php if (!empty($champion['Skill'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Champion Id'); ?></th>
		<th><?php echo __('Name Pl'); ?></th>
		<th><?php echo __('Name En'); ?></th>
		<th><?php echo __('Desc Pl'); ?></th>
		<th><?php echo __('Cooldown'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th><?php echo __('Range'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($champion['Skill'] as $skill): ?>
		<tr>
			<td><?php echo $skill['id'];?></td>
			<td><?php echo $skill['champion_id'];?></td>
			<td><?php echo $skill['name_pl'];?></td>
			<td><?php echo $skill['name_en'];?></td>
			<td><?php echo $skill['desc_pl'];?></td>
			<td><?php echo $skill['cooldown'];?></td>
			<td><?php echo $skill['cost'];?></td>
			<td><?php echo $skill['range'];?></td>
			<td><?php echo $skill['type'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'skills', 'action' => 'view', $skill['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'skills', 'action' => 'edit', $skill['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'skills', 'action' => 'delete', $skill['id']), null, __('Are you sure you want to delete # %s?', $skill['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Skill'), array('controller' => 'skills', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
