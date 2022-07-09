
<?php 
include 'session_member.php';
if ($_GET['act']==''){?>

<div class="col-md-12">

<h4 style="text-align: center;">KEMATIAN</h4><hr> 
<a href="?module=datakematian&act=tambah" class="btn btn-success ">Tambah</a><br><br>
      <?php
      $query = mysql_query("SELECT COUNT(*) jumData from kematian");
      $data = mysql_fetch_array($query);
      $jumlahData = $data["jumData"];
       
      $dataperPage = 5;
        if(isset($_GET['hal']))
        {
        $noPage= $_GET['hal'];
        }
        else
        {
        $noPage=1;
        }
      $offset = ($noPage-1)*$dataperPage;
      ?>
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>

      <th>No.Kematian</th>
      <th>Nama</th>
      <th>Tanggal Kematian</th>
      <th>Keterangan</th>
      
      <th width="140">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $tampil=mysql_query("SELECT id_kematian, 
                              nama_anak, 
                              DATE_FORMAT(tanggal_kematian, '%d-%m-%Y') as tanggal, 
                              keterangan  FROM kematian JOIN anak ON kematian.id_anak=anak.id_anak limit  $offset, $dataperPage");
    while($row=mysql_fetch_array($tampil)){
  ?>
    <tr>
        <td><?php echo $row['id_kematian'];?></td>
      <td><?php echo $row['nama_anak'];?></td>
      <td><?php echo $row['tanggal'];?></td>
      <td><?php echo $row['keterangan'];?></td>
     
      <td><a href="?module=datakematian&act=edit&id=<?php echo $row[id_kematian];?>" class="btn btn-default">Edit</a> <a href="content/aksi_kematian.php?module=anak&act=hapus&id=<?php echo $row[id_kematian];?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"  class="btn btn-danger">Hapus</a></td>
    </tr>
  <?php } ?>
   
  </tbody>
</table>
<nav>
        <ul class="pagination ">
        <?php include 'content/view_kematian.php';?>
        </ul>
        </nav>
</div>
<br>
</div>

<?php } elseif ($_GET['act']=='tambah') {?>

<h4 style="text-align: center;">INPUT DATA KEMATIAN</h4><hr><br>
<div class="col-md-6 col-sm-offset-2 ">
<form class="form-horizontal" method="post" action="content/aksi_kematian.php?module=anak&act=input">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">No.Kematian</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   name='id_kematian'>
      
    </div>
    </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">NIB</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name='id_anak' onchange="isi_otomatis()" id="id">
      
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-8">
     
       <input type="text" class="form-control" id="nama_anak"  >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Tanggal Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control"   name='tanggal_kematian'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Keterangan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name='keterangan'>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-success" value="Simpan"> <input type="reset" class="btn btn-danger" value="Reset">
    </div>
 
  </div>
</form>
</div>

<?php } elseif ($_GET['act']=='edit') {
$syarat=$_GET['id'];
$data = "SELECT * FROM kematian WHERE id_kematian='$syarat'";
$hasil  = mysql_query($data);
$row  = mysql_fetch_array($hasil);
?>

<h4 style="text-align: center;">EDIT DATA</h4><hr><br>
<div class="col-md-6 col-sm-offset-2 ">
<form class="form-horizontal" method="post" action="content/aksi_kematian.php?module=anak&act=edit">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">No.Kematian</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   name='id_kematian' value="<?php echo $row[id_kematian];?>">
      
    </div>
    </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">NIB</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name='id_anak' value="<?php echo $row[id_anak];?>" onchange="isi_otomatis()" id="id">
      
    </div>
  </div>
  <?php $tampil2=mysql_query("SELECT *  FROM anak WHERE id_anak='$row[id_anak]'");
        $row2=mysql_fetch_array($tampil2);?>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nama_anak" value="<?php echo $row2[nama_anak];?>"  >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Tanggal Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control"   name='tanggal_kematian' value="<?php echo $row[tanggal_kematian];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Keterangan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name='keterangan' value="<?php echo $row[keterangan];?>">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-success" value="Simpan"> <input type="reset" class="btn btn-danger" value="Reset">
    </div>
 
  </div>
</form>
</div>

<?php } ?>
