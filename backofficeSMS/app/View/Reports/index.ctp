<div class="reports index">
	<h2><?php echo __('Reports');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('last');?></th>
			<th><?php echo $this->Paginator->sort('idcard');?></th>
			<th><?php echo $this->Paginator->sort('carrier');?></th>
			<th><?php echo $this->Paginator->sort('mobile');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('operator');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($reports as $report): ?>
	<tr>
		<td><?php echo h($report['Report']['id']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['name']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['last']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['idcard']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['carrier']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['mobile']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['state']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['city']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['email']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['operator']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $report['Report']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $report['Report']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $report['Report']['id']), null, __('Are you sure you want to delete # %s?', $report['Report']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Report'), array('action' => 'add')); ?></li>
	</ul>
</div>
