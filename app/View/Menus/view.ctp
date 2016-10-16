<div class="menus view">
<h2><?php  echo __('Menu');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menu['ParentMenu']['id'], array('controller' => 'menus', 'action' => 'view', $menu['ParentMenu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grupo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menu['Grupo']['id'], array('controller' => 'grupos', 'action' => 'view', $menu['Grupo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mostrar'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['mostrar']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Icon'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['icon']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
		<li><?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar Menu'), array('action' => 'edit', $menu['Menu']['id']), array('class' => 'btn', 'escape' => false)); ?> </li>
