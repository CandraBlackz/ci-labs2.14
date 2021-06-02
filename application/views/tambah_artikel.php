<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
		<title>Formulir Penambahan Artikel</title>
			<style type="text/css">
					label{
						width:100px; display: inline-block; margin-bottom: 10px;
					}
					input[type=text]{
						width: 280px;
					}
					textarea{
						width: 280px; height: 140px; vertical-align: text-top;
					}

					input[type=submit]{
						margin-top: 10px; margin-left: 105px;
					}

					p.alert{
						color:red;
						margin-left: 105px;
					}
			</style>
	</head>
	<body>
		<h1>Formulir Tambah Artikel</h1>
			<p>Berikut adalah menu yang bisa diakses</p>
				<a href="<?=base_url('front/tambah_artikel');?>">Tambah Artikel</a> |
				<a href="<?=base_url('front/daftar_artikel');?>">Daftar Artikel</a>
				<br /><br />

				<?php // echo validation_errors();?>

			<?php echo form_open_multipart(base_url("front/tambah_artikel/kirim"), 'method="POST"');?>
				<?php echo form_error('title');?>
				<label>Judul Artikel:</label><input type="text" name="title" value="<?php echo set_value('title');?>" /><br>
				<?php echo form_error('author');?>
				<label>Penulis:</label><input type="text" name="author" value="<?php echo set_value('author');?>" /><br>
				<?php echo form_error('content');?>
				<label>Isi Artikel</label><textarea  name="content"> <?php echo set_value('content');?></textarea><br>
				<label>File Gambar:</label><input type="file" name="userfile" size="20" /><br>
				<input type="submit" name="submit" value="Tambah Artikel" />
			<?php echo form_close();?>	
	</body>
</html>
