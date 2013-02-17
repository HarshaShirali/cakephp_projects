<div class="pages actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
    <?php if ($this->Session->read('Auth.User.role') === 'admin'): ?>
		  <li><?php echo $this->Html->link(__('Usuarios'), array('controller'=>'users', 'action' => 'index'));?></li>
	<?php endif; ?>
    <?php if ($this->Session->read('Auth.User.role') === 'admin' || $this->Session->read('Auth.User.role') === 'operator'): ?>
		  <li><?php echo $this->Html->link(__('Crear nuevo reporte'), array('controller'=>'reports', 'action' => 'new_report'));?></li>
	<?php endif; ?>
	<?php if ($this->Session->read('Auth.User.role') === 'admin' || $this->Session->read('Auth.User.role') === 'operator'): ?>
		  <li><?php echo $this->Html->link(__('Confirmar celular'), array('controller'=>'mobiles', 'action' => 'won_list'));?></li>
	<?php endif; ?>
	<?php if ($this->Session->read('Auth.User.role') === 'admin' || $this->Session->read('Auth.User.role') === 'store'): ?>
		  <li><?php echo $this->Html->link(__('Confirmar entrega'), array('controller'=>'mobiles', 'action' => 'confirmed_list'));?></li>
	<?php endif; ?>
    <?php if ($this->Session->read('Auth.User.role') === 'admin' || $this->Session->read('Auth.User.role') === 'stats'): ?>
		  <li><?php echo $this->Html->link(__('Status de la promo'), array('controller'=>'users', 'action' => 'stats'));?></li>
    <?php endif; ?>
		<li><?php echo $this->Html->link(__('Salir del sistema'), array('controller' => 'users', 'action' => 'logout'));?></li>
	</ul>
</div>
