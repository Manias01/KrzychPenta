<div class="items view">
<h2><?php  echo __('Item');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($item['Item']['id']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Moba_id'); ?></dt>
		<dd>
			<?php echo h($item['Item']['moba_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name Pl'); ?></dt>
		<dd>
			<?php echo h($item['Item']['name_pl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name En'); ?></dt>
		<dd>
			<?php echo h($item['Item']['name_en']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc Pl'); ?></dt>
		<dd>
			<?php echo h($item['Item']['desc_pl']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item'), array('action' => 'edit', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Item'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?> </li>
	</ul>
</div>
