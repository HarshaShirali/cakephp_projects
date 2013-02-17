<div class="raffles view">
<h2><?php  echo __('Sorteo');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($id); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha'); ?></dt>
		<dd>
			<?php echo h($date); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bloqueado'); ?></dt>
		<dd>
			<?php echo h($locked); ?>
			&nbsp;
		</dd>
	</dl>
	<h3>Premios</h3>
	<table id="prizesList">
		<tr>
			<th>Cantidad</th>
			<th>Descripci&oacute;n</th>
			<th></th>
		</tr>
		<?php foreach($prizes as $prize) {?>
		<tr id="prize<?php echo $prize['Prize']['id']; ?>">
			<td><?php echo $prize['Prize']['quantity']; ?></td>
			<td><?php echo $prize['Prize']['description']; ?></td>
			<td class="center">
				<a href="<?php echo $this->Html->url(array('controller' => 'prizes', 'action' => 'delete_remotely', $prize['Prize']['id'])); ?>">
					<?php echo $this->Html->image('delete.png'); ?>
				</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $id)); ?> </li>
		<li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $id), null, __('Are you sure you want to delete # %s?', $id)); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de sorteos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo sorteo'), array('action' => 'add')); ?> </li>
	</ul>
</div>
