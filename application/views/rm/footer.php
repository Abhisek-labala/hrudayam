<!-- jQuery -->
<script src="<?php echo base_url()?>assets/js/bootstrap/jquery-3.7.1.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/patternomaly"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<!-- 1. Load Chart.js FIRST -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- 2. Load only ONE version of the DataLabels plugin -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url()?>assets/js/bootstrap/bootstrap.bundle.min.js" type="text/javascript"></script>

<!-- Custom JS -->
<script src="<?php echo base_url()?>assets/js/bootstrap/script.js" type="text/javascript"></script>

<!---Data Tabel Intilizaion----->
<script>

$(document).ready( function () {
    $('#myTable').DataTable({searching: true, paging: false, info: false,"pageLength": 100});
} );

//$('#myTable').DataTable({searching: true, paging: false, info: false,"pageLength": 100});
</script>
<!-------->

<script>
$(document).ready(function(e) { 
  $('.slimscroll').slimscroll({    
    height: '593px',
    alwaysVisible: true
  });
});

</script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>


<?php 
unset($_SESSION['error']);
unset($_SESSION['message']);
unset($_SESSION['info']);
?>