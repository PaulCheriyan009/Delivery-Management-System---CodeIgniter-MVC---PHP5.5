<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>DMS - Permissions Changed</title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="form-signin">
    <h1>Congrats!</h1>
    <p>Your permissions have been changed to <?php echo var_dump($permission_id); ?> <?php echo anchor('admin/login', 'Login Now');?></p>
</div>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</body>
</html>    
    