<div class="mobiles form">
<?php echo $this->Form->create('Mobile', array('class'=>'formular'));?>
	<fieldset>
		<legend><?php echo __('Confirmar ganador'); ?></legend>
	<?php
		$operators = array('0412'=>'0412',
						   '0414'=>'0414',
						   '0424'=>'0424',
						   '0416'=>'0416',
						   '0426'=>'0426');
		echo $this -> Form -> input('mobile', array('label'=>'Celular',
									'disabled'=>'disabled',
									'value' => $mobileNormal));
		echo $this -> Form -> input('name', array('label' => 'Nombre',
									'class'=>'validate[required,text-input]',
									'type' => 'text',
									'maxlength' => 20,
									'onkeypress' => 'return alpha(event,letters)'));
		echo $this -> Form -> input('last', array('label' => 'Apellido',
									'type' => 'text',
									'class'=>'validate[required,text-input]',
									'maxlength' => 20, 'onkeypress' => 'return alpha(event,letters)'));
		echo $this -> Form -> input('idcard', array('label' => 'Cédula',
									'class' => 'validate[required, custom[integer], minSize[4], maxSize[8]]',
									'type' => 'text',
									'escape' => false,
									'maxlength' => 8,
									'value' => "",
									'onkeypress' => 'return isNumberKey(event)'));
		echo $this -> Form -> input('operator', array('label' => '',
									'type' => 'select',
									'class' => 'barata1',
									'options' => $operators));
		echo $this -> Form -> input('mobile2', array('label' => 'Número celular',
									'type' => 'text',
									'maxlength' => 7,
									'class' => 'validate[required, custom[integer], minSize[7], maxSize[7]] barata2',
									'onkeypress' => 'return alpha(event, numbers)'));
		echo $this -> Form -> input('email', array('label' => 'Correo electr&oacute;nico',
									'class' => 'validate[custom[email]]',
									'escape' => false,
									'type' => 'text',
									'onkeypress' => 'return alpha(event,emailchars)'));
		echo $this -> Form -> input('region', array('label' => 'Región',
									'type' => 'select',
									'class' => 'validate[required]',
									'escape' => false,
									'options' => $regions));
		echo $this -> Form -> input('city', array('label' => 'Ciudad',
									'type' => 'select',
									'class' => 'validate[required]',
									'escape' => false));
		echo $this -> Form -> input('store', array('label' => 'Agente Movistar',
									'class' => 'validate[required]',
									'type' => 'select'));
		echo $this -> Form -> input('address', array('label' => 'Dirección',
									'type' => 'textarea',
									'value' => '',
									'disabled' => 'disabled'));
		echo $this -> Form -> input('officehours', array('label' => 'Horario',
									'type' => 'textarea',
									'value' => '',
									'disabled' => 'disabled'));
	?>
	</fieldset>
<?php
	$options = array('label' => 'Confirmar', 'id' => 'ConfirmButton');
	echo $this->Form->end($options);
?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this -> Html -> link(__('Regresar'), array('controller' => 'mobiles', 'action' => 'won_list')); ?></li>
	</ul>
</div>
<div class="modal"><!-- Place at bottom of page --></div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		// binds form submission and fields to the validation engine
		jQuery("#MobileConfirmForm").validationEngine();
		$('#MobileCity').append($("<option />").val("0").text("Selecciona una ciudad"));
		$("body").on({
		    ajaxStart: function() { 
		        $(this).addClass("loading"); 
		    },
		    ajaxStop: function() { 
		        $(this).removeClass("loading"); 
		    }    
		});
	});
	var stores = null;
	var storesIndex = null;
	var city_url = '<?php echo $this->Html->url(array('controller'=>'stores','action'=>'get_cities_from_region'),true) ?>';
	var store_url = '<?php echo $this->Html->url(array('controller'=>'stores','action'=>'get_from_city'),true) ?>';
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

	$('#MobileRegion').change(function(){
			var options = $('#MobileCity');
			options.empty();
			$('#MobileStore').empty();
			$('#MobileAddress').val('');
			$('#MobileOfficehours').val('');
			options.append($("<option />").val("").text("Selecciona una ciudad"));
			if ($('#MobileRegion').val() == "") { return 0;}
			$.getJSON(city_url + '/' + $('#MobileRegion').val(), function(result){
				$.each(result, function(key,val){
					options.append($("<option />").val(key).text(val));
				})
			})
		}
	);
	
	$('#MobileCity').change(function(){
			var options = $('#MobileStore');
			options.empty();
			$('#MobileAddress').val('');
			$('#MobileOfficehours').val('');
			stores = new Array();
			storesIndex = new Array();
			if ($('#MobileCity').val() == 0) { return 0;}
			$.getJSON(store_url + '/' + $('#MobileCity').val(), function(result){
				var x = 0;
				$.each(result, function(key, store) {
					options.append($("<option />").val(store.username).text(store.name));
					storesIndex[x] = store.username;
					stores[x] = store; 
					x++;
				});
				$('#MobileAddress').val(stores[0].address);
				$('#MobileOfficehours').val(stores[0].officehours);
			})
		}
	);
	
	$('#MobileStore').change(function(){
		for (i = 0; i < storesIndex.length; i++) {
			if (storesIndex[i] == $('#MobileStore').val()) {
				$('#MobileAddress').val(stores[i].address);
				$('#MobileOfficehours').val(stores[i].officehours);
			} 
		}
	});

	/*$("#ConfirmButton").click(function(event) {
		event.preventDefault();

		var isNameEmpty = $("#MobileName").val() == "";
		var isLastEmpty = $("#MobileLast").val() == "";
		var isIdCardValid = $("#MobileIdcard").val().length >= 4 && $("#MobileIdcard").val().length <= 8;
		var isMobile2Valid = $("#MobileMobile2").val().length == 7;
		var isStore = true;
		var isEmail = true;
		
		if ($('#MobileStore').val() == null || $('#MobileStore').val() == 0)
			isStore = false;
		
		if ($('#MobileEmail').val().length > 0){
			re = re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			isEmail = re.test($('#MobileEmail').val()); 
		}
		
		if (!isNameEmpty && !isLastEmpty && isIdCardValid && isMobile2Valid && isStore) {
			//alert("Formulario válido");
			$("#MobileConfirmForm").submit();
		}
		else {
			alert("Revisar la validez todos los campos");
		}
	});
	*/
	
	 
</script>
