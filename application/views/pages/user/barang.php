<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Barang</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                  <li class="breadcrumb-item active">Barang </li>
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
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Barang</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Kode Barang</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Stok</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Lokasi</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Kondisi</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $no = 1;
                              foreach ($barang as $data) {
                              ?>
                                 <tr>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="3%"><?php echo $no ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->kode ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->stok ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->lokasi ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->kondisi ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                       <a onclick="openModalPinjamHarian(this)" data-idpeminjam="<?php echo $this->session->userdata('id_user') ?>" data-idbarang="<?= $data->id_barang ?>" data-namabarang="<?= $data->nama ?>" id="btn-harian" data-toggle="modal" data-target="#modalHarian" href="#" class="btn btn-primary">Harian</a>
                                       <a onclick="openModalPinjamanBawaPulang(this)" data-idpeminjam="<?php echo $this->session->userdata('id_user') ?>" data-idbarang="<?= $data->id_barang ?>" data-namabarang="<?= $data->nama ?>" data-kondisibarang="<?= $data->kondisi ?>" id="btn-bawapulang" data-toggle="modal" data-target="#modalBawaPulang" href="#" class="btn btn-success">Bawa Pulang</a>

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
            <div class="modal fade" id="modalHarian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Peminjaman Harian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-8">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Nama Barang</label>
                                 <input class="form-control" type="text" readonly id="namabarangpinjamanharian" name="namabarangpinjamanharian">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Jumah</label>
                                 <input class="form-control" style="text-align: right;" value="1" type="number" id="jumlahpinjamanharian" name="jumlahpinjamanharian">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="btn-savepinjamanharian" type="button" class="btn btn-primary">Submit</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal fade" id="modalBawaPulang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Peminjaman Bawa Pulang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-8">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Nama Barang</label>
                                 <input class="form-control" type="text" readonly id="namabarangpinjamanbawapulang" name="namabarangpinjamanbawapulang">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Kondisi Barang</label>
                                 <input class="form-control" readonly type="text" id="kondisibarang" name="kondisibarang">
                              </div>
                           </div>

                        </div>
                        <div class="row">
                           <div class="col-md-8">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Estimasi Pengembalian</label>
                                 <input class="form-control" type="date" id="estimasipengembalian" name="estimasipengembalian">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Jumah</label>
                                 <input class="form-control" style="text-align: right;" value="1" type="number" id="jumlahpinjamanbawapulang" name="jumlahpinjamanbawapulang">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <label for="exampleFormControlTextarea1">alasanpinjam</label>
                              <textarea class="form-control" id="alasanpinjam" name="alasanpinjam"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="btn-savepinjamanbawapulang" type="button" class="btn btn-primary">Submit</button>
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
<!-- Function Javascript -->
<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<script>
   function openModalPinjamHarian(elem) {
      const namaBarang = $(elem).data("namabarang");
      const idBarang = $(elem).data("idbarang");
      const idPeminjam = $(elem).data("idpeminjam");

      $("#namabarangpinjamanharian").attr("value", namaBarang);

      $('#btn-savepinjamanharian').on('click', function() {
         const data = {
            id_peminjam: idPeminjam,
            quantity: $('#jumlahpinjamanharian').val(),
         };
         $.ajax({
            url: '<?= base_url($this->session->userdata('menu')) ?>/pinjam_harian/' + idBarang,
            method: 'POST',
            data: data,
            success: function(response) {
               if (response.status == 'ok') {
                  Swal.fire({
                     icon: 'success',
                     title: '',
                     text: 'Peminjaman harian berhasil disimpan'
                  }).then(function() {
                     window.location.reload();
                  });
               }
            },
            error: function(error) {}
         });
      });
   }

   function openModalPinjamanBawaPulang(elem) {
      const namaBarang = $(elem).data("namabarang");
      const kondisiBarang = $(elem).data("kondisibarang");
      const idBarang = $(elem).data("idbarang");
      const idPeminjam = $(elem).data("idpeminjam");

      $("#namabarangpinjamanbawapulang").attr("value", namaBarang);
      $("#kondisibarang").attr("value", kondisiBarang);

      $('#btn-savepinjamanbawapulang').on('click', function() {
         const data = {
            id_peminjam: idPeminjam,
            quantity: $('#jumlahpinjamanbawapulang').val(),
            estimasipengembalian: $('#estimasipengembalian').val(),
            kondisibarang: $('#kondisibarang').val(),
            alasanpinjam: $('#alasanpinjam').val(),
         };

         if ($('#estimasipengembalian').val() == "" || $('#kondisibarang').val() == "" || $('#alasanpinjam').val() == "") {
            Swal.fire({
               icon: 'warning',
               title: '',
               text: 'Data belum lengkap'
            }).then(function() {
               window.location.reload();
            });
         } else {
            $.ajax({
               url: '<?= base_url($this->session->userdata('menu')) ?>/pinjam_pulang/' + idBarang,
               method: 'POST',
               data: data,
               success: function(response) {
                  if (response.status == 'ok') {
                     Swal.fire({
                        icon: 'success',
                        title: '',
                        text: 'Peminjaman bawa pulang berhasil disimpan'
                     }).then(function() {
                        window.location.reload();
                     });
                  }
               },
               error: function(error) {}
            });
         }

      });
   }
</script>
<!-- /.content-wrapper -->