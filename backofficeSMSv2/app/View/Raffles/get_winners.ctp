<div class="raffles form">
<?php echo $this->Form->create('Raffle');?>
	<fieldset>
		<legend><?php echo __('Sorteo de fecha '.$date); ?></legend>
	<?php
		if ($toShow == 'form') {
			echo $this -> Form -> input('backups', array('label' => 'Backups',
													 	 'type' => 'text',
													 	 'maxlength' => '3',
											         	 'onkeypress' => 'return alpha(event,numbers)'));
		
	?>
	</fieldset>
	<?php echo $this->Form->end(__('¡Sorteo!')); ?>
		<h3>Premios a entregar</h3>
		<table>
			<tr>
				<th>Cantidad</th>
				<th>Descripci&oacute;n</th>
			</tr>
	<?php foreach($prizes as $prize) {?>
		<tr id="prize<?php echo $prize['Prize']['id']; ?>">
			<td><?php echo $prize['Prize']['quantity']; ?></td>
			<td><?php echo $prize['Prize']['description']; ?></td>
		</tr>
	<?php } ?>
		</table>
	<?php } else { ?>
		<h3>Ganadores</h3>
		<table>
			<!-- Change the columns in order to comply with the fields needed
				 in the current raffle to program.
				 Copy and paste what's inside also in get_winners_excel.ctp file -->
			<tr>
				<th>Celular</th>
				<th>C&eacute;dula</th>
				<th>Premio</th>
			</tr>
			
			<?php foreach ($winners as $winner) { ?>
			<tr>
				<td><?php echo $winner['mobile']; ?></td>
				<td><?php echo $winner['idcard']; ?></td>
				<td><?php echo $winner['prize']; ?></td>
			</tr>
			<?php } //end for ?>
			
			<!-- End of modifiable and copy-paste block. -->
		</table>
		
	<?php } //endif ?>
</div>

<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<?php if($this->Session->read('Auth.User.role') != 'raffle'): ?>
		<li><?php echo $this->Html->link(__('Regresar'), array('action' => 'index')); ?></li>
		<?php endif; ?>
		<?php if($isRaffleDone == true): ?>
			<li><a href="#" id="excelButton" >Exportar Excel</a></li>
			<li><?php echo $this->Html->link(__('Bloquear y salir'), array('action' => 'lock', $id)); ?></li>
		<?php endif; ?>
	</ul>
</div>
<style>
	#RaffleBackups {
		width: 45px;
	}
</style>
<script type="text/javascript">
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
		
		$("#RaffleBackups").focus();
		
		$("#RaffleBackups").keypress(function (event){
			var key = event.which;
			if (key == 13) {
				$("#RaffleGetWinnersForm").submit();
			}
		});
		
		$("#excelButton").click(function(event) {
			event.preventDefault();
			window.open('<?php echo $this->Html->url(array('controller' => 'raffles', 'action' => 'get_winners_excel', $id),false); ?>');
			return false;
		});
		
		$("#lockButton").click(function() {
			top.location.href = '<?php echo $this->Html->url(array('controller' => 'raffles', 'action' => 'lock', $id),false); ?>';
			return false;
		});
	});
</script>
