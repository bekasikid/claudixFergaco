<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Fergaco</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/maruti-login.css" />
    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" method="POST" class="form-vertical" action="<?php echo site_url('login/check');?>">
				 <div class="control-group normal_text"> <h3><img src="<?php echo base_url()."themes/admin/";?>img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" name="username" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-right"><input type="submit" class="btn btn-success" value="Login" /></span>
                </div>
            </form>
        </div>
        
        <script src="<?php echo base_url()."themes/admin/";?>js/jquery.min.js"></script>  
        <script src="<?php echo base_url()."themes/admin/";?>js/maruti.login.js"></script> 
    </body>
</html>