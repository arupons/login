<div class="rols view">
<h2><?php  echo __('Rol');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rol['Rol']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($rol['Rol']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
		<li><?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar Rol'), array('action' => 'edit', $rol['Rol']['id']), array('class' => 'btn', 'escape' => false)); ?> </li>
