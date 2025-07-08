<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Report</title>

    <!-- DataTables core CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons extension CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .report-header { margin-bottom: 20px; text-align: center; }
        .report-title { font-size: 18px; font-weight: bold; }
        .report-filters { margin: 10px 0; font-size: 14px; }
        table { width: 100% !important; }

        .dt-button.buttons-csv { background-color: #2196F3 !important; color: #fff !important; }
        .dt-button.buttons-excel { background-color: #4CAF50 !important; color: #fff !important; }
        .dt-button.buttons-pdf { background-color: #f44336 !important; color: #fff !important; }

        .dt-button {
            border: none !important;
            padding: 6px 12px !important;
            margin: 5px 3px !important;
            border-radius: 4px !important;
            font-size: 13px !important;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dt-button:hover { opacity: 0.9; }
    </style>
</head>
<body>

<div class="report-header">
    <div class="report-title">Patient Inquiry Report</div>
    <div class="report-filters">
        Date Range: <?php echo date('d M Y', strtotime($fromDate)); ?> to <?php echo date('d M Y', strtotime($toDate)); ?>
    </div>
</div>

<table id="patientReportTable" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Sr No</th>
            <?php if (!empty($patientData)): ?>
                <?php foreach (array_keys($patientData[0]) as $key): ?>
                    <th><?php echo ucwords(str_replace('_', ' ', $key)); ?></th>
                <?php endforeach; ?>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($patientData)): ?>
            <?php $sr = 1; ?>
            <?php foreach ($patientData as $patient): ?>
                <tr>
                    <td><?php echo $sr++; ?></td>
                    <?php foreach ($patient as $value): ?>
                        <td><?php echo htmlspecialchars($value); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="100%" style="text-align: center;">No data found</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables core JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('#patientReportTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['csv', 'excel'],
            scrollX: true,
            pageLength: 50
        });
    });
</script>

</body>
</html>
