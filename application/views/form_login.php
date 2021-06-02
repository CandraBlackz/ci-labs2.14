<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<title>Formulir Login</title>
	<style type="text/css">
		label{
			width: 100px; display: inline-block; margin-bottom: 10px;
		}
		input[type=submit]{
			margin-top: 10px; margin-left: 105px;
		}
	</style>
	</head>
	<body>
		<h1>Form Login</h1>
		<?php echo validation_errors();?>
		<form action="<?php echo base_url('user/login');?>" method="POST">
			<label>Username:</label><input type="text" name="username" /><br>
			<label>Password:</label><input type="password" name="password" /><br>
			<input type="submit" name="submit" value="Login" />
		</form>
	</body>
</html>
