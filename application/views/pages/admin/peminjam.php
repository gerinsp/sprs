<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Peminjam</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                        <li class="breadcrumb-item active">Peminjam</li>
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
                            <form action="<?php echo base_url($this->session->userdata('menu')) . '/peminjam-save'; ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" aria-hidden="true">
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="nama">Nama Peminjam</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="nama" id="nama" type="text">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="username">Username Peminjam</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="username" id="username" type="text">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="password">Password Peminjam</label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text bg-white border-left-0 <?= (form_error('password')) ? 'border-danger rounded-right' : ''; ?>">
                                                        <a role="button" onclick="previewPassword(this, 'password')"><span class="fa fa-fw fa-sm fa-eye-slash text-black-50"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2">
                                        <label for="image">Foto Peminjam</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" required name="image" id="image" type="file">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-md-2"> </div>
                                    <div class="col-md-5" style="text-align: right;">
                                        <button class="btn btn-md btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="shadow card" style="margin-top:40px;">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" id="dataTable" class="table tablelist table-bordered table-striped" width="100%" height="1px" cellspacing="0">
                                    <thead>
                                        <tr height="20px">
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('number'); ?></th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Peminjam</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Username Peminjam</th>
                                            <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Foto Peminjam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($peminjam as $data) {
                                        ?>
                                            <tr>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="3%"><?php echo $no ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->username ?></td>
                                                <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" class="text-center" width="12%">
                                                <?php if(!$data->image) { ?>
                                                    <img src="<?= base_url('assets/img/profile/default.png') ?>" class="img-circle elevation-2" alt="User Image" width="20%">
                                                <?php } else { ?>
                                                    <img src="<?php echo $data->image ?>" alt="<?php echo $data->nama ?>" width="50%">
                                                <?php } ?>
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