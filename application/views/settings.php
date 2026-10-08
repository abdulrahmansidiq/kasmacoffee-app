<section class="content-header">
  <h1>
    Settings
    <small>Pengaturan Aplikasi</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Settings</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Pengaturan Umum</h3>
        </div>
        <div class="box-body">
          <?= form_open_multipart('settings/update'); ?>
            <div class="form-group">
              <label for="nama_usaha">Nama Usaha</label>
              <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" value="<?= htmlspecialchars($setting->nama_usaha ?? '') ?>" required>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" id="alamat" class="form-control" rows="3"><?= htmlspecialchars($setting->alamat ?? '') ?></textarea>
            </div>
            <div class="form-group">
              <label for="telepon">No Telepon / WhatsApp</label>
              <input type="text" name="telepon" id="telepon" class="form-control" value="<?= htmlspecialchars($setting->telepon ?? '') ?>">
            </div>
            <div class="form-group">
              <label for="logo">Logo Usaha</label>
              <?php if (!empty($setting->logo)) { ?>
                <div style="margin-bottom:10px;">
                  <img src="<?= base_url('uploads/'.$setting->logo) ?>" alt="Logo" style="height: 80px; object-fit: contain;">
                </div>
              <?php } ?>
              <input type="file" name="logo" id="logo" class="form-control">
              <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo.</small>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Pengaturan</button>
            </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
