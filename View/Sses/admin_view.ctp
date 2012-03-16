<div class="sses view">
<h2><?php  echo __('Ss');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ss['Ss']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name Pl'); ?></dt>
		<dd>
			<?php echo h($ss['Ss']['name_pl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name En'); ?></dt>
		<dd>
			<?php echo h($ss['Ss']['name_en']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc Pl'); ?></dt>
		<dd>
			<?php echo h($ss['Ss']['desc_pl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc En'); ?></dt>
		<dd>
			<?php echo h($ss['Ss']['desc_en']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lv'); ?></dt>
		<dd>
			<?php echo h($ss['Ss']['lv']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ss'), array('action' => 'edit', $ss['Ss']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ss'), array('action' => 'delete', $ss['Ss']['id']), null, __('Are you sure you want to delete # %s?', $ss['Ss']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ss'), array('action' => 'add')); ?> </li>
	</ul>
</div>
