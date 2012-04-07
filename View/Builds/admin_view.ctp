<div class="builds view">
<h2><?php  echo __('Build');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($build['Build']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($build['Build']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Champion'); ?></dt>
		<dd>
			<?php echo $this->Html->link($build['Champion']['name'], array('controller' => 'champions', 'action' => 'view', $build['Champion']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Skill Sequence'); ?></dt>
		<dd>
			<?php echo h($build['Build']['skill_sequence']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Masteries'); ?></dt>
		<dd>
			<?php echo h($build['Build']['masteries']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ss1 Id'); ?></dt>
		<dd>
			<?php echo h($build['Build']['ss1_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ss2 Id'); ?></dt>
		<dd>
			<?php echo h($build['Build']['ss2_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Runes'); ?></dt>
		<dd>
			<?php echo h($build['Build']['runes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Items'); ?></dt>
		<dd>
			<?php echo h($build['Build']['items']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($build['Build']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($build['User']['id'], array('controller' => 'users', 'action' => 'view', $build['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($build['Build']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($build['Build']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Build'), array('action' => 'edit', $build['Build']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Build'), array('action' => 'delete', $build['Build']['id']), null, __('Are you sure you want to delete # %s?', $build['Build']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Builds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Build'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Champions'), array('controller' => 'champions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Champion'), array('controller' => 'champions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
