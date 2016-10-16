<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Cambiar Contraseña'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username', array('label' => 'Usuario', 'READONLY'));
		echo $this->Form->input('password', array('label' => 'Contrase&ntilde;a'));
		echo $this->Form->input('passwd_confirm', array('label' => 'Confirmar Contrase&ntilde;a'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
