<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
   $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

<script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.dateTime.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>

<!-- Select2 -->
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/dist/js/pages/dashboard.js') ?>"></script> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Lightbox -->
<script src="<?= base_url('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>

<script src="https://a.kabachnik.info/assets/js/libs/quagga.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- leafllet -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>


<script>
   $(document).ready(function() {
      $('.tablelist').DataTable({});
   });
</script>

<script>
   $(document).ready(function() {
      const table1 = $('.table-laporan').DataTable({
         buttons: [{
            extend: 'excel',
            className: 'btn-primary',
            style: {
               background: 'red',
               color: 'blue'
            }
         }]
      });
      table1.buttons('.buttons-excel').container().hide();
      $('.btn-export').on('click', () => {
         table1.buttons('.buttons-excel').trigger();
         console.log('tombol export di klik');
      })
   });
</script>

<script>
   $(function() {
      // Summernote
      $('#summernote').summernote()

   })
   $(function() {
      $('.select2').select2({
         placeholder: "Select An Option"
      })
   })
</script>
<script>

</script>
<script>
   $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
         event.preventDefault();
         var dataGalleryValue = $(this).data('gallery'); // Ambil nilai data-gallery dari elemen yang di-klik
         $(this).ekkoLightbox({
            alwaysShowClose: true,
            gallery_parent: dataGalleryValue // Atur gallery_parent dengan nilai data-gallery
         });
      });
   })
</script>

<script>
   <?php if ($this->session->flashdata('success')) { ?>
      var isi = <?php echo json_encode($this->session->flashdata('success')) ?>

      Swal.fire({
         icon: 'success',
         title: 'Berhasil',
         text: isi
      })
   <?php } ?>
   <?php if ($this->session->flashdata('error')) { ?>
      var isi = <?php echo json_encode($this->session->flashdata('error')) ?>

      Swal.fire({
         icon: 'error',
         title: 'Gagal',
         text: isi
      })
   <?php } ?>
   <?php if ($this->session->flashdata('warning')) { ?>
      var isi = <?php echo json_encode($this->session->flashdata('warning')) ?>

      Swal.fire({
         icon: 'warning',
         title: 'Peringatan',
         text: isi
      })
   <?php } ?>
   <?php if ($this->session->flashdata('warningimport')) { ?>
      var isi = <?php echo json_encode($this->session->flashdata('warningimport')) ?>

      Swal.fire({
         icon: 'warning',
         title: '<h5 style:"margin-bottom:0px;padding-bottom:0px">Silahkan cek kembali field sku produk berdasarkan data di bawah :</h5>',
         text: isi
      })
   <?php } ?>
</script>

<script>
   function formatNumber(number) {
      return new Intl.NumberFormat('id-ID', {
         minimumFractionDigits: 2,
         maximumFractionDigits: 2,
      }).format(number);
   }

   function converttanggalIndo(string) {
      bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

      tanggal = string.split("-")[2];
      bulan = string.split("-")[1];
      tahun = string.split("-")[0];

      return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun;
   }
</script>
</body>

</html>