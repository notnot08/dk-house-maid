  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cari Surat Perjanjian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Surat Perjanjian</a></li>
              <li class="breadcrumb-item active">Cari Surat Perjanjian</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search Result</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>NOMOR SURAT</th>
                      <th>MAID CODE</th>
                      <th>PEKERJAAN</th>
                      <th>NAMA</th>
                      <th>PENANGGUNG JAWAB</th>
                      <th>TANGGAL PENGESAHAN</th>
                      <th>STATUS PENGESAHAN</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_result->result() as $row ): ?>
                      <tr>
                        <td><?php echo $row->NOMOR_SURAT; ?></td>
                        <td><?php echo $row->MAID_CODE; ?></td>
                        <td><?php echo $row->PEKERJAAN; ?></td>
                        <td><?php echo $row->NAMA; ?></td>
                        <td><?php echo $row->NAMA_PJ; ?></td>
                        <td><?php echo $row->TANGGAL_PENGESAHAN; ?></td>
                        <td><?php if ($row->SURAT_PERJANJIAN_APPROVAL == '0') {
                          echo '<span class="badge bg-warning">ON DRAFT</span>';
                        } elseif ($row->SURAT_PERJANJIAN_APPROVAL == '1') {
                          echo '<span class="badge bg-success">APPROVED</span>';
                        } elseif ($row->SURAT_PERJANJIAN_APPROVAL == '2') {
                          echo '<span class="badge bg-danger">REJECTED</span>';
                        } elseif ($row->SURAT_PERJANJIAN_APPROVAL == '3') {
                          echo '<span class="badge bg-primary">SUBMITED</span>';
                        } else {
                          echo '<span class="badge bg-secondary">ERROR</span>';
                        } ?></td>
                        <td><div class="btn-group">
                          <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="<?php echo base_url('index.php/Perjanjian/detail/').$row->ID;?>">Lihat Surat</a>
                            <a class="dropdown-item" href="<?php echo base_url('index.php/Pekerjaan/detail/').$row->ID_JUSTIFIKASI;?>">Lihat Detail Pekerjaan</a>
                          </div>
                        </div></td>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
<!-- /.content-wrapper -->