<script type="text/javascript"">
	top.location.href = '<?php echo $facebookUrl; ?>';
</script>
<p>Celular: <?php echo $mobile ?></p>
<p>Pa&iacute;s: <?php echo $country ?></p>
<p><input id="twitterLink" type="button" class="<?php echo $twitterImg; ?>"/> <?php echo $twitterTxt; ?></p>
<?php echo $this->Form->create('Customer'); ?>
<?php echo $this->Form->end(__('Opciones')); ?>
<script type="text/javascript">
	$(document).ready(function (){
		$('#twitterLink').click(function() {
			<?php if($twitterLink != '#'): ?>
				top.location.href = '<?php echo $twitterLink ?>';
			<?php endif; ?>
		});
	});
</script>