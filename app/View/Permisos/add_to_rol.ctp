<?php if (isset($rol_id))
{
echo $this->Html->css(array('olesistemas.tree', 'olesistemas.checkbox')); ?>
<div class="permisos form">
<?php echo $this->Form->create('Permiso'); ?>
	<fieldset id='datas'>
		<legend><?php echo __('Asignar Permisos a '.$this->params->url); ?></legend>
    	<?php
            echo "<div id='edit'>";
            if (isset($permisos) && $permisos!=null)
                foreach ($permisos as $permiso) {
                    echo $this->Form->input('Permiso.'.$permiso['Permiso']['menu_id'].'.id', array('value'=>$permiso['Permiso']['id']));
                    echo $this->Form->hidden('Permiso.'.$permiso['Permiso']['menu_id'].'.valor', array('value'=>$permiso['Permiso']['valor']));
                }
    		echo '</div>' . $leArbol;
    	?>
	</fieldset>
<?php echo $this->Form->end(__('Ingresar'));?>
</div>
		<?php echo $this->Html->link(__('<i class="icon-arrow-left"></i> Volver'), array('controller'=>'rols','action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>

<script type="text/javascript">
	$(function () {
        //Definir padrres
	    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Cerrar');

	    $('.tree li.parent_li i').on('click', function (e) {
	        var children = $(this).parent('li.parent_li').find(' > ul > li');
	        if (children.is(":visible")) {
	            children.hide('fast');
                
	            $(this).attr('title', 'Abrir').addClass('icon-plus-sign').removeClass('icon-minus-sign');
	        } else {
	            children.show('fast');
	            $(this).attr('title', 'Cerrar').addClass('icon-minus-sign').removeClass('icon-plus-sign');
	        }
	        e.stopPropagation();
	    });
        //$("input:checked").each(function() {console.log($(this).attr("id"))})
        $('.tree li.parent_li span').on('click', function (e) {
            //var children = $(this).parent('li.parent_li').find(' > ul > li');
           
            if( $(this).find('input').prop('checked'))
                $(this).find('input').prop('checked', '');
            else
                $(this).find('input').prop('checked', 'checked');
            e.stopPropagation();
        });

        $('.tree li.parent_li span').on('click', function (e) {
            //var children = $(this).parent('li.parent_li').find(' > ul > li');
           
            if( $(this).find('input').prop('checked'))
            {
                $(this).removeClass('label-success').find('input').prop('checked', '');
                var id = $(this).find('input').attr('id');
                if ( $('#Permiso'+id+'Id').length ) {
                    $('#Permiso'+id+'Valor').val(0)
                    $(this).addClass('label-important').find('input').prop('checked', '');
                }else
                {
                    rol = <?php echo $rol_id ?>;
                    var nombre =  $(this).text();
                    $("#Permiso"+id+"Valor").val('0');
                }
            }
            else
            {
                $(this).addClass('label-success').find('input').prop('checked', 'checked');
                var id = $(this).find('input').attr('id');
                if(typeof(id) != "undefined" && id !== null)
                {
                    if ( $('#Permiso'+id+'Id').length ) {
                        $(this).removeClass('label-important').find('input').prop('checked', 'checked');
                        $('#Permiso'+id+'Valor').val(1)
                        $(this).addClass('label-success').find('input').prop('checked', 'checked');
                    }else {
                        rol = <?php echo $rol_id ?>;
                    	var nombre =  $(this).text();
                        $('#datas').append('<div id="fields'+id+'"><input name="data[Permiso]['+id+'][menu_id]" id="Permiso'+id+'MenuId" type="hidden" value='+id+'>'
                            +'<input name="data[Permiso]['+id+'][model]" id="Permiso'+id+'Model" type="hidden" value="Rol">'
                            +'<input name="data[Permiso]['+id+'][foreign_key]" id="Permiso'+id+'ForeignKey" type="hidden" value='+rol+'>'
                            +'<input name="data[Permiso]['+id+'][valor]" id="Permiso'+id+'Valor" type="hidden" value=1>');
                    }
                }
            }
            e.stopPropagation();
        });
	});
</script>
<?php 
}else
{
	echo "<h1>El Rol seleccionado no es válido o no existe, seleccione un usuario válido e intente de nuevo.</h1>";
}