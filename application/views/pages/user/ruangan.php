<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Ruangan</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                  <li class="breadcrumb-item active">Ruangan</li>
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
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Ruangan</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Lokasi Ruangan</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Foto Ruangan</th>
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
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->nama ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%"><?php echo $data->lokasi ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                       <img src="<?php echo $data->foto_ruangan ?>" alt="<?php echo $data->nama ?>" width="60%">
                                    </td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="12%">
                                       <a onclick="openModalPinjamRuangan(this)" data-idpeminjam="<?php echo $this->session->userdata('id_user') ?>" data-idruangan="<?= $data->id_ruangan ?>" data-namaruangan="<?= $data->nama ?>" id="btn-pinjamruangan" data-toggle="modal" data-target="#modalPinjamRuangan" href="#" class="btn btn-success">Pinjam Ruangan</a>
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
            <div class="modal fade" id="modalPinjamRuangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Peminjaman Ruangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Nama Ruangan</label>
                                 <input class="form-control" type="text" readonly id="namaruangan" name="namaruangan">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Nama Acara</label>
                                 <input class="form-control" type="text" id="namaacara" name="namaacara">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Kebutuhan</label>
                                 <input class="form-control" type="text" id="kebutuhan" name="kebutuhan">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Keterangan</label>
                                 <input class="form-control" type="text" id="keterangan" name="keterangan">
                              </div>
                           </div>
                        </div>
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="exampleFormControlTextarea1">Tanggal Acara</label>
                                     <input class="form-control" type="date" id="tgl_acara" name="tgl_acara">
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="btn-savepinjamanruangan" type="button" class="btn btn-primary">Submit</button>
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
   function openModalPinjamRuangan(elem) {
      const namaRuangan = $(elem).data("namaruangan");
      const idRuangan = $(elem).data("idruangan");
      const idPeminjam = $(elem).data("idpeminjam");

      $("#namaruangan").attr("value", namaRuangan);

      $('#btn-savepinjamanruangan').on('click', function() {
         const data = {
            id_peminjam: idPeminjam,
            namaacara: $('#namaacara').val(),
            kebutuhan: $('#kebutuhan').val(),
            keterangan: $('#keterangan').val(),
             tglacara: $('#tgl_acara').val(),
         };
         if ($('#tgl_acara').val() == "" || $('#kebutuhan').val() == "" || $('#keterangan').val() == "" || $('#namaacara').val() == "") {
            Swal.fire({
               icon: 'warning',
               title: '',
               text: 'Data belum lengkap'
            }).then(function() {
               window.location.reload();
            });
         } else {
            $.ajax({
               url: '<?= base_url($this->session->userdata('menu')) ?>/pinjam_ruangan/' + idRuangan,
               method: 'POST',
               data: data,
               success: function(response) {
                  if (response.status == 'ok') {
                     Swal.fire({
                        icon: 'success',
                        title: '',
                        text: 'Peminjaman ruangan berhasil disimpan'
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