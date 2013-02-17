<div class="login form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User', array('action'=>'login'));?>
	<fieldset>
		<legend><?php echo __('Ingresar al Sistema'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
