<div class="skills form">
<?php echo $this->Form->create('Skill');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Skill'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('champion_id');
		echo $this->Form->input('name_pl');
		echo $this->Form->input('name_en');
		echo $this->Form->input('desc_pl');
		echo $this->Form->input('cooldown');
		echo $this->Form->input('cost');
		echo $this->Form->input('range');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Skill.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Skill.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Skills'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Champions'), array('controller' => 'champions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Champion'), array('controller' => 'champions', 'action' => 'add')); ?> </li>
	</ul>
</div>
