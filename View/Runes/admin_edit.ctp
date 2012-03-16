<div class="runes form">
<?php echo $this->Form->create('Rune');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Rune'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name_pl');
		echo $this->Form->input('name_en');
		echo $this->Form->input('desc_pl');
		echo $this->Form->input('desc_en');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rune.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Rune.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Runes'), array('action' => 'index'));?></li>
	</ul>
</div>
