<html>
<head>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" type="text/css"/>
</head>
<body>
<div class="container-fluid">
    <div class="row-fluid">
        <h1>DMS-P <small>Unit Testing Suite</small></h1>
        <p>Models covered:
        <ul>
            <li>deliveries_model.php</li>
            <li>facilities_model.php</li>
            <li>suppliers_model.php</li>
            <li>users_model.php</li>
        </ul>
        </p>
        <?php echo $this->unit->report(); ?>
    </div>
</div>
</body>
</html>