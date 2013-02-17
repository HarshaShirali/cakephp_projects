<div class="mobiles form">
<?php echo $this->Form->create('Mobile');?>
	<fieldset>
		<legend><?php echo __('Add Mobile'); ?></legend>
	<?php
		echo $this->Form->input('raffledate');
		echo $this->Form->input('chosen');
		echo $this->Form->input('current');
		echo $this->Form->input('mobile');
		echo $this->Form->input('dateupdated');
		echo $this->Form->input('name');
		echo $this->Form->input('last');
		echo $this->Form->input('idcard');
		echo $this->Form->input('stats');
		echo $this->Form->input('confirmedby');
		echo $this->Form->input('dateconfirmed');
		echo $this->Form->input('givenby');
		echo $this->Form->input('dategiven');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mobiles'), array('action' => 'index'));?></li>
	</ul>
</div>
