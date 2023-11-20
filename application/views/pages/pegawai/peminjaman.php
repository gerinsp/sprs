<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Peminjaman Berlangsung</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                        <li class="breadcrumb-item active">Peminjaman</li>
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
                    <h4>Kendaraan</h4>
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
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Kendaraan</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Kilometer Awal</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Supir</th>
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Penerima</th>
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
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->nama_supir ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->penerima ?></td>
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                                <a id="btn-kendaraan" id-kendaraan="<?= $data->id_pinjam_kendaraan ?>" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" href="#">Pengembalian</a>
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
                                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Penerima</th>
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
                                            <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->penerima ?></td>
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
                                <h5 class="modal-title" id="exampleModalLabel">Form Pengembalian Kendaraan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Kilometer Akhir</label>
                                    <input type="number" name="km_akhir" class="form-control" id="km_akhir">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Denda</label>
                                    <input type="number" name="denda" class="form-control" id="denda">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="keterangan">
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
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<script>
    $(document).ready(() => {
        $('#btn-kendaraan').on('click', () => {
            const idPinjam = $('#btn-kendaraan').attr('id-kendaraan');

            $('#btn-save').on('click', function() {
                const data = {
                    id_pinjam_kendaraan: idPinjam,
                    kilometer_akhir: $('#km_akhir').val(),
                    denda: $('#denda').val(),
                    keterangan: $('#keterangan').val()
                };

                $.ajax({
                    url: '<?= base_url($this->session->userdata('menu')) ?>/pengembalian/kendaraan',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if(response.status == 'ok') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Kendaraan Berhasil dikembalikan'
                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(error) {
                    }
                });
            });
        })
    })
</script>