
<?php 
include 'session_member.php';
if ($_GET['act']==''){?>

<div class="col-md-12">

<h4 style="text-align: center;">DATA PENIMBANGAN</h4><hr> 
<div class="">
 <a href="?module=perbalita" class="btn btn-warning ">Lihat Per Balita</a> <a href="?module=penimbangan&act=tambah" class="btn btn-success ">Tambah</a><br><br></div>
      <?php
      $query = mysql_query("SELECT COUNT(*) jumData from anak");
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

      <th>Kode Timbang</th>
      <th>Tanggal Timbang</th>
      <th>Usia Anak</th>
      <th>Berat Badan</th>
      <th>Lingkar Perut</th>
      <th>Jenis Imunisasi</th>
      <th>Jenis Vitamin</th>
      <th>Saran</th>
     
      <th width="170">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $tampil=mysql_query("SELECT id_penimbangan, 
                              DATE_FORMAT(tanggal_timbang, '%d-%m-%Y') as tanggal, 
                              usia, 
                              berat_badan,
                              lingkar_perut,
                              jenis_imunisasi,
                              jenis_vitamin,
                              saran FROM penimbangan JOIN imunisasi ON penimbangan.id_imunisasi=imunisasi.id_imunisasi JOIN vitamin ON penimbangan.id_imunisasi=vitamin.id_vitamin limit  $offset, $dataperPage");
    while($row=mysql_fetch_array($tampil)){
  ?>
    <tr>
        <td><?php echo $row['id_penimbangan'];?></td>
      <td><?php echo $row['tanggal'];?></td>
      <td><?php echo $row['usia'];?></td>
      <td><?php echo $row['berat_badan'];?></td>
      <td><?php echo $row['lingkar_perut'];?></td>
      <td><?php echo $row['jenis_imunisasi'];?></td>
      <td><?php echo $row['jenis_vitamin'];?></td>
      <td><?php echo $row['saran'];?></td>
      <td><a href="?module=penimbangan&act=edit&id=<?php echo $row[id_penimbangan];?>" class="btn btn-default">Perbarui</a> <a href="content/aksi_penimbangan.php?module=timbang&act=hapus&id=<?php echo $row[id_penimbangan];?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"  class="btn btn-danger">Hapus</a></td>
    </tr>
  <?php } ?>
   
  </tbody>
</table>
<nav>
        <ul class="pagination ">
        <?php include 'content/view_anak.php';?>
        </ul>
        </nav>
</div>
<br>
</div>

<?php } elseif ($_GET['act']=='tambah') {
 $query = "SELECT 
      max(id_penimbangan) as maxID 
      FROM penimbangan";
$hasil = mysql_query($query);
$data = @mysql_fetch_array($hasil);
$idMax = $data['maxID'];

$noUrut = (int) substr($idMax, 1, 9);
$noUrut++;
$char = "P";
$newID = $char.sprintf("%04s", $noUrut); 
  ?>

<h4 style="text-align: center;">INPUT DATA PENIMBANGAN BALITA</h4><hr><br>
<div class="col-md-6 col-sm-offset-2 ">
<form class="form-horizontal" method="post" action="content/aksi_penimbangan.php?module=timbang&act=input">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Kode Timbang</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" disabled  value="<?php echo "$newID";?>" name='id_penimbangan'>
      <input type="hidden" class="form-control"  value="<?php echo "$newID";?>" name='id_penimbangan'>
      
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">NIB</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   name='id_anak'  onchange="isi_otomatis()" id="id" >
    </div>
  </div>
  <div class="form-group">

    <label for="inputPassword3" class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name='nama_anak' id='nama_anak' >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Tanggal Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control"  name='tanggal_lahir' id='tanggal_lahir'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Tanggal Timbang</label>
    <div class="col-sm-8">
      <input type="date" class="form-control"  name='tanggal_timbang'>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Usia</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name='usia'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Berat Badan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name='beratbadan'>
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Lingkar Perut</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name="lingkar_perut">
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Jenis Imunisasi</label>
    <div class="col-sm-8">
      <select  name="id_imunisasi" class="form-control ">
    <?php 
    $sel_kriteria="select * from imunisasi";
    $q=mysql_query($sel_kriteria);
      echo'<option value="">Pilih Imunisasi</option>';
        while($data_kriteria=mysql_fetch_array($q)){
      ?>
    <option value="<?php echo $data_kriteria["id_imunisasi"] ?>" ><?php echo $data_kriteria["jenis_imunisasi"] ?></option>
<?php }?>
              
    </select>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Jenis Vitamin</label>
    <div class="col-sm-8">
       <select  name="id_vitamin" class="form-control ">
    <?php 
    $sel_kriteria="select * from vitamin";
    $q=mysql_query($sel_kriteria);
      echo'<option value="">Pilih Vitamin</option>';
        while($data_kriteria=mysql_fetch_array($q)){
      ?>
    <option value="<?php echo $data_kriteria["id_vitamin"] ?>" ><?php echo $data_kriteria["jenis_vitamin"] ?></option>
<?php }?>
              
    </select>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Saran</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   name="saran">
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
$data = "SELECT * FROM penimbangan WHERE id_penimbangan='$syarat'";
$hasil  = mysql_query($data);
$row  = mysql_fetch_array($hasil);
?>

<h4 style="text-align: center;">EDIT DATA</h4><hr><br>
<div class="col-md-6 col-sm-offset-2 ">
<form class="form-horizontal" method="post" action="content/aksi_penimbangan.php?module=timbang&act=edit">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Kode Timbang</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   name='id_penimbangan' value="<?php echo $row[id_penimbangan];?>">
      
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">NIB</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   name='id_anak' value="<?php echo $row[id_anak];?>" onchange="isi_otomatis()" id="id">
    </div>
  </div>
  <?php $tampil2=mysql_query("SELECT *  FROM anak WHERE id_anak='$row[id_anak]'");
        $row2=mysql_fetch_array($tampil2);?>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  disabled value="<?php echo $row2[nama_anak];?>" id="nama_anak">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Tanggal Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" value="<?php echo $row2[tanggal_lahir];?>"  >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Tanggal Timbang</label>
    <div class="col-sm-8">
      <input type="date" class="form-control"  name='tanggal_timbang' value="<?php echo $row[tanggal_timbang];?>">
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Usia</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name='usia' value="<?php echo $row[usia];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Berat Badan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name='badan' value="<?php echo $row[berat_badan];?>">
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Lingkar Perut</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name="lingkar_perut" value="<?php echo $row[lingkar_perut];?>">
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Jenis Imunisasi</label>
    <div class="col-sm-8">
      <select  name="id_imunisasi" class="form-control ">
   <?php 
                     $tampil=mysql_query("SELECT * FROM imunisasi");
          if ($row[id_imunisasi]==0){
            echo "<option value=0 selected>- Pilih Imunisasi-</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($row[id_imunisasi]==$w[id_imunisasi]){
              echo "<option value=$w[id_imunisasi] selected>$w[jenis_imunisasi]</option>";
            }
            else{
              echo "<option value=$w[id_imunisasi]>$w[jenis_imunisasi]</option>";
            }
          }?>  
              
    </select>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Jenis Vitamin</label>
    <div class="col-sm-8">
       <select  name="id_vitamin" class="form-control ">
    <?php 
                     $tampil=mysql_query("SELECT * FROM vitamin");
          if ($row[id_vitamin]==0){
            echo "<option value=0 selected>- Pilih Vitamin-</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($row[id_vitamin]==$w[id_vitamin]){
              echo "<option value=$w[id_vitamin] selected>$w[jenis_vitamin]</option>";
            }
            else{
              echo "<option value=$w[id_vitamin]>$w[jenis_vitamin]</option>";
            }
          }?>  
              
    </select>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label" >Saran</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   name="saran" value="<?php echo $row[saran];?>">
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


