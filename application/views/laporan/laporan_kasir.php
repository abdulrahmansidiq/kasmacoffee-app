<section class="content-header">
	<h1>
		Laporan Kasir
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Laporan</li>
	</ol>
</section>

<section class="content">
	<div class="col">
		<div class="box box-primary">
			<div class="box-body">
				<form action="<?= base_url('laporan/laporan_kasir') ?>" method="POST" autocomplete="off">
					<div class="form-group">
						<label>Date:</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right date-picker" id="tgl_awal" name="tgl_awal" autocomplete="off" required>
						</div>
					</div>

					<div class="form-group">
						<label>Date range:</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right date-picker" id="tgl_akhir" name="tgl_akhir" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group">
						<label>Nama Item</label>
						<select class="form-control" id="penjualan" name="penjualan">
							<option value="semua">Semua</option>
							<?php
							foreach ($row->result() as $key => $data) {
							?>
								<option value="<?php echo $data->item_id ?>"><?php echo $data->name ?></option>
							<?php
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<button type="submit" id="cetak_kasir" class="btn btn-success btn-flat">
							<i class="fa fa-save"> Simpan</i>
						</button>
						<input type="hidden" name="xyz" id="xyz" value="2">
					</div>
				</form>
			</div>

			<?php
			if (isset($_POST['tgl_awal'])) {
				$tgl_awal = $_POST['tgl_awal'];
				$tgl_akhir = $_POST['tgl_akhir'];
				$tgl_awal = date("Y-m-d 00:00:00", strtotime($tgl_awal));
				$tgl_akhir = date("Y-m-d 23:59:59", strtotime($tgl_akhir));
				$penjualan = $_POST['penjualan'];
				$xyz = $_POST['xyz'];

				if ($xyz == 2) {
			?>
					<div class="box">
						<div class="box-header">
							<div class="pull-left">
								<a href="<?= base_url(); ?>laporan/cetak_laporan_kasir?tgl_awal=<?php echo $_POST['tgl_awal'] ?>&tgl_akhir=<?php echo $_POST['tgl_akhir'] ?>&penjualan=<?= $_POST['penjualan'] ?>" target="_blank" class="btn btn-default">Print Review</a>
							</div>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-striped table-bordered table-hover" id="table1">
								<thead>
									<tr>
										<th>Invoice</th>
										<th>Tanggal</th>
										<th>Nama Item</th>
										<th>Customer</th>
										<th>Sub Total</th>
										<th>Diskon</th>
										<th>Grand Total</th>
										<th>Cash</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($penjualan == "semua") {
										$query = $this->db->query("SELECT kd.*, k.invoice as kasir_invoice, k.created as kasir_created, c.name as customer_name, k.discount as kasir_discount, k.final_price as kasir_final_price, k.cash as kasir_cash, i.name as item_name, k.total_price as kasir_total_price FROM kasir_detail kd JOIN kasir k ON kd.kasir_id = k.kasir_id JOIN customer c ON k.customer_id = c.customer_id JOIN item i ON kd.item_id = i.item_id WHERE k.created >= '$tgl_awal' AND k.created <= '$tgl_akhir'")->result();
									} else {
										$query = $this->db->query("SELECT kd.*, k.invoice as kasir_invoice, k.created as kasir_created, c.name as customer_name, k.discount as kasir_discount, k.final_price as kasir_final_price, k.cash as kasir_cash, i.name as item_name, k.total_price as kasir_total_price FROM kasir_detail kd JOIN kasir k ON kd.kasir_id = k.kasir_id JOIN customer c ON k.customer_id = c.customer_id JOIN item i ON kd.item_id = i.item_id WHERE k.created >= '$tgl_awal' AND k.created <= '$tgl_akhir' AND i.item_id = '$penjualan'")->result();
									}
									foreach ($query as $data) {
									?>
										<tr>
											<td><?= $data->kasir_invoice ?></td>
											<td><?= indo_date($data->kasir_created) ?></td>
											<td><?= $data->item_name ?></td>
											<td><?= $data->customer_name ?></td>
											<td><?= $data->total ?></td>
											<td><?= $data->kasir_discount ?></td>
											<td><?= $data->kasir_final_price ?></td>
											<td><?= $data->kasir_cash ?></td>
										</tr>
									<?php
									}

									?>
								</tbody>
							</table>
						</div>
					</div>

			<?php
				}
			}
			?>
		</div>
	</div>
</section>


<script src="<?= base_url('assets/') ?>dist/js/ace.js" type="text/javascript"></script>
<script type='text/javascript' src="<?= base_url('assets/') ?>dist/js/jquery-1.3.0.min.js"></script>
<script>
	$(document).ready(function() {
		$('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
			})
			.next().on(ace.click_event, function() {
				$(this).prev().focus()
			})
	})
</script>