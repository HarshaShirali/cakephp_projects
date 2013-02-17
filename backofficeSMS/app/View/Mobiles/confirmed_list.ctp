<div class="mobiles view">
<table>
<?php
	foreach ($confirmedMobilesList as $mobile) {
		$mobileNumber = $mobile['Mobile']['mobile'];
		$mobileId = $mobile['Mobile']['id'];
?>
		<tr>
			<td><?php echo $mobile['Mobile']['name'] . " " . $mobile['Mobile']['last']; ?></td>
			<td><?php echo $mobile['Mobile']['idcard']; ?></td>
			<td><?php echo $this -> Html -> link(__('Entregar'), array('controller' => 'mobiles',
																		'action' => 'confirmed_list', $mobileId)); ?>
			</td>
		</tr>
<?php
	}
?>
</table>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this -> Html -> link(__('Regresar'), array('controller' => 'users', 'action' => 'main')); ?></li>
	</ul>
</div>
