<div class="reports view">
<h2><?php  echo __('Report');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($report['Report']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($report['Report']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last'); ?></dt>
		<dd>
			<?php echo h($report['Report']['last']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idcard'); ?></dt>
		<dd>
			<?php echo h($report['Report']['idcard']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Carrier'); ?></dt>
		<dd>
			<?php echo h($report['Report']['carrier']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($report['Report']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($report['Report']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($report['Report']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($report['Report']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Operator'); ?></dt>
		<dd>
			<?php echo h($report['Report']['operator']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Report'), array('action' => 'edit', $report['Report']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Report'), array('action' => 'delete', $report['Report']['id']), null, __('Are you sure you want to delete # %s?', $report['Report']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reports'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report'), array('action' => 'add')); ?> </li>
	</ul>
</div>
