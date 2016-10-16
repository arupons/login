<div class="users index">
	<h2><?php echo __('Usuarios: '); echo $this->Paginator->counter(array('format' => __('{:count}')));?></h2>
	<div class='well span11' >
		<div class='span8'>
			<?php 
				
				echo $this->Form->create('buscar');
				echo $this->Form->input('criterio', array('class' => 'input-xxlarge search-query', 'onkeydown' => 'if (event.keyCode == 13) document.getElementById("buscarIndexForm").submit()', 'default' => $criterio));
				echo $this->Html->tag('span','<i class="icon-search"></i> Buscar', array('class' => 'btn btn-primary', 'escape' => false, 'onclick'=>'document.getElementById("buscarIndexForm").submit()'));
				echo $this->Html->link(__('<i class="icon-white icon-pencil"></i> Roles'), array('controller'=>'rols', 'action' => 'index'), array('class' => 'btn btn-inverse','div'=>'span3', 'escape' => false));
				echo $this->Form->end();
			?>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nick', 'Usuario');?></th>
			<th><?php echo $this->Paginator->sort('rol_id');?></th>
			<th><?php echo $this->Paginator->sort('empresa_id');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Creado el');?></th>
			<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Rol']['name'], array('controller' => 'rols', 'action' => 'view', $user['Rol']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($user['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $user['Empresa']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('<i class="icon-white icon-pencil"></i> Permisos'), array('controller'=>'Permisos','action' => 'addToUser', $user['User']['id']), array('class' => 'btn btn-success', 'escape' => false)); ?>
			<?php echo $this->Html->link(__('<i class="icon-white icon-pencil"></i> Editar'), array('action' => 'EditFromEmp', $user['User']['id']), array('class' => 'btn btn-inverse', 'escape' => false)); ?>
			<?php echo $this->Form->postLink(__('<i class="icon-remove"></i> Eliminar'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('Seguro de eliminar el registro # %s?', $user['User']['id'])); ?>
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
