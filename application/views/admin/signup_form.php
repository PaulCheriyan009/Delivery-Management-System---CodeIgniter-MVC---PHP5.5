<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>CodeIgniter Admin Sample Project</title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
    <style>
        body,html {
            height: 100%;
        }
        body {
            padding:30px;
            background: #f2f9fe; /* Old browsers */
            /* IE9 SVG, needs conditional override of 'filter' to 'none' */
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2YyZjlmZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNkNmYwZmQiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
            background: -moz-linear-gradient(top,  #f2f9fe 0%, #d6f0fd 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f2f9fe), color-stop(100%,#d6f0fd)); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top,  #f2f9fe 0%,#d6f0fd 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top,  #f2f9fe 0%,#d6f0fd 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top,  #f2f9fe 0%,#d6f0fd 100%); /* IE10+ */
            background: linear-gradient(to bottom,  #f2f9fe 0%,#d6f0fd 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f9fe', endColorstr='#d6f0fd',GradientType=0 ); /* IE6-8 */

        }
    </style>
  </head>
  <body>
<?php
//form validation
echo validation_errors();
?>  	
<div class="container login">
<?php
$attributes = array('class' => 'form-signin');   
echo form_open('admin/create_member', $attributes);
echo '<h2 class="form-signin-heading">Create an account</h2>';
echo form_input('first_name', set_value('first_name'), 'placeholder="First name"');
echo form_input('last_name', set_value('last_name'), 'placeholder="Last name"');
echo form_input('email_address', set_value('email_address'), 'placeholder="Email"');

echo form_input('username', set_value('username'), 'placeholder="Username"');
echo form_password('password', '', 'placeholder="Password"');
echo form_password('password2', '', 'placeholder="Password confirm"');

echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
</div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>    
    