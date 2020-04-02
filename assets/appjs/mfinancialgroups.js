
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

	$('#modalEdit').on('shown.bs.modal', function(e) {
		console.log([
			$('#infoIdEdit').val(),
			$('#infoNameEdit').val(),
			$('#infoGroupEdit').val(),
			$('#optionEdit').val(),
			$('#userIdEdit').val(),
		]);
		
		$('#btnCancelEdit').on('click', function() {
			$('#modalEdit').modal('hide');
			
			event.preventDefault();
		});

		$('#btnSaveEdit').on('click', function() {
			console.log('Save');
		});
	});

	$('#btnDelete').on('click', function() {
		$('#delInfoId').val($(this).data('id'));
		$('#delUserId').val($(this).data('userid'));
		$('#delModal').modal('show');
	});

	$('.delModal').on('shown.bs.modal', function(e) {
		console.log([
			$('#delInfoId').val(),
			$('#delUserId').val(),
		]);
		
		$('#btnCancelDelete').on('click', function() {
			$('#delModal').modal('hide');
			
			event.preventDefault();
		});

		$('#btnYesDel').on('click', function() {
			console.log('Save');
		});
	});
});