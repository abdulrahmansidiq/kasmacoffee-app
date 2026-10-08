<section class="content-header">
  <h1>
    Laporan Stock Out
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laporan</li>
  </ol>
</section>

<section class="content">
	<div class="col">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Pilih Laporan</h3>
			</div>

			<div class="box-body">
				<form action="<?= base_url('laporan/laporan_stock_keluar') ?>" method="POST" autocomplete="off">
                    <div class="form-group">
						<label>Stock Barang</label>
						<select class="form-control" id="stock_keluar" name="stock_keluar">
                            <option value="semua">Semua</option>
                            <?php
                                foreach($item->result() as $key => $data)
                                {
                                    ?>
                                    <option value="<?php echo $data->item_id ?>"><?php echo $data->name ?></option>
                                    <?php
                                }
                            ?>
                        </select>
					</div>

					<div class="form-group">
						<button type="submit" id="cetak_stock_keluar" class="btn btn-success btn-flat">
							<i class="fa fa-save"> Simpan</i>
						</button>
						<input type="hidden" name="xyz" id="xyz" value="2">
					</div>
				</form>
            </div>
            
            <?php
            if(isset($_POST['stock_keluar']))
            {
                $stock_brg = $_POST['stock_keluar'];
                $xyz = $_POST['xyz'];

                if($xyz == 2)
                {
                    ?>
					<div class="box">
						<div class="box-header">
							<div class="pull-left">
								<a href="<?= base_url(); ?>laporan/cetak_laporan_stock_keluar?stock_keluar=<?= $_POST['stock_keluar'] ?>" target="_blank" class="btn btn-default">Print Review</a>
							</div>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-striped table-bordered table-hover" id="table1">
								<thead>
									<tr>
										<th>No</th>
                                        <th>Tanggal</th>
										<th>Nama Item</th>
                                        <th>Detail</th>
										<th>Qty</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                    $no = 1;
                                    if ($stock_brg == "semua"){
                                       $query = $this->db->query("SELECT s.*, i.name as item_name FROM stock s JOIN item i ON s.item_id = i.item_id WHERE s.type = 'out'")->result();
                                    }
                                    else{
                                        $query = $this->db->query("SELECT s.*, i.name as item_name FROM stock s JOIN item i ON s.item_id = i.item_id WHERE s.type = 'out' AND s.item_id = '$stock_brg'")->result();
                                    }
                                    foreach($query as $key => $data)
                                    {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= indo_date($data->created) ?></td>
                                            <td><?= $data->item_name ?></td>
                                            <td><?= $data->detail ?></td>
                                            <td><?= $data->qty ?></td>
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


