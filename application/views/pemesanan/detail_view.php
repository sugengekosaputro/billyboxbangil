<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h4>Detail Pemesanan</small></h4>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
              <div class="clearfix">
              </div>
            </div>
            <div class="x_content">
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#pesanan-content" id="pesanan-tab" role="tab" data-toggle="tab" aria-expanded="true">Pesanan</a>
                  </li>
                  <li role="presentation" class=""><a href="#dikirim-content" role="tab" id="dikirim-tab" data-toggle="tab" aria-expanded="false">Pesanan Dikirim</a>
                  </li>
                  <li role="presentation" class=""><a href="#pembayaran-content" role="tab" id="pembayaran-tab" data-toggle="tab" aria-expanded="false">Pembayaran</a>
                  </li>
                </ul>

                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="pesanan-content" aria-labelledby="pesanan-tab">
                    <div class="row">
                      <div class="col-md-6 col-xs-6 pull-right">
                        <h4><p class="text-right"><b><?php echo date('d-m-Y'); ?></b></p></h4>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <p>Tuan / Toko : <b><?php echo $pelanggan['nama_pelanggan'] ?></b></p>
                        <p>Alamat : <?php echo $pelanggan['alamat'] ?></p>
                        <p></p>
                      </div>
                      <div class="col-md-6 col-xs-12 text-right">
                        <p>Nota No : <b><u><?php echo $order['id_order'] ?></u></b></p>
                      </div>
                    </div>
                    <div class="row">
                      <table class="table table-bordered dt-responsive nowrap" id="tbl_preview" cellspacing="0" width="100%">
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
                          <?php for($i=0; $i < count($order['detail_order']);$i++){ ?>
                            <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><?php echo $order['detail_order'][$i]['nama_barang'] ?></td>
                            <td><?php echo $order['detail_order'][$i]['jumlah'] ?></td>
                            <td><?php echo 'Rp '.number_format($order['detail_order'][$i]['harga_satuan']); ?></td>
                            <td><?php echo 'Rp '.number_format($order['detail_order'][$i]['harga']) ?></td>
                          </tr>
                          <?php } ?>
                          <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Total</b></td>
                            <td><?php echo 'Rp '.number_format($pembayaran['harga_pesan']) ?></td>
                          </tr>
                          <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Uang Muka Minimal</b></td>
                            <td><?php echo 'Rp '.number_format(($pembayaran['harga_pesan'] * $pembayaran['dp'])); ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <p><h4>Status Order : <b><?php echo $order['status_order'] ?></b></h4></p>
                        <form class="form-horizontal form-label-left input_mask" action="<?php echo site_url('pemesanan/update_status_order/'.$this->uri->segment(3) )?>" method="POST"> 
                          <p>
                            <div class="radio">
                              <label>
                                <input type="radio" name="status_order" id="orderBaru" value="Baru">
                                Baru
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="status_order" id="orderProses" value="Diproses">
                                Diproses KSI
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="status_order" id="orderDikirim" value="Dikirim">
                                Dikirim
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="status_order" id="orderSelesai" value="Selesai">
                                Selesai
                              </label>
                            </div>
                          </p>
                          <button type="button" class="btn btn-sm btn-success ubah-status"><span class="fa fa-refresh">&nbsp</span>Ubah Status </button>
                        </form>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <p><h4>Status Pembayaran : <b><?php echo $pembayaran['status_pembayaran'] ?></b></h4></p>
                        <p><h4>Total Sudah Dibayar : <b><?php echo 'Rp '.number_format($pembayaran['sudah_dibayar']) ?></b></h4></p>
                        <button type="button" class="btn btn-sm btn-success input-pembayaran"><span class="fa fa-dollar">&nbsp</span>Input Pembayaran </button>
                      </div>
                    </div>
                  </div>

                  <div role="tabpanel" class="tab-pane fade" id="dikirim-content" aria-labelledby="dikirim-tab">
                    <div class="row">
                      <div class="x_content">
                        <a href="<?php echo site_url('pemesanan/surat_jalan/'.$order['id_order']) ?>" class="btn btn-sm btn-warning"><span class="fa fa-plus">&nbsp</span>Surat Jalan</a>
                      </div>
                    </div>

                    <?php if($surat_jalan['history'] == false){ ?>
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Barang Belum Ada Laporan Pengiriman</strong>
                      </div>
                    <?php } else { ?>
                    <?php foreach($surat_jalan['history'] as $key => $val){ ?>
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key ?>" aria-expanded="true" aria-controls="collapse<?php echo $key ?>">
                          <p>No : <?php echo $val['no_sj'] ?></p>
                          <p>Tanggal : <?php echo $val['tanggal'] ?></p>
                        </a>
                        <div id="collapse<?php echo $key ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Barang</th>
                                  <th>Jumlah</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no = 1; foreach($val['list'] as $item){ ?>
                                <tr>
                                  <td><?php echo $no++ ?></td>
                                  <td><?php echo $item['nama_barang'] ?></td>
                                  <td><?php echo $item['dikirim'] ?></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                   <?php }?>
                  </div>

                  <div role="tabpanel" class="tab-pane fade" id="pembayaran-content" aria-labelledby="pembayaran-tab">
                  <div class="row">
                      <div class="col-md-6 col-xs-6 pull-right">
                        <h4><p class="text-right"><b><?php echo date('d-m-Y'); ?></b></p></h4>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <p>Tuan / Toko : <b>CV FABI SUGENG</b></p>
                        <p>Alamat : Malang, Jawa Timur, Indonesia</p>
                        <p></p>
                      </div>
                      <div class="col-md-6 col-xs-12 text-right">
                        <p>Nota No : <b><u><?php echo $order['id_order'] ?></u></b></p>
                      </div>
                    </div>
                    <div class="row">
                      <table class="table table-bordered dt-responsive nowrap" id="tbl_preview" cellspacing="0" width="100%">
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
                          <?php for($j=0; $j < count($pembayaran['nota']);$j++){ ?>
                          <tr>
                            <td><?php echo $j+1; ?></td>
                            <td><?php echo $pembayaran['nota'][$j]['nama_barang'] ?></td>
                            <td><?php echo $pembayaran['nota'][$j]['dikirim'] ?></td>
                            <td><?php echo 'Rp '.number_format($pelanggan['harga_jual'][$j]['harga_jual'] )?></td>
                            <td><?php echo 'Rp '.number_format(($pelanggan['harga_jual'][$j]['harga_jual'] * $pembayaran['nota'][$j]['dikirim'])) ?></td>
                          </tr>
                          <?php } ?>
                          <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Total</b></td>
                            <td>
                              <?php if($pembayaran['harga_dikirim'] == null){
                                echo '0';
                              } else {
                                echo 'Rp '.number_format($pembayaran['harga_dikirim']);
                              } ?>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Sudah Dibayar</b></td>
                            <td><?php echo 'Rp '.number_format($pembayaran['sudah_dibayar']) ?></td>
                          </tr>
                          <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Sisa Pembayaran</b></td>
                            <td><?php echo 'Rp '.number_format($pembayaran['sisa_pembayaran']) ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <button type="button" class="btn btn-sm btn-warning tampil-notif"><span class="fa fa-bell">&nbsp</span>Kirim Notifikasi Email </button>
                    <button type="button" class="btn btn-sm btn-success input-pembayaran"><span class="fa fa-dollar">&nbsp</span>Input Pembayaran </button>

                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Rincian Pembayaran</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Dibayar</th>
                                  <th>Tanggal</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no=1; foreach($pembayaran['detail_pembayaran'] as $det){?>
                                <tr>
                                  <td><?php echo $no++ ?></td>
                                  <td><?php echo 'Rp '.number_format($det['dibayar']) ?></td>
                                  <td><?php echo date('d-m-Y',strtotime($det['tanggal'])) ?></td>
                                </tr>
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
            </div>
          </div>
        </div>   
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-pembayaran" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form class="form-horizontal form-label-left input_mask" method="POST">
        <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <!--hide-->
              <input type="hidden" name="id_pembayaran" id="id_pembayaran" value="<?php echo $pembayaran['id_pembayaran'] ?>">
              <input type="number" name="dibayar" class="form-control has-feedback-left" id="dibayar" placeholder="Masukkan Nominal Pembayaran">
              <span class="form-control-feedback left" aria-hidden="true">Rp</span>
          </div>
          <div class="form-group">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-default" id="close-pembayaran">Close</button>
          <input type="button" class="btn btn-sm btn-success" id="simpan-pembayaran" value="Simpan"/>     
        </div>
      </form>  
    </div>
  </div>
</div>

<div class="modal fade" id="modal-notif" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <p>Kirim Notifikasi Sekarang ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" id="close-notif">Close</button>
        <input type="button" class="btn btn-sm btn-success" id="kirim-notif" value="Kirim"/>     
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
  var id_order = "<?php echo $this->uri->segment(3) ?>";
  tampilkanStatusOrder(id_order);

  $('.ubah-status').on('click', function () {
    const sts = $("input[name='status_order']:checked").val();
    $.ajax({
        type: "post",
        url: "<?php echo site_url('pemesanan/update_status_order/'.$this->uri->segment(3) )?>",
        data: {
          status_order : sts,
        },
        dataType: "json",
        success: function (res) {
          if(res.status){
            location.reload();
          }
        },
        error: function (err) { 
          console.log(err);
        }
      });
  });

  $('.input-pembayaran').on('click', function () {
    $('#modal-pembayaran').modal('show');
    $('#simpan-pembayaran').on('click', function () {
      let id = $('#id_pembayaran').val();
      let dibayar = $('#dibayar').val();
      $.ajax({
        type: "post",
        url: "<?php echo site_url('tagihan/inputpembayaran') ?>",
        data: {
          id_pembayaran : id,
          value : dibayar,
          id_order : id_order,
        },
        dataType: "json",
        success: function (res) {
          if(res.status){
            $('#modal-pembayaran').modal('hide');
            alert(res.message);
            location.reload();
          }
 //         console.log(res);
        },
        error: function (err) { 
          console.log(err);
        }
      });
    });
    $('#close-pembayaran').on('click', function () {
      $('#modal-pembayaran').modal('hide');
      $('#dibayar').val('');
    });
  });

  $('.tampil-notif').on('click', function () {
    $('#modal-notif').modal('show');
    $('#kirim-notif').on('click', function () {
      $.ajax({
        type: "post",
        data: {id_order : id_order},
        url: "http://localhost/billyboxbangil/pemesanan/notifEmailPemesanan/2",
        dataType: "json",
        success: function (response) {
        }
      });
      $('#modal-notif').modal('hide');
//console.log('kirim');
    });
  });

  function tampilkanStatusOrder(id_order) {
    $.ajax({
      type: "get",
      url: "http://localhost/billyboxbangilapi/pemesanan/"+id_order,
      dataType: "json",
      success: function (res) {
        let status = res.order.status_order;
        if(status == "Baru"){
          $('input:radio[name=status_order][value=Baru]').prop('checked','checked');
        }else if(status == "Diproses"){
          $('input:radio[name=status_order][value=Diproses]').prop('checked','checked');
        }else if(status == "Dikirim"){
          $('input:radio[name=status_order][value=Dikirim]').prop('checked','checked');
        }else if(status == "Selesai"){
          $('input:radio[name=status_order][value=Selesai]').prop('checked','checked');
        }
      },
      error: function (err) { 
        console.log(err);
      }
    });
  };
})
</script>