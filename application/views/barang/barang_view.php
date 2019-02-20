<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Barang<small>UD.BBB</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 pull-left">
                <a href="<?php echo site_url()?>barang/tambah" class="btn btn-sm btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 pull-right">
                  <div class="input-group">
                    <input type="text" class="form-control cari_barang" placeholder="Cari barang...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><span class="fa fa-search"></span></button>
                    </span>
                  </div>
                  <a href="#" class="showAll" style="text-decoration:underline">Tampilkan Semua</a>
                </div>
              </div>
              <br>
              <?php if($data == null) { ?>
                <div class="alert alert-primary" role="alert">
                  <strong>Data Barang Kosong</strong>
                </div>
              <?php } else { ?>
                <div class="row content-barang">
                <?php foreach($data['barang'] as $barang){ ?>
                  <div class="col-md-4">
                    <div class="thumbnail">
                      <div class="image view view-first">
                        <img style="width: 100%; height: 100%; display: block;" src="<?php echo $barang['foto_barang'] ?>" alt="image" />
                        <div class="mask">
                          <p><?php echo $barang['nama_barang']; ?></p>
                          <div class="tools tools-bottom">
                            <a href="<?php echo site_url('barang/edit/'.$barang['id_barang']) ?>"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo site_url() ?>" onClick="javascript:return confirm(`Anda Yakin Ingin Hapus Data ?`)"><i class="fa fa-trash"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="caption">
                        <p><?php echo $barang['nama_barang']; ?></p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                </div>
              <?php } ?>
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
  var original_page = $('.content-barang').html();

  $('.showAll').on('click', function () {
    $('.content-barang').html(original_page);
  });
  $('.cari_barang').autocomplete({
    serviceUrl : "http://localhost/billyboxbangil/barang/cari",
    onSelect: function (suggestion) {
      $(this).val('').focus();
      $('.content-barang').html(
        `<div class="col-md-4">
          <div class="thumbnail">
            <div class="image view view-first">
              <img style="width: 100%; height: 100%; display: block;" src="`+suggestion.foto_barang+`" alt="image" />
              <div class="mask">
                <p>`+suggestion.value+`</p>
                <div class="tools tools-bottom">
                  <a href="<?php echo site_url('barang/edit')?>"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo site_url() ?>" onClick="javascript:return confirm("Anda Yakin Ingin Hapus Data ?")"><i class="fa fa-trash"></i></a>
                </div>
              </div>
            </div>
            <div class="caption">
              <p>`+suggestion.value+`</p>
            </div>
          </div>
        </div>`
      );
    },
  });
});
</script>