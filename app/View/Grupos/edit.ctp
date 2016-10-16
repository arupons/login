<div class="grupos form">
<?php echo $this->Form->create('Grupo');?>
	<fieldset>
		<legend><?php echo __('Edit Grupo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
