<div class="messages form">
<?php echo $this->Form->create('Message');?>
	<fieldset>
		<legend><?php echo __('Add Message'); ?></legend>
	<?php
		echo $this->Form->input('mobile');
		echo $this->Form->input('message');
		echo $this->Form->input('answer');
		echo $this->Form->input('posteddate');
		echo $this->Form->input('valid');
		echo $this->Form->input('winner');
		echo $this->Form->input('prize');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Messages'), array('action' => 'index'));?></li>
	</ul>
</div>
