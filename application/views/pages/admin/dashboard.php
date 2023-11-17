<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="content pb-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Peminjaman Kendaraan
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold">
                                        <?= $kendaraan ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="nav-icon fas fa-car fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Peminjaman Ruangan
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold">
                                        <?= $ruangan ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="nav-icon fas fa-building fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Peminjaman Barang Harian
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold">
                                        <?= $barang_harian ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="nav-icon fas fa-calendar-day fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Peminjaman Barang Pulang
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold">
                                        <?= $barang_pulang ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="nav-icon fas fa-shopping-bag fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Supir
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold">
                                        <?= $supir ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="nav-icon fas fa-shopping-bag fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                        Peminjam
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold">
                                        <?= $peminjam ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="nav-icon fas fa-shopping-bag fa-2x text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>