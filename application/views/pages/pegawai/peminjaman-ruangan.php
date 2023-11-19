<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Riwayat Peminjaman Ruangan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                        <li class="breadcrumb-item active">Peminjaman Ruangan</li>
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
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->