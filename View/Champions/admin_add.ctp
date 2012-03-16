<div class="champions form">
<?php echo $this->Form->create('Champion');?>
	<fieldset>
		<legend><?php echo __('Admin Add Champion'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('rp');
		echo $this->Form->input('ip');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Champions'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Skills'), array('controller' => 'skills', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Skill'), array('controller' => 'skills', 'action' => 'add')); ?> </li>
	</ul>
</div>
