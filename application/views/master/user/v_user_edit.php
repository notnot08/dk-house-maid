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
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/master/User');?>">Master User</a></li>
              <li class="breadcrumb-item active"><a href="#">Detail</a></li>
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
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <?php foreach($data_user->result() as $row ): ?>
            <div class="card card-<?php if ($row->JENIS == '0') {
                            echo "primary";
                          } elseif ($row->JENIS == '1') {
                            echo "success";
                          } elseif ($row->JENIS == '2') {
                            echo "warning";
                          } elseif ($row->JENIS == '3') {
                            echo "secondary";
                          } elseif ($row->JENIS == '4') {
                            echo "danger";
                          }
                          ?>">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <form action="<?php echo base_url('index.php/data/Data_user/edit_user');?>" method="post">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="<?php echo $row->USERNAME; ?>">
                        <input type="hidden" readonly class="form-control" placeholder="ID USER" name="id_user" id="id_user" value="<?php echo $row->ID; ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Nama" name="nama" id="nama" value="<?php echo $row->NAMA; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Jenis User</label>
                        <select class="custom-select rounded-0" id="jenis" name="jenis">
                          <option value="<?php echo $row->JENIS; ?>"><?php if ($row->JENIS == '0') {
                            echo "Super Admin";
                          } elseif ($row->JENIS == '1') {
                            echo "Admin";
                          } elseif ($row->JENIS == '2') {
                            echo "Manager";
                          } elseif ($row->JENIS == '3') {
                            echo "Penyalur";
                          } elseif ($row->JENIS == '4') {
                            echo "Unassigned";
                          }
                          ?></option>
                          <option value="<?php echo $row->JENIS; ?>">--</option>
                          <option value="0">Super Admin</option>
                          <option value="1">Admin</option>
                          <option value="2">Manager</option>
                          <option value="3">Penyalur</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status User</label>
                        <select class="custom-select rounded-0" id="status" name="status">
                          <option value="<?php echo $row->STATUS;?>"><?php if ($row->STATUS == '1') {
                            echo "Aktif";
                          } elseif ($row->STATUS == '0') {
                            echo "Non Aktif";
                          } ?></option>
                          <option value="<?php echo $row->STATUS;?>">--</option>
                          <option value="1">Aktif</option>
                          <option value="0">Non Aktif</option>
                        </select>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-<?php if ($row->JENIS == '0') {
                            echo "primary";
                          } elseif ($row->JENIS == '1') {
                            echo "success";
                          } elseif ($row->JENIS == '2') {
                            echo "warning";
                          } elseif ($row->JENIS == '3') {
                            echo "secondary";
                          } elseif ($row->JENIS == '4') {
                            echo "danger";
                          }
                          ?>" onclick="clicked(event)">EDIT</button>
                <a href="<?php echo base_url('data/Data_user/resetPassword/').$row->USERNAME; ?>" class="btn btn-primary">Reset Password User</a>
              </div>
              </form>
            </div>
            <!-- /.card -->
            <?php endforeach; ?>

          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Log Aktivitas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Kegiatan</th>
                      <th>Catatan</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_log_activity->result() as $row ): ?>
                    <tr>
                      <td><?php echo $row->KEGIATAN; ?></td>
                      <td><?php echo $row->CATATAN; ?></td>
                      <td><?php echo $row->INSERT_DATE; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Log User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Kegiatan</th>
                      <th>Set</th>
                      <th>Catatan</th>
                      <th>User</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_log_user->result() as $row ): ?>
                    <tr>
                      <td><?php echo $row->KEGIATAN; ?></td>
                      <td><?php if ($row->CHANGE_STATUS == '1') {
                        echo "AKTIF";
                      } elseif ($row->CHANGE_STATUS == '0') {
                        echo "NON AKTIF";
                      } ?></td>
                      <td><?php echo $row->CATATAN; ?></td>
                      <td><?php echo $row->NAMA; ?></td>
                      <td><?php echo $row->INSERT_DATE; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->