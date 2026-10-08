<section class="content-header">
	<h1>
		Log
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Log</li>
	</ol>
</section>

<section class="content">
	<div class="col">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Pilih Log</h3>
			</div>

			<div class="box-body">
				<form action="<?= base_url('log') ?>" method="POST">
					<div class="form-group">
						<label>Date:</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right date-picker" id="tgl_awal" name="tgl_awal" required>
						</div>
					</div>

					<div class="form-group">
						<label>Date range:</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right date-picker" id="tgl_akhir" name="tgl_akhir" required>
						</div>
					</div>

					<div class="form-group">
						<button type="submit" id="cari" class="btn btn-success btn-flat">
							<i class="fa fa-search"> Cari</i>
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
				$xyz = $_POST['xyz'];

				if ($xyz == 2) {
			?>
					<div class="box">
						<div class="box-body table-responsive">
							<table class="table table-striped table-bordered table-hover" id="table1">
								<thead>
									<tr>
										<td>Id Log</td>
										<td>Keterangan</td>
										<td>Dibuat</td>
										<td>Tanggal Dibuat</td>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = $this->db->query("SELECT * FROM log WHERE created >= '$tgl_awal' AND created <= '$tgl_akhir'")->result();
									$no = 1;
									foreach ($query as $data_log) {
									?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $data_log->keterangan ?></td>
											<td><?= $data_log->created_by ?></td>
											<td><?= $data_log->created ?></td>
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