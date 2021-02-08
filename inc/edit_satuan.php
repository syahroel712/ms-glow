<?php
$id = @$_GET['id'];
$sql = mysql_query("SELECT * from tb_satuan where id_satuan = '$id'") or die(mysql_error());
$data = mysql_fetch_array($sql);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Satuan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Satuan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Edit Data Satuan
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action='inc/proses_edit_satuan.php' method='post'>
                            <table class='table'>
                                <tr>
                                    <td width='150px' scope='row'>ID Satuan</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="text" readonly=readonly name="id_satuan" value="<?php echo $data['id_satuan']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='150px' scope='row'>Kode Barang</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="text" readonly=readonly name="kode_barang" value="<?php echo $data['kode_barang']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='150px' scope='row'>Nama Satuan</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="text" name="nama_satuan" value="<?php echo $data['nama_satuan']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='150px' scope='row'>Harga Satuan</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="text" name="harga_satuan" value="<?php echo $data['harga_satuan']; ?>" /></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><input type='submit' id="edit" value='Edit' class="btn btn-primary"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>