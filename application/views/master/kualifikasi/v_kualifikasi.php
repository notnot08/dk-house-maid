  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Kualifikasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="<?php echo base_url('index.php/master/Kualifikasi');?>">Master Kualifikasi</a></li>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-kualifikasi">Tambah Pertanyaan Kualifikasi Baru</button>
              </div>
              <div class="card-body">
                <table id="non_export" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>PERTANYAAN</th>
                      <th>CATATAN</th>
                      <th>JENIS PERTANYAAN</th>
                      <th>STATUS</th>
                      <th>WAKTU DIBUAT</th>
                      <th>DIBUAT OLEH</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_kualifikasi->result() as $row ): ?>
                      <tr>
                        <td><?php echo $row->PERTANYAAN;?></td>
                        <td><?php echo $row->CATATAN;?></td>
                        <td><?php if ($row->JENIS == '1') {
                          echo '<span class="badge bg-success">Pilihan YA atau TIDAK</span>';
                        } else {
                          echo '<span class="badge bg-warning">Pertanyaan Biasa</span>';
                        }
                        ?></td>
                        <td><?php if ($row->STATUS == '1') {
                          echo '<span class="badge bg-success">AKTIF</span>';
                        } elseif ($row->STATUS == '0') {
                          echo '<span class="badge bg-danger">NON AKTIF</span>';
                        } else {
                          echo '<span class="badge bg-danger">UNDEFINED</span>';
                        }
                        ?></td>
                        <td><?php echo $row->INSERT_DATE;?></td>
                        <td><?php echo $row->NAMA;?></td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <?php if ($row->STATUS == '1') {
                                echo '<a class="dropdown-item" href="'.base_url('index.php/data/Data_kualifikasi/changestatus_kualifikasi/0/').$row->ID; echo '">Deactivate Kualifikasi</a>';
                              } elseif ($row->STATUS == '0') {
                                echo '<a class="dropdown-item" href="'.base_url('index.php/data/Data_kualifikasi/changestatus_kualifikasi/1/').$row->ID; echo '">Activate Kualifikasi</a>';
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
                      <th>PERTANYAAN</th>
                      <th>CATATAN</th>
                      <th>JENIS PERTANYAAN</th>
                      <th>STATUS</th>
                      <th>WAKTU DIBUAT</th>
                      <th>DIBUAT OLEH</th>
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
                <h3 class="card-title">Log Kualifikasi</h3>
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
                    <?php foreach($data_log_kualifikasi->result() as $row ): ?>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-add-kualifikasi">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="<?php echo base_url('index.php/data/Data_kualifikasi/insert_kualifikasi');?>" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Pertanyaan Kualifikasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Pertanyaan</label>
                  <textarea class="form-control" rows="1" placeholder="Pertanyaan ..." name="pertanyaan" id="pertanyaan" required></textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Jenis Kualifikasi</label>
                  <select class="form-control" name="jenis">
                    <option value="0">Pertanyaan Biasa</option>
                    <option value="1">Pilihan YA atau TIDAK</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Catatan</label>
                  <textarea class="form-control" rows="1" placeholder="Catatan ..." name="catatan" id="catatan"></textarea>
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