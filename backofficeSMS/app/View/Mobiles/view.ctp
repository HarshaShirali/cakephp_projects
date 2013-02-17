<div class="mobiles view">
<h2><?php  echo __('Mobile');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Raffledate'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['raffledate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Chosen'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['chosen']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Current'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['current']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dateupdated'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['dateupdated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['last']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idcard'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['idcard']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stats'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['stats']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Confirmedby'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['confirmedby']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dateconfirmed'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['dateconfirmed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Givenby'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['givenby']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dategiven'); ?></dt>
		<dd>
			<?php echo h($mobile['Mobile']['dategiven']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mobile'), array('action' => 'edit', $mobile['Mobile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mobile'), array('action' => 'delete', $mobile['Mobile']['id']), null, __('Are you sure you want to delete # %s?', $mobile['Mobile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mobiles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mobile'), array('action' => 'add')); ?> </li>
	</ul>
</div>
