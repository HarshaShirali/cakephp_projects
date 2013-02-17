<div class="reports form">
<?php echo $this -> Form -> create('Report'); ?>
	<fieldset>
		<legend><?php echo __('Creación de Nuevo Reporte'); ?></legend>
	<?php
	$venezuelaStates = $states;

	$carriers = array('0412' => '0412',
					  '0414' => '0414',
					  '0424' => '0424',
					  '0416' => '0416',
					  '0426' => '0426');

	echo $this -> Form -> input('name', array('label' => 'Nombre',
								'class'=>'validate[required,text-input]',
								'type' => 'text',
								'maxlength' => 20,
								'onkeypress' => 'return alpha(event,letters)'));
	echo $this -> Form -> input('last',array('label' => 'Apellido',
								'class'=>'validate[required,text-input]',
								'type' => 'text',
								'maxlength' => 20,
								'onkeypress' => 'return alpha(event,letters)'));
	echo $this -> Form -> input('idcard', array('label' => 'C&eacute;dula',
								'class' => 'validate[required, custom[integer], minSize[4], maxSize[8]]',
								'type' => 'text',
								'escape' => false,
								'maxlength' => 8,
								'onkeypress' => 'return isNumberKey(event)'));
	echo $this -> Form -> input('carrier', array('label' => '',
								'type' => 'select',
								'class' => 'barata1',
								'options' => $carriers));
	echo $this -> Form -> input('mobile', array('label' => 'N&uacute;mero celular',
								'class' => 'validate[required, custom[integer], minSize[7], maxSize[7]] barata2',
								'maxlength' => 7,
								'escape' => false,
								'onkeypress' => 'return alpha(event,numbers)'));
	echo $this -> Form -> input('state', array('label' => 'Estado',
								'type' => 'select',
								'escape' => false,
								'options' => $venezuelaStates));
	echo $this -> Form -> input('city', array('label' => 'Ciudad',
								'class'=>'validate[required,text-input]',
								'type' => 'select'));
	echo $this -> Form -> input('email', array('label' => 'Correo electr&oacute;nico',
								'class' => 'validate[custom[email]]',
								'escape' => false,
								'type' => 'text',
								'onkeypress' => 'return alpha(event,emailchars)'));
	?>
	</fieldset>
<?php
$options = array('label' => 'Crear', 'id' => 'NewReportButton');
echo $this -> Form -> end($options);
?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this -> Html -> link(__('Regresar'), array('controller' => 'users', 'action' => 'main')); ?></li>
	</ul>
</div>
<div class="modal"><!-- Place at bottom of page --></div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		// binds form submission and fields to the validation engine
		jQuery("#ReportNewReportForm").validationEngine();
		$('#ReportCity').append($("<option />").val("").text("Selecciona una ciudad"));
		$("body").on({
		    ajaxStart: function() { 
		        $(this).addClass("loading"); 
		    },
		    ajaxStop: function() { 
		        $(this).removeClass("loading"); 
		    }    
		});
	});
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

	$('#ReportState').change(function(){
		var options = $('#ReportCity');
		options.empty();
		options.append($("<option />").val("").text("Selecciona una ciudad"));
		if ($('#ReportState').val() == "0") { return 0;}
		$.getJSON(city_url + '/' + $('#ReportState').val(), function(result){
			$.each(result, function(key,val){
				options.append($("<option />").val(key).text(val));
			})
		})
	});

	/*$("#NewReportButton").click(function(event) {
		event.preventDefault();
		var input = $("#ReportEmail").val();
		if (input != "") {
			re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			var isValid = re.test(input);
			if (isValid == false) {
				alert('Dirección de correo inválida');
			} else {
				$("#ReportNewReportForm").submit();
			}
		} else {
			$("#ReportNewReportForm").submit();
		}
	});*/ 
</script>
