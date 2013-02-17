<div class="reports form">
<?php echo $this->Form->create('Report');?>
	<fieldset>
		<legend><?php echo __('Add Report'); ?></legend>
	<?php
		echo $this->Form->input('idmessage');
		echo $this->Form->input('idraffle');
		echo $this->Form->input('messageposteddate');
		echo $this->Form->input('mobile');
		echo $this->Form->input('idcard');
		echo $this->Form->input('name');
		echo $this->Form->input('receipt');
		echo $this->Form->input('prize');
		echo $this->Form->input('mobile2');
		echo $this->Form->input('city');
		echo $this->Form->input('posteddate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reports'), array('action' => 'index'));?></li>
	</ul>
</div>
