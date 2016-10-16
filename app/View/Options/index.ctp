<div class="options index">
	<h2><?php echo __('Options');?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($options as $option): ?>
	<tr>
		<td><?php echo h($option['Option']['id']); ?>&nbsp;</td>
		<td><?php echo h($option['Option']['nombre']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('<i class="icon-eye-open"></i> Ver'), array('action' => 'view', $option['Option']['id']), array('class' => 'btn btn-info', 'escape' => false)); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('P&aacute;gina {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, comenzando en el registro {:start}, terminando en el {:end}')
	));
	?>	</p>

	<div class="pagination">
		<ul>
			<?php
				echo '<li>';
					echo $this->Paginator->first('<< ' . __('Primero '), array(), null, array('class' => 'prev disabled '));
				echo '</li><li>';
					echo $this->Paginator->prev('< ' . __('Anterior '), array(), null, array('class' => 'prev disabled '));
				echo '</li>';
				//echo $this->Paginator->numbers(array('separator' => ' '));
				echo $this->Paginator->numbers(array(
													    'separator' => '',
													    'currentClass' => 'active',
													    'currentTag' => 'a',
													    'tag' => 'li'
													));
				echo '<li>';
					echo $this->Paginator->next(__(' Siguiente') . ' >',array(), null, array('class' => 'next disabled '));
				echo '</li><li>';
					echo $this->Paginator->last(__(' Final') . ' >>',array(), null, array('class' => 'next disabled '));
				echo '</li>';
			?>
		</ul>
	</div>
</div>
<br/>
		<?php echo $this->Html->link(__('<i class="icon-plus"></i> Ingresar Option'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
