<div class="optionDetails view">
<h2><?php  echo __('Option Detail');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($optionDetail['OptionDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option'); ?></dt>
		<dd>
			<?php echo $this->Html->link($optionDetail['Option']['id'], array('controller' => 'options', 'action' => 'view', $optionDetail['Option']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($optionDetail['OptionDetail']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
		<li><?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar Option Detail'), array('action' => 'edit', $optionDetail['OptionDetail']['id']), array('class' => 'btn', 'escape' => false)); ?> </li>
