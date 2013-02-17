<?php
	date_default_timezone_set('America/Caracas');
    header("Content-Disposition: attachment; filename=ganadores-sorteo-".date("d-m-Y").".xls");
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
    <table  border="1">
		<tr>
			<td>Nombre de la Promocion:</td>
			<td><?php echo $promoName;?></td>
		</tr>
		<tr>
			<td>Fecha:</td>
			<td><?php echo date('d/m/Y');?></td>
		</tr>
		<tr>
			<td>Total Ganadores:</td>
			<td><?php echo $winners_count;?></td>
		</tr>
		<tr>
			<td>Total Backup:</td>
			<td><?php echo $backup_count;?></td>
		</tr>
        
         <tr><td>Asistentes:</td><td></td></tr>
         <tr><td>&nbsp;</td><td></td></tr>
         <tr><td>&nbsp;</td><td></td></tr>
         <tr><td>&nbsp;</td><td></td></tr>
         <tr><td>&nbsp;</td><td></td></tr>
         <tr><td>&nbsp;</td><td></td></tr>
         <tr><td>&nbsp;</td><td></td></tr>
         <tr><td>&nbsp;</td><td></td></tr>
         <tr><td>&nbsp;</td><td></td></tr>

    </table>
	
	
	<table border="1">
        <!-- Change the columns in order to comply with the fields needed
			 in the current raffle to program.
			 Copy and paste what's inside also in get_winners_excel.ctp file -->
		<tr>
			<th>Celular</th>
			<th>C&eacute;dula</th>
			<th>Premio</th>
		</tr>
		
		<?php foreach ($winners as $winner) { ?>
		<tr>
			<td><?php echo $winner['Winner']['mobile']; ?></td>
			<td><?php echo $winner['Winner']['idcard']; ?></td>
			<td><?php echo $winner['Winner']['prize']; ?></td>
		</tr>
		<?php } //end for ?>
		
		<!-- End of modifiable and copy-paste block. -->
    </table>
