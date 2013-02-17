<div class="users form">
	<h1>Status</h1>
	<table>
		<tr>
			<th colspan="2">V&aacute;lidos</th>
		</tr>
		<tr>
			<td>Total v&aacute;lidos (SMS + 0800)</td>
			<td><?php echo $valid; ?></td>
		</tr>
		<tr>
			<td>SMS v&aacute;lidos</td>
			<td><?php echo $smsValid; ?></td>
		</tr>
		<tr>
			<td>SMS no v&aacute;lidos</td>
			<td><?php echo $smsNotValid; ?></td>
		</tr>
		<tr>
			<td>Total SMS recibidos</td>
			<td><?php echo $smsTotal; ?></td>
		</tr>
		<tr>
			<td>Registros 0800</td>
			<td><?php echo $callcenter; ?></td>
		</tr>
	</table>
	
	<table>
		<tr>
			<th colspan="2">Operadoras</th>
		</tr>
		<tr>
			<td>Digitel</td>
			<td><?php echo $digitel; ?></td>
		</tr>
		<tr>
			<td>Movilnet</td>
			<td><?php echo $movilnet; ?></td>
		</tr>
		<tr>
			<td>Movistar</td>
			<td><?php echo $movistar; ?></td>
		</tr>
		<tr>
			<td>Fijos (Digitel, Movistar, Movilnet)</td>
			<td><?php echo $others; ?></td>
		</tr>
		<tr>
			<td>Total SMS recibidos</td>
			<td><?php echo $smsTotal; ?></td>
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
		<li><?php echo $this->Html->link(__('General'), array('controller'=>'users', 'action' => 'stats'));?></li>
		<li><?php echo $this->Html->link(__('Detallado'), array('controller'=>'users', 'action' => 'stats_details'));?></li>
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