<div class="mobiles form">
<?php echo $this->Form->create('Mobile');?>
	<fieldset>
		<legend><?php echo __('Confirmar ganador'); ?></legend>
	<?php
		$operators = array('0412', '0414', '0424', '0416', '0426');
		echo $this->Form->input('mobile', array('label'=>'Celular','disabled'=>'disabled', 'value' => $mobileNormal));
		echo $this -> Form -> input('name', array('label' => 'Nombre', 'type' => 'text', 'maxlength' => 20, 'onkeypress' => 'return alpha(event,letters)'));
		echo $this -> Form -> input('last', array('label' => 'Apellido', 'type' => 'text', 'maxlength' => 20, 'onkeypress' => 'return alpha(event,letters)'));
		echo $this -> Form -> input('idcard', array('label' => 'Cédula',
												'type' => 'text',
												'escape' => false,
												'maxlength' => 8,
												'value' => "",
												'onkeypress' => 'return isNumberKey(event)'));
		echo $this -> Form -> input('operator', array('label' => '',
													  'type' => 'select',
													  'options' => $operators));
		echo $this -> Form -> input('mobile2', array('label' => 'Teléfono adicional',
													 'type' => 'text',
													 'maxlength' => 7,
													 'onkeypress' => 'return alpha(event, numbers)'));
		echo $this -> Form -> input('email', array('label' => 'Correo electr&oacute;nico', 'escape' => false, 'type' => 'text', 'onkeypress' => 'return alpha(event,emailchars)'));
		echo $this -> Form -> input('state', array('label' => 'Estado', 'type' => 'select', 'escape' => false, 'options' => $venezuelaStates));
		echo $this -> Form -> input('city', array('label' => 'Ciudad', 'type' => 'select'));
		echo $this -> Form -> input('store', array('label' => 'Agente Movistar', 'type' => 'select'));
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
<script type="text/javascript">
	var city_url = '<?php echo $this->Html->url(array('controller'=>'cities','action'=>'get_from_state'),true) ?>';
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

	$('#MobileState').change(function(){
			var options = $('#MobileCity');
			options.empty();
			options.append($("<option />").val("0").text(""));
			$.getJSON(city_url + '/' + $('#MobileState').val(), function(result){
				$.each(result, function(key,val){
					options.append($("<option />").val(key).text(val));
				})
			})
		}
	);
	
	$('#MobileCity').change(function(){
			var options = $('#MobileStore');
			options.empty();
			$.getJSON(store_url + '/' + $('#MobileCity').val(), function(result){
				$.each(result, function(key,val){
					options.append($("<option />").val(key).text(val));
				})
			})
		}
	);

	$("#ConfirmButton").click(function(event) {
		event.preventDefault();
		
		var isNameEmpty = $("#MobileName").val() != "";
		var isLastEmpty = $("#MobileLast").val() != "";
		var isIdCardValid = $("#MobileIdcard").val().length >= 4 && $("#MobileIdcard").val().length <= 8;
		var isMobile2Valid = $("#MobileMobile2").val() != "" && $("#MobileMobile2").val().length == 7;
		var isStore = true;
		var isEmail = true;
		
		if ($('#MobileState').val() == null || $('#MobileState').val() == 0)
			isStore = false;
		
		if ($('#MobileEmail').val().length > 0){
			re = re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			isEmail = re.test($('#MobileEmail').val()); 
		}
		alert(isNameEmpty);
		if (!isNameEmtpy && !isLastEmpty && isIdCardValid && isMobile2Valid && isStore) {
			alert("Formulario válido");
			//$("#ReportNewReportForm").submit();
		}
		else {
			alert("Revisar la validez todos los campos");
		}
	}); 
</script>
