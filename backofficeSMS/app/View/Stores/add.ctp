<div class="stores form">
<?php echo $this->Form->create('Store');?>
	<fieldset>
		<legend><?php echo __('Agregar Agente Movistar'); ?></legend>
	<?php
		echo $this->Form->input('region', array('label' => 'Región', 'type' => 'select', 'options' => $venezuelaStates));
		echo $this->Form->input('name', array('label' => 'Nombre Agente'));
		echo $this->Form->input('address', array('label' => 'Dirección'));
		echo $this->Form->input('username', array('label' => 'Login'));
		echo $this->Form->input('password', array('label' => 'Contraseña'));
		echo $this->Form->input('password2', array('label' => 'Repetir contraseña'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Agregar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this -> Html -> link(__('Regresar'), array('controller' => 'users', 'action' => 'stats')); ?></li>
	</ul>
</div>
<script type="text/javascript">
	var city_url = '<?php echo $this->Html->url(array('controller'=>'cities','action'=>'get_from_state'),true) ?>';
	var letters = ' ABCÇDEFGHIJKLMNÑOPQRSTUVWXYZabcçdefghijklmnñopqrstuvwxyzàáÀÁéèÈÉíìÍÌïÏóòÓÒúùÚÙüÜ'
	var numbers = '1234567890'
	var signs = ',.:;@-\''
	var mathsigns = '+-=()*/'
	var custom = '<>#$%&?¿'
	var emailchars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@.-'

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

	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}

	$('#StoreState').change(function(){
			var options = $('#StoreCity');
			options.empty();
			options.append($("<option />").val(0).text(""));
			$.getJSON(city_url + '/' + $('#StoreState').val(), function(result){
				$.each(result, function(key,val){
					options.append($("<option />").val(key).text(val));
				})
			})
		}
	);
	
	$('#MobileCity').autocomplete({
		minLength: 1,
		source: function(request, response) {
			$.ajax({
				url: city_url + '/' + $('#MobileState').val(), 
				dataType: 'json',
				type: 'GET',
				success: function(data) {
      				response( $.map( data, function( item ) {
      					if (item != null) {
	        				return {
					          label: item,
					          value: item
            				}
            			}
      				}));
    			}
			});
		}
	});

</script>