<div class="customers form">
<?php echo $this->Form->create('Customer'); ?>
	<fieldset>
		<legend><?php echo __('Opciones'); ?></legend>
	<?php
		echo $this->Form->input('country', array('label'=>'País',
												 'type'=>'select',
												 'options'=>$countries));
	?>
	<div id="viableOptions">											 
		<?php
			echo $this->Form->input('operator', array('label'=>'',
													 'type'=>'select',
													 'options'=>$operators,
													 'class' => ''));
			echo $this->Form->input('mobile', array('label'=>'Celular',
													'type'=>'text',
													'maxlength' => '7',
													'class' => 'validate[required, custom[integer], minSize[7], maxSize[7]] barata2',
													'onkeypress' => 'return alpha(event,numbers)'));
		?>
		
		<?php
			$params = array('id'=>'boton');
			echo $this->Form->end(__('Guardar'), $params);
		?>
	</div>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Regresar'), array('action' => 'index')); ?></li>
	</ul>
</div>
<script>
	var numbers = '1234567890';
		
	function alpha(e, allow) {
		var charCode = (e.which) ? e.which : e.keyCode;
		//	KEY			CHAR CODE
		//	backspace	8
		//	tab			9
		//	space		32
		//	delete		46
		if ( charCode == 8 || charCode == 9 || charCode == 32 || charCode == 46) {
			return true;
		}
		else {
			var k;
			k = document.all ? parseInt(e.keyCode) : parseInt(e.which);
			return (allow.indexOf(String.fromCharCode(k)) != -1);
		}
	}
	
	$(document).ready(function() {
		
		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
		
		function showHide() {
			if ($('#CustomerCountry').val() == "ve") {
				$('#viableOptions').show();
				$('#inviableCountry').hide();
			}
			else {
				$('#viableOptions').hide();
				$('#inviableCountry').show();
			}
		}
		
		$('#CustomerCountry').change(function(){
			showHide();
		});
		
		showHide();
	});
</script>