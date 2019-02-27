<div class="right_col" role="main">
      <div class="page-title">
     
      </div>
     <div class="clearfix"></div>

  <div class="">
    <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Status Pemesanan</h2>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row tile_count">
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-user"></i> Order Baru</span>
                  <div class="count"><?php echo $data['order']['order_baru'] ?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-clock-o"></i> Sedang Diproses</span>
                  <div class="count"><?php echo $data['order']['order_proses'] ?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-user"></i> Sudah Dikirim</span>
                  <div class="count"><?php echo $data['order']['order_dikirim'] ?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-user"></i> Order Selesai</span>
                  <div class="count"><?php echo $data['order']['order_selesai'] ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Status Pembayaran</h2>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row tile_count">
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-user"></i> Belum Bayar</span>
                  <div class="count"><?php echo $data['pembayaran']['belum_bayar'] ?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-clock-o"></i> Proses Bayar</span>
                  <div class="count"><?php echo $data['pembayaran']['proses_bayar'] ?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-user"></i> Lunas</span>
                  <div class="count"><?php echo $data['pembayaran']['lunas'] ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>
