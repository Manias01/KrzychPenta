<div class="ads form">
<?php echo $this->Form->create('Ad');?>
	<fieldset>
		<legend><?php echo __('Admin Add Ad'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ads'), array('action' => 'index'));?></li>
	</ul>
</div>
