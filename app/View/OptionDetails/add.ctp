<div class="optionDetails form">
<?php echo $this->Form->create('OptionDetail');?>
	<fieldset>
		<legend><?php echo __('Add Option Detail'); ?></legend>
	<?php
		echo $this->Form->input('option_id');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
