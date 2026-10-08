<section class="content-header">
  <h1>
    Data
    <small>Produk</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-user"></i> Item</a></li>
    <li class="active"><?= ucfirst($page) ?> Item</li>
  </ol>
</section>

<section class="content">
<?php $this->view('message');?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= ucfirst($page) ?> Item</h3>
      <div class="pull-right">
        <a href="<?= site_url('item'); ?>" class="btn btn-default btn-flat">
          <i class="fa fa-undo"> Kembali</i>
        </a>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <?= form_open_multipart('item/proses') ?>
						<div class="form-group">
              <label>Kode Item *</label>
              <input value="<?= $row -> item_id ?>" type="hidden" name="id">
              <input class="form-control" value="<?= $row -> barcode ?>" type="text" name="barcode" required>
            </div>
						<div class="form-group">
              <label>Nama Produk *</label>
              <input class="form-control" value="<?= $row -> name ?>" type="text" name="nama" required>
            </div>
						<div class="form-group">
              <label>Kategori *</label>
              <select name="category" class="form-control" required>
                <option value="">- Pilih -</option>
                <?php foreach($category->result() as $key => $data) { ?>
									<option value="<?= $data->category_id ?>" <?= $data->category_id == $row -> category_id ? "selected" : null ?>><?= $data->name ?></option>
                <?php } ?>
              </select>
            </div>
						<div class="form-group">
              <label>Unit *</label>
                <?php echo form_dropdown('unit', $unit, $selectedunit, 
                ['class' => 'form-control','required' => 'required']) ?>
            </div>
						<div class="form-group">
              <label>Harga *</label>
              <input class="form-control" value="<?= $row -> price ?>" type="number" name="harga" min="1000" required>
            </div>
            <div class="form-group">
              <label>Gambar Barang</label>
              <?php if($page == 'ubah'){ 
                if($row->image != null) { ?>
                <div style="margin-bottom:6px" >
                  <img src="<?= base_url('uploads/produk/'.$row -> image) ?>" style="width:80%;">
                </div>
              <?php } 
              }
              ?>
              <input class="form-control" type="file" name="image">
            </div>
            <div class="form-group">
              <button type="submit" name=<?=$page?> class="btn btn-success btn-flat">Simpan</button>
              <button type="reset" class="btn btn-default btn-flat">Reset</button>
            </div>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</section>