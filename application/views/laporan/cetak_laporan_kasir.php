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
            Laporan Penjualan
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
            if(isset($_GET['tgl_awal']))
            {
                $tgl_awal = $_GET['tgl_awal'];
                $tgl_akhir = $_GET['tgl_akhir'];
                $tgl_awal = date("Y-m-d 00:00:00", strtotime($tgl_awal));
                $tgl_akhir = date("Y-m-d 23:59:59", strtotime($tgl_akhir));
                $penjualan = $_GET['penjualan'];
            ?>
            <thead>
                <tr>
                    <th style="width:px">Invoice</th>
                    <th style="width:100px">Tanggal</th>
                    <th>Customer</th>
                    <th style="width:100px">Sub Total</th>
                    <th style="width:100px">Diskon</th>
                    <th style="width:100px">Grand Total</th>
                    <th style="width:100px">Cash</th>
                </tr>
            </thead>
          <tbody>
                <?php
                if($penjualan == "semua"){
                    $query = $this->db->query("SELECT kd.*, k.invoice as kasir_invoice, k.created as kasir_created, c.name as customer_name, k.discount as kasir_discount, k.final_price as kasir_final_price, k.cash as kasir_cash, i.name as item_name, k.total_price as kasir_total_price FROM kasir_detail kd JOIN kasir k ON kd.kasir_id = k.kasir_id JOIN customer c ON k.customer_id = c.customer_id JOIN item i ON kd.item_id = i.item_id WHERE k.created >= '$tgl_awal' AND k.created <= '$tgl_akhir'")->result();
                }else{
                    $query = $this->db->query("SELECT kd.*, k.invoice as kasir_invoice, k.created as kasir_created, c.name as customer_name, k.discount as kasir_discount, k.final_price as kasir_final_price, k.cash as kasir_cash, i.name as item_name, k.total_price as kasir_total_price FROM kasir_detail kd JOIN kasir k ON kd.kasir_id = k.kasir_id JOIN customer c ON k.customer_id = c.customer_id JOIN item i ON kd.item_id = i.item_id WHERE k.created >= '$tgl_awal' AND k.created <= '$tgl_akhir' AND i.item_id = '$penjualan'")->result();
                }
                foreach($query as $data)
                {
                ?>
                <tr>
                    <td style="text-align:center;"><?= $data->kasir_invoice ?></td>
                    <td style="text-align:center;"><?= indo_date($data->kasir_created)?></td>
                    <td style="text-align:left;"><?= $data->customer_name ?></td>
                    <td style="text-align:center;"><?= $data->total?></td>
                    <td style="text-align:center;"><?= $data->kasir_discount?></td>
                    <td style="text-align:center;"><?= $data->kasir_final_price?></td>
                    <td style="text-align:center;"><?= $data->kasir_cash?></td>
                </tr>

                <tr>
                    <th colspan="3">Nama Item</th>
                    <th>Harga Item</th>
                    <th>Qty</th>
                    <th>Diskon Item</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center;"><?= $data->item_name?></td>
                    <td style="text-align:center;"><?= $data->price?></td>
                    <td style="text-align:center;"><?= $data->qty?></td>
                    <td style="text-align:center;"><?= $data->discount_item?></td>
                    <td style="text-align:center;"><?= $data->total?></td>
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
