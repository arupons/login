<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Editar Usario'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username', array('label' => 'Usuario', 'readonly'));
		//echo $this->Form->input('password');
		echo $this->Form->input('password', array('label' => 'Contrase&ntilde;a'),
		    array('label' => 'Password',
		        'type' => 'password'));
		echo $this->Form->input('password2',
		    array('label' => 'Confirmar Contrase&ntilde;a',
		        'type' => 'password'));
		echo $this->Form->hidden('rol_id');
		echo $this->Form->hidden('empresa_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
