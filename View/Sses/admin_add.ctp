<div class="sses form">
<?php echo $this->Form->create('Ss');?>
	<fieldset>
		<legend><?php echo __('Admin Add Ss'); ?></legend>
	<?php
		echo $this->Form->input('name_pl');
		echo $this->Form->input('name_en');
		echo $this->Form->input('desc_pl');
		echo $this->Form->input('desc_en');
		echo $this->Form->input('lv');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sses'), array('action' => 'index'));?></li>
	</ul>
</div>
