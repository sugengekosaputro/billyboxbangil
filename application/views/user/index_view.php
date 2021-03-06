<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('user');?>">Daftar user</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah user</li>
          </ol>
        </nav>
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Users<small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                <a href="<?php echo site_url()?>user/tambah" class="btn btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
              </p>
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data['user'] as $data){ ?>
                  <tr>
                    <td><?php echo $data['id_user']; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['password']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><img src="<?php echo $data['foto']; ?>" alt="" height="100px" weight="100px"></td>
                    <td><?php echo $data['role']; ?></td>
                    <td>
                      <a href="<?php echo site_url('user/edit/'.$data['id_user']) ?>" class="btn btn-sm btn-warning"><span class="fa fa-edit">&nbsp</span>Update</a>
                      <a href="<?php echo site_url('user/hapus/'.$data['id_user']) ?>" class="btn btn-danger" onClick="javascript:return confirm(`Anda Yakin Ingin Hapus Data ?`)"><span class="fa fa-trash">&nbsp</span>Hapus</a>
                    </td>
                  </tr>
                <?php }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>