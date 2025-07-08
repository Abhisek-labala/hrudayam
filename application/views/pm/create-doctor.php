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
							<h4 class="card-title">HCP Management</h4>
							<button type="button" class="btn btn-primary float-right" data-toggle="modal"
								data-target="#doctorModal" onclick="resetForm()">
								<i class="fa fa-plus"></i> Add HCP
							</button>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="doctorsTable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>MSL CODE</th>
											<th>Name</th>
											<th>City</th>
											<th>State</th>
											<th>Zone</th>
											<th>Speciality</th>
											<th>First Visit</th>
											<th>Educator Name</th>
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

<!-- Doctor Modal -->
<div class="modal fade" id="doctorModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Add HCP</h5>
			</div>
			<div class="modal-body">
				<form action="Pm-Create-Doctor-Post" name="createDoctor" id="createDoctor" method="post"
					enctype="multipart/form-data">
					<input type="hidden" name="doctor_id" id="doctor_id">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>MSL CODE <span class="text-danger">*</span></label>
								<input type="text" maxlength="50" class="form-control" name="msl_code" id="msl_code">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Name <span class="text-danger">*</span></label>
								<input type="text" maxlength="50" class="form-control" name="name" id="name">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>State <span class="text-danger">*</span></label>
								<select class="form-control" name="state" id="state">
									<option value=""> -- Select -- </option>
									<?php
									$states = getIndianStates();
									foreach ($states as $code => $name) {
										echo '<option value="' . $code . '">' . $name . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>City <span class="text-danger">*</span></label>
								<select class="form-control" name="city" id="city">
									<option value=""> -- Select -- </option>

								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Zone <span class="text-danger">*</span></label>
								<select class="form-control" name="zone" id="zone">
									<option value=""> -- Select -- </option>

								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Speciality <span class="text-danger">*</span></label>
								<input type="text" id="speciality" name="speciality" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>First Visit <span class="text-danger">*</span></label>
									<input type="date" id="first_vist" name="first_vist" class="form-control">
								</div>
							</div>
						</div>
					</div>

					<div class="text-center">
						<button type="submit" name="submit" id="submitBtn" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-secondary" onclick="closemodal();"
							data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Doctor Modal -->

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirm Delete</h5>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this doctor?</p>
				<input type="hidden" id="delete_id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" onclick="deleteDoctor()">Delete</button>
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
		$('#doctorsTable').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			processing: true,
			serverSide: true,
			ajax: {
				url: 'Pm-Get-Doctors',
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
				{ data: 'msl_code' },
				{ data: 'name' },
				{ data: 'city' },
				{ data: 'state' },
				{ data: 'zone' },
				{ data: 'speciality' },
				{ data: 'first_vist' },
				{ data: 'first_name' },
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
				$('#doctorsTable').DataTable().clear().draw();
			}
		});
	});

	$('#state').on('change', function () {

		let stateCode = $(this).val();
		let stateName = $('#state option:selected').text();

		$('#city').html('<option value="">Loading...</option>');

		if (stateCode !== '') {
			$.ajax({
				url: 'Pm-Get-cities', // Make sure this URL matches your route/controller
				type: 'POST',
				dataType: 'json',
				data: { state: stateName },
				success: function (response) {
					if (response.status === 'success') {
						let options = '<option value="">-- Select City --</option>';
						$.each(response.cities, function (index, city) {
							options += '<option value="' + $('<div>').text(city).html() + '">' + city + '</option>';
						});
						$('#city').html(options);
					} else if (response.status === 'no_data') {
						$('#city').html('<option value="">No cities found</option>');
					} else {
						$('#city').html('<option value="">Invalid state</option>');
					}
				},
				error: function () {
					$('#city').html('<option value="">Error loading cities</option>');
				}
			});
		} else {
			$('#city').html('<option value="">-- Select --</option>');
		}
	});
	$('#city').on('change', function () {
		$('#zone').html('<option value="">Loading...</option>');

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
					$('#zone').html(options);
				} else if (response.status === 'no_data') {
					$('#zone').html('<option value="">No zones found</option>');
				} else {
					$('#zone').html('<option value="">Invalid city</option>');
				}
			},
			error: function () {
				$('#zone').html('<option value="">Error loading zones</option>');
			}
		});
	});


	function resetForm() {
		$('#doctorModal').modal('show');
		$('#modalTitle').text('Add Doctor');
		$('#createDoctor')[0].reset();
		$('#doctor_id').val('');
		$('#profile_image_preview').html('');
		$('#submitBtn').text('Submit');
		$('.is-invalid').removeClass('is-invalid');
		$('.invalid-feedback').remove();
	}
	function closemodal() {
		$('#educatorModal').modal('hide');
	}
	function confirmDelete(id) {
		$('#delete_id').val(id);
		$('#deleteModal').modal('show');
	}

	// Delete doctor
	function deleteDoctor() {
		var id = $('#delete_id').val();

		$.ajax({
			url: 'Pm-Delete-Doctor/' + id,
			type: 'POST',
			dataType: 'json',
			contentType: 'application/json',
			processData: false,
			beforeSend: function (xhr) {
				// Explicitly request no compression
				xhr.setRequestHeader('Accept-Encoding', 'identity');
			},
			success: function (response) {
				if (response.status) {
					$('#doctorsTable').DataTable().ajax.reload(null, false); // false to maintain paging
					$('#deleteModal').modal('hide');
					alert('deleted', response.message);
				} else {
					alert('error', response.message);
				}
			},
			error: function (xhr, status, error) {
				// Handle error cases
				if (xhr.status === 0) {
					alert('error', 'Network error - please check your connection');
				} else {
					try {
						var errResponse = JSON.parse(xhr.responseText);
						alert('error', errResponse.message || 'Error deleting doctor');
					} catch (e) {
						alert('error', 'Error processing response');
					}
				}
			}
		});
	}



	$('#createDoctor').submit(function (e) {
    e.preventDefault();
    var $submitBtn = $('#submitBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

    if (validateDoctorForm()) {
        var formData = new FormData(this);
		var stateText = $('#state option:selected').text();
        formData.set('state', stateText); 
        $.ajax({
            url: 'Pm-Create-Doctor-Post',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    $('#doctorsTable').DataTable().ajax.reload();
                    $('#doctorModal').modal('hide');
                    showAlert('success', response.message);
                } else {
                    showAlert('error', response.message);
                    if (response.errors) {
                        $.each(response.errors, function (field, message) {
                            $('#' + field).addClass('is-invalid').after('<div class="invalid-feedback">' + message + '</div>');
                        });
                    }
                }
            },
            error: function (xhr) {
                showAlert('error', 'An error occurred. Please try again.');
                console.error(xhr.responseText);
            },
            complete: function () {
                $submitBtn.prop('disabled', false).html('Submit');
            }
        });
    } else {
        $submitBtn.prop('disabled', false).html('Submit');
    }
});

// Show alert (replace with SweetAlert or Toastr if needed)
function showAlert(type, message) {
    alert(message); // simple alert; replace with toast if needed
}

// Form validation
function validateDoctorForm() {
    var isValid = true;

    // Fetch values
    const name = $('#name').val().trim();
    const msl_code = $('#msl_code').val().trim();
    const state = $('#state option:selected').text();
    const city = $('#city').val().trim();
    const zone = $('#zone').val().trim();
    const speciality = $('#speciality').val().trim();
    // const first_vist = $('#first_vist').val().trim();

    // Clear previous errors
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();

    if (isEmpty(msl_code)) {
        $('#msl_code').addClass('is-invalid').after('<div class="invalid-feedback">MSL Code is required</div>');
        isValid = false;
    }
    if (isEmpty(name)) {
        $('#name').addClass('is-invalid').after('<div class="invalid-feedback">Name is required</div>');
        isValid = false;
    }
    if (isEmpty(state)) {
        $('#state').addClass('is-invalid').after('<div class="invalid-feedback">State is required</div>');
        isValid = false;
    }
    if (!isValidCity(city)) {
        $('#city').addClass('is-invalid').after('<div class="invalid-feedback">City must contain only letters</div>');
        isValid = false;
    }
    if (isEmpty(zone)) {
        $('#zone').addClass('is-invalid').after('<div class="invalid-feedback">Zone is required</div>');
        isValid = false;
    }
    if (isEmpty(speciality)) {
        $('#speciality').addClass('is-invalid').after('<div class="invalid-feedback">Speciality is required</div>');
        isValid = false;
    }

    return isValid;
}

// Utility validation
function isEmpty(value) {
    return value === "";
}

function isValidCity(city) {
    const pattern = /^[A-Za-z\s]+$/;
    return pattern.test(city);
}
</script>