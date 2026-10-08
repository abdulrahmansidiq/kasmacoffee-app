<section class="content-header">
    <h1>
        Laporan Stock In
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
                <form action="<?= base_url('laporan/laporan_stock') ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Stock Barang</label>
                        <select class="form-control" id="stock_barang" name="stock_barang">
                            <option value="semua">Semua</option>
                            <?php
                            foreach ($item->result() as $key => $data) {
                            ?>
                                <option value="<?php echo $data->item_id ?>"><?php echo $data->nama ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="cetak_stock" class="btn btn-success btn-flat">
                            <i class="fa fa-save"> Simpan</i>
                        </button>
                        <input type="hidden" name="xyz" id="xyz" value="2">
                    </div>
                </form>
            </div>

            <?php
            if (isset($_POST['stock_barang'])) {
                $stock_barang = $_POST['stock_barang'];
                $xyz = $_POST['xyz'];

                if ($xyz == 2) {
            ?>
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a href="<?= base_url(); ?>laporan/cetak_laporan_stock?stock_barang=<?= $_POST['stock_barang'] ?>" target="_blank" class="btn btn-default">Print Review</a>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table1">
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
                                    if ($stock_barang == "semua") {
                                        $query = $this->db->query("SELECT i.*, c.name as category_name, u.name as unit_name FROM item i JOIN category c ON i.category_id = c.category_id JOIN unit u ON i.unit_id = u.unit_id")->result();
                                    } else {
                                        $query = $this->db->query("SELECT i.*,  c.name as category_name, u.name as unit_name FROM item i JOIN category c ON i.category_id = c.category_id JOIN unit u ON i.unit_id = u.unit_id WHERE i.item_id = '$stock_barang'")->result();
                                    }
                                    foreach ($query as $key => $data) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= indo_date($data->created) ?></td>
                                            <td><?= $data->name ?></td>
                                            <td><?= $data->category_name ?></td>
                                            <td><?= $data->unit_name ?></td>
                                            <td><?= $data->price ?></td>
                                            <td><?= $data->stock ?></td>
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