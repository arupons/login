<div class="menus form">
<?php echo $this->Form->create('Menu');?>
	<fieldset>
		<legend><?php echo __('Edit Menu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('parent_id', array('type' => 'select', 'options' => $parentMenus));
		echo $this->Form->input('nombre');
		echo $this->Form->input('alias');
		echo $this->Form->input('grupo_id', array('type' => 'select', 'options' => $grupos));
		echo $this->Form->input('mostrar');
		echo $this->Form->input('isTree', array('label' => 'Es Árbol'));
		echo $this->Form->input('icon');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
