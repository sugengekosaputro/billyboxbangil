<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="barang">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Harga pelanggan</li>
          </ol>
        </nav>
          <div class="x_panel">
            <div class="x_title">
              <h3><?php echo $data['nama_pelanggan'] ?></h3>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                <a href="<?php echo site_url('pelanggan/tambah_harga/').$this->uri->segment(3)?>" class="btn btn-sm btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
              </p>
              <?php if($data['harga_jual'] == false) { ?>
                <div class="alert alert-primary" role="alert">
                  <strong>Harga Jual Belum Ditentukan </strong>
                </div>
              <?php } else { ?>
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Harga Pelanggan</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data['harga_jual'] as $val){ ?>
                  <tr>
                    <td>
                      <?php echo $val['nama_barang']; ?> <br>
                      <small>Rp. <?php echo $val['harga']; ?></small>
                    </td>
                    <td>
                        <form class="form-horizontal form-label-left input_mask" action="<?php echo site_url('pelanggan/update_laba/'.$val['id_master_jual'])?>" method="POST"> 
                        Rp.
                        <input type="text" name="id_pelanggan" value="<?php echo $val['id_pelanggan'] ?>" hidden>
                        <input type="text" name="laba" id="laba" value="<?php echo $val['laba'] ?>">
                        <input type="submit" value="Edit"/>
                        </form>
                    </td>
                    <td><?php echo $val['harga_jual'] ?></td>
                    <td>
                    <a href="<?php echo site_url('pelanggan/hapus_harga/'.$val['id_master_jual'].'/'.$this->uri->segment(3)) ?>" class="btn btn-sm btn-danger" onClick="javascript:return confirm(`Anda Yakin Ingin Hapus Data ?`)" ><span class="fa fa-trash">&nbsp</span>Hapus</a>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <?php }?>
              <p class="text-muted font-13 m-b-30">
                  <a href="<?php echo site_url()?>pelanggan" class="btn btn-sm btn-default"><span class="fa fa-arrow-left">&nbsp</span>Kembali</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>