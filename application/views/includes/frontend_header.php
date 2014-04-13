<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Delivery Management System 2014">
    <meta name="author" content="Adam Bull, Lukata Binns & Mishrey Almarshoud">

    <title><?php echo $this->config->item('application_name') ?></title>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/jquery.multipage.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/css/frontend/style.css" type="text/css" rel="stylesheet"/>

</head>

<body>

<nav class="navbar navbar-default" style="margin-bottom: 0;" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Delivery Management System 2014</a>
        </div>

        <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                if
                 <li><a href="<?php echo base_url(); ?>register">Register</a></li>
                 <li><a href="<?php echo base_url(); ?>login">Login</a></li>

                 <li><a href="<?php echo base_url(); ?>admin">Admin Log In</a></li>
            </ul>
        </div>
    </div>
</nav>
