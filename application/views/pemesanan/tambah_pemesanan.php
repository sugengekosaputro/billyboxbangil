<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-7 col-sm-7 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h4>Input Pemesanan</h4>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form class="form-horizontal form-label-left input_mask" method="post" id="form">
                  <!-- hidden input -->
                  <input type="text" name="id_pelanggan" id="id_pelanggan"hidden>
                  <input type="text" name="id_barang" id="id_barang" hidden>
                  <input type="text" name="harga" id="harga" hidden>
                  <input type="text" name="laba" id="laba" hidden>
                  <input type="text" name="harga_jual" id="harga_jual" hidden>
                  <!-- -->
                <div class="form-group">
                  <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback validasi_pelanggan">
                    <input type="text" name="nama_pelanggan" class="form-control has-feedback-left" id="namaPelanggan" placeholder="Nama Pelanggan">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback">
                    <input type="text" name="nama_barang" class="form-control has-feedback-left" id="namaBarang" placeholder="Nama Barang" disabled>
                    <span class="fa fa-shopping-cart form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                    <input type="text" name="jumlah_barang" class="form-control has-feedback-left" id="jumlahBarang" placeholder="Jumlah" disabled>
                    <span class="fa fa-shopping-cart form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-2 col-sm-2 col-xs-4 form-group">
                    <button type="button" class="btn btn-sm btn-primary" id="tambah" disabled><span class="fa fa-plus">&nbsp</span> Tambah</button>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-4 form-group">
                    <button type="button" class="btn btn-sm btn-danger" id="hapus" disabled><span class="fa fa-minus">&nbsp</span> Hapus</button>
                  </div>
                </div>

                <div class="ln_solid"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-sm-5 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h4>Pembayaran</h4>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form class="form-horizontal form-label-left input_mask" method="post">
                <div class="form-group">
                  <label class="control-label col-md-5 col-sm-5 col-xs-12" for="last-name">Uang Muka Minimal
                  </label>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                    <input type="number" class="form-control has-feedback-right" id="dp" value="50">
                    <span class="fa fa-percent form-control-feedback right" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-5 col-sm-5 col-xs-12" for="last-name">Jatuh Tempo
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="date" data-date="" data-date-format="YYYY-MM-DD" class="form-control has-feedback-right" id="jatuh_tempo">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2 col-sm-2 col-xs-4 form-group">
                    <button type="button" class="btn btn-sm btn-warning" id="simpanPembayaran" disabled><span class="fa fa-credit-card">&nbsp</span> Simpan Pembayaran</button>
                  </div>
                </div>
              </form>
              <div class="ln_solid"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h4>Preview Pesanan</h4>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <p><b><h5> Harga Total : Rp.<i id="hargatotal">0</i></h5></b></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                <button type="button" class="btn btn-sm btn-success" id="simpan" disabled><span class="fa fa-save">&nbsp</span> Simpan</button>
                </div>
              </div>
              <table class="table table-striped table-bordered dt-responsive nowrap" id="tbl_preview" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Barang</th>
                    <th width="10%">Banyaknya</th>
                    <th width="20%">Harga Jual</th>
                    <th width="20%">Jumlah</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  <tr id="baris0">
                  </tr>
                </tbody>
              </table>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
  
  var i = 0;
  var row = 0;
  var pesanan = [];
  var pembayaran = {};

  $("#namaPelanggan").focus();

  const namapelanggan =  $('#namaPelanggan').autocomplete({
    serviceUrl : "http://localhost/billyboxbangil/pelanggan/cari",
    onSelect: function (suggestion) {
      var id = $('#id_pelanggan').val(suggestion.id);
      $("#namaBarang").prop("disabled",false).focus();
    }
  });

  $('#namaBarang').autocomplete({
    serviceUrl : "http://localhost/billyboxbangil/barang/cariby/",
    params : {'id_pelanggan' : function () { return $("#id_pelanggan").val() }},
    onSelect: function (suggestion) {
      $("#id_barang").val(''+suggestion.id);
      $("#namaBarang").val(''+suggestion.value);
      $("#harga_jual").val(''+suggestion.harga_jual);
      $("#jumlahBarang").prop("disabled",false).focus();
    }
  });

  $('#jumlahBarang').on("input",function () { 
    let val = $(this).val();

    if (val.length === 0){
      $("#tambah").prop("disabled", true);
      $("#simpan").prop("disabled", true);
      $("#simpanPembayaran").prop("disabled", true);
    } else {
      $("#tambah").prop("disabled", false);
    }
  });
  
  $("#tambah").on("click", function () {
    let hrgjual = $("#harga_jual").val();
    let jml = $("#jumlahBarang").val();
    let item_pesanan = {
        'id_barang' : $("#id_barang").val(),
        'nama_barang' : $("#namaBarang").val(),
        'jumlah' : $("#jumlahBarang").val(),
        'harga' : $("#harga").val(),
        'laba' : $("#laba").val(),
        'harga_jual' : $("#harga_jual").val(),
        'total' : (hrgjual * jml),
    };
    pesanan.push(item_pesanan);

    hitungTotal();

    $("#hapus").prop('disabled',false);
    $("#simpanPembayaran").prop('disabled',false);
    $("#baris"+row+"").html(`
      <td>`+(row+1)+`</td>
      <td>`+pesanan[row]['nama_barang']+`</td>
      <td>`+pesanan[row]['jumlah']+`</td>
      <td>`+formatRupiah(pesanan[row]['harga_jual'])+`</td>
      <td>`+formatRupiah(pesanan[row]['total'])+`</td>
    `);

    $("#tbl_preview").append(`<tr id="baris`+(row+1)+`"></tr>`);
    row++;
    $(this).prop('disabled',true);
    resetForm();
  });

  $("#hapus").on("click", function () {
    pesanan.pop();
    $("#baris"+(row-1)+"").html("");
    row--;
    if(pesanan.length == 0){
      $("#hapus").prop("disabled",true);
      $("#simpan").prop("disabled",true);
      $("#simpanPembayaran").prop("disabled",true);
    }
    hitungTotal();
  });

  $("#simpanPembayaran").on("click",function () {
    let harga_pesan = pesanan.reduce(function(accumulator, currentVal){
      return accumulator + currentVal.total;
    },0);
    let dp = $("#dp").val();
    const jt = $("#jatuh_tempo").val();

    if(jt == ""){
       alert("Tentukan Tanggal Jatuh Tempo !")
    }else{
      pembayaran.harga_pesan = harga_pesan;
      pembayaran.dp = dp/100;
      pembayaran.jatuh_tempo = jt;

      $("#namaPelanggan,#namaBarang,#jumlahBarang,#tambah,#hapus").prop("disabled",true);
      $("#simpan").prop("disabled",false);
    }
  });

  $("#simpan").on("click", function () {
    let data = {
      'id_pelanggan' : $("#id_pelanggan").val(),
      'pesanan' : pesanan,
      'pembayaran' : pembayaran,
    };
    $.ajax({
      type: "post",
      url: "http://localhost/billyboxbangil/pemesanan/simpan",
      data: {obj : data},
      dataType: "json",
      success: function (res) {
        console.log(res);
        if(res){
          alert(res.message);
          let id_order = res.id_order;
          $.ajax({
            type: "post",
            url: "http://localhost/billyboxbangil/pemesanan/notifEmailPemesanan",
            data: {id_order : id_order},
            dataType: "json",
            success: function (response) {
            }
          });
          window.location.href = "<?php echo site_url('pemesanan') ?>"
        }
      },
      error: function (err) {
        console.log(err);
      }
    });
  });

  function resetForm(){
    $("#namaBarang,#jumlahBarang").val('');
    $("#jumlahBarang").prop("disabled",true);
    $("#namaBarang").focus();
  }

  function hitungTotal() { 
    let tot = pesanan.reduce(function(accumulator, currentVal){
      return accumulator + currentVal.total;
    },0);
    $("#hargatotal").html(formatRupiah(tot));
  }

  function formatRupiah(angka){
      var reverse = angka.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
      ribuan = ribuan.join('.').split('').reverse().join('');
      return ribuan;
  }

  function Pembayaran(harga_pesan,dp,jatuh_tempo){
    this.harga_pesan = harga_pesan;
    this.dp = dp;
    this.jatuh_tempo = jatuh_tempo;
  }
});
</script>