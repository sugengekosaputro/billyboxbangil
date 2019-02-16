<!-- 
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
      
      </div>
    </div>
  </div>
</div>
-->
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
              <p class="text-muted font-13 m-b-30">
                  <a href="<?php echo site_url()?>barang/tambah" class="btn btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
              </p>
              <?php if($data == null) { ?>
                <div class="alert alert-primary" role="alert">
                  <strong>Data Barang Kosong</strong>
                </div>
              <?php } else { ?>
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" data-order="[[ 0, &quot;asc&quot; ]]" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th width=7%>No</th>
                    <th width=30%>Gambar</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><img src="<?php echo base_url() ?>assets/upload/barang/111.jpg" class="img-fluid" alt="" height=15% width=100%></td>
                    <td>asdadad</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><img src="<?php echo base_url() ?>assets/upload/barang/111.jpg" class="img-fluid" alt="" height=15% width=100%></td>
                    <td>
                      <div class="row">
                        <div class="col-md-6 col-xs-1">
                          <h4 class="text-left">Mangga Klonal 21 Putih Kosongan 24Kg Plus Partisi Besar Harum Manis</h4>
                          <small class="text-primary">123123R3</small>
                        <div>
                      </div>
                      <div class="row">
                        <div class="col-md-7 col-xs-12">
                          <div class="x_panel">
                            
                            <div class="bg-success col-xs-6 col-sm-6 col-md-6">
                              
                            </div>
                            <div class="bg-primary col-xs-6 col-sm-6 col-md-6">
                              
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><img src="https://localhost/billyboxbangilapi/assets/upload/barang/111.jpg" class="img-fluid" alt="" height=15% width=100%></td>
                    <td>asdadad</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><img src="https://localhost/billyboxbangilapi/assets/upload/barang/111.jpg" class="img-fluid" alt="" height=15% width=100%></td>
                    <td>asdadad</td>
                  </tr>
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