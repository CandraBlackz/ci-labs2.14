<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Penambahan Artikel Berhasil</title>
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
</style>
</head>
<body>
<h1>Penambahan Artikel Berhasil</h1>
<p>Anda telah sukses menambah artikel, berikut info artikel yang sudah dibuat :</p>
<a href="<?php echo base_url('front/tambah_artikel');?>">Tambah Artikel Lagi</a> | <a href="<?=base_url('front/daftar_artikel');?>">Daftar Artikel</a>
</body>
</html>
