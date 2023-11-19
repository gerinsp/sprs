<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Kendaraan</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                  <li class="breadcrumb-item active">Kendaraan</li>
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

               <div class="shadow card">
                  <!-- /.card-header -->
                  <div class="card-body">
                     <div class="table-responsive">
                        <table style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" id="dataTable" class="table tablelist table-bordered table-striped" width="100%" height="1px" cellspacing="0">
                           <thead>
                              <tr height="20px">
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('number'); ?></th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Kendaraan</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Stok</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Lokasi</th>
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
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->stok ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->lokasi ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                       <a onclick="openModalPinjamKendaraan(this)" data-idpeminjam="<?php echo $this->session->userdata('id_user') ?>" data-idkendaraan="<?= $data->id_kendaraan ?>" data-namakendaraan="<?= $data->nama ?>" id="btn-pinjamkendaraan" data-toggle="modal" data-target="#modalPinjamKendaraan" href="#" class="btn btn-success">Pinjam Kendaraan</a>
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
            <div class="modal fade" id="modalPinjamKendaraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Peminjaman Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Nama Kendaraan</label>
                                 <input class="form-control" type="text" readonly id="namakendaraan" name="namakendaraan">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Kilometer Awal</label>
                                 <input class="form-control" style="text-align: right;" type="number" id="kilometerawal" name="kilometerawal">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Supir</label>
                                 <select class="form-control" name="supir" id="supir">
                                    <option value="">Pilih Supir</option>
                                    <?php foreach ($supir as $data) { ?>
                                       <option value="<?= $data->id_supir ?>"><?= $data->nama ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="btn-savepinjamankendaraan" type="button" class="btn btn-primary">Submit</button>
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
   function openModalPinjamKendaraan(elem) {
      const namaKendaraan = $(elem).data("namakendaraan");
      const idKendaraan = $(elem).data("idkendaraan");
      const idPeminjam = $(elem).data("idpeminjam");

      $("#namakendaraan").attr("value", namaKendaraan);

      $('#btn-savepinjamankendaraan').on('click', function() {
         const data = {
            id_peminjam: idPeminjam,
            kilometerawal: $('#kilometerawal').val(),
            supir: $('#supir').val(),
         };
         if ($('#supir').val() == "" || $('#kilometerawal').val() == "") {
            Swal.fire({
               icon: 'warning',
               title: '',
               text: 'Data belum lengkap'
            }).then(function() {
               window.location.reload();
            });
         } else {
            $.ajax({
               url: '<?= base_url($this->session->userdata('menu')) ?>/pinjam_kendaraan/' + idKendaraan,
               method: 'POST',
               data: data,
               success: function(response) {
                  if (response.status == 'ok') {
                     Swal.fire({
                        icon: 'success',
                        title: '',
                        text: 'Peminjaman kendaraan berhasil disimpan'
                     }).then(function() {
                        window.location.href = "<?= base_url($this->session->userdata('menu')) ?>/peminjaman"
                     });
                  }
               },
               error: function(error) {}
            });
         }
      });
   }
</script>