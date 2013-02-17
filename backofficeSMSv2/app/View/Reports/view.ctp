<div class="reports view">
<h2><?php  echo __('Report');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($report['Report']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idmessage'); ?></dt>
		<dd>
			<?php echo h($report['Report']['idmessage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idraffle'); ?></dt>
		<dd>
			<?php echo h($report['Report']['idraffle']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Messageposteddate'); ?></dt>
		<dd>
			<?php echo h($report['Report']['messageposteddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($report['Report']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idcard'); ?></dt>
		<dd>
			<?php echo h($report['Report']['idcard']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($report['Report']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Receipt'); ?></dt>
		<dd>
			<?php echo h($report['Report']['receipt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prize'); ?></dt>
		<dd>
			<?php echo h($report['Report']['prize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile2'); ?></dt>
		<dd>
			<?php echo h($report['Report']['mobile2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($report['Report']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Posteddate'); ?></dt>
		<dd>
			<?php echo h($report['Report']['posteddate']); ?>
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
