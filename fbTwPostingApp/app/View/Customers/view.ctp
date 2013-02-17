<div class="customers view">
<h2><?php  echo __('Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sex'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['sex']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthday'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['birthday']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fbid'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['fbid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twid'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['twid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fbcounter'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['fbcounter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twcounter'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['twcounter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datecreated'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['datecreated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Customer'), array('action' => 'delete', $customer['Customer']['id']), null, __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?> </li>
	</ul>
</div>
