<div class="winners index">
	
		<legend>Ganadores</legend>
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Pendientes</a></li>
				<li><a href="#tabs-2">Contactados</a></li>
				<li><a href="#tabs-3">Agendados</a></li>
				<li><a href="#tabs-4">Rechazados</a></li>
				<li><a href="#tabs-5">Backup</a></li>
			</ul>
			<table id="tabs-1">
				<tr>
					<th>Tel&eacute;fono 1</th>
					<th>Tel&eacute;fono 2</th>
					<th>Acci&oacute;n</th>
				</tr>
				<?php $x = 0; ?>
				<?php foreach ($pending as $p): ?>
				<?php $x += 1; ?>
				<tr>
					<td><?php echo $p['Winner']['mobile']; ?></td>
					<td><?php echo $p['Winner']['mobile2']; ?></td>
					<td class="actions"><?php echo $this->Html->link('Ver', array('controller' => 'winners', 'action' => 'edit', $p['Winner']['id'])); ?></td>
				</tr>
				<?php endforeach; ?>
				<?php if ($x == 0): ?>
				<tr>
					<td colspan="3">No se encontraron registros</td>
				</tr>
				<?php endif; ?>
			</table>
	
			<table id="tabs-2">
				<tr>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>C&eacute;dula</th>
				</tr>
				<?php $x = 0; ?>
				<?php foreach ($contacted as $p): ?>
				<?php $x += 1; ?>
				<tr>
					<td><?php echo $p['Winner']['name']; ?></td>
					<td><?php echo $p['Winner']['last']; ?></td>
					<td><?php echo $p['Winner']['idcard']; ?></td>
				</tr>
				<?php endforeach; ?>
				<?php if ($x == 0): ?>
				<tr>
					<td colspan="3">No se encontraron registros</td>
				</tr>
				<?php endif; ?>
			</table>
			
			<table id="tabs-3">
				<tr>
					<th>Tel&eacute;fono 1</th>
					<th>Tel&eacute;fono 2</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Acciones</th>
				</tr>
				<?php $x = 0; ?>
				<?php foreach ($scheduled as $p): ?>
				<?php $x += 1; ?>
				<tr>
					<td><?php echo $p['Winner']['mobile']; ?></td>
					<td><?php echo $p['Winner']['mobile2']; ?></td>
					<td><?php echo $p['Winner']['name']; ?></td>
					<td><?php echo $p['Winner']['last']; ?></td>
					<td class="actions"><?php echo $this->Html->link('Ver', array('controller' => 'winners', 'action' => 'edit', $p['Winner']['id'])); ?></td>
				</tr>
				<?php endforeach; ?>
				<?php if ($x == 0): ?>
				<tr>
					<td colspan="5">No se encontraron registros</td>
				</tr>
				<?php endif; ?>
			</table>
			
			<table id="tabs-4">
				<tr>
					<th>Nombre</th>
					<th>Apellido</th>
				</tr>
				<?php $x = 0; ?>
				<?php foreach ($rejected as $p): ?>
				<?php $x += 1; ?>
				<tr>
					<td><?php echo $p['Winner']['name']; ?></td>
					<td><?php echo $p['Winner']['last']; ?></td>							
				</tr>
				<?php endforeach; ?>
				<?php if ($x == 0): ?>
				<tr>
					<td colspan="2">No se encontraron registros</td>
				</tr>
				<?php endif; ?>
			</table>
			
			<table id="tabs-5">
				<tr>
					<th>Tel&eacute;fono 1</th>
					<th>Tel&eacute;fono 2</th>
				</tr>
				<?php $x = 0; ?>
				<?php foreach ($backup as $p): ?>
				<?php $x += 1; ?>
				<tr>
					<td><?php echo $p['Winner']['mobile']; ?></td>
					<td><?php echo $p['Winner']['mobile2']; ?></td>							
				</tr>
				<?php endforeach; ?>
				<?php if ($x == 0): ?>
				<tr>
					<td colspan="2">No se encontraron registros</td>
				</tr>
				<?php endif; ?>
			</table>
		</div>
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Regresar'), array('controller' => 'users','action' => 'main')); ?></li>
	</ul>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#tabs').tabs();
	});
</script>