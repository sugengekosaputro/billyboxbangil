<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h3>Form Tambah Harga</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <h4>Pelanggan : <b><?php echo $nama['nama_pelanggan']; ?></b></h4>
              <br />
              <form class="form-horizontal form-label-left input_mask" action="<?php echo site_url('pelanggan/simpan_harga')?>" method="POST">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <!-- Hidden Text -->
                <input  type="text" name="id_barang" class="" id="idbarang" hidden>
                <input type="text" name="id_pelanggan" class="" id="idpelanggan" value="<?php echo $this->uri->segment(3); ?>" hidden>
                <!-- -->
                  <input type="text" name="nama_barang" class="form-control has-feedback-left" id="namabarang" placeholder="Nama Barang">
                  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                  <input type="number" name="laba" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Harga Pelanggan">
                  <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                </div>
                
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-sm btn-default" href="<?php echo base_url('pelanggan/harga/').$this->uri->segment(3) ?>" type="button"> <span class="fa fa-arrow-left"></span> Kembali</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type='text/javascript'>

var site = "http://localhost/billyboxbangil/barang/cari";
$(function(){
    $('#namabarang').autocomplete({
    serviceUrl : site,
    onSelect: function (suggestion) {
        $('#idbarang').val(''+suggestion.id);
    }
  });
});
</script>