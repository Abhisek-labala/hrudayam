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

            <?php include('alerts.php'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="assignEducatorForm" name="assignEducatorForm" method="post">
                                <?php
                                // Get all educators
                                $educators = array();
                                $educatorData = getAllEducator();
                                if ($educatorData && isset($educatorData['educatorData'])) {
                                    foreach ($educatorData['educatorData'] as $educatorItem) {
                                        $id = $educatorItem['id'];
                                        $name = $educatorItem['first_name'] . ' ' . $educatorItem['last_name'];
                                        $educators[$id] = array('id' => $id, 'name' => $name);
                                    }
                                }

                                // Get all RMs
                                $rms = array();
                                $rmData = getAllRM();
                                if ($rmData && isset($rmData['rmManagerData'])) {
                                    foreach ($rmData['rmManagerData'] as $rmItem) {
                                        $id = $rmItem['id'];
                                        $name = $rmItem['name'];
                                        $rms[$id] = array('id' => $id, 'name' => $name);
                                    }
                                }
                                ?>

                                <div class="mb-3 row">
                                    <label class="col-form-label col-md-2">Select Educator</label>
                                    <div class="col-md-10">
                                        <select name="educator_id" id="educator_id" class="form-select form-control" required>
                                            <option value="">-- Select Educator --</option>
                                            <?php foreach ($educators as $educator): ?>
                                            <option value="<?= $educator['id'] ?>"><?= $educator['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-form-label col-md-2">Assign to RM</label>
                                    <div class="col-md-10">
                                        <select name="rm_id" id="rm_id" class="form-select form-control" required>
                                            <option value="">-- Select Regional Manager --</option>
                                            <option value="0">Unassign (No RM)</option>
                                            <?php foreach ($rms as $rm): ?>
                                            <option value="<?= $rm['id'] ?>"><?= $rm['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-form-label col-md-2"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-primary">Assign Educator</button>
                                        <div id="responseMessage" class="mt-2"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Wrapper -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#assignEducatorForm').submit(function(e) {
        e.preventDefault();
        
        // Clear previous messages
        $('#responseMessage').removeClass('alert-success alert-danger').html('');
        
        // Get form data
        var formData = {
            educator_id: $('#educator_id').val(),
            rm_id: $('#rm_id').val()
        };
        
        // Validate inputs
        if (!formData.educator_id || !formData.rm_id) {
            $('#responseMessage').addClass('alert alert-danger').html('Please select both educator and RM');
            return;
        }
        
        // Show loading state
        $('button[type="submit"]').prop('disabled', true).html('Processing...');
        
        // AJAX request
        $.ajax({
            url: 'MIS-Assign-Educator-Post',
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#responseMessage').addClass('alert alert-success').html(response.message);
                    // Optionally reset form
                    $('#assignEducatorForm')[0].reset();
                } else {
                    $('#responseMessage').addClass('alert alert-danger').html(response.message);
                }
            },
            error: function(xhr, status, error) {
                $('#responseMessage').addClass('alert alert-danger').html('An error occurred: ' + error);
            },
            complete: function() {
                $('button[type="submit"]').prop('disabled', false).html('Assign Educator');
            }
        });
    });
});
</script>

<?php include('footer.php'); ?>