<?php
session_start();
error_reporting(0);
include '../config/koneksi.php';
$module=$_GET['module'];
$act=$_GET['act'];

// Hapus format
if ($module=='anak' AND $act=='hapus'){
  mysql_query("DELETE FROM kematian WHERE id_kematian='$_GET[id]'");
 
echo "<script language='javascript'>alert('Data Berhasil Dihapus');
document.location='../?module=datakematian';
</script>";
}

// Input format
elseif ($module=='anak' AND $act=='input'){

		mysql_query("INSERT INTO kematian (id_kematian,
											id_anak,
											tanggal_kematian,
											keterangan) 
								VALUES( '$_POST[id_kematian]',
										'$_POST[id_anak]',
										'$_POST[tanggal_kematian]',
										'$_POST[keterangan]')");
								   
echo "<script language='javascript'>alert('Data Berhasil Disimpan');
document.location='../?module=datakematian';
</script>";

}
elseif ($module=='anak' AND $act=='edit'){

mysql_query("UPDATE kematian SET id_anak='$_POST[id_anak]',
								tanggal_kematian='$_POST[tanggal_kematian]',
								keterangan='$_POST[keterangan]' WHERE id_kematian='$_POST[id_kematian]'");
echo "<script language='javascript'>alert('Data Berhasil Diedit');
document.location='../?module=datakematian';
</script>";
		

}
elseif ($module=='siswabaru' AND $act=='update'){

      mysql_query("UPDATE rb_siswa SET noinduk	 = '$_POST[aa]',
								       password  = '$_POST[ab]',
									   status    = '1',
									   kodekelas = '$_POST[ac]'
									where nopendaftaran ='$_POST[id]'");
									
	 header('location:../../media.php?module=siswabaru&status=0');
}


?>
