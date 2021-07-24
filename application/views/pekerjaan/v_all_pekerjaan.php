  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Pekerjaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/Pekerjaan/pengajuan');?>">Pekerjaan</a></li>
              <li class="breadcrumb-item active">Manage Pekerjaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php echo $this->session->flashdata('message');?>
        <?php foreach($count_job->result() as $row ): ?>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $row->PEKERJAAN_AKTIF;?></h3>

                <p>Pekerjaan Aktif</p>
              </div>
              <div class="icon">
                <i class="fa fa-handshake"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $row->PEKERJAAN_SELESAI;?></h3>

                <p>Pekerjaan Selesai</p>
              </div>
              <div class="icon">
                <i class="fa fa-thumbs-up"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $row->PEKERJAAN_DIBATALKAN;?></h3>

                <p>Pekerjaan Dibatalkan</p>
              </div>
              <div class="icon">
                <i class="fa fa-thumbs-down"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $row->TOTAL_PEKERJAAN;?></h3>

                <p>Total Pekerjaan</p>
              </div>
              <div class="icon">
                <i class="fa fa-calculator"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <?php endforeach; ?>
        <!-- /.row -->
        <div class="row">
          <!-- left column -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Pekerjaan</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>MAID CODE</th>
                      <th>NAMA</th>
                      <th>PEKERJAAN</th>
                      <th>PROGRESS</th>
                      <th>STATUS</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data_pekerjaan_aktif != FALSE) { ?>
                      <?php foreach($data_pekerjaan_aktif->result() as $row ): ?>
                        <tr>
                          <td><?php echo $row->MAID_CODE; ?></td>
                          <td><?php echo $row->NAMA; ?></td>
                          <td><?php echo $row->PEKERJAAN; ?></td>
                          <td><?php if ($row->PROGRESS == '0') {
                            echo '<span class="badge bg-success">COMPLETED</i></span>';
                          } elseif ($row->PROGRESS == '1') {
                            echo '<span class="badge bg-warning">ON GOING</i></span>';
                          } elseif ($row->PROGRESS == '5') {
                            echo '<span class="badge bg-danger">CANCELLED</i></span>';
                          } ?></td>
                          <td><?php if ($row->STATUS_JUSTIFIKASI == '1') {
                            echo '<span class="badge bg-success">ACTIVE</i></span>';
                          } elseif ($row->STATUS_JUSTIFIKASI == '0') {
                            echo '<span class="badge bg-warning">NON ACTIVE</i></span>';
                          } ?></td>
                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="<?php echo base_url("index.php/Pekerjaan/detail/").$row->ID_JUSTIFIKASI?>">Lihat</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php } else { ?>
                      <tr>
                        <td colspan="6"><p style="text-align:center">Tidak Ada Data</p></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>MAID CODE</th>
                      <th>NAMA</th>
                      <th>PEKERJAAN</th>
                      <th>PROGRESS</th>
                      <th>STATUS</th>
                      <th>AKSI</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
  <!-- /.content-wrapper -->