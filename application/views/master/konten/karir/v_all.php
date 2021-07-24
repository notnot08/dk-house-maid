  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Karir</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/master/Konten');?>">Master Konten</a></li>
              <li class="breadcrumb-item active"><a href="#">Karir</a></li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Karir</h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a href="<?php echo base_url('index.php/master/Konten/add/2');?>" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="non_export" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Judul</th>
                      <th>Created By</th>
                      <th>Status</th>
                      <th>Insert Date</th>
                      <th>Last Update</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_result->result() as $row ): ?>
                      <tr>
                        <td><?php echo $row->JUDUL;?></td>
                        <td><?php echo $row->USER;?></td>
                        <td><?php if ($row->STATUS == '1') {
                          echo '<span class="badge bg-success">Aktif</span>';
                        } elseif ($row->STATUS == '0') {
                          echo '<span class="badge bg-warning">Non Aktif</span>';
                        } ?></td>
                        <td><?php echo $row->INSERT_DATE;?></td>
                        <td><?php echo $row->UPDATE_DATE;?></td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="<?php echo base_url('index.php/master/Konten/detail/'); echo $row->ID;?>">Edit</a>
                              <?php if ($row->STATUS == '1') {
                                echo '<a class="dropdown-item" href="'.base_url('index.php/data/Data_konten/changestatus_konten/0/').$row->ID; echo '" onclick="clicked(event)">Deactivate Konten</a>';
                              } elseif ($row->STATUS == '0') {
                                echo '<a class="dropdown-item" href="'.base_url('index.php/data/Data_konten/changestatus_konten/1/').$row->ID; echo '" onclick="clicked(event)">Activate Konten</a>';
                              } 
                              ?>
                            </div>
                          </div>
                        </td>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->