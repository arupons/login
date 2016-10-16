<div class="permisos view">
<h2><?php  echo __('Permiso');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($permiso['Permiso']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($permiso['Menu']['id'], array('controller' => 'menus', 'action' => 'view', $permiso['Menu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd>
			<?php echo h($permiso['Permiso']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foreign Key'); ?></dt>
		<dd>
			<?php echo h($permiso['Permiso']['foreign_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valor'); ?></dt>
		<dd>
			<?php echo h($permiso['Permiso']['valor']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
		<li><?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar Permiso'), array('action' => 'edit', $permiso['Permiso']['id']), array('class' => 'btn', 'escape' => false)); ?> </li>
