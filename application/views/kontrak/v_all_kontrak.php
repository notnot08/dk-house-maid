  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kontrak Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Kontrak</a></li>
              <li class="breadcrumb-item active">Data Kontrak Kerja</li>
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
                <h3 class="card-title">Manage Kontrak</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>NOMOR SURAT</th>
                      <th>MAID CODE</th>
                      <th>NAMA</th>
                      <th>PEKERJAAN</th>
                      <th>PIHAK PERTAMA</th>
                      <th>TANGGAL PENGESAHAN</th>
                      <th>STATUS PENGESAHAN</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_result->result() as $row ): ?>
                      <tr>
                        <td><?php echo $row->NO_KONTRAK; ?></td>
                        <td><?php echo $row->MAID_CODE; ?></td>
                        <td><?php echo $row->NAMA; ?></td>
                        <td><?php echo $row->PEKERJAAN; ?></td>
                        <td><?php echo $row->PIHAK_PERTAMA; ?></td>
                        <td><?php echo $row->TANGGAL_PENGESAHAN; ?></td>
                        <td><?php if ($row->KONTRAK_KERJA_APPROVAL == '0') {
                          echo '<span class="badge bg-primary">NEW</span>';
                        } elseif ($row->KONTRAK_KERJA_APPROVAL == '1') {
                          echo '<span class="badge bg-success">APPROVED</span>';
                        } elseif ($row->KONTRAK_KERJA_APPROVAL == '2') {
                          echo '<span class="badge bg-warning">REJECTED</span>';
                        } 
                        ?>
                      </td>
                        <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="<?php echo base_url('index.php/Kontrak/detail/').$row->ID;?>">Detail</a>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
<!-- /.content-wrapper -->