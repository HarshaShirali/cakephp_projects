<div class="prizes form">
<?php echo $this->Form->create('Prize');?>
	<fieldset>
		<legend><?php echo __('Add Prize'); ?></legend>
	<?php
		echo $this->Form->input('idraffle');
		echo $this->Form->input('quantity');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Prizes'), array('action' => 'index'));?></li>
	</ul>
</div>
