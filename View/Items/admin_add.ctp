<div class="items form">
<?php echo $this->Form->create('Item');?>
	<fieldset>
		<legend><?php echo __('Admin Add Item'); ?></legend>
	<?php
                echo $this->Form->input('moba_id');
		echo $this->Form->input('name_pl');
		echo $this->Form->input('name_en');
		echo $this->Form->input('desc_pl');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index'));?></li>
	</ul>
</div>
