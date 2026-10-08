<section class="content-header">
  <h1>
    Data
    <small>Produk</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Produk</li>
    <li class="active">Item</li>
  </ol>
</section>

<section class="content">
<?php $this->view('message');?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Item</h3>
      <div class="pull-right">
        <a href="<?= site_url('item/tambah'); ?>" class="btn btn-primary btn-flat">
          <i class="fa fa-user-plus"> Tambah Item</i>
        </a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kode Item</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Satuan Unit</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach($row->result() as $key => $data){ ?>
          <tr>
            <td style="width:5% ;"><?= $no++ ?></td>
            <td><?= $data -> barcode ?></td>
            <td><?= $data -> name ?></td>
            <td><?= $data -> category_name ?></td>
            <td><?= $data -> unit_name ?></td>
            <td><?= indo_currency($data -> price) ?></td>
            <td>
              <?php if($data->image != null){ ?>
                <img src="<?= base_url('uploads/produk/'.$data -> image) ?>" style="width:100px;">
              <?php } ?>
            </td>
            <td><?= $data -> stock ?></td>
            <td class="text-center" width="160px">
              <a href="<?= site_url('item/ubah/'.$data->item_id); ?>" class="btn btn-warning btn-xs ">
                <i class="fa fa-pencil"> Ubah</i>
              </a>
              <a href="<?= site_url('item/hapus/'.$data->item_id); ?>" onclick="return confirm('Apakah Data Ini Ingin Dihapus ?')" class="btn btn-danger btn-xs ">
                <i class="fa fa-trash"> Hapus</i>
              </a>
            </td>
          </tr>
          <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>