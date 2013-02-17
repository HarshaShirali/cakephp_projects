<div class="raffles form">
<?php echo $this->Form->create('Raffle');?>
	<fieldset>
		<legend><?php echo __('Crear sorteo'); ?></legend>
	<?php
		$options = array('N' => 'Abierto', 'Y' => 'Bloqueado');
		echo $this -> Form -> input('raffledate', array('label' => 'Fecha', 'type' => 'text', 'id'=>'BeginDate','onkeypress' => 'return false;'));
		echo $this -> Form -> input('Status', array('type' => 'select',
												'options' => $options));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Crear'));?>

</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3> 
	<ul>
		<li><?php echo $this->Html->link(__('Lista de sorteos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Regresar'), array('controller' => 'users', 'action' => 'main')); ?></li>
	</ul>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$("#BeginDate").datepicker({ dateFormat: "yy-mm-dd" });
	});
</script>