<?php

	//Koneksi Database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "dblatihan";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		$simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi)
										   VALUES ('$_POST[tnim]', 
										   		   '$_POST[tnama]',
										   		   '$_POST[talamat]',
										   		   '$_POST[tprodi]')
									      ");
		if($simpan) //jika simpan sukses
		{
			echo "<script>
					alert('Simpan data suksess!');
					document.location='index.php';
				 </script>";
		}
		else
		{
			echo "<script>
					alert('Simpan data GAGAL!');
					document.location='index.php';
				 </script>";
		}
	}

	//Pengujian jika tombol Edit/Hapus di klik
	if(isset($_GET['hal']))
	{
		//Tampilan Data yang akan diedit
		$tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]' ");
		$data = mysqli_fetch_array($tampil);
		if($data)
		{
			//Jika data ditemukan, maka data ditampung ke dalam variabel
			$vnim = $data['nim'];
			$vnama = $data['nama'];
			$valamat =$data['alamat'];
			$vprodi =$data['prodi'];	
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD2022 with Bootstrap</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="text-center">Tugas Web Lanjut seputar CRUD dengan template Bootstrap</h1>
	<h2 class="text-center">@Tony Sofyan Prasetyo [NPM 201943501813] </h2>

	<!-- Awal Card Form -->
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Form Input Data Mahasiswa
	  </div>
	  <div class="card-body">
	   <form method="post" action="">
	   		<div class="form-group">
	   			<label>Nim</label>
	   			<input type="text" name="tnim" value="<?=@$vnim?>" class="form-control" placeholder="Input Nim anda disini !" required>
	   		</div>
	   </form>
	   <div class="form-group">
	   			<label>Nama</label>
	   			<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama anda disini !" required>
	   		</div>
	   		<div class="form-group">
	   			<label>Alamat</label>
	   			<textarea class="form-control" name="talamat" placeholder="Input Alamat anda disini !"><?=@$valamat?></textarea>
	   		</div>
	   		<div class="form-group">
	   			<label>Program Studi</label>
	   			<select class="form-control" name="tprodi">
	   				<option value="<?=@$vprodi?>"><?=@$vprodi?></option>
	   				<option value="S1-SI">S1-SI</option>
	   				<option value="S1-TI">S1-TI</option>
	   				<option value="S1-DKV">S1-DKV</option>
	   			</select>
	   		</div>

	   		<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
	   		<button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

	   	</form>
	  </div>
	</div>
	<!-- Akhir Card Form -->

	<!-- Awal Card Tabel -->
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    Daftar Mahasiswa
	  </div>
	  <div class="card-body">

	  	<table class="table table-bordered table-striped">
	  		<tr>
	  			<th>No.</th>
	  			<th>Nim</th>
	  			<th>Nama</th>
	  			<th>Alamat</th>
	  			<th>Program Studi</th>
	  			<th>Aksi</th>
	  		</tr>
	  		<?php 
	  			$no = 1;
	  			$tampil = mysqli_query($koneksi, "SELECT * from tmhs order by id_mhs desc");
	  			while($data = mysqli_fetch_array($tampil)) :

	  		?>
	  		<tr>
	  			<td><?=$no++;?></td>
	  			<td><?=$data['nim']?></td>
	  			<td><?=$data['nama']?></td>
	  			<td><?=$data['alamat']?></td>
	  			<td><?=$data['prodi']?></td>
	  			<td>
	  				<a href="#" class="btn btn-warning"> Edit </a>
	  				<a href="#" class="btn btn-danger"> Hapus </a>
	  		</tr>
	  	<?php endwhile; //penutup perulangan while ?>
	  	</table>
	  
	  </div>
	</div>
	<!-- Akhir Card Tabel -->
</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>