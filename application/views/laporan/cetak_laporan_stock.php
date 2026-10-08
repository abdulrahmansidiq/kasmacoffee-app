<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/Ionicons/css/ionicons.min.css">

</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h4 class="page-header" style="text-align: center;">
          Laporan Stock
          <br>
          Malabar Mountain Coffee Pangalengan 
        </h4>
      </div>
      <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped" align="center" ">
          <?php
          if(isset($_GET['stock_barang']))
          {
              $stock_barang = $_GET['stock_barang'];
          ?>
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Item</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Stock</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if ($stock_barang == "semua"){
              $query = $this->db->query("SELECT i.*, c.name as category_name, u.name as unit_name FROM item i JOIN category c ON i.category_id = c.category_id JOIN unit u ON i.unit_id = u.unit_id")->result();
          }
          else{
              $query = $this->db->query("SELECT i.*,  c.name as category_name, u.name as unit_name FROM item i JOIN category c ON i.category_id = c.category_id JOIN unit u ON i.unit_id = u.unit_id WHERE i.item_id = '$stock_barang'")->result();
          }
          foreach($query as $key => $data)
          {
          ?>
          <tr>
            <td style="text-align:center;"><?= $no++ ?></td>
            <td style="text-align:center;"><?= indo_date($data->created) ?></td>
            <td style="text-align:left;"><?= $data->name ?></td>
            <td style="text-align:left;"><?= $data->category_name?></td>
            <td style="text-align:center;"><?= $data->unit_name?></td>
            <td style="text-align:center;"><?= indo_currency($data->price)?></td>
            <td style="text-align:center;"><?= $data->stock?></td>
          </tr>
          <?php
          }
          ?>
          </tbody>
          <?php
          }
          ?>
        </table>
        <table align="center" style="width:750px; border:none;margin-top:5px;margin-bottom:20px;">
          <tr>
              <td align="right">Bandung, <?php echo date('d-M-Y')?></td>
          </tr>
      
          <tr>
          <td><br/><br/><br/><br/></td>
          </tr>    
          <tr>
              <td align="right">( <?= $this->fungsi->user_login()->name?> )</td>
          </tr>
          <tr>
              <td align="center"></td>
          </tr>
        </table>
      </div>
      <!-- /.col -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
