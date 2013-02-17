<?php
    header("Content-Disposition: attachment; filename=status_detalle.xls");
?>

<style type="text/css">
<!--
.xl65
{
    mso-style-parent:style0;
    mso-number-format:"\@";
}
-->
</style>
	<h2>Top 5 Ciudades</h2>
	<table border="1">
		<tr>
			<th>Ciudad</th>
			<th>Mensajes</th>
		</tr>
		<?php foreach ($cities as $c): ?>
		<tr>
			<td><?php echo $c['Message']['city']; ?></td>
			<td><?php echo $c[0]['message_num']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<h2>Status diario</h2>
	<table border="1">
		<tr>
			<th>Fecha</th>
			<th>Total</th>
			<th>Validos</th>
			<th>Invalidos</th>
			<th>Digitel</th>
			<th>Movilnet</th>
			<th>Movistar</th>
			<th>Fijos</th>
			<th>Callcenter</th>
		</tr>
		<?php foreach ($report as $r): ?>
		<tr>
			<td><?php echo substr($r['date'], 8, 2).'-'.substr($r['date'], 5, 2).'-'.substr($r['date'], 0, 4); ?></td>
			<td class="right"><?php echo $r['total']; ?></td>
			<td class="right"><?php echo $r['valid']; ?></td>
			<td class="right"><?php echo $r['notvalid']; ?></td>
			<td class="right"><?php echo $r['digitel']; ?></td>
			<td class="right"><?php echo $r['movilnet']; ?></td>
			<td class="right"><?php echo $r['movistar']; ?></td>
			<td class="right"><?php echo $r['others']; ?></td>
			<td class="right"><?php echo $r['callcenter']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
