<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penolakan Ruangan</h1>
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
                            <form action="<?php echo base_url($this->session->userdata('menu')) . '/tolak-ruangan/' . $ruangan->id_pinjam_ruangan; ?>" method="post" accept-charset="utf-8" aria-hidden="true">
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="peminjam">Nama Peminjam</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="peminjam" id="peminjam" type="text" value="<?= $ruangan->peminjam; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="waktu">Waktu Pinjam</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="waktu" id="waktu" type="text" value="<?= $ruangan->waktu; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="nama_ruangan">Nama ruangan</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="nama_ruangan" id="nama_ruangan" type="text" value="<?= $ruangan->nama_ruangan; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="acara">Nama Acara</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="acara" id="acara" type="text" value="<?= $ruangan->acara; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="kebutuhan">Kebutuhan</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="kebutuhan" id="kebutuhan" type="text" value="<?= $ruangan->kebutuhan; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="keterangan">Keterangan</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="keterangan" id="keterangan" type="text" value="<?= $ruangan->keterangan; ?>" disabled>
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