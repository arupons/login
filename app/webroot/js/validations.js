function validateHonorarios()
{
	$("#honorarios > [id$=MedicoId]").each(function(index) {
		if($(this).val()==null)
			console.log('NOT OK');
	});
}
