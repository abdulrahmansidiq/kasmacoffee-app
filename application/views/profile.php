<section class="content-header">
  <h1>
    Profile
    <small>Pengguna</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Profile</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-4">
      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <?php 
            $user_photo = $this->fungsi->user_login()->photo;
            $photo_url = !empty($user_photo) ? base_url('uploads/profile/'.$user_photo) : base_url('assets/dist/img/user2-160x160.jpg');
          ?>
          <img class="profile-user-img img-responsive img-circle" src="<?= $photo_url ?>" alt="User profile picture">

          <h3 class="profile-username text-center"><?= $this->fungsi->user_login()->name; ?></h3>

          <p class="text-muted text-center"><?= ucfirst($this->fungsi->user_login()->level == 1 ? "Admin" : "Kasir"); ?></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Nama</b> <a class="pull-right"><?= $this->fungsi->user_login()->name; ?></a>
            </li>
            <li class="list-group-item">
              <b>Username</b> <a class="pull-right"><?= $this->fungsi->user_login()->username; ?></a>
            </li>
            <li class="list-group-item">
              <b>Alamat</b> <a class="pull-right"><?= $this->fungsi->user_login()->address; ?></a>
            </li>
          </ul>

          <!-- Form Upload Foto -->
          <?= form_open_multipart('profile/upload_photo'); ?>
            <div class="form-group text-center">
              <label for="photo">Ganti Foto Profil</label>
              <input type="file" name="photo" id="photo" class="form-control" style="margin-bottom:10px;" required>
              <button type="submit" class="btn btn-primary btn-block"><b>Upload Foto</b></button>
            </div>
          <?= form_close(); ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ganti Password</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?= site_url('profile/change_password') ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="old_password">Password Lama</label>
              <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Masukkan password lama" required>
            </div>
            <div class="form-group">
              <label for="new_password">Password Baru</label>
              <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Masukkan password baru" required minlength="5">
            </div>
            <div class="form-group">
              <label for="conf_password">Konfirmasi Password Baru</label>
              <input type="password" name="conf_password" id="conf_password" class="form-control" placeholder="Ulangi password baru" required minlength="5">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Password</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
