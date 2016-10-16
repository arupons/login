<div class="options form">
<?php echo $this->Form->create('Option');?>
	<fieldset>
		<legend><?php echo __('Add Option'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
