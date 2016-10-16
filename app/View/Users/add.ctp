<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Agregar Usuario'); ?></legend>
	<?php
		echo $this->Form->input('username', array('label' => 'Usuario'));
		//echo $this->Form->hide('password');
		echo $this->Form->input('password',
		    array('label' => 'Contrase&ntilde;a',
		        'type' => 'password'));
		echo $this->Form->input('password2',
		    array('label' => 'Confirmar Contrase&ntilde;a',
		        'type' => 'password'));
		echo $this->Form->input('rol');
		echo $this->Form->input('empresa');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>