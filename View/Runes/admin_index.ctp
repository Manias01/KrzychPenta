<div class="runes index">
	<h2><?php echo __('Runes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
                        <th>Image</th>
			<th><?php echo $this->Paginator->sort('name_en');?></th>
			<th><?php echo $this->Paginator->sort('name_pl');?></th>
			<th><?php echo $this->Paginator->sort('desc_pl');?></th>
			<th><?php echo $this->Paginator->sort('desc_en');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($runes as $rune): ?>
        <?$img_url = $this->StrChanger->Dehumanize($rune['Rune']['name_en'])?>
	<tr>
		<td><?php echo h($rune['Rune']['id']); ?>&nbsp;</td>
                <td><img src="<?=$this->base?>/img/lol/runes/<?=$img_url?>.gif" alt="<?=$rune['Rune']['name_en']?>"/></td>
		<td><?php echo h($rune['Rune']['name_en']); ?>&nbsp;</td>
                <td><?php echo h($rune['Rune']['name_pl']); ?>&nbsp;</td>
		<td><?php echo h($rune['Rune']['desc_pl']); ?>&nbsp;</td>
		<td><?php echo h($rune['Rune']['desc_en']); ?>&nbsp;</td>
		<td><?php echo h($rune['Rune']['type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rune['Rune']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rune['Rune']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rune['Rune']['id']), null, __('Are you sure you want to delete # %s?', $rune['Rune']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rune'), array('action' => 'add')); ?></li>
	</ul>
</div>