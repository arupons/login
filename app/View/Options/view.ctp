<div class="options view">
<h2><?php  echo __('Option');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($option['Option']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($option['Option']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
		<li><?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar Option'), array('action' => 'edit', $option['Option']['id']), array('class' => 'btn', 'escape' => false)); ?> </li>
