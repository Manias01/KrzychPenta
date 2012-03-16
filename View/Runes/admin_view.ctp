<div class="runes view">
<h2><?php  echo __('Rune');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rune['Rune']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name Pl'); ?></dt>
		<dd>
			<?php echo h($rune['Rune']['name_pl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name En'); ?></dt>
		<dd>
			<?php echo h($rune['Rune']['name_en']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc Pl'); ?></dt>
		<dd>
			<?php echo h($rune['Rune']['desc_pl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc En'); ?></dt>
		<dd>
			<?php echo h($rune['Rune']['desc_en']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($rune['Rune']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rune'), array('action' => 'edit', $rune['Rune']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rune'), array('action' => 'delete', $rune['Rune']['id']), null, __('Are you sure you want to delete # %s?', $rune['Rune']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Runes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rune'), array('action' => 'add')); ?> </li>
	</ul>
</div>
