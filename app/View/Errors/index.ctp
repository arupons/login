<div class="accountcuses index">
	<h2><?php echo __('Estado de Cuenta');?></h2>
	
	<?php
		echo $this->Form->create('buscar');
		$criterio = null;
		echo $this->Form->input('criterio', array('class' => 'input-xxlarge search-query', 'onkeydown' => 'if (event.keyCode == 13) document.getElementById("buscarIndexForm").submit()', 'default' => $criterio, 'placeholder' => 'Ingrese nombre o RUC del cliente')); 
	?>
	</br>
	<script language = "javascript">
		function look()
		{
			document.getElementById("buscarIndexForm").submit();
		}
	</script>
	<center>
	<?php
		echo $this->Form->button('<i class="icon-search icon-white"></i> Buscar', array('type' => 'button', 'class' => 'btn btn-warning',
    'onclick' => ' look();', 'escape' => false
    ));
		echo $this->Form->end();
	?></center>	

	<div class="paging">
	
	</div>
</div>
<br/>
