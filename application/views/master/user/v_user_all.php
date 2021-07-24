  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="<?php echo base_url('index.php/master/User');?>">Master User</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php echo $this->session->flashdata('message');?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-user">Tambah User Baru</button>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>USERNAME</th>
                      <th>NAMA</th>
                      <th>JENIS USER</th>
                      <th>STATUS</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_user->result() as $row ): ?>
                      <tr>
                        <td><?php echo $row->USERNAME; ?></td>
                        <td><?php echo $row->NAMA; ?></td>
                        <td><?php if ($row->JENIS == '0') {
                          echo '<span class="badge bg-secondary">SUPERADMIN</span>';
                        } elseif ($row->JENIS == '1') {
                          echo '<span class="badge bg-secondary">ADMIN</span>';
                        } elseif ($row->JENIS == '2') {
                          echo '<span class="badge bg-secondary">MANAGER</span>';
                        } elseif ($row->JENIS == '3') {
                          echo '<span class="badge bg-secondary">PENYALUR</span>';
                        } else {
                          echo '<span class="badge bg-secondary">UNASSIGNED</span>';
                        }
                        ?>
                      </td>
                      <td><?php if ($row->STATUS == '1') {
                        echo '<span class="badge bg-success">AKTIF</span>';
                      } elseif ($row->STATUS == '0') {
                        echo '<span class="badge bg-danger">NON AKTIF</span>';
                      } else {
                        echo '<span class="badge bg-danger">UNDEFINED</span>';
                      }
                      ?>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="<?php echo base_url('index.php/master/User/detail/'); echo $row->ID;?>">Edit</a>
                          <a class="dropdown-item" href="<?php echo base_url('data/Data_user/resetPassword/').$row->USERNAME; ?>">Reset Password</a>
                          <?php if ($row->STATUS == '1') {
                            echo '<a class="dropdown-item" href="'.base_url('index.php/data/Data_user/changestatus_user/0/').$row->ID; echo '" onclick="clicked(event)">Deactivate User</a>';
                          } elseif ($row->STATUS == '0') {
                            echo '<a class="dropdown-item" href="'.base_url('index.php/data/Data_user/changestatus_user/1/').$row->ID; echo '" onclick="clicked(event)">Activate User</a>';
                          } 
                          ?>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>USERNAME</th>
                  <th>NAMA</th>
                  <th>JENIS USER</th>
                  <th>STATUS</th>
                  <th>AKSI</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="modal-add-user">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url('index.php/data/Data_user/insert_user');?>" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Tambah User Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="Nama" name="nama" id="nama" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Jenis User</label>
                <select class="custom-select rounded-0" id="jenis" name="jenis">
                  <option value="0">--</option>
                  <?php if ($_SESSION['logged_in']['role'] == '0') { ?> <option value="0">Super Admin</option><?php } ?>
                  <option value="1">Admin</option>
                  <option value="2">Manager</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" onclick="clicked(event)">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
      <!-- /.modal -->