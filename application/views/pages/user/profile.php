<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a class="text-info" href="<?= base_url($this->session->userdata('menu')) ?>">Home</a></li>
                  <li class="breadcrumb-item active">Profile</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-3">
               <!-- Profile Image -->
               <form>
                  <div class="card card-primary card-outline">
                     <div class="card-body box-profile">
                        <div class="text-center">
                           <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/profile/') . $user->image ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $user->nama ?></h3>

                        <ul class="list-group list-group-unbordered">
                           <li class="list-group-item">
                              <b>Nama</b><br> <input readonly type="text" class="form-control" id="name" name="name" value="<?= $user->nama ?>"><input type="hidden" class="form-control" id="id_user" name="id" value="<?= $user->id_user ?>" readonly>
                           </li>
                           <li class="list-group-item">
                              <b>Username</b><br> <input type="text" name="username" class="form-control" value="<?= $user->username ?>" disabled>
                           </li>
                        </ul>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </form>
               <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
               <div class="card card-primary card-outline">
                  <div class="card-header p-2">
                     <h4>Ubah Password</h4>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                     <form action="<?= base_url($this->session->userdata('menu')) ?>/profile-ubahpassword" method="post">
                        <div class="box-body">
                           <div class="row">
                              <div class="col-md-6">
                                 <label for="current_password">Current Password</label>
                                 <div class="input-group">
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $user->id_user ?>" readonly>
                                    <input type="password" class="form-control" id="current_password" name="current_password">
                                    <div class="input-group-append">
                                       <div class="input-group-text bg-white border-left-0 <?= (form_error('password')) ? 'border-danger rounded-right' : ''; ?>">
                                          <a role="button" onclick="previewPassword(this, 'current_password')"><span class="fa fa-fw fa-sm fa-eye-slash text-black-50"></span></a>
                                       </div>
                                    </div>
                                 </div>
                                 <?= form_error('current_password', '<small class="text-danger pl-2">', '</small>'); ?>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="new_password1">New Password</label>
                                    <div class="input-group">
                                       <input type="password" class="form-control" id="new_password1" name="new_password1">
                                       <div class="input-group-append">
                                          <div class="input-group-text bg-white border-left-0">
                                             <a role="button" onclick="previewPassword(this, 'new_password1')"><span class="fa fa-fw fa-sm fa-eye-slash text-black-50"></span></a>
                                          </div>
                                       </div>
                                    </div>
                                    <?= form_error('new_password1', '<small class="text-danger pl-2">', '</small>'); ?>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="new_password2">Confirm New Password</label>
                                    <div class="input-group">
                                       <input type="password" class="form-control" id="new_password2" name="new_password2">
                                       <div class="input-group-append">
                                          <div class="input-group-text bg-white border-left-0 <?= (form_error('password')) ? 'border-danger rounded-right' : ''; ?>">
                                             <a role="button" onclick="previewPassword(this, 'new_password2')"><span class="fa fa-fw fa-sm fa-eye-slash text-black-50"></span></a>
                                          </div>
                                       </div>
                                    </div>
                                    <?= form_error('new_password2', '<small class="text-danger pl-2">', '</small>'); ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- /.card-body -->
                        <button type="submit" style="margin-top: 10px;" class="btn btn-primary" title="Simpan">Ubah Password</button>
                     </form>
                     <!-- /.tab-content -->
                  </div><!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>