<div class="grupos view">
<h2><?php  echo __('Grupo');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($grupo['Grupo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($grupo['Grupo']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
		<li><?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar Grupo'), array('action' => 'edit', $grupo['Grupo']['id']), array('class' => 'btn', 'escape' => false)); ?> </li>
