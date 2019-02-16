<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h3>Data Pelanggan</h3>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                  <a href="<?php echo site_url()?>pelanggan/tambah" class="btn btn-sm btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
              </p>
              <?php if($data == null) { ?>
                <div class="alert alert-primary" role="alert">
                  <strong>Data Pelanggan Kosong</strong>
                </div>
              <?php } else { ?>
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Telepon</th>
                      <th>Email</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data['pelanggan'] as $key => $val){ ?>
                  <tr>
                    <td><?php echo $val['nama_pelanggan']; ?></td>
                    <td><?php echo $val['alamat']; ?></td>
                    <td><?php echo $val['nomor_telepon']; ?></td>
                    <td><?php echo $val['email']; ?></td>
                    <td>
                      <a href="<?php echo site_url('pelanggan/harga/'.$val['id_pelanggan']) ?>" class="btn btn-sm btn-success"><span class="fa fa-shopping-cart">&nbsp</span>harga pelanggan</a>
                      <a href="<?php echo site_url('pelanggan/edit/'.$val['id_pelanggan']) ?>" class="btn btn-sm btn-warning"><span class="fa fa-edit">&nbsp</span>Update</a>
                      <a href="<?php echo site_url('pelanggan/hapus/'.$val['id_pelanggan']) ?>" class="btn btn-sm btn-danger" onClick="javascript:return confirm(`Anda Yakin Ingin Hapus Data ?`)" ><span class="fa fa-trash">&nbsp</span>Hapus</a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>