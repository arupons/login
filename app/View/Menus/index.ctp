<div class="menus index">
	<h2><?php echo __('Menus');?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('parent_id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('alias');?></th>
			<th><?php echo $this->Paginator->sort('grupo_id');?></th>
			<th><?php echo $this->Paginator->sort('mostrar');?></th>
			<th><?php echo $this->Paginator->sort('icon');?></th>
			<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($menus as $menu): ?>
	<tr>
		<td><?php echo h($menu['Menu']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($menu['ParentMenu']['id'], array('controller' => 'menus', 'action' => 'view', $menu['ParentMenu']['id'])); ?>
		</td>
		<td><?php echo h($menu['Menu']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($menu['Menu']['alias']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($menu['Grupo']['id'], array('controller' => 'grupos', 'action' => 'view', $menu['Grupo']['id'])); ?>
		</td>
		<td><?php echo h($menu['Menu']['mostrar']); ?>&nbsp;</td>
		<td><?php echo h($menu['Menu']['icon']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('<i class="icon-eye-open"></i> Ver'), array('action' => 'view', $menu['Menu']['id']), array('class' => 'btn btn-info', 'escape' => false)); ?>
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
		<?php echo $this->Html->link(__('<i class="icon-plus"></i> Ingresar Menu'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
