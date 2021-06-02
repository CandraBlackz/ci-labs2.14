<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<title>Formulir Register</title>
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
		<h1>Form Registrasi Member</h1>
		<?php echo validation_errors();?>
		<form action="<?php echo base_url('user/register');?>" method="POST">
			<label>Username:</label><input type="text" name="username" /><br>
			<label>Password:</label><input type="password" name="password" /><br>
			<label>Email:</label><input type="email" name="email" /><br>
			<input type="submit" name="submit" value="Daftar" />
		</form>
	</body>
</html>
