<div class="users form">
	<table>
		<tr>
			<td>C&oacute;digos activados</td>
			<td><?php echo $codesUsed; ?></td>
		</tr>
		<tr>
			<td>C&oacute;digos Movistar entregados</td>
			<td><?php echo $prizes; ?></td>
		</tr>
		<tr>
			<td>C&oacute;digos Backup entregados</td>
			<td><?php echo $codesBackup; ?></td>
		</tr>
		<tr>
			<td>Cantidad de SMS recibidos</td>
			<td><?php echo $sms; ?></td>
		</tr>
		<tr>
			<td>Celulares entregados</td>
			<td><?php echo $mobilesGiven; ?></td>
		</tr>
	</table>

	<?php echo $this -> Form -> create('Stats'); ?>
	<fieldset>
		<legend><?php //echo __('Status de la promo'); ?></legend>
	<?php
	echo $this -> Form -> input('begin', array('label' => 'Inicio', 'type' => 'text', 'id'=>'BeginDate','onkeypress' => 'return false;'));
	echo $this -> Form -> input('end', array('label' => 'Fin', 'type' => 'text', 'id'=>'EndDate','onkeypress' => 'return false;'));
	?>
	</fieldset>
	<?php
	$options = array('label' => 'Consultar', 'id' => 'GetStatsButton');
	echo $this -> Form -> end($options);
	?>
	

</div>

<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Regresar'), array('controller'=>'users', 'action' => 'main'));?></li>
	</ul>
</div>

<script type="text/javascript">
	$("#BeginDate").datepicker({ dateFormat: "yy-mm-dd" });
	$("#EndDate").datepicker({ dateFormat: "yy-mm-dd" });
	
	$("#GetStatsButton").click(function(event) {
		event.preventDefault();
		var isBeginDate = $("#BeginDate").val() == "" ? false : true;
		var isEndDate = $("#EndDate").val() == "" ? false : true;
		if (isBeginDate == isEndDate) {
			if (isBeginDate == true) {
				var beginDate = Date.parse($("#BeginDate").val());
				var endDate = Date.parse($("#EndDate").val());
				var result = endDate - beginDate;
				if (result >= 0)
					$("#StatsStatsForm").submit();
				else
					alert("Fecha fin debe ser igual o mayor a fecha de inicio");
			}
			else {
				$("#StatsStatsForm").submit();
			}
		}
		else {
			alert("Ambas fechas deben estar en blanco o seleccionadas");
		}
	}); 
</script>