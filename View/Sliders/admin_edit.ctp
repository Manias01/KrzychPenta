<div class="sliders form">
<?php echo $this->Form->create('Slider');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Slider'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('image');
		echo $this->Form->input('description');
		echo $this->Form->input('url');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Slider.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Slider.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sliders'), array('action' => 'index'));?></li>
	</ul>
</div>
