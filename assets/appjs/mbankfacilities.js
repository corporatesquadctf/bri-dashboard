
$(window).load(function() {

	$('#buttonAdd').on('click', function() {
		$('#modalAdd').modal('show');
	});

	$('#modalAdd').on('shown.bs.modal', function(e) {
		$('#btnCancel').on('click', function() {
			$('#modalAdd').modal('hide');

			event.preventDefault();
		});
	});

	
	$('#btnEdit').on('click', function() {
		$('#infoIdEdit').val($(this).data('id'));
		$('#infoNameEdit').val($(this).data('infoname'));
		$('#infoGroupEdit').val($(this).data('groupid'));
		$('#optionEdit').val($(this).data('isdef'));
		$('#userIdEdit').val($(this).data('userid'));
		$('#modalEdit').modal('show');
	});

	
 $('#btnDelete').on('click', function() {
		$('#delModal').modal('show');
	});

 $('#delModal').on('shown.bs.modal', function(e){
		
		$('#btnCancelDelete').on('click', function() {
			$('#delModal').modal('hide');
			
			event.preventDefault();
		});

		$('#btnYesDel').on('click', function() {
			console.log('Delete');
		});
	});
});