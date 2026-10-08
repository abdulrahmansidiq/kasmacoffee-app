<section class="content-header">
  <h1>
    Data
    <small>Produk</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Produk</li>
  </ol>
</section>

<section class="content">
<?php $this->view('message');?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Stock In</h3>
      <div class="pull-right">
        <a href="<?= site_url('stock/in/tambah'); ?>" class="btn btn-primary btn-flat">
          <i class="fa fa-user-plus"> Tambah Stock In</i>
        </a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kode Item</th>
            <th>Produk Item</th>
            <th>Qty</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach($row as $key => $data){ ?>
          <tr>
            <td style="width:5% ;"><?= $no++ ?></td>
            <td><?= $data -> barcode ?></td>
            <td><?= $data -> item_name ?></td>
            <td class="text-right"><?= $data -> qty ?></td>
            <td clas="text-center"><?= indo_date($data -> date) ?></td>
            <td class="text-center" width="160px">
              <a href="#" class="btn btn-warning btn-xs ">

                <i id="detail1" class="fa fa-eye" data-toggle="modal" data-target="#modal-detail"
                data-barcode="<?=$data->barcode?>"
                data-itemname="<?=$data->item_name?>"
                data-qty="<?=$data->qty?>"
                data-date="<?= indo_date($data -> date) ?>"
                data-detail="<?=$data->detail?>"
                > Detail</i>
              </a>
              <a href="<?= site_url('stock/in/hapus/'.$data->stock_id.'/'.$data->item_id); ?>" onclick="return confirm('Apakah Data Ini Ingin Dihapus ?')" class="btn btn-danger btn-xs ">
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


<div class="modal fade" id="modal-detail">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" >Detail Stock</h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered no-margin">
            <tbody>
                <tr>
                    <th style="width:35%">Kode Item</th>
                    <td><span id="barcode"></span></td>
                </tr>
                <tr>
                    <th style="">Nama Item</th>
                    <td><span id="item_name"></span></td>
                </tr>
                <tr>
                    <th style="">Quantity</th>
                    <td><span id="qty"></span></td>
                </tr>
                <tr>
                    <th style="">Tanggal</th>
                    <td><span id="date"></span></td>
                </tr>
                <tr>
                    <th style="">Detail</th>
                    <td><span id="detail"></span></td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/')?>dist/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','#detail1', function(){
      var barcode = $(this).data('barcode');
      var itemname = $(this).data('itemname');
      var qty = $(this).data('qty');
      var date = $(this).data('date');
      var detail = $(this).data('detail');
      $('#barcode').text(barcode);
      $('#item_name').text(itemname);
      $('#qty').text(qty);
      $('#date').text(date);
      $('#detail').text(detail);
    });
  });
</script>