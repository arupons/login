<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Agregar Usuario'); ?></legend>
	<?php
		echo $this->Form->input('Empleado.nombre', array('label' => 'Nombre Completo', 'div'=> 'input text span3'));
		echo $this->Form->input('Empleado.cargo', array('label' => 'Cargo'));
		echo $this->Form->input('User.username', array('label' => 'Usuario', 'div'=> 'input text span3'));
		echo $this->Form->input('User.rol', array('options' => $rols));
		//echo $this->Form->hide('password');
		echo $this->Form->input('password',
		    array('label' => 'Contrase&ntilde;a',
		        'type' => 'password', 'div'=> 'input text required span3'));
		echo $this->Form->input('password2',
		    array('label' => 'Confirmar Contrase&ntilde;a',
		        'type' => 'password', 'div'=> 'input text required span3'));
		echo $this->Form->hidden('empresa', array('value' => $emp_id));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>