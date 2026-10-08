<section class="content-header">
  <h1>
    Stock
    <small>Barang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Stock</a></li>
    <li class="active">Stock Out</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"> Tambah Stock Out</h3>
      <div class="pull-right">
        <a href="<?= site_url('stock/out'); ?>" class="btn btn-default btn-flat">
          <i class="fa fa-undo"> Kembali</i>
        </a>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form action="<?= site_url('stock/proses_out') ?>" method="POST">
            <div class="form-group">
              <label>Tanggal</label>
              <input class="form-control" type="date" value="<?= date('Y-m-d') ?>" name="tanggal" required>
            </div>
            <div>
                <label>Kode Item</label>
            </div>
            <div class="form-group input-group">
                <input type="hidden" name="item_id" id="item_id">
                <input type="text" name="barcode" id="barcode" class="form-control" required autofocus>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                    <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            <div class="form-group">
              <label>Nama Item</label>
              <input class="form-control" type="text" name="item_name" id="item_name" readonly>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                        <label for="nama_unit">Nama Unit</label>
                        <input type="text" name="unit_name" id="unit_name" value="-" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="stock">Stock</label>
                        <input type="text" name="stock" id="stock" value="-" min="1" class="form-control" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label>Detail</label>
              <input class="form-control" type="text" value="" name="detail" required>
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input class="form-control" type="number" value="" name="qty" required>
            </div>

            <div class="form-group">
              <button type="submit" name="out_add" class="btn btn-success btn-flat">Simpan</button>
              <button type="reset" class="btn btn-default btn-flat">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="modal-item">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" >Pilih Item</h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered tabel-striped" id="table1">
            <thead>
                <tr>
                  <th>Kode Item</th>
                  <th>Nama</th>
                  <th>Unit</th>
                  <th>Harga</th>
                  <th>Stock</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($item as $i => $data){ ?>
                <tr>
                    <td><?= $data->barcode?></td>
                    <td><?= $data->name ?></td>
                    <td><?= $data->unit_name?></td>
                    <td><?= indo_currency($data->price)?></td>
                    <td><?= $data->stock?></td>
                    <td>
                      <button class="btn btn-xs btn-info" id="pilih" 
                      data-id="<?=$data->item_id?>"
                      data-barcode="<?=$data->barcode?>"
                      data-name="<?=$data->name?>"
                      data-unit="<?=$data->unit_name?>"
                      data-stock="<?=$data->stock?>">
                        <i class="fa fa-check"> Pilih</i>
                      </button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/')?>dist/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','#pilih', function(){
      var item_id = $(this).data('id');
      var barcode = $(this).data('barcode');
      var name = $(this).data('name'); 
      var unit_name = $(this).data('unit');
      var stock = $(this).data('stock');
      $('#item_id').val(item_id);
      $('#barcode').val(barcode);
      $('#item_name').val(name);
      $('#unit_name').val(unit_name);
      $('#stock').val(stock);
      $('#modal-item').modal('hide');
    });
  });
</script>