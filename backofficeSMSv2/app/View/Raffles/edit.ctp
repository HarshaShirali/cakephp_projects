<div class="raffles form">
<?php echo $this->Form->create('Raffle');?>
	<fieldset>
		<legend><?php echo __('Modificar sorteo'); ?></legend>
	<?php
		$options = array('N' => 'Abierto', 'Y' => 'Bloqueado');
		echo $this -> Form -> input('raffledate', array('label' => 'Fecha',
														'type' => 'text',
														'id'=>'BeginDate',
														'onkeypress' => 'return false;'));
		echo $this -> Form -> input('locked', array('label' => 'Status',
		                                            'type' => 'select',
												    'options' => $options));
	?>
	<div clas="input text">
			<h3>Premios</h3>
			<label>Cantidad Descripci&oacute;n</label>
			<div>
				<input type="text" maxlength="3" id="quantity" name="quantity" onkeypress="return alpha(event,numbers)" />
				<input type="text" id="description" name="description" />
				<input id="newPrizeButton" name="newPrizeButton" class="form submit" type="submit" value="Agregar" />
			</div>
			<table id="prizesList">
				<tr>
					<th>Cantidad</th>
					<th>Descripci&oacute;n</th>
					<th></th>
				</tr>
				<?php foreach($prizes as $prize) {?>
				<tr id="prize<?php echo $prize['Prize']['id']; ?>">
					<td><?php echo $prize['Prize']['quantity']; ?></td>
					<td><?php echo $prize['Prize']['description']; ?></td>
					<td class="center">
						<a href="<?php echo $this->Html->url(array('controller' => 'prizes', 'action' => 'delete_remotely', $prize['Prize']['id'])); ?>">
							<?php echo $this->Html->image('delete.png'); ?>
						</a>
					</td>
				</tr>
				<?php } ?>
			</table>
	</div>
	</fieldset>

<?php echo $this->Form->end(__('Modificar'));?>
</div>

<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Raffle.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Raffle.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Lista de sorteos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Regresar'), array('action' => 'index')); ?></li>
	</ul>
</div>
<style>
	#quantity {
		width: 40px;
		margin-left: -6px;
	}
	#description {
		width: 400px;
		margin-left: 18px;
		position: relative;
	}
</style>
<script type="text/javascript">
	var numbers = '1234567890';
	var raffleId = <?php echo $raffleId; ?>;
	var newPrizeUrl = '<?php echo $this->Html->url(array('controller' => 'prizes', 'action' => 'add_from_raffle'), true); ?>';
	var prizesListUrl = '<?php echo $this->Html->url(array('controller' => 'prizes', 'action' => 'get_from_raffle', $raffleId), true); ?>';
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
	
	function addPrize() {
		$("body").on({
		    ajaxStart: function() { 
		        $(this).addClass("loading"); 
		    },
		    ajaxStop: function() { 
		        $(this).removeClass("loading"); 
		    }    
		});
		
		var varDescription = $("#description").val();
		var varQuantity = parseInt($("#quantity").val());
		if (varDescription != "" && varQuantity >= 1) {
			$.post(
				newPrizeUrl,
				{idraffle: raffleId, quantity: varQuantity, description: varDescription},
				function (response) {
					if (response == "ok") {
						$("#description").val('');
						$("#quantity").val('');
						$("#prizesList tr:last").after('<tr><td>'+varQuantity+'</td><td>'+varDescription+'</td></tr>');
					}
					else {
						alert('Hubo un error. Intenta de nuevo.');
					}
				}
			);
		}
		else {
			alert("Pelón en el formulario");
		}
	}
	
	$(document).ready(function () {
		
		jQuery("#AddPrizeForm").validationEngine();
		
		$("#BeginDate").datepicker({ dateFormat: "yy-mm-dd" });
		
		$("#newPrizeButton").click(function(event){
			event.preventDefault();	
			addPrize();
		});
		
		$("#description").keypress(function (event){
			var key = event.which;
			if (key == 13) {
				event.preventDefault();
				addPrize();
			}
		});
	});
</script>