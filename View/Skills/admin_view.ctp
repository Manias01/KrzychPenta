<div class="skills view">
<h2><?php  echo __('Skill');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($skill['Skill']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Champion'); ?></dt>
		<dd>
			<?php echo $this->Html->link($skill['Champion']['name'], array('controller' => 'champions', 'action' => 'view', $skill['Champion']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name Pl'); ?></dt>
		<dd>
			<?php echo h($skill['Skill']['name_pl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name En'); ?></dt>
		<dd>
			<?php echo h($skill['Skill']['name_en']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc Pl'); ?></dt>
		<dd>
			<?php echo h($skill['Skill']['desc_pl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cooldown'); ?></dt>
		<dd>
			<?php echo h($skill['Skill']['cooldown']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cost'); ?></dt>
		<dd>
			<?php echo h($skill['Skill']['cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Range'); ?></dt>
		<dd>
			<?php echo h($skill['Skill']['range']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($skill['Skill']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Skill'), array('action' => 'edit', $skill['Skill']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Skill'), array('action' => 'delete', $skill['Skill']['id']), null, __('Are you sure you want to delete # %s?', $skill['Skill']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Skills'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Skill'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Champions'), array('controller' => 'champions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Champion'), array('controller' => 'champions', 'action' => 'add')); ?> </li>
	</ul>
</div>
