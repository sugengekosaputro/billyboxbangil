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
              <h4>Stok Barang</h4>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <form class="form-horizontal form-label-left input_mask" action="<?php // echo site_url('pelanggan/simpan_harga')?>" method="POST">
                    <input  type="text" name="id_barangMasuk" class="" id="idbarangMasuk" hidden>
                    <input  type="text" name="stokMasuk" class="" id="stokMasuk" hidden>
                    <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                      <input type="text" name="nama_barangMasuk" class="form-control has-feedback-left" id="namabarangMasuk" placeholder="Nama Barang">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback warning-masuk">
                      <input type="number" name="jumlahMasuk" class="form-control has-feedback-left" id="jumlahMasuk" placeholder="Jumlah Masuk">
                      <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-arrow-down"></span> Masuk</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-6 col-xs-12">
                  <form class="form-horizontal form-label-left input_mask" action="<?php // echo site_url('pelanggan/simpan_harga')?>" method="POST">
                    <input  type="text" name="id_barangKeluar" class="" id="idbarangKeluar" hidden>
                    <input  type="text" name="stokKeluar" class="" id="stokKeluar" hidden>
                    <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                      <input type="text" name="nama_barangKeluar" class="form-control has-feedback-left" id="namabarangKeluar" placeholder="Nama Barang">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback warning-keluar">
                      <input type="number" name="jumlahKeluar" class="form-control has-feedback-left has-warning" id="jumlahKeluar" placeholder="Jumlah Keluar">
                      <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="button" class="btn btn-sm btn-danger"><span class="fa fa-arrow-up"></span> Keluar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="row">
                <?php if($data == null) { ?>
                  <div class="alert alert-primary" role="alert">
                    <strong>Data Pelanggan Kosong</strong>
                  </div>
                <?php } else { ?>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Nama</th>
                      <th>Stok</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1; foreach($data['barang'] as $key => $val){ ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $val['nama_barang']; ?></td>
                      <td><?php echo $val['stok']; ?></td>
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type='text/javascript'>

var site = "http://localhost/billyboxbangil/barang/cari";
var stokMasuk,stokKeluar;
$(function(){
  $('#namabarangMasuk').autocomplete({
    serviceUrl : site,
    onSelect: function (suggestion) {
        $('#idbarangMasuk').val(''+suggestion.id);
        $('#stokMasuk').val(''+suggestion.stok);
    }
  });
  $('#namabarangKeluar').autocomplete({
    serviceUrl : site,
    onSelect: function (suggestion) {
        $('#idbarangKeluar').val(''+suggestion.id);
        $('#stokKeluar').val(''+suggestion.stok);
    }
  });

  $('#jumlahMasuk').on('input', function () {
    const jum = parseInt($(this).val());
    const stok = parseInt($('#stokMasuk').val());

    stokMasuk = stok + jum;
  });

  $('#jumlahKeluar').on('input', function () {
    const jum = parseInt($(this).val());
    const stok = parseInt($('#stokKeluar').val());

    stokKeluar = stok - jum;
  });

  $('.btn-primary').on('click', function () {
    const jum = $('#jumlahMasuk').val();
    let id = $('#idbarangMasuk').val();
    if(jum.length == 0){
      $('.warning-masuk ').addClass('has-warning');
      $('#jumlahMasuk').focus();
    }else{
      $('.warning-masuk ').removeClass('has-warning');
      //update
      $.ajax({
        type: "post",
        url: "<?php echo site_url('stok/updateStok') ?>",
        data: {
          id_barang : id,
          stok : stokMasuk,
        },
        dataType: "json",
        success: function (res) {
          if(res.status){
            alert(res.message);
            location.reload();
          }
        }
      });
    }
  });

  $('.btn-danger').on('click', function () {
    const jum = $('#jumlahKeluar').val();
    let id = $('#idbarangKeluar').val();
    if(jum.length == 0){
      $('.warning-keluar').addClass('has-warning');
      $('#jumlahKeluar').focus();
    }else{
      $('.warning-keluar').removeClass('has-warning');
      if(stokKeluar < 0){
        alert('Stok Tidak Mencukupi !!');
        $('.warning-keluar').addClass('has-warning');
        $('#jumlahKeluar').focus();
      }else{
        $('.warning-keluar').removeClass('has-warning');
        //updatee
        $.ajax({
          type: "post",
          url: "<?php echo site_url('stok/updateStok') ?>",
          data: {
            id_barang : id,
            stok : stokKeluar,
          },
          dataType: "json",
          success: function (res) {
            if(res.status){
            alert(res.message);
            location.reload();
          }
          }
        });
      }
    }
  });
});
</script>