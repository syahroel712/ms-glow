<?php
$id = $_GET['id'];
$sql = mysql_query("SELECT * from tb_supplier WHERE idsup = '$id'");
$data = mysql_fetch_array($sql);
?>

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Edit Pemasok ( <b><?= $data['nmsup'] ?></b> )
            </h3>
          </div>
          <form action='inc/pemasok/proses_edit_pemasok.php' method='post'>
            <div class="card-body">
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="nm" value="<?php echo $data['nmsup']; ?>" /><input class="form-control" type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Sales</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="sales" value="<?php echo $data['sales']; ?>" />
                </div>
              </div>


              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">No.telp Seles</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="nosales" value="<?php echo $data['nosales']; ?>" />
                </div>
              </div>


              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Almat</label>
                <div class="col-sm-10">
                  <td><textarea name="alamat" class="form-control"><?php echo $data['almt_s']; ?></textarea></td>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="nohp" value="<?php echo $data['notelp_s']; ?>" />
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button name="edit" type="submit" class="btn btn-primary">Tambah</button>
              <a href="index.php?page=pemasok&action=view" class="btn btn-default float-right">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>