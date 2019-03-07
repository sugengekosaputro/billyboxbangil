<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
     
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('pelanggan');?>">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah pelanggan</li>
          </ol>
        </nav>
          <div class="x_panel">
            <div class="x_title">
              <h3>Form Tambah Pelanggan</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left input_mask" action="<?php echo site_url('pelanggan/simpan')?>" method="POST">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="nama_pelanggan" class="form-control has-feedback-left" id="" placeholder="Nama Pelanggan">
                  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="alamat" class="form-control has-feedback-left" id="" placeholder="Alamat">
                  <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="nomor_telepon" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Nomor Telpon">
                  <span class="fa fa-phone-square form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="email" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Email">
                  <span class="fa fa-mail-forward form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                </div>
                
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-sm btn-default" href="<?php echo base_url('pelanggan'); ?>" type="button"> <span class="fa fa-arrow-left"></span> Kembali</a>
                    <button type="submit" class="btn btn-sm btn-success"><span class="fa fa-save"></span> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>      