<div class="builds form">
<?php echo $this->Form->create('Build');?>
	<fieldset>
		<legend><?php echo __('Admin Add Build'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('champion_id');
		echo $this->Form->input('skill_sequence');
		echo $this->Form->input('masteries');
		echo $this->Form->input('ss1_id');
		echo $this->Form->input('ss2_id');
		echo $this->Form->input('runes');
		echo $this->Form->input('items');
		echo $this->Form->input('description');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Builds'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Champions'), array('controller' => 'champions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Champion'), array('controller' => 'champions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
