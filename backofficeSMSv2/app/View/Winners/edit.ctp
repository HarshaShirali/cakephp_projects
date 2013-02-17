<div class="winners form">
<?php echo $this->Form->create('Winner');?>
	<fieldset>
		<legend><?php echo __('Modificar ganador'); ?></legend>
	<?php
		$carriers = array('58412' => '0412',
						  '0414' => '0414',
						  '0424' => '0424',
						  '158' => '0416',
						  '199' => '0426');
		$status	= array('contacted' => 'Contactado',
                        'scheduled' => 'Agendado',
						'rejected'  => 'Rechazado');
		$venezuelaStates = $states;
		if ($this->request->data['Winner']['receipt'] == '0') {
			$this->request->data['Winner']['receipt'] = '';
		}
		echo $this -> Form -> input('mobile', array('label' => 'N&uacute;mero celular',
									'class' => '',
									'escape' => false,
									'readonly' => 'readonly'));
		echo $this -> Form -> input('idcard', array('label' => 'C&eacute;dula',
									'class' => '',
									'type' => 'text',
									'escape' => false,
									'maxlength' => 8,
									'readonly' => 'readonly'));
		echo $this -> Form -> input('prize', array('label' => 'Premio',
									'class'=>'',
									'type' => 'text',
									'readonly' => 'readonly'));
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
		echo $this -> Form -> input('mobile2', array('label' => 'Tel&eacute;fono 2 (opcional)',
									'class' => 'validate[custom[integer], minSize[7], maxSize[15]]',
									'maxlength' => 15,
									'escape' => false,
									'onkeypress' => 'return alpha(event,numbers)'));
		echo $this -> Form -> input('receipt', array('label' => 'Factura',
									'type' => 'text',
									'escape' => false,
									'onkeypress' => 'return alpha(event,numbers)'));
		if ($this->request->data['Winner']['city'] == '') {
			echo $this -> Form -> input('state', array('label' => 'Estado',
										'type' => 'select',
										'escape' => false,
										'options' => $venezuelaStates));
			echo $this -> Form -> input('city', array('label' => 'Ciudad (opcional)',
			                                          'class'=>'validate[required]',
										              'type' => 'select'));
		}
		echo $this -> Form -> input('status', array('label' => 'Status',
		                                            'options' => $status));
		echo $this -> Form -> input('notes', array('label' => 'Observaciones',
		                                           'class'=>'validate[required]',
		                                           'type' => 'textarea'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Regresar'), array('action' => 'index'));?></li>
	</ul>
</div>
<div class="modal"><!-- Place at bottom of page --></div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		// binds form submission and fields to the validation engine
		jQuery("#WinnerEditForm").validationEngine();
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
		//	altgr		18
		//	space		32
		//	delete		46
		if ( charCode == 8 || charCode == 9 || charCode == 18 || charCode == 32 || charCode == 46) {
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

	$('#WinnerState').change(function(){
		var options = $('#WinnerCity');
		options.empty();
		options.append($("<option />").val("").text("Selecciona una ciudad"));
		if ($('#WinnerState').val() == "0") { return 0;}
		$.getJSON(city_url + '/' + $('#WinnerState').val(), function(result){
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
