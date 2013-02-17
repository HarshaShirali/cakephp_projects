<div class="customers form">
<?php echo $this->Form->create('Customer'); ?>
	<fieldset>
		<legend><?php echo __('Add Customer'); ?></legend>
	<?php
		echo $this->Form->input('mobile');
		echo $this->Form->input('name');
		echo $this->Form->input('sex');
		echo $this->Form->input('birthday');
		echo $this->Form->input('email');
		echo $this->Form->input('country');
		echo $this->Form->input('fbid');
		echo $this->Form->input('twid');
		echo $this->Form->input('fbcounter');
		echo $this->Form->input('twcounter');
		echo $this->Form->input('datecreated');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?></li>
	</ul>
</div>
