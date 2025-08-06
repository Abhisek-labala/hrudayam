<?php
include('header.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper">

	<!-- Sidebar -->
	<?php
	include('side_bar.php');
	?>
	<!-- /Sidebar -->


	<!-- Page Wrapper -->
	<div class="page-wrapper" style="min-height: 653px;">
		<div class="content container-fluid">

			<!-- Page Header -->
			<?php include('breadcum.php'); ?>
			<!-- /Page Header -->

			<?php
			include('alerts.php');
			?>

			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">RM Management</h4>
							<button type="button" class="btn btn-primary float-right" data-toggle="modal"
								data-target="#rmModal" onclick="resetForm()">
								<i class="fa fa-plus"></i> Add RM
							</button>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="rmsTable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Emp Id</th>
											<th>Name</th>
											<th>Username</th>
											<th>Password</th>
											<th>Zone</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<!-- Data will be loaded via AJAX -->
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>
<!-- /Main Wrapper -->

<!-- Rm Modal -->
<div class="modal fade" id="rmModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Add Rm</h5>
			</div>
			<div class="modal-body">
				<form action="Pm-Create-Rm-Post" name="createRm" id="createRm" method="post"
					enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>EMP ID <span class="text-danger">*</span></label>
								<input type="text" maxlength="50" class="form-control" name="emp_id"
									id="emp_id">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Full Name <span class="text-danger">*</span></label>
								<input type="text" maxlength="50" class="form-control" name="name"
									id="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Password <span class="text-danger">*</span></label>
								<input type="password" maxlength="12" class="form-control" name="password"
									id="password">
								<small class="text-muted">Min 5 chars with at least 1 uppercase letter</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Zone <span class="text-danger">*</span></label>
								<select class="form-control" name="zone_id" id="zone_id">
									<option value=""> -- Select -- </option>

								</select>
							</div>
						</div>
					</div>

					<div class="text-center">
						<button type="submit" name="submit" id="submitBtn" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-secondary" onclick="closemodal();" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Rm Modal -->

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirm Delete</h5>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this rm?</p>
				<input type="hidden" id="delete_id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" onclick="deleteRm()">Delete</button>
			</div>
		</div>
	</div>
</div>
<!-- /Delete Confirmation Modal -->

<?php
include('footer.php');
?>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
		$(document).ready(function () {
			$('#rmsTable').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				],
				processing: true,
				serverSide: true,
				ajax: {
					url: 'Pm-Get-Rm',
					type: 'POST',
					dataType: 'json',
					contentType: 'application/json',
					data: function (d) {
						return JSON.stringify({
							draw: d.draw,
							start: d.start,
							length: d.length,
							search: {
								value: d.search.value
							},
							order: d.order,
							columns: d.columns
						});
					},
					dataSrc: function (json) {
						if (!json || json.error) {
							console.error(json?.error || 'Empty response');
							return [];
						}
						return json.data;
					}
				},
				columns: [
					{ data: 'id' },
					{ data: 'emp_id' },
					{ data: 'name' },
					{ data: 'username' },
					{ data: 'password' },
					{ data: 'zone' },
					{
						data: null,
						render: function (data, type, row) {
							return '<div class="actions">' +
								'<a href="javascript:void(0);" class="btn btn-sm bg-danger-light m-2" onclick="confirmDelete(' + row.id + ')">Delete</a>' +
								'</div>';
						}
					}
				],
				error: function (xhr, error, thrown) {
					console.error('DataTables error:', error, thrown);
					$('#rmsTable').DataTable().clear().draw();
				}
			});
		});

	

	// Reset form and modal - improved version
	function resetForm() {
		$('#rmModal').modal('show');
		$('#modalTitle').text('Add Rm');
		$('#createRm')[0].reset();
		$('#rm_id').val('');
		$('#emp_id').val('');
		$('#password').val('').removeAttr('placeholder');
		$('#submitBtn').text('Submit');
		$('#zone_id').html('<option value="">Loading...</option>');

		$.ajax({
			url: 'Pm-Get-zones', // Your API route
			type: 'GET',
			dataType: 'json',
			success: function (response) {
				if (response.status === 'success') {
					let options = '<option value="">-- Select Zone --</option>';
					$.each(response.zones, function (index, zone) {
						options += '<option value="' + $('<div>').text(zone.id).html() + '">' + $('<div>').text(zone.name).html() + '</option>';
					});
					$('#zone_id').html(options);
				} else if (response.status === 'no_data') {
					$('#zone_id').html('<option value="">No zones found</option>');
				} else {
					$('#zone_id').html('<option value="">Invalid city</option>');
				}
			},
			error: function () {
				$('#zone_id').html('<option value="">Error loading zones</option>');
			}
		});
		// Clear validation errors
		$('.is-invalid').removeClass('is-invalid');
		$('.invalid-feedback').remove();
	}

	function closemodal()
	{
		$('#rmModal').modal('hide');	
	}
	function confirmDelete(id) {
		$('#delete_id').val(id);
		$('#deleteModal').modal('show');
	}

	// Delete rm
	function deleteRm() {
    var id = $('#delete_id').val();
    
    $.ajax({
        url: 'Pm-Delete-Rm/' + id,
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        processData: false,
        beforeSend: function(xhr) {
            // Explicitly request no compression
            xhr.setRequestHeader('Accept-Encoding', 'identity');
        },
        success: function(response) {
            if (response.status) {
                $('#rmsTable').DataTable().ajax.reload(null, false); // false to maintain paging
                $('#deleteModal').modal('hide');
                alert('deleted', response.message);
            } else {
                alert('error', response.message);
            }
        },
        error: function(xhr, status, error) {
            // Handle error cases
            if (xhr.status === 0) {
                alert('error', 'Network error - please check your connection');
            } else {
                try {
                    var errResponse = JSON.parse(xhr.responseText);
                    alert('error', errResponse.message || 'Error deleting rm');
                } catch (e) {
                    alert('error', 'Error processing response');
                }
            }
        }
    });
}


	// Form validation and submission
	$('#createRm').submit(function(e) {
    e.preventDefault();
    
    // Disable submit button to prevent duplicate submissions
    var $submitBtn = $('#submitBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
    
    if (validateRmForm()) {
        var formData = new FormData(this);

        $.ajax({
            url: 'Pm-Create-Rm-Post',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#rmsTable').DataTable().ajax.reload();
                    $('#rmModal').modal('hide');
                    // Show success message in a better way
                    showAlert('success', response.message);
                } else {
                    showAlert('error', response.message);
                    // Highlight problematic fields if returned in response
                    if (response.errors) {
                        $.each(response.errors, function(field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field).after('<div class="invalid-feedback">' + message + '</div>');
                        });
                    }
                }
            },
            error: function(xhr) {
                showAlert('error', 'An error occurred. Please try again.');
                console.error(xhr.responseText);
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html('Submit');
            }
        });
    } else {
        $submitBtn.prop('disabled', false).html('Submit');
    }
});

// Helper function to show alerts
function showAlert(type, message) {
    // You can replace this with your preferred notification system
    alert(message); // Temporary - replace with Toastr/SweetAlert/etc
}

	// Form validation
	function validateRmForm() {
		var isValid = true;
		var messages = [];

		const firstName = $('#name').val().trim();
		const password = $('#password').val();
		const zone=$('#zone_id').val();
		// Clear previous errors
		$('.is-invalid').removeClass('is-invalid');
		$('.invalid-feedback').remove();

		if (isEmpty(firstName)) {
			$('#first_name').addClass('is-invalid').after('<div class="invalid-feedback">First name is required</div>');
			isValid = false;
		}
		

		// Only validate password if it's a new rm or password field is not empty
		if ( !isEmpty(password)) {
			if (!isValidPassword(password)) {
				$('#password').addClass('is-invalid').after('<div class="invalid-feedback">Password must be at least 5 characters with at least one uppercase letter</div>');
				isValid = false;
			}
		}


		if (!isValid) {
			return false;
		}

		return true;
	}

	// Utility validation functions
	function isEmpty(value) {
		return value.trim() === "";
	}

	

	function isValidPassword(password) {
		const pattern = /^(?=.*[A-Z]).{5,}$/;
		return pattern.test(password);
	}
</script>