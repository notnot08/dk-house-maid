  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengajuan Pekerjaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/Pekerjaan/pengajuan');?>">Pekerjaan</a></li>
              <li class="breadcrumb-item active">Pendaftaran Calon TKI</li>
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
          <!-- left column -->
          <div class="col-md-12">
            <div class="card">
              <!-- form start -->
              <div class="card-body">
                <form action="<?php echo base_url('index.php/Pekerjaan/pengajuan/search');?>" method="post">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Cari Berdasarkan</label>
                        <select class="form-control" name="param">
                          <option value="NAMA">Nama TKI</option>
                          <option value="NIK">NIK TKI</option>
                          <option value="MAID_CODE">MAID CODE</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputcari">Cari</label>
                        <input type="text" class="form-control" required id="inputcari" placeholder="Cari..." name="cari">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-block">CARI DATA TKI</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <!-- <div class="card">
              <div class="card-body">
                <div class="row">
                </div>
              </div>
            </div> -->

          </div>
          <?php if ($data_result != FALSE) { ?>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Search Result</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>NIK</th>
                        <th>MAID CODE</th>
                        <th>NAMA</th>
                        <th>APPROVAL DOK TKI</th>
                        <th>KETERANGAN</th>
                        <th>AKSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data_result->result() as $row ): ?>
                        <tr>
                          <td><?php echo $row->NIK; ?></td>
                          <td><?php echo $row->MAID_CODE; ?></td>
                          <td><?php echo $row->NAMA; ?></td>
                          <td><?php if ($row->APPROVE == '0') {
                            echo '<span class="badge bg-warning">Dokumen TKI Belum Diapprove</span>';
                          } elseif ($row->APPROVE == '1') {
                            echo '<span class="badge bg-success">Dokumen TKI Sudah Diapprove</span>';
                          } elseif ($row->APPROVE == '2') {
                            echo '<span class="badge bg-danger">Dokumen TKI Ditolak</span>';
                          } ?></td>
                          <?php
                          if ($row->APPROVAL == '0') {
                            echo '<td><span class="badge bg-warning">Sedang ada pekerjaan aktif</span></td>';
                            echo '<td><a href="'.base_url("index.php/Pekerjaan/detail/").$row->ID_JUSTIFIKASI.'" class="btn btn-outline-primary btn-block"><i class="fa fa-eye"></i> Lihat Pekerjaan</a></td>';
                          } elseif ($row->APPROVAL == '1') {
                            echo '<td><span class="badge bg-success">Tidak ada pekerjaan aktif</span></td>';
                            echo '<td><a href="'.base_url("index.php/Pekerjaan/tambah/").$row->ID_TKI.'" class="btn btn-outline-primary btn-block"><i class="fa fa-edit"></i> Ajukan Pekerjaan</a></td>';
                          } elseif ($row->APPROVAL == '2') {
                            echo '<td><span class="badge bg-danger">Belum bisa mengajukan pekerjaan</span></td>';
                            echo '<td></td>';
                          } 
                          ?>
                        </tr>

                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          <?php } ?>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tersedia Untuk Diajukan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>NIK</th>
                      <th>MAID CODE</th>
                      <th>NAMA</th>
                      <th>APPROVAL DOK TKI</th>
                      <th>KETERANGAN</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_pekerjaan_available->result() as $row ): ?>
                      <tr>
                        <td><?php echo $row->NIK; ?></td>
                        <td><?php echo $row->MAID_CODE; ?></td>
                        <td><?php echo $row->NAMA; ?></td>
                        <td><?php if ($row->APPROVE == '0') {
                          echo '<span class="badge bg-warning">Dokumen TKI Belum Diapprove</span>';
                        } elseif ($row->APPROVE == '1') {
                          echo '<span class="badge bg-success">Dokumen TKI Sudah Diapprove</span>';
                        } elseif ($row->APPROVE == '2') {
                          echo '<span class="badge bg-danger">Dokumen TKI Ditolak</span>';
                        } ?></td>
                        <?php
                        if ($row->APPROVAL == '0') {
                          echo '<td><span class="badge bg-warning">Sedang ada pekerjaan aktif</span></td>';
                          echo '<td><a href="'.base_url("index.php/Pekerjaan/detail/").$row->ID_JUSTIFIKASI.'" class="btn btn-outline-primary btn-block"><i class="fa fa-eye"></i> Lihat Pekerjaan</a></td>';
                        } elseif ($row->APPROVAL == '1') {
                          echo '<td><span class="badge bg-success">Tidak ada pekerjaan aktif</span></td>';
                          echo '<td><a href="'.base_url("index.php/Pekerjaan/tambah/").$row->ID_TKI.'" class="btn btn-outline-primary btn-block"><i class="fa fa-edit"></i> Ajukan Pekerjaan</a></td>';
                        } elseif ($row->APPROVAL == '2') {
                          echo '<td><span class="badge bg-danger">Belum bisa mengajukan pekerjaan</span></td>';
                          echo '<td></td>';
                        } 
                        ?>
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