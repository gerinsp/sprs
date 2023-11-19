<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permintaan Pinjam</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                        <li class="breadcrumb-item active">Permintaan</li>
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
                    <h2>Barang Pulang</h2>
                    <div class="shadow card" style="margin-bottom: 30px;">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" id="dataTable" class="table tablelist table-bordered table-striped" width="100%" height="1px" cellspacing="0">
                                    <thead>
                                    <tr height="20px">
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('number'); ?></th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Peminjam</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Waktu Pinjam</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Barang</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Quantity</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Alasan Pinjam</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($barang_pulang as $data) {
                                        ?>
                                        <tr>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="3%"><?php echo $no ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->peminjam ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->waktu_pinjam ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama_barang ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->quantity ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->alasan_pinjam ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                                <a href="<?= base_url($this->session->userdata('menu')) ?>/approve-pulang/<?= $data->id_pinjam_barang; ?>" class="btn btn-primary">Konfirmasi</a>
                                                <a id-confirm="<?php $this->session->userdata('id_user') ?>" id-pinjam="<?= $data->id_pinjam_barang ?>" id="btn-barang" data-toggle="modal" data-target="#exampleModal" href="#" class="btn btn-danger">Tolak</a> </td>
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <h4>Kendaraan</h4>
                    <div class="shadow card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" id="dataTable" class="table tablelist table-bordered table-striped" width="100%" height="1px" cellspacing="0">
                                    <thead>
                                    <tr height="20px">
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('number'); ?></th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Peminjam</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Waktu Pinjam</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Kendaraan</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Kilometer Awal</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Supir</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kendaraan as $data) {
                                        ?>
                                        <tr>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="3%"><?php echo $no ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->peminjam ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo date('j M Y H:i:s', strtotime($data->waktu_pinjam)) ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama_kendaraan ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->kilometer_awal ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama_supir ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                                <a href="<?= base_url($this->session->userdata('menu')) ?>/approve-kendaraan/<?= $data->id_pinjam_kendaraan; ?>" class="btn btn-primary">Konfirmasi</a>
                                                <a id-confirm="<?php $this->session->userdata('id_user') ?>" id-pinjam="<?= $data->id_pinjam_kendaraan ?>" id="btn-kendaraan" data-toggle="modal" data-target="#exampleModal" href="#" class="btn btn-danger">Tolak</a>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <h4>Ruangan</h4>
                    <div class="shadow card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" id="dataTable" class="table tablelist table-bordered table-striped" width="100%" height="1px" cellspacing="0">
                                    <thead>
                                        <tr height="20px">
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('number'); ?></th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Peminjam</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Waktu Pinjam</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Ruangan</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Acara</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Kebutuhan</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Keterangan</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($ruangan as $data) {
                                        ?>
                                            <tr>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="3%"><?php echo $no ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->peminjam ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo date('j M Y H:i:s', strtotime($data->waktu_pinjam)) ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama_ruangan ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->acara ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->kebutuhan ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->keterangan ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                                    <a href="<?= base_url($this->session->userdata('menu')) ?>/approve-ruangan/<?= $data->id_pinjam_ruangan; ?>" class="btn btn-primary">Konfirmasi</a>
                                                    <a id-confirm="<?php $this->session->userdata('id_user') ?>" id-pinjam="<?= $data->id_pinjam_ruangan ?>" id="btn-ruangan" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger">Tolak</a>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Alasan Penolakan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Pesan</label>
                                    <textarea name="pesan" class="form-control" id="pesan" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button id="btn-save" type="button" class="btn btn-primary">Submit</button>
                            </div>
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

<!-- Function Javascript -->
<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<script>
    $(document).ready(() => {
        $('#btn-kendaraan').on('click', function() {
            const idPinjam = $('#btn-kendaraan').attr('id-pinjam');
            const idConfirm = $('#btn-kendaraan').attr('id-confirm');

            $('#btn-save').on('click', function() {
                const data = {
                    id_pinjam_kendaraan: idPinjam,
                    pesan: $('#pesan').val()
                };

                $.ajax({
                    url: '<?= base_url($this->session->userdata('menu')) ?>/tolak-kendaraan',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if(response.status == 'ok') {
                            Swal.fire({
                                icon: 'success',
                                title: 'sukses',
                                text: 'Data berhasil ditolak'
                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(error) {
                    }
                });
            });
        });

        $('#btn-ruangan').on('click', function() {
            const idPinjam = $('#btn-ruangan').attr('id-pinjam');
            const idConfirm = $('#btn-ruangan').attr('id-confirm');

            $('#btn-save').on('click', function() {
                const data = {
                    id_pinjam_ruangan: idPinjam,
                    pesan: $('#pesan').val()
                };

                $.ajax({
                    url: '<?= base_url($this->session->userdata('menu')) ?>/tolak-ruangan',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if(response.status == 'ok') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Data berhasil ditolak'
                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(error) {
                    }
                });
            });
        });

        $('#btn-barang').on('click', function() {
            const idPinjam = $('#btn-barang').attr('id-pinjam');
            const idConfirm = $('#btn-barang').attr('id-confirm');

            $('#btn-save').on('click', function() {
                const data = {
                    id_pinjam_barang: idPinjam,
                    pesan: $('#pesan').val()
                };

                $.ajax({
                    url: '<?= base_url($this->session->userdata('menu')) ?>/tolak-pulang',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if(response.status == 'ok') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: response.message
                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(error) {
                    }
                });
            });
        });

    })
</script>

