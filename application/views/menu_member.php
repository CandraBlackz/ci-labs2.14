<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Menu Member</title>
		<style type="text/css">
		</style>
	</head>
	<body>
		<h1>Menu Member</h1>
		<p>Berikut adalah menu yang bisa diakses</p>
		<a href="<?=base_url('front/tambah_artikel');?>">Tambah Artikel</a> |
		<a href="<?=base_url('front/daftar_artikel');?>">Daftar Artikel</a>
	</body>
</html>
