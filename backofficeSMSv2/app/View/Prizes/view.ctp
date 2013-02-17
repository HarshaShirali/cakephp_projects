<div class="prizes view">
<h2><?php  echo __('Prize');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prize['Prize']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idraffle'); ?></dt>
		<dd>
			<?php echo h($prize['Prize']['idraffle']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($prize['Prize']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($prize['Prize']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Prize'), array('action' => 'edit', $prize['Prize']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Prize'), array('action' => 'delete', $prize['Prize']['id']), null, __('Are you sure you want to delete # %s?', $prize['Prize']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Prizes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prize'), array('action' => 'add')); ?> </li>
	</ul>
</div>
