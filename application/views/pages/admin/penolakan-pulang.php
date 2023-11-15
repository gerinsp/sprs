<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penolakan Barang Pulang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>/permintaan">Permintaan</a></li>
                        <li class="breadcrumb-item active">Penolakan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid" style="padding-bottom:100px;">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <?= $this->session->flashdata('message'); ?>
                    <div class="shadow card">
                        <div class="card-body">
                            <form action="<?php echo base_url($this->session->userdata('menu')) . '/tolak-pulang/' . $barang->id_pinjam_barang; ?>" method="post" accept-charset="utf-8" aria-hidden="true">
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="peminjam">Nama Peminjam</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="peminjam" id="peminjam" type="text" value="<?= $barang->peminjam; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="waktu">Waktu Pinjam</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="waktu" id="waktu" type="text" value="<?= $barang->waktu_pinjam; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="nama_barang">Nama Barang</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="nama_barang" id="nama_barang" type="text" value="<?= $barang->nama_barang; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="quantity">Quantity Barang</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="quantity" id="quantity" type="text" value="<?= $barang->quantity; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="alasan_pinjam">Alasan Pinjam</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="alasan_pinjam" id="alasan_pinjam" type="text" value="<?= $barang->alasan_pinjam; ?>" disabled>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="pesan">Pesan Penolakan</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="pesan" id="pesan" type="text">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2"> </div>
                                    <div class="col-md-5" style="text-align: right;">
                                        <button class="btn btn-md btn-primary">Tolak</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->