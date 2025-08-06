<?php
include('header.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Sidebar -->
    <?php include('side_bar.php'); ?>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper" style="min-height: 653px;">
        <div class="content container-fluid">

            <!-- Page Header -->
            <?php include('breadcum.php'); ?>
            <!-- /Page Header -->

            <?php include('alerts.php'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <?php
                            // Get patient list data
                            $EducatorPatient = getpatientlistdata();
                            $EducatorPatientList = $EducatorPatient['EducatorPatient'];

                            // Get digital educators list - extract inner array
                            $digitaleducatorlistArray = digitaleducatorlist()['digitaleducatorlist'];

                            // Debug print to confirm data - remove after testing
                            /*
                            echo '<pre>';
                            print_r($digitaleducatorlistArray);
                            echo '</pre>';
                            */
                            ?>

                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Weight</th>
                                        <th>Height</th>
                                        <th>Doctor Name</th>
                                        <th>Date</th>
                                        <th>Digital Educator</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sr = 1;
                                    foreach ($EducatorPatientList as $PatientItem) {
                                        $campId = $PatientItem['camp_id'];
                                        $query = "SELECT * FROM `camp` WHERE `id`='" . $campId . "' limit 1";
                                        $campData = $this->master_model->customQueryRow($query);
                                        $campName = isset($campData->camp_id) ? $campData->camp_id : '';

                                        $date = $PatientItem['date'];
                                        $id = $PatientItem['id'];
                                        $name = $PatientItem['patient_name'];
                                        $age = $PatientItem['age'];
                                        $gender = $PatientItem['gender'];
                                        $patientId = $PatientItem['id'];
                                        $doctorId = $PatientItem['doctor_id'];
                                        $height = $PatientItem['height'];
                                        $weight = $PatientItem['weight'];
                                        $digitaleducatorid = $PatientItem['digital_educator_id'];
                                        // echo $digitaleducatorid;die;
                                        $hcp_name = $PatientItem['hcp_name'];
                                        $query = "SELECT * FROM `doctors_new` WHERE `id`='" . $hcp_name . "' limit 1";
                                        $doctorData = $this->master_model->customQueryRow($query);
                                        $doctorName = isset($doctorData->name) ? $doctorData->name : 'N/A';
                                        ?>
                                        <tr>
                                            <td><?php echo $sr; ?></td>
                                            <td><?php echo htmlspecialchars($name); ?></td>
                                            <td><?php echo htmlspecialchars($gender); ?></td>
                                            <td><?php echo htmlspecialchars($age); ?></td>
                                            <td><?php echo htmlspecialchars($weight); ?></td>
                                            <td><?php echo htmlspecialchars($height); ?></td>
                                            <td><?php echo htmlspecialchars($doctorName); ?></td>
                                            <td><?php echo htmlspecialchars($date); ?></td>
                                            <td>
                                                <?php
                                                if (!empty($digitaleducatorid)) {
                                                    // Find the educator's name from the $digitaleducatorlistArray by matching ID
                                                    $educatorName = 'N/A';
                                                    foreach ($digitaleducatorlistArray as $educator) {
                                                        if ($educator['id'] == $digitaleducatorid) {
                                                            $educatorName = htmlspecialchars($educator['first_name']);
                                                            break;
                                                        }
                                                    }
                                                    echo $educatorName;
                                                } else {
                                                    // Show assign form
                                                    ?>
                                                    <form method="post" action="mis-assign_digitaleducator_post">
                                                        <input type="hidden" name="patient_id"
                                                            value="<?php echo htmlspecialchars($patientId); ?>">
                                                        <select name="digital_educator_id" class="form-control" required>
                                                            <option value="">Select Educator</option>
                                                            <?php
                                                            foreach ($digitaleducatorlistArray as $educator) {
                                                                echo '<option value="' . htmlspecialchars($educator['id']) . '">' . htmlspecialchars($educator['first_name']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-success mt-1">Assign</button>
                                                    </form>
                                                    <?php
                                                }
                                                ?>
                                            </td>

                                        </tr>
                                        <?php
                                        $sr++;
                                    }
                                    ?>
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