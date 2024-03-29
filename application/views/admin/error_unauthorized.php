<html>
<head>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" type="text/css"/>
    <style>
        body{padding-top:50px}#banner{border-bottom:none}.page-header h1{font-size:4em}.bs-docs-section{margin-top:8em}.bs-component{position:relative}.bs-component .modal{position:relative;top:auto;right:auto;left:auto;bottom:auto;z-index:1;display:block}.bs-component .modal-dialog{width:90%}.bs-component .popover{position:relative;display:inline-block;width:220px;margin:20px}#source-button{position:absolute;top:0;right:0;z-index:100;font-weight:bold}.progress{margin-bottom:10px}footer{margin:5em 0}footer li{float:left;margin-right:1.5em;margin-bottom:1.5em}footer p{clear:left;margin-bottom:0}.splash{padding:4em 0 2em;background-color:#1c2533;background:-webkit-linear-gradient(70deg, #080f1f 30%, #2b4b5a 87%, #435e67 100%);background:-o-linear-gradient(70deg, #080f1f 30%, #2b4b5a 87%, #435e67 100%);background:-ms-linear-gradient(70deg, #080f1f 30%, #2b4b5a 87%, #435e67 100%);background:-moz-linear-gradient(70deg, #080f1f 30%, #2b4b5a 87%, #435e67 100%);background:linear-gradient(20deg, #080f1f 30%, #2b4b5a 87%, #435e67 100%);background-attachment:fixed;color:#fff;text-align:center}.splash h1{font-size:4em}.splash #social{margin:2em 0}.splash .alert{margin:2em 0}.splash .bsa{max-width:350px;margin:0 auto;background:none}.splash .bsa .one .bsa_it_ad{border:1px solid #3e4653 !important;border-color:rgba(255,255,255,0.2) !important}.splash .bsa a{color:#fff}.section-tout{padding:4em 0 3em;border-top:1px solid rgba(255,255,255,0.1);border-bottom:1px solid rgba(0,0,0,0.1);background-color:#eaf1f1}.section-tout .fa{margin-right:.5em}.section-tout p{margin-bottom:3em}.section-preview{padding:4em 0 4em}.section-preview .preview{margin-bottom:4em;background-color:#eaf1f1;border:1px solid rgba(0,0,0,0.1);border-radius:6px}.section-preview .preview .image{padding:5px}.section-preview .preview .image img{border:1px solid rgba(0,0,0,0.1)}.section-preview .preview .options{text-align:center;padding:0 2em 2em}.section-preview .preview .options p{margin-bottom:2em}.section-preview .dropdown-menu{text-align:left}.section-preview .lead{margin-bottom:2em}@media (max-width:767px){.section-preview .image img{width:100%}}.sponsor img{border:1px solid rgba(0,0,0,0.1);border-radius:4px}.sponsor a:hover{text-decoration:none}.bsa{padding:0}.bsa .one .bsa_it_ad{border:none !important;background-color:transparent !important}.bsa .one .bsa_it_ad .bsa_it_t,.bsa .one .bsa_it_ad .bsa_it_d{color:inherit !important}.bsa .one .bsa_it_ad .bsa_it_i{margin-bottom:0 !important}.bsa .one .bsa_it_p{display:none}
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 class="text-danger" id="container"><i class="fa fa-exclamation-triangle"></i> Forbidden</h1>
            </div>
            <div class="bs-component">
                <div class="jumbotron">
                    <h1>Uhoh!?</h1>
                    <p class="lead">Sorry, you are not authorized to view this area. Please sign in with the correct credentials.</p>
                    <?php
                    $prefix = '';
                    if(!$this->session->userdata('driver_id')) {
                        $prefix = 'admin';
                    }
                    ?>
                    <p><a class="btn btn-primary btn-lg" href="<?php echo base_url().$prefix; ?>">Back to main site.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>