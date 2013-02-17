<div class="users form">
	<p>
		<form>
			<input id="excelButton" type="submit" value="Exportar Excel" />
		</form>
	</p>
	<h1>Top 5 Ciudades</h1>
	<table>
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
	<h1>Status diario</h1>
	<table>
		<tr>
			<th><a href="#" title="Fecha" class="tooltip">Fecha</a></th>
			<th><a href="#" title="Total" class="tooltip">Tot</a></th>
			<th><a href="#" title="V&aacute;lidos" class="tooltip">Val</a></th>
			<th><a href="#" title="Inv&aacute;lidos" class="tooltip">Inv</a></th>
			<th><a href="#" title="Digitel" class="tooltip">Dig</a></th>
			<th><a href="#" title="Movilnet" class="tooltip">Mnt</a></th>
			<th><a href="#" title="Movistar" class="tooltip">Mst</a></th>
			<th><a href="#" title="Fijos" class="tooltip">Fij</a></th>
			<th><a href="#" title="Callcenter" class="tooltip">Cnt</a></th>
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

</div>

<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('General'), array('controller'=>'users', 'action' => 'stats'));?></li>
		<li><?php echo $this->Html->link(__('Detallado'), array('controller'=>'users', 'action' => 'stats_details'));?></li>
		<li><?php echo $this->Html->link(__('Regresar'), array('controller'=>'users', 'action' => 'main'));?></li>
	</ul>
</div>
<style>
	td.right {
		text-align: right;
	}
	.tooltip{display:inline;position:relative}
	.tooltip:hover{text-decoration:none}
	.tooltip:hover:after{
		background:#111;
		background:rgba(0,0,0,.8);
		border-radius:5px;
		bottom:18px;
		color:#fff;
		content:attr(title);
		display:block;
		left:0%;
		padding:5px 15px;
		position:absolute;
		white-space:nowrap;
		z-index:98;
	}
	.tooltip:hover:before{
		border:solid;
		border-color:#111 transparent;
		border-width:6px 6px 0 6px;
		bottom:12px;
		content:"";
		display:block;
		left:15%;
		position:absolute;
		z-index:99;
	}
</style>
<script type="text/javascript">
	$("#BeginDate").datepicker({ dateFormat: "yy-mm-dd" });
	$("#EndDate").datepicker({ dateFormat: "yy-mm-dd" });
	$(".tooltip").click(function(event) {
		event.preventDefault();
	});
	$("#excelButton").click(function(event) {
		event.preventDefault();
		window.open('<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'stats_details_excel'),false); ?>');
		return false;
	});
	
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