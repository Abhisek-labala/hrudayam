<?php
include('header.php');
?>
<div class="main-wrapper">
    <?php include('side_bar.php'); ?>
    <div class="page-wrapper" style="min-height: 653px;">
        <div class="content container-fluid">
            <?php include('breadcum.php'); ?>
            <?php include('alerts.php'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php $campdetails = CampDetails(); ?>
                            <button type="button" class="btn btn-success"
                                            onclick="openNewWindow();">Camp Report</button>
                            <table id="campTable" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Educator Name</th>
                                        <th>Doctor Name</th>
                                        <th>In Time</th>
                                        <th>Out Time</th>
                                        <th>Remarks</th>
                                        <th>Execution Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sr = 1;
                                    foreach ($campdetails['campDetails'] as $camp) {
                                        ?>
                                        <tr>
                                            <td><?= $sr ?></td>
                                            <td><?= htmlspecialchars($camp['first_name']) ?></td>
                                            <td><?= htmlspecialchars($camp['hcp_name']) ?></td>
                                            <td><?= htmlspecialchars($camp['in_time']) ?></td>
                                            <td><?= htmlspecialchars($camp['out_time']) ?></td>
                                            <td><?= htmlspecialchars($camp['remarks']) ?></td>
                                            <td><?= htmlspecialchars($camp['execution_status']) ?></td>
                                            <td><?= htmlspecialchars($camp['date']) ?></td>
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

<!-- CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    $('#campTable').DataTable({
        dom: 'Bfrtip',      // Show buttons
        buttons: [          // Button configuration
            { extend: 'excelHtml5', title: 'Camp Details' },
            { extend: 'pdfHtml5', title: 'Camp Details' }
        ],
        responsive: true
    });
});
function openNewWindow() {
    var url = 'campreport_excel'; // Adjusted path to work with CI routing
    var reportWindow = window.open(url, '_blank', 'width=1200,height=800,scrollbars=yes,resizable=yes');

    if (reportWindow) {
        reportWindow.focus(); // Focus the new window
    } else {
        alert("Popup blocked! Please allow popups for this website.");
    }
}

</script>

<?php include('footer.php'); ?>
