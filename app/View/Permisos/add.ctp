<div class="permisos form">
<?php echo $this->Form->create('Permiso');?>
	<fieldset>
		<legend><?php echo __('Add Permiso'); ?></legend>
	<?php
		echo $this->Form->input('menu_id');
		echo $this->Form->input('model');
		echo $this->Form->input('foreign_key');
		echo $this->Form->input('valor');

		
		echo $this->Form->input('menu_id');
		echo $this->Form->input('model');
		echo $this->Form->input('foreign_key');
		echo $this->Form->input('valor');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
