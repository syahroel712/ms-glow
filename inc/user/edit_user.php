<?php
$id = $_GET['id'];
$sql = mysql_query("SELECT * from tb_user where kode_user = '$id'");
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
              Edit User (<b> <?= $data['nama_lengkap'] ?> <b>)
            </h3>
          </div>
          <form action='inc/user/proses_edit_user.php' method='post'>
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input class="form-control" type="hidden" id="id" name="id" value="<?php echo $data['kode_user']; ?>" />
                  <input class="form-control" type="text" id="nm" name="nm" value="<?php echo $data['nama_lengkap']; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="user" name="user" value="<?php echo $data['username']; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input class="form-control" type="password" id="pass" name="pass" value="<?php echo $data['pass']; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select id="jk" name="jk" class="form-control">
                    <?php
                    if ($data['jenis_kelamin'] == 'Laki-laki') {
                    ?>
                      <option class="form-control" value="Laki-laki" selected>Laki-laki</option>
                      <option class="form-control" value="Perempuan">Perempuan</option>
                    <?php } else { ?>
                      <option class="form-control" value="Laki-laki">Laki-laki</option>
                      <option class="form-control" value="Perempuan" selected>Perempuan</option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-10">
                  <select id="level" name="level" class="form-control">
                    <?php
                    if ($data['level'] == 'admin') {
                    ?>
                      <option class="form-control" value="admin" selected>Admin</option>
                      <option class="form-control" value="kasir">Kasir</option>
                    <?php } else { ?>
                      <option class="form-control" value="admin">Admin</option>
                      <option class="form-control" value="kasir" selected>Kasir</option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea id="alamat" name="alamat" class="form-control"><?php echo $data['alamat']; ?></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">No. Telp</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="tlp" name="tlp" value="<?php echo $data['no_telepon']; ?>" />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                  <textarea id="ket" name="ket" class="form-control"><?php echo $data['keterangan']; ?></textarea>
                </div>
              </div>

            </div>
            <div class="card-footer">
              <button id="edit" class="btn btn-primary">Simpan</button>
              <a href="index.php?page=user&action=view" class="btn btn-default float-right">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>