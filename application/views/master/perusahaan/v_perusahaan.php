  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Perusahaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="<?php echo base_url('index.php/master/Pekerjaan');?>">Master Perusahaan</a></li>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-job">Tambah Perusahaan Baru</button>
              </div>
              <div class="card-body">
                <table id="non_export" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>PERUSAHAAN</th>
                      <th>ALAMAT</th>
                      <th>FLAG GROUP</th>
                      <th>STATUS</th>
                      <th>DIBUAT OLEH</th>
                      <th>WAKTU DIBUAT</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($allPerusahaan->result() as $row) :?>
                    <tr>
                      <td><?php echo $row->NAMA_PERUSAHAAN;?></td>
                      <td><?php echo $row->ALAMAT;?></td>
                      <td><?php if ($row->KET != NULL) { 
                        echo '<span class="badge bg-primary">'.$row->KET.'</span>';
                      }?></td>
                      <td><?php if ($row->STATUS == '1') {
                        echo '<span class="badge bg-success">AKTIF</span>';
                      } elseif ($row->STATUS == '0') {
                        echo '<span class="badge bg-warning">NON AKTIF</span>';
                      } else {
                        echo '<span class="badge bg-danger">UNDEFINED</span>';
                      }
                      ?></td>
                      <td><?php echo $row->NAMA;?></td>
                      <td><?php echo $row->INSERT_DATE;?></td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="#">EDIT</a>
                            <?php if ($row->KET == NULL) { ?>
                              <a class="dropdown-item" href="<?php echo base_url('data/Data_perusahaan/procgenerateGroupPenyalur/').$row->ID;?>">GENERATE GROUP PENYALUR</a>
                            <?php } ?>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>PERUSAHAAN</th>
                      <th>ALAMAT</th>
                      <th>FLAG GROUP</th>
                      <th>STATUS</th>
                      <th>DIBUAT OLEH</th>
                      <th>WAKTU DIBUAT</th>
                      <th></th>
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
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Log List Perusahaan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Kegiatan</th>
                      <th>SET</th>
                      <th>Catatan</th>
                      <th>Created By</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
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
  <div class="modal fade" id="modal-add-job">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="<?php echo base_url('index.php/data/Data_perusahaan/insert_com');?>" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Perusahaan Baru</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Nama Perusahaan</label>
                  <input type="text" class="form-control" placeholder="Nama Perusahaan" name="nama_perusahaan" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email Perusahaan</label>
                  <input type="email" class="form-control" placeholder="Email Perusahaan" name="email_perusahaan" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nomor Telp Perusahaan</label>
                  <input type="text" class="form-control" placeholder="Nomor Telp Perusahaan" name="no_telp_perusahaan" required maxlength="12">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>NPWP</label>
                  <input type="text" class="form-control" placeholder="NPWP Perusahaan" name="npwp_perusahaan" maxlength="20">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Alamat Perusahaan</label>
                  <textarea class="form-control" rows="1" placeholder="Alamat Perusahaan ..." name="alamat_perusahaan" required></textarea>
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