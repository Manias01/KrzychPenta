<div class="sliders view">
<h2><?php  echo __('Slider');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Slider'), array('action' => 'edit', $slider['Slider']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Slider'), array('action' => 'delete', $slider['Slider']['id']), null, __('Are you sure you want to delete # %s?', $slider['Slider']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sliders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Slider'), array('action' => 'add')); ?> </li>
	</ul>
</div>
