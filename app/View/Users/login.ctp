<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend>
            <?php echo __('Por favor ingrese sus credenciales'); ?>
        </legend>
        <?php 
        	echo $this->Form->input('username', array('label' => 'Nombre de usuario'));
        	echo $this->Form->input('password', array('label' => 'Contrase&ntilde;a', 'escape' => false));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Ingresar')); ?>
</div>