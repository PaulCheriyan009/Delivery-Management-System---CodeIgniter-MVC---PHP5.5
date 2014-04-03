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
</body>

</html>
