<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Status Peminjaman Kendaraan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                        <li class="breadcrumb-item active">Peminjaman Kendaraan</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" id="dataTable" class="table tablelist table-bordered table-striped" width="100%" height="1px" cellspacing="0">
                                    <thead>
                                        <tr height="20px">
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('number'); ?></th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Peminjam</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Waktu Pinjam</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Waktu Kembali</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Kendaraan</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Kilometer Awal</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Supir</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;" colspan="2" class="text-center">Status</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Alasan</th>
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
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->waktu_kembali ? date('j M Y H:i:s', strtotime($data->waktu_kembali)) : '' ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama_kendaraan ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->kilometer_awal ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama_supir ?></td>
                                                <?php if ($data->is_finish == 1) : ?>
                                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">Kepala Sekolah Approve</td>
                                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">Kepegawaian Approve</td>
                                                <?php endif; ?>
                                                <?php if ($data->status == 'ditolak' && $data->id_penerima == 2) { ?>
                                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">Kepala Sekolah Tolak</td>
                                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">N/A</td>
                                                <?php } elseif($data->status == 'ditolak' && $data->id_penerima == 3) { ?>
                                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">Kepala Sekolah Approve</td>
                                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">Kepegawaian Tolak</td>
                                                <?php } ?>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->pesan ?></td>
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
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->