<!-- this template used for iframe popups where there is no need to show full template -->
<!DOCTYPE HTML>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" id="bootstrap" href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet"/>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="span12">
            <?php $this->load->view($main_content); ?>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- jQuery UI -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon.min.js"></script>
</body>

</html>
