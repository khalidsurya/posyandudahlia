<?php error_reporting(0);
		session_start();
include 'config/koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistem Informasi Posyandu dahlia</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript">
            function isi_otomatis(){
                var id = $("#id").val();
                $.ajax({
                    url: 'proses-ajax.php',
                    data:"id="+id ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#nama_anak').val(obj.nama_anak);
                    $('#tanggal_lahir').val(obj.tanggal_lahir);
                    $('#jenis_kelamin').val(obj.jenis_kelamin);
     
                });
            }
        </script>
</head>

<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<header>
				<img width='100%' src="header.jpg">
				<nav class="navbar navbar-default navbar-default">

						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<div id="navbar" class="navbar-collapse collapse">
							  
						          <?php if($_SESSION[nama_admin]) { 
				?>
							<ul class="nav navbar-nav">
								<li ><a href="?module=home"><i class="glyphicon glyphicon-home"></i>  Home</a></li>
								<li><a href="?module=dataanak"><i class="glyphicon glyphicon-user"></i> Balita</a></li>
								<li><a href="?module=penimbangan"><i class="glyphicon glyphicon-tasks"></i> Penimbangan</a></li>
								<li><a href="?module=imunisasi"><i class="glyphicon glyphicon-pushpin"></i> Imunisasi</a></li>
								
								<li><a href="?module=vitamin"><i class="glyphicon glyphicon-tint"></i>  Vitamin</a></li>
								<li><a href="?module=datakematian"><i class="glyphicon glyphicon-file"></i> kematian</a></li>
								
								<li class="dropdown">
						          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-print"></i> Laporan <span class="caret"></span></a>
						        
						          <ul class="dropdown-menu">

						            <li><a href="laporan/databalita.php"  target="_blank">Laporan Data Balita </a></li>
						            <li><a href="laporan/datapenimbangan.php" target="_blank">Laporan Data Penimbangan</a></li>
						             <li><a href="?module=lapperbalita">Laporan Data Per Balita</a></li>
						              <li><a href="laporan/datakematian.php" target="_blank">Laporan Data Kematian</a></li>
						          </ul>
						        </li>
						        <?php }else{?>

						        <ul class="dropdown-menu">

						            <li><a href="index.php"  >Laporan Data Balita </a></li>
						            <li><a href="index.php" >Laporan Data Penimbangan</a></li>
						             <li><a href="index.php">Laporan Data Per Balita</a></li>
						              <li><a href="index.php" >Laporan Data Kematian</a></li>
						          </ul>
						        </li>

<?php

						        }

								

		 
			//periksa apakah user telah login atau memiliki session 
			if($_SESSION[nama_admin]) { 
				?>


						<li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Keluar</a></li>
				<?php }?>
					


								
							</ul>
						</div>

				</nav>
			</header>
		</div>
	</div>


		
	<?php include 'content.php';?>
		


	<div class="row" >
		<div class="col-md-12">
			<footer class="well"><p style="color: #8BC34A;">Sistem Informasi Posyandu dahlia </p></footer>
		</div>
	</div>
</div>


</body>
</html>