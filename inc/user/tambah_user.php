<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Tambah User
            </h3>
          </div>
          <form action='inc/user/proses_tambah_user.php' method='post'>
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="nm" name="nm" />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="user" name="user" />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input class="form-control" type="password" id="pass" name="pass" />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select id="jk" name="jk" class="form-control">
                    <option class="form-control" value="Laki-laki">Laki-laki</option>
                    <option class="form-control" value="Perempuan">Perempuan</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-10">
                  <select id="level" name="level" class="form-control">
                    <option class="form-control" value="admin">Admin</option>
                    <option class="form-control" value="kasir">Kasir</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea id="alamat" name="alamat" class="form-control"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">No. Telp</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="tlp" name="tlp" />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                  <textarea id="ket" name="ket" class="form-control"></textarea>
                </div>
              </div>

            </div>
            <div class="card-footer">
              <button id="tambah" class="btn btn-primary">Simpan</button>
              <a href="index.php?page=user&action=view" class="btn btn-default float-right">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>