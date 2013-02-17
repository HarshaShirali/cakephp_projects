<div class="reports form">
<?php echo $this->Form->create('Report');?>
	<fieldset>
		<legend><?php echo __('Edit Report'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('last');
		echo $this->Form->input('idcard');
		echo $this->Form->input('carrier');
		echo $this->Form->input('mobile');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('email');
		echo $this->Form->input('operator');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Report.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Report.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Reports'), array('action' => 'index'));?></li>
	</ul>
</div>
