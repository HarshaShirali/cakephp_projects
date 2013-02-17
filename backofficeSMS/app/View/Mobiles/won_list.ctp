<div class="mobiles view">
<table>
<?php
	foreach ($wonMobilesList as $mobile) {
		$mobileNumber = $mobile['Mobile']['mobile'];
		$mobileId = $mobile['Mobile']['id'];
?>
		<tr>
			<td><?php echo $this->Html->link($mobileNumber, array('controller' => 'mobiles', 'action' => 'confirm', $mobileId)); ?></td>
			<td><?php echo $mobile['Mobile']['dateupdated']; ?></td>
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
