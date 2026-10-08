<section class="content-header">
  <h1>
    Data
    <small>Produk</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-user"></i> Category</a></li>
    <li class="active"><?= ucfirst($page) ?> Category</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= ucfirst($page) ?> Category</h3>
      <div class="pull-right">
        <a href="<?= site_url('category'); ?>" class="btn btn-default btn-flat">
          <i class="fa fa-undo"> Kembali</i>
        </a>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form action="<?= site_url('category/proses') ?>" method="POST">
            <div class="form-group">
              <label>Nama Category</label>
              <input value="<?= $row -> category_id ?>" type="hidden" name="id">
              <input class="form-control" value="<?= $row -> name ?>" type="text" name="nama" pattern="[a-z A-Z]+" required>
            </div>
            <div class="form-group">
              <button type="submit" name=<?=$page?> class="btn btn-success btn-flat">Simpan</button>
              <button type="reset" class="btn btn-default btn-flat">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>