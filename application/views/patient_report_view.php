<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Report</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .report-header {
            margin-bottom: 20px;
            text-align: center;
        }

        .report-title {
            font-size: 18px;
            font-weight: bold;
        }

        .report-filters {
            margin: 10px 0;
            font-size: 14px;
        }

        table {
            width: 100% !important;
        }

        .dt-button.buttons-csv {
            background-color: #2196F3 !important;
            color: #fff !important;
        }

        .dt-button.buttons-excel {
            background-color: #4CAF50 !important;
            color: #fff !important;
        }

        .dt-button.buttons-pdf {
            background-color: #f44336 !important;
            color: #fff !important;
        }

        .dt-button {
            border: none !important;
            padding: 6px 12px !important;
            margin: 5px 3px !important;
            border-radius: 4px !important;
            font-size: 13px !important;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dt-button:hover {
            opacity: 0.9;
        }

        .file-link {
            color: #2196F3;
            text-decoration: none;
        }

        .file-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php

    $base_url = 'https://hridayampsp.com/uploads/';


    // Determine headers and max prescription files
    $headers = [];
    $maxPrescriptions = 0;
    if (!empty($patientData)) {
        $headers = array_keys($patientData[0]);

        foreach ($patientData as $row) {
            if (!empty($row['prescription_file'])) {
                $count = count(explode(',', $row['prescription_file']));
                $maxPrescriptions = max($maxPrescriptions, $count);
            }
        }
    }
    ?>

    <div class="report-header">
        <div class="report-title">Patient Inquiry Report</div>
        <div class="report-filters">
            Date Range: <?php echo date('d M Y', strtotime($fromDate)); ?> to
            <?php echo date('d M Y', strtotime($toDate)); ?>
        </div>
    </div>

    <table id="patientReportTable" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Sr No</th>
                <?php foreach ($headers as $key): ?>
                    <?php if ($key === 'prescription_file'): ?>
                        <?php for ($i = 1; $i <= $maxPrescriptions; $i++): ?>
                            <th>Prescription File <?php echo $i; ?></th>
                        <?php endfor; ?>
                    <?php elseif ($key === 'consent_form_file'): ?>
                        <th>Consent Form</th>
                        <?php elseif ($key === 'purchase_bill'): ?>
                <th>Purchase Bill</th>
                    <?php else: ?>
                        <th><?php echo ucwords(str_replace('_', ' ', $key)); ?></th>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php $sr = 1; ?>
            <?php foreach ($patientData as $row): ?>
                <tr>
                    <td><?php echo $sr++; ?></td>
                    <?php foreach ($headers as $key): ?>
                        <?php if ($key === 'prescription_file'): ?>
                            <?php
                            $prescriptions = !empty($row[$key]) ? explode(',', $row[$key]) : [];
                            for ($i = 0; $i < $maxPrescriptions; $i++):
                                $file = trim($prescriptions[$i] ?? '');
                                if ($file):
                                    $url = $base_url . $file;
                                    echo "<td><a class='file-link' href='{$url}' target='_blank'>$url</a></td>";
                                else:
                                    echo "<td></td>";
                                endif;
                            endfor;
                            ?>
                        <?php elseif ($key === 'consent_form_file' || $key === 'purchase_bill'): ?>
                            <td>
                                <?php if (!empty($row[$key])): ?>
                                    <a href="<?php echo $base_url . trim($row[$key]); ?>" target="_blank" class="file-link">
                                        <?php echo $base_url . trim($row[$key]); ?>
                                    </a>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td><?php echo htmlspecialchars($row[$key]); ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script>
        $(document).ready(function () {
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