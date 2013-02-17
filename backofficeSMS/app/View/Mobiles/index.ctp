<div class="mobiles index">
	<h2><?php echo __('Mobiles');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('raffledate');?></th>
			<th><?php echo $this->Paginator->sort('chosen');?></th>
			<th><?php echo $this->Paginator->sort('current');?></th>
			<th><?php echo $this->Paginator->sort('mobile');?></th>
			<th><?php echo $this->Paginator->sort('dateupdated');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('last');?></th>
			<th><?php echo $this->Paginator->sort('idcard');?></th>
			<th><?php echo $this->Paginator->sort('stats');?></th>
			<th><?php echo $this->Paginator->sort('confirmedby');?></th>
			<th><?php echo $this->Paginator->sort('dateconfirmed');?></th>
			<th><?php echo $this->Paginator->sort('givenby');?></th>
			<th><?php echo $this->Paginator->sort('dategiven');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($mobiles as $mobile): ?>
	<tr>
		<td><?php echo h($mobile['Mobile']['id']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['raffledate']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['chosen']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['current']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['mobile']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['dateupdated']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['name']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['last']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['idcard']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['stats']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['confirmedby']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['dateconfirmed']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['givenby']); ?>&nbsp;</td>
		<td><?php echo h($mobile['Mobile']['dategiven']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mobile['Mobile']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mobile['Mobile']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mobile['Mobile']['id']), null, __('Are you sure you want to delete # %s?', $mobile['Mobile']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Mobile'), array('action' => 'add')); ?></li>
	</ul>
</div>
