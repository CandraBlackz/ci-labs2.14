<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title></title>
		<style type="text/css">
			table{width: 78%; border:1px solid #000; margin: 20px 0 30px 0;}
			table tr th{font-size: 18px; background: #efefef; border:none; padding:10px;}
			table tr td{text-align: center; padding: 10px;}

			div.paging{margin-top: 20px; margin-bottom: 20px;}
			div.paging a, div.paging strong{
				display: inline-block;
				width: 20px;
				height: 20px;
				text-align: center;
			}

			div.paging strong{
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<h1>Daftar Artikel</h1>
		<p>Berikut adalah menu yang bisa diakses</p>
		<a href="<?=base_url('front/tambah_artikel');?>">Tambah Artikel</a> |
		<a href="<?=base_url('front/daftar_artikel');?>">Daftar Artikel</a>
		
		<table>
			<thead>
				<tr>
					<th width="45%">Judul</th>
					<th>Penulis</th>
					<th>Gambar</th>
					<th>Tanggal</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($record)):?>
					<?php foreach($record as $row):?>
				<tr>
					<td><?php echo $row['title'];?></td>
					<td>
						<img src="<?php echo $row['featured_image'];?>" width="75" />
					</td>
					<td><?php echo $row['author'];?></td>
					<td><?php echo $row['date'];?></td>
					<td><a href="<?php echo base_url('front/edit_artikel/'.$row['ID']);?>">Edit</a> | 
					<a href="<?php echo base_url('front/delete_artikel/'.$row['ID']);?>">Hapus</a></td>
				</tr>
					<?php endforeach;?>
				<?php endif;?>
			</tbody>
		</table>

		<?php echo $pagination ;?>
	</body>
</html>
