<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-archive"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Items</span>
              <span class="info-box-number"><?= $this->fungsi->count_item(); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Transactions</span>
              <span class="info-box-number"><?= $this->fungsi->count_transaction(); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Customer</span>
              <span class="info-box-number"><?= $this->fungsi->count_customer(); ?></span>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number"><?= $this->fungsi->count_user(); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Financial Analytics -->
      <div class="row">
        <div class="col-lg-6 col-xs-12">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Rp <?= number_format($this->fungsi->pendapatan_hari_ini(), 0, ',', '.') ?></h3>
              <p>Pendapatan Hari Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?= site_url('laporan/laporan_kasir') ?>" class="small-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-xs-12">
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>Rp <?= number_format($this->fungsi->total_pendapatan(), 0, ',', '.') ?></h3>
              <p>Total Pendapatan</p>
            </div>
            <div class="icon">
              <i class="fa fa-line-chart"></i>
            </div>
            <a href="<?= site_url('laporan/laporan_kasir') ?>" class="small-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <!-- Welcome Panel -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Selamat Datang di <?= $this->fungsi->get_setting()->nama_usaha ?></h3>
            </div>
            <div class="box-body text-center" style="padding: 50px;">
              <?php if (!empty($this->fungsi->get_setting()->logo)): ?>
                <img src="<?= base_url('uploads/'.$this->fungsi->get_setting()->logo) ?>" alt="Logo" style="height: 150px; object-fit: contain; margin-bottom: 20px;">
              <?php endif; ?>
              <h1>Sistem Point of Sale (POS)</h1>
              <p class="lead">Kelola transaksi kasir, inventaris barang, pelanggan, dan laporan dengan mudah dan cepat.</p>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->