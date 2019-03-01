<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Menu</h3>
    <ul class="nav side-menu">
      <li class="<?php if(isset($lihome)){echo $lihome;} ?>"><a style="color:white" href="<?php echo base_url('home')?>"><i class="fa fa-home"></i>
          Home<span class="label label-success pull-right"></span></a>
      </li>
      <li class="<?php if(isset($libarang)){echo $libarang;} ?>"><a style="color:white"><i class="fa fa-edit"></i> Barang <span style="color:white" class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="<?php if(isset($ulbarang)){echo $ulbarang;} ?>">
          <li class="<?php if(isset($lidaftarbarang)){echo $lidaftarbarang;} ?>"><a style="color:white" href="<?php echo base_URL('barang'); ?>">Daftar Barang</a></li>
          <li class="<?php if(isset($listok)){echo $listok;} ?>"><a style="color:white" href="<?php echo base_url('stok'); ?>">Stok Gudang</a></li>
        </ul>
      </li>
      
      <li class="<?php if(isset($lipemesanan)){echo $lipemesanan;} ?>"><a style="color:white" href="<?php echo base_url('pemesanan'); ?>"><i class="fa fa fa-shopping-cart"></i>
      Pemesanan<span class="label label-success pull-right"></span></a>
      </li>

      <li class="<?php if(isset($lipelanggan)){echo $lipelanggan;} ?>"><a style="color:white" href="<?php echo base_url('pelanggan')?>"><i class="fa fa-bar-chart-o"></i>
          Pelanggan<span class="label label-success pull-right"></span></a>
      </li>
      <li class="<?php if(isset($liuser)){echo $liuser;} ?>"><a style="color:white" href="<?php echo base_url('user')?>"><i class="fa fa-bar-chart-o"></i>
          User<span class="label label-success pull-right"></span></a>
      </li>
    </ul>
  </div>             
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Settings">
    <span style="color:white" class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
    <span style="color:white" class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Lock">
    <span style="color:white" class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('login/logout')?>">
    <span style="color:white" class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>
<!-- /menu footer buttons -->