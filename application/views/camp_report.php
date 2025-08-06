<?php
$campdetails = CampDetails(); // Fetch your camp data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camp Daily Report</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
        .dt-button.excel-button {
    background-color: green !important;
    color: white !important;
    border: none !important;
     border-radius: 5px !important;
}

.dt-button.pdf-button {
    background-color: blue !important;
    color: white !important;
    border: none !important;
    border-radius: 5px !important;
}

    </style>
</head>
<body>

<h2>Camp Daily Report</h2>
<p>Report Date: <?php echo date('d M Y'); ?></p>

<table id="campReportTable" class="display nowrap" style="width:100%">
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
        if (!empty($campdetails['campDetails'])):
            $sr = 1;
            foreach ($campdetails['campDetails'] as $camp):
        ?>
        <tr>
            <td><?= $sr++; ?></td>
            <td><?= htmlspecialchars($camp['first_name']); ?></td>
            <td><?= htmlspecialchars($camp['hcp_name']); ?></td>
            <td><?= htmlspecialchars($camp['in_time']); ?></td>
            <td><?= htmlspecialchars($camp['out_time']); ?></td>
            <td><?= htmlspecialchars($camp['remarks']); ?></td>
            <td><?= htmlspecialchars($camp['execution_status']); ?></td>
            <td><?= htmlspecialchars($camp['date']); ?></td>
        </tr>
        <?php
            endforeach;
        else:
        ?>
        <tr><td colspan="8" style="text-align:center;">No data found</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$('#campReportTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            text: 'Excel',
            className: 'excel-button'
        },
        {
            extend: 'pdfHtml5',
            text: 'PDF',
            className: 'pdf-button'
        },
    ],
    scrollX: true,
    responsive: true
});

</script>

</body>
</html>
