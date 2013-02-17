<div class="form">
	<?php if(isset($raffleId)): ?>
		<?php if($raffleId > 0): ?>
			<a href="<?php echo $this->Html->url(array('controller' => 'raffles', 'action' => 'get_winners', $raffleId)) ?>" >Ir a sorteo de hoy.</a>
		<?php else: ?>
			<p>No hay sorteos para el d&iacute;a de hoy.</p>
		<?php endif; ?>
	<?php endif; ?>
</div>
<div class="pages actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<?php if ($this->Session->read('Auth.User.role') === 'admin'): ?>
	<h4>Admin</h4>
	<ul>
		<li><?php echo $this->Html->link(__('Usuarios'), array('controller'=>'users', 'action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Sorteos'), array('controller'=>'raffles', 'action' => 'index'));?></li>
	</ul>
	<br/>
	<?php endif; ?>
	
	
	
	<?php if ($this->Session->read('Auth.User.role') === 'admin' || $this->Session->read('Auth.User.role') === 'contact'): ?>
	<h4>Men&uacute; Contacto</h4>
	<ul>
		<li><?php echo $this->Html->link(__('Ganadores'), array('controller'=>'winners', 'action' => 'index'));?></li>
	</ul>
	<br/>
	<?php endif; ?>	
	
	<?php if ($this->Session->read('Auth.User.role') === 'admin' || $this->Session->read('Auth.User.role') === 'operator'): ?>
	<h4>Men&uacute; Operador</h4>
	<ul>
		<li><?php echo $this->Html->link(__('Agregar usuario'), array('controller'=>'messages', 'action' => 'add'));?></li>
	</ul>
	<br/>
	<?php endif; ?>
	
	<?php if ($this->Session->read('Auth.User.role') === 'admin' || $this->Session->read('Auth.User.role') === 'stats'): ?>
	<h4>Men&uacute; Status</h4>
	<ul>
		<li><?php echo $this->Html->link(__('Status de la promo'), array('controller'=>'users', 'action' => 'stats'));?></li>
	</ul>
	<br/>
	<?php endif; ?>
	<ul>
		<li><?php echo $this->Html->link(__('Salir del sistema'), array('controller' => 'users', 'action' => 'logout'));?></li>
	</ul>
</div>
