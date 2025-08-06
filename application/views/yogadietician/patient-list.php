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
						<!--<div class="card-header">
								<h4 class="card-title">Basic Inputs</h4>
							</div>-->
						<div class="card-body">

							<?php
							$digital_educator_id = $this->session->userdata('digital_educator_id');
							$EducatorPatient = getDigitalEducatorPatient($digital_educator_id);
							// pr($EducatorPatient);
							$EducatorPatientList = $EducatorPatient['EducatorPatient'];
							?>

							<table id="myTable" class="display">
								<thead>
									<tr>
										<th>Sr </th>
										<th>Educator Name</th>
										<th>Name</th>
										<th>Mobile Number</th>
										<th>Gender</th>
										<th>Age</th>
										<th>Weight</th>
										<th>Height</th>
										<th>Doctor Name</th>
										<th>Cipla Brand Prescribed</th>
										<th>Date</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sr = 1;
									$doctorIds = array();
									$brand = "";


									$medicines = medicines();
									foreach ($medicines as $med) {
										$medicineId = $med['id'];
										$medicineName = $med['name'];
										$medicineIdWise[$medicineId] = $medicineName;
									}


									foreach ($EducatorPatientList as $PatientItem) {
										//pr($doctorsItem);
										$campId = $PatientItem['camp_id'];
										$query = "SELECT * FROM `camp` WHERE `id`='" . $campId . "' limit 1";
										$campData = $this->master_model->customQueryRow($query);
										$campName = $campData->camp_id;

										$date = $PatientItem['date'];
										$id = $PatientItem['id'];
										$educator_name = $PatientItem['educator_name'];
										$name = $PatientItem['patient_name'];
										$mobile = $PatientItem['mobile_number'];
										$age = $PatientItem['age'];
										$gender = $PatientItem['gender'];
										$patientId = $PatientItem['id'];
										$doctorId = $PatientItem['doctor_id'];
										$height = $PatientItem['height'];
										$weight = $PatientItem['weight'];
										$bmi = $PatientItem['bmi'];
										$date = $PatientItem['date'];
										$wh_ratio = $PatientItem['waist_to_height_ratio'];
										$waist_circumference = $PatientItem['waist_circumference_remark'];


										$hcp_name = $PatientItem['hcp_name'];
										$query = "SELECT * FROM `doctors_new` WHERE `id`='" . $hcp_name . "' limit 1";
										$doctorData = $this->master_model->customQueryRow($query);
										$doctorName = $doctorData->name;


										$medicineFromDb = $PatientItem['medicine'];
										$brand = "";
										if ($medicineFromDb) {
											$medicineFromDb = explode(',', $medicineFromDb);
											//pr($medicineFromDb);
											//echo "<br>";					
											foreach ($medicineFromDb as $med) {
												if ($medicineIdWise[$med]) {
													$brand .= $medicineIdWise[$med] . ',';
												}
											}
										}


										//die();
										?>
										<tr>
											<td><?php echo $sr; ?></td>
											<td><?php echo $educator_name; ?></td>
											<td><?php echo $name; ?></td>
											<td><?php echo $mobile; ?></td>
											<td><?php echo $gender; ?></td>
											<td><?php echo $age; ?></td>
											<td><?php echo $height; ?></td>
											<td><?php echo $weight; ?></td>
											<!-- <td><?php echo $waist_circumference; ?></td>                                 
					<td><?php echo $bmi; ?></td>                                 
					<td><?php echo $wh_ratio; ?></td>                                 -->


											<td><?php echo $doctorName; ?></td>
											<td><?php echo $brand; ?></td>
											<td><?php echo $date; ?></td>
											<td><button class="btn btn-success" onclick="openform(<?php echo $id;?>);">View Form</button></td>
										</tr>
										<?php $sr++;
									} ?>
								</tbody>
							</table>

						</div>
					</div>


				</div>
			</div>

		</div>
	</div>

</div>
<!-- /Main Wrapper -->
<?php
include('footer.php');
?>
<script>
	function openform($id) {
    window.location.href = 'Digital-educator-follow-up-form?patient_id=' + $id;
}

</script>