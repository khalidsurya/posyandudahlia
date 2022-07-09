<?php
session_start();
error_reporting(0);
include '../config/koneksi.php';
$module=$_GET['module'];
$act=$_GET['act'];

// Hapus format
if ($module=='timbang' AND $act=='hapus'){
  mysql_query("DELETE FROM penimbangan WHERE id_penimbangan='$_GET[id]'");
 
echo "<script language='javascript'>alert('Data Berhasil Dihapus');
document.location='../?module=penimbangan';
</script>";
}

// Input format
elseif ($module=='timbang' AND $act=='input'){

		mysql_query("INSERT INTO penimbangan (id_penimbangan,
											id_anak,
											tanggal_timbang,
											usia,
											berat_badan,
											lingkar_perut,
											id_imunisasi,
											id_vitamin,
											saran) 
								VALUES( '$_POST[id_penimbangan]',
										'$_POST[id_anak]',
										'$_POST[tanggal_timbang]',
										'$_POST[usia]',
										'$_POST[beratbadan]',
										'$_POST[lingkar_perut]',
										'$_POST[id_imunisasi]',
										'$_POST[id_vitamin]',
										'$_POST[saran]')");
								   
echo "<script language='javascript'>alert('Data Berhasil Disimpan');
document.location='../?module=penimbangan';
</script>";

}
elseif ($module=='timbang' AND $act=='edit'){

mysql_query("UPDATE penimbangan SET id_anak='$_POST[id_anak]',
								tanggal_timbang='$_POST[tanggal_timbang]',
								usia='$_POST[usia]',
								berat_badan='$_POST[badan]',
								lingkar_perut='$_POST[lingkar_perut]',
								id_imunisasi='$_POST[id_imunisasi]',
								id_vitamin='$_POST[id_vitamin]',
								saran='$_POST[saran]'
								 WHERE id_penimbangan='$_POST[id_penimbangan]'");
echo "<script language='javascript'>alert('Data Berhasil Diedit');
document.location='../?module=penimbangan';
</script>";
		

}
elseif ($module=='siswabaru' AND $act=='update'){

      mysql_query("UPDATE rb_siswa SET noinduk	 = '$_POST[aa]',
								       password  = '$_POST[ab]',
									   status    = '1',
									   kodekelas = '$_POST[ac]'
									where nopendaftaran ='$_POST[id]'");
									
	 header('location:../../media.php?module=siswabaru&status=0');

}elseif ($module =='lihatnilai' AND $act=='input') {
	$kampus = $_POST['id_anak'];

	header("location:../?module=perbalita&id=$_POST[id_anak]");
}elseif ($module =='cekimunisasi' AND $act=='input') {
	$kampus = $_POST['id_anak'];

	header("location:../?module=imunisasi&id=$_POST[id_anak]");
}elseif ($module =='cekvitamin' AND $act=='input') {
	$kampus = $_POST['id_anak'];

	header("location:../?module=vitamin&id=$_POST[id_anak]");
}




?>
