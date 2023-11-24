<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <!-- <a href="index3.html" class="brand-link">
      <img src="<?= base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
   </a> -->

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <a href="<?= base_url('profile') ?>" class="d-block">
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
               <?php if (!$user->image) { ?>
                  <img src="<?= base_url('assets/img/profile/default.png') ?>" class="img-circle elevation-2" alt="User Image">
               <?php } else { ?>
                  <img src="<?= $user->image ?>" class="img-circle elevation-2" alt="User Image">
               <?php } ?>
            </div>
            <div class="info">
               <p style="margin-bottom: 0px;"><?= $user->nama ?></p>
            </div>
         </div>
      </a>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
               <a href="<?= base_url($this->session->userdata('menu')) ?>" class="nav-link <?php if (!$this->uri->segment(2)) {
                                                                                                echo "active";
                                                                                             } ?>">
                  <i class=" nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>
            <?php if ($user->id_role == 1 || $user->id_role == 4) : ?>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/barang' ?>" class="nav-link <?php if ($this->uri->segment(2) == "barang") {
                                                                                                               echo "active";
                                                                                                            } ?>">
                     <i class=" nav-icon fa fa-users"></i>
                     <p>
                        Data Barang
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/kendaraan' ?>" class="nav-link <?php if ($this->uri->segment(2) == "kendaraan") {
                                                                                                                  echo "active";
                                                                                                               } ?>">
                     <i class=" nav-icon fa fa-book"></i>
                     <p>
                        Data Kendaraan
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/ruangan' ?>" class="nav-link <?php if ($this->uri->segment(2) == "ruangan") {
                                                                                                               echo "active";
                                                                                                            } ?>">
                     <i class="nav-icon fas fa-map-marker-alt"></i>
                     <p>
                        Data Ruangan
                     </p>
                  </a>
               </li>
            <?php endif; ?>
            <?php if ($user->id_role == 1) : ?>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/peminjam' ?>" class="nav-link <?php if ($this->uri->segment(2) == "peminjam") {
                                                                                                               echo "active";
                                                                                                            } ?>">
                     <i class=" nav-icon fas fa-chart-bar"></i>
                     <p>
                        Data Peminjam
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/supir' ?>" class="nav-link <?php if ($this->uri->segment(2) == "supir") {
                                                                                                            echo "active";
                                                                                                         } ?>">
                     <i class="nav-icon fas fa-map-marker-alt"></i>
                     <p>
                        Data Supir
                     </p>
                  </a>
               </li>

            <?php endif; ?>

            <?php if ($user->id_role != 4) : ?>
               <li class="nav-header">Transaksi</li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/permintaan' ?>" class="nav-link <?php if ($this->uri->segment(2) == "permintaan") {
                                                                                                                  echo "active";
                                                                                                               } ?>">
                     <i class="nav-icon fas fa-hand-holding"></i>
                     <p>
                        Permintaan
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/peminjaman' ?>" class="nav-link <?php if ($this->uri->segment(2) == "peminjaman") {
                                                                                                                  echo "active";
                                                                                                               } ?>">
                     <i class="nav-icon fas fa-recycle"></i>
                     <p>
                        Peminjaman
                     </p>
                  </a>
               </li>

                <?php if ($user->id_role == 1) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($this->session->userdata('menu')) . '/riwayat-peminjaman-ditolak' ?>" class="nav-link <?php if ($this->uri->segment(2) == "riwayat-peminjaman-ditolak") {
                            echo "active";
                        } ?>">
                            <i class="nav-icon fas fa-recycle"></i>
                            <p>
                                Peminjaman Ditolak
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
               <li class="nav-header">Riwayat Peminjaman</li>
               <?php if ($user->id_role == 1) : ?>
                  <li class="nav-item">
                     <a href="<?= base_url($this->session->userdata('menu')) . '/peminjaman-harian' ?>" class="nav-link <?php if ($this->uri->segment(2) == "peminjaman-harian") {
                                                                                                                           echo "active";
                                                                                                                        } ?>">
                        <i class="nav-icon fas fa-calendar-day"></i>
                        <p>
                           Barang Harian
                        </p>
                     </a>
                  </li>
               <?php endif; ?>
               <?php if ($user->id_role != 3) : ?>
                  <li class="nav-item">
                     <a href="<?= base_url($this->session->userdata('menu')) . '/peminjaman-pulang' ?>" class="nav-link <?php if ($this->uri->segment(2) == "peminjaman-pulang") {
                                                                                                                           echo "active";
                                                                                                                        } ?>">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                           Barang Bawa Pulang
                        </p>
                     </a>
                  </li>
               <?php endif; ?>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/peminjaman-kendaraan' ?>" class="nav-link <?php if ($this->uri->segment(2) == "peminjaman-kendaraan") {
                                                                                                                           echo "active";
                                                                                                                        } ?>">
                     <i class="nav-icon fas fa-car"></i>
                     <p>
                        Kendaraan
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/peminjaman-ruangan' ?>" class="nav-link <?php if ($this->uri->segment(2) == "peminjaman-ruangan") {
                                                                                                                           echo "active";
                                                                                                                        } ?>">
                     <i class="nav-icon fas fa-building"></i>
                     <p>
                        Ruangan
                     </p>
                  </a>
               </li>

               <?php if ($user->id_role == 3 || $user->id_role == 2) : ?>
                  <li class="nav-header">Status Peminjaman</li>
                   <?php if ($user->id_role == 2) : ?>
                        <li class="nav-item">
                            <a href="<?= base_url($this->session->userdata('menu')) . '/status-peminjaman-pulang' ?>" class="nav-link <?php if ($this->uri->segment(2) == "status-peminjaman-pulang") {
                                echo "active";
                            } ?>">
                                <i class="nav-icon fas fa-shopping-bag"></i>
                                <p>
                                    Barang Bawa Pulang
                                </p>
                            </a>
                        </li>
                   <?php endif; ?>
                  <li class="nav-item">
                     <a href="<?= base_url($this->session->userdata('menu')) . '/status-peminjaman-kendaraan' ?>" class="nav-link <?php if ($this->uri->segment(2) == "status-peminjaman-kendaraan") {
                                                                                                                                       echo "active";
                                                                                                                                    } ?>">
                        <i class="nav-icon fas fa-car"></i>
                        <p>
                           Kendaraan
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?= base_url($this->session->userdata('menu')) . '/status-peminjaman-ruangan' ?>" class="nav-link <?php if ($this->uri->segment(2) == "status-peminjaman-ruangan") {
                                                                                                                                    echo "active";
                                                                                                                                 } ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                           Ruangan
                        </p>
                     </a>
                  </li>
               <?php endif; ?>
            <?php endif; ?>
            <?php if ($user->id_role == 4) : ?>
               <li class="nav-header">Transaksi</li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/peminjaman' ?>" class="nav-link <?php if ($this->uri->segment(2) == "peminjaman") {
                                                                                                                  echo "active";
                                                                                                               } ?>">
                     <i class="nav-icon fas fa-recycle"></i>
                     <p>
                        Peminjaman
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/riwayat-peminjaman-ditolak' ?>" class="nav-link <?php if ($this->uri->segment(2) == "riwayat-peminjaman-ditolak") {
                                                                                                                                 echo "active";
                                                                                                                              } ?>">
                     <i class="nav-icon fas fa-recycle"></i>
                     <p>
                        Peminjaman Ditolak
                     </p>
                  </a>
               </li>
               <li class="nav-header">Riwayat Peminjaman</li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/riwayat-peminjaman-barang' ?>" class="nav-link <?php if ($this->uri->segment(2) == "riwayat-peminjaman-barang") {
                                                                                                                                 echo "active";
                                                                                                                              } ?>">
                     <i class="nav-icon fas fa-calendar-day"></i>
                     <p>
                        Barang
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/riwayat-peminjaman-kendaraan' ?>" class="nav-link <?php if ($this->uri->segment(2) == "riwayat-peminjaman-kendaraan") {
                                                                                                                                    echo "active";
                                                                                                                                 } ?>">
                     <i class="nav-icon fas fa-car"></i>
                     <p>
                        Kendaraan
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url($this->session->userdata('menu')) . '/riwayat-peminjaman-ruangan' ?>" class="nav-link <?php if ($this->uri->segment(2) == "riwayat-peminjaman-ruangan") {
                                                                                                                                 echo "active";
                                                                                                                              } ?>">
                     <i class="nav-icon fas fa-building"></i>
                     <p>
                        Ruangan
                     </p>
                  </a>
               </li>
            <?php endif; ?>
            <li class="nav-header">Profil</li>
            <li class="nav-item">
               <a href="<?= base_url($this->session->userdata('menu')) . '/profile' ?>" class="nav-link <?php if ($this->uri->segment(2) == "profile") {
                                                                                                            echo "active";
                                                                                                         } ?>">
                  <i class=" nav-icon fas fa-user"></i>
                  <p>Profil</p>
               </a>
            </li>
            <li class="nav-header">Keluar</li>
            <li class="nav-item">
               <a href="#" data-toggle="modal" data-target="#logoutModal" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>Logout</p>
               </a>
            </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>