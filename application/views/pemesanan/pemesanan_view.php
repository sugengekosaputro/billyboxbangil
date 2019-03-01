<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <img height="20px" width="30px" src="<?php echo base_url('assets/images/home.png') ?>">
        <a> __ </a>
        <a href="#"><u>pemesanan</a>
          <div class="x_panel">
            <div class="x_title">
              
              <h2>Pemesanan<small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                  <a href="<?php echo site_url()?>pemesanan/tambah" class="btn btn-sm btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
              </p>
              <table id="datatable-responsive" class="table table-striped table-bordered table-fit dt-responsive nowrap col-xs-12" data-order="[[ 0, &quot;desc&quot; ]]" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>ID Order</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($data == null){ ?>
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Belum Ada Pemesanan</strong>
                    </div>
                  <?php } else { 
                    foreach($data['pemesanan'] as $psn ){ 
                  ?>
                  <tr>
                      <td><?php echo $psn['id_order'] ?></td>
                      <td>
                        <p><?php echo $psn['nama_pelanggan'] ?></p>
                        <p><i><?php echo $psn['alamat'] ?></i></p>
                      </td>
                      <td><?php echo $psn['tanggal_order'] ?></td>
                      <td>
                        <p>Order : <b><i><?php echo $psn['status_order'] ?></i></b></p>
                        <p>Pembayaran : <b><i><?php echo $psn['status_pembayaran'] ?></i></b></p>
                      </td>
                      <td>
                        <a href="<?php echo site_url('pemesanan/detail/'.$psn['id_order']) ?>" class="btn btn-sm btn-success"><span class="fa fa-shopping-cart">&nbsp</span> Detail</a>
                      </td>
                  </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
