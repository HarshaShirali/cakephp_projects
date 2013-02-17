<div class="prizes view">
<h2><?php  echo __('Prize');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prize['Prize']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prize'); ?></dt>
		<dd>
			<?php echo h($prize['Prize']['prize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Used'); ?></dt>
		<dd>
			<?php echo h($prize['Prize']['used']); ?>
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
