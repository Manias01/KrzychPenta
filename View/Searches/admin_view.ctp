<div class="searches view">
<h2><?php  echo __('Search');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($search['Search']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phrase'); ?></dt>
		<dd>
			<?php echo h($search['Search']['phrase']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($search['Search']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Search'), array('action' => 'edit', $search['Search']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Search'), array('action' => 'delete', $search['Search']['id']), null, __('Are you sure you want to delete # %s?', $search['Search']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Searches'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Search'), array('action' => 'add')); ?> </li>
	</ul>
</div>
