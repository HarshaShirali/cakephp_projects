<div class="winners view">
<h2><?php  echo __('Winner');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idmessage'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['idmessage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idraffle'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['idraffle']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Messageposteddate'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['messageposteddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idcard'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['idcard']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['last']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Receipt'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['receipt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prize'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['prize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile2'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['mobile2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Posteddate'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['posteddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($winner['Winner']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Winner'), array('action' => 'edit', $winner['Winner']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Winner'), array('action' => 'delete', $winner['Winner']['id']), null, __('Are you sure you want to delete # %s?', $winner['Winner']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Winners'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Winner'), array('action' => 'add')); ?> </li>
	</ul>
</div>
