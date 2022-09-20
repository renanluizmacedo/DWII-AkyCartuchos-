function showRemoveModal(id, nome) {
	console.log(nome);
	$('#id_remove').val(id);
	$('#removeModal').modal().find('.modal-body').html("");
	$('#removeModal').modal().find('.modal-body').append("Deseja remover o registro <b class='text-danger'>"+nome+"</b> ?");
	$("#removeModal").modal('show');
}

function closeRemoveModal() {
	$("#removeModal").modal('hide');
}

function remove() {
	let id = $('#id_remove').val();
	let form = "form_" + $('#id_remove').val();
	document.getElementById(form).submit();
	$("#removeModal").modal('hide')
}