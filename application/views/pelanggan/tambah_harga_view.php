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

                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback alert-barang">
                    <!-- Hidden Text -->
                    <input  type="text" name="id_barang" class="" id="idbarang" hidden>
                    <input type="text" name="id_pelanggan" class="" id="idpelanggan" value="<?php echo $this->uri->segment(3); ?>" hidden>
                    <!-- -->
                    <input type="text" name="nama_barang" class="form-control has-feedback-left" id="namabarang" placeholder="Nama Barang">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>

                  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback alert-laba">
                    <input type="number" name="laba" class="form-control has-feedback-left" id="laba" placeholder="Harga Pelanggan">
                    <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <p id="harga-barang"></p>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <p id="harga-laba"></p>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <p id="harga-jual"></p>
                  </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-sm btn-default" href="<?php echo base_url('pelanggan/harga/').$this->uri->segment(3) ?>" type="button"> <span class="fa fa-arrow-left"></span> Kembali</a>
                    <button type="button" class="btn btn-sm btn-success simpan"><span class="fa fa-save"></span> Simpan</button>
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
  var brg = $('#namabarang').val();
  var laba = $('#laba').val();
  var hrg_brg,hrg_laba,hrg_jual;
  
  $('#namabarang').autocomplete({
    serviceUrl : site,
    onSelect: function (suggestion) {
      $('#idbarang').val(''+suggestion.id);
      $('#namabarang').val(suggestion.value);
      hrg_brg = suggestion.harga_jual;
      $("#harga-barang").text('Harga Barang : '+hrg_brg);
      $('.alert-barang').removeClass('has-warning');
    }
  });

  $("#laba").on('input', function () {

      $('.alert-barang').removeClass('has-warning');

      hrg_laba = $(this).val();
      hrg_jual = parseInt(hrg_brg) + parseInt(hrg_laba);
      
      $("#harga-laba").text('Harga Laba : '+hrg_laba);
      $("#harga-jual").text('Harga Jual : '+hrg_jual);

  });

  $('.simpan').on('click', function () {
    const brg = $('#namabarang').val();
    const laba = $('#laba').val();

    if(brg.length == 0 && laba.length == 0){
      $('#namabarang').focus();
      $('.alert-barang').addClass('has-warning');
      $('.alert-laba').addClass('has-warning');
    }else if(laba.length == 0){
      $('#laba').focus();
      $('.alert-laba').addClass('has-warning');
    }else{
      $('.form-horizontal')[0].submit();
    }
    // if(brg.length == 0){
    //   alert('Barang Tidak Boleh Kosong');
    // }

    // if(laba.length == 0){
    //   alert('Laba Tidak Boleh Kosong');
    // }

    //
  });
});
</script>