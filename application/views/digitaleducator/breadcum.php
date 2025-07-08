<!-- Page Header -->
<?php
$segment = $this->uri->segment(1);
$segment = str_replace('-',' ',$segment);
?>
<div class="page-header">
    <div class="row">
        <div class="col">
        <h3 class="page-title"> <?php echo $formattedString = ucwords(strtolower($segment));?> </h3>
            <!-- <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active"><?php echo $segment?></li>
            </ul> -->
        </div>
    </div>
</div>
<!-- /Page Header -->