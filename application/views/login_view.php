<!DOCTYPE html>
<html>
<head>

	<meta content="text/html; charset=utf-8">
	<title>Pertamina EP Admin · Live Preview</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/master.css" />
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/layout/favicon.png" />
	
	<!--[if IE 6]><link rel="stylesheet" type="text/css" href="./ie/css/ie6.css" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="./ie/css/ie7.css" /><![endif]-->
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/my-jquery.js"></script>

</head>

<body class="login">

	<p id="header" class="loginheader">
		<img src="<?php //echo base_url(); ?>assets/img/content/logo.png" />
	</p><!-- #header -->

	<div id="content">
		<div id="loginbox" class="tabs span-2 first">

			<div class="head">
				<ul>
					<li><a href="#login">Login</a></li>
					<li><a href="#lost-password">Lost Password?</a></li>
				</ul>
			</div>

			<div id="login" class="body clearfix">
				<?php echo form_open('login/logon'); ?>
					<p>
						<label for="username">Username:</label><br />
						<?php echo form_input( array('id'=>'username', 'name'=>'username', 'size'=>'36') ); ?>
					</p>
					<p>
						<label for="password">Password:</label><br />
						<?php echo form_password( array('id'=>'password', 'name'=>'password', 'size'=>'36') ); ?>
					</p>
					<p>
						<input id="remember" type="checkbox" />
						<label for="remember">Remember me</label>
					</p>
					<p class="submit">
						<button type="submit">Login</button>
						<!-- <button type="submit" id="actionsubmit" onclick="logon_by_ajax()">Login</button> -->
					</p>					
					
					<p><?php echo validation_errors(); ?></p>
					
				<?php echo form_close(); ?>
				<!--[if lte IE 7]><div class="clear">&nbsp;</div><![endif]-->
			</div>

			<div id="lost-password" class="body clearfix">
				<form method="post" action="#">
					<p>
						<label for="email">Your e-mail address:</label><br />
						<?php echo form_submit('email', 'youremail@yourdomain.com') ?>
						
						<input id="email" type="text" size="36" />
					</p>
					<p class="submit">
						<button type="submit" >Reset Password</button>
					</p>
				</form>
				<!--[if lte IE 7]><div class="clear">&nbsp;</div><![endif]-->
			</div>

		</div>
	</div><!-- #content -->

	
	<script type="text/javascript">
		$(document).ready(function() {
			// You can delete the code block below. Its purpose is just to redirect the user
			// to the live preview page when clicking on the login button.
			$('#login button').click(function() {
				//window.location = 'index.html';
				//return false;
			});
		});

		// 
		function logon_by_ajax() {
			alert('OKAAA');
			$.ajax({
				url: <?php site_url('login/logon') ?>,
				type: 'POST',
				success: function(page) {						
					$('#content').html(page);	// tampilkan content
				}
			});
			return false;
		}
	</script>
	
</body>
</html>