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
                    <h4>Barang Harian</h4>
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
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($barang_harian as $data) {
                                        ?>
                                            <tr>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="3%"><?php echo $no ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->peminjam ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo date('j M Y H:i:s', strtotime($data->waktu_pinjam)) ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama_barang ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->quantity ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                                    <a href="<?= base_url($this->session->userdata('menu')) ?>/approve-harian/<?= $data->id_pinjam_barang; ?>" class="btn btn-primary">Konfirmasi</a>
                                                    <a href="<?= base_url($this->session->userdata('menu')) ?>/penolakan-harian/<?= $data->id_pinjam_barang; ?>" class="btn btn-danger">Tolak</a>
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
                    <h4>Barang Pulang</h4>
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
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo date('j M Y H:i:s', strtotime($data->waktu_pinjam)) ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama_barang ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->quantity ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->alasan_pinjam ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                                    <a href="<?= base_url($this->session->userdata('menu')) ?>/approve-pulang/<?= $data->id_pinjam_barang; ?>" class="btn btn-primary">Konfirmasi</a>
                                                    <a href="<?= base_url($this->session->userdata('menu')) ?>/penolakan-pulang/<?= $data->id_pinjam_barang; ?>" class="btn btn-danger">Tolak</a>
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
                                                    <a href="<?= base_url($this->session->userdata('menu')) ?>/penolakan-ruangan/<?= $data->id_pinjam_ruangan; ?>" class="btn btn-danger">Tolak</a>
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
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->