<div class="sliders index">
	<h2><?php echo __('Sliders');?></h2>
        <p>Wyświetlają się jedynie 3 ostatnie slajdy</p>
        
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($sliders as $slider): ?>
	<tr>
		<td><?php echo h($slider['Slider']['id']); ?>&nbsp;</td>
		<td><?php echo h($slider['Slider']['image']); ?>&nbsp;</td>
		<td><?php echo h($slider['Slider']['description']); ?>&nbsp;</td>
		<td><?php echo h($slider['Slider']['url']); ?>&nbsp;</td>
		<td><?php echo h($slider['Slider']['type']); ?>&nbsp;</td>
		<td><?php echo h($slider['Slider']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $slider['Slider']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $slider['Slider']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $slider['Slider']['id']), null, __('Are you sure you want to delete # %s?', $slider['Slider']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Slider'), array('action' => 'add')); ?></li>
	</ul>
</div>
