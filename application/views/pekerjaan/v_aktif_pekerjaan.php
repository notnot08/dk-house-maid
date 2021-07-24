  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pekerjaan Aktif</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/Pekerjaan/pengajuan');?>">Pekerjaan</a></li>
              <li class="breadcrumb-item active">Pekerjaan Aktif</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pekerjaan Aktif</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>NAMA</th>
                      <th>MAID CODE</th>
                      <th>PEKERJAAN</th>
                      <th>DOK TKI</th>
                      <th>ASSIGN PEKERJAAN</th>
                      <th>SURAT PERJANJIAN</th>
                      <th>KONTRAK KERJA</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data_pekerjaan_aktif != FALSE) { ?>
                      <?php foreach($data_pekerjaan_aktif->result() as $row ): ?>
                        <tr>
                          <td><?php echo $row->NAMA; ?></td>
                          <td><?php echo $row->MAID_CODE; ?></td>
                          <td><?php echo $row->PEKERJAAN; ?></td>
                          <td><?php if ($row->APPROVE == '0') {
                            echo '<span class="badge bg-warning">Belum Diapprove</span>';
                          } elseif ($row->APPROVE == '1') {
                            echo '<span class="badge bg-success"><i class="fa fa-check"></i></span>';
                          } elseif ($row->APPROVE == '2') {
                            echo '<span class="badge bg-danger">Ditolak</span>';
                          } ?></td>
                          <td><?php if ($row->ID_LOWONGAN == NULL) {
                            echo '<span class="badge bg-warning">Belum Diassign</span>';
                          } else {
                            echo '<span class="badge bg-success"><i class="fa fa-check"></i></span>';
                          } ?></td>
                          <td><?php if ($row->SURAT_PERJANJIAN_APPROVAL == '0') {
                            echo '<span class="badge bg-warning">Belum Diapprove</span>';
                          } elseif ($row->SURAT_PERJANJIAN_APPROVAL == '1') {
                            echo '<span class="badge bg-success"><i class="fa fa-check"></i></span>';
                          } elseif ($row->SURAT_PERJANJIAN_APPROVAL == '2') {
                            echo '<span class="badge bg-danger">Ditolak</span>';
                          } elseif ($row->SURAT_PERJANJIAN_APPROVAL == '3') {
                            echo '<span class="badge bg-primary">Submit</span>';
                          } ?></td>
                          <td><?php if ($row->KONTRAK_KERJA_APPROVAL == '0') {
                            echo '<span class="badge bg-warning">Belum Diapprove</span>';
                          } elseif ($row->KONTRAK_KERJA_APPROVAL == '1') {
                            echo '<span class="badge bg-success"><i class="fa fa-check"></i></span>';
                          } elseif ($row->KONTRAK_KERJA_APPROVAL == '2') {
                            echo '<span class="badge bg-danger">Ditolak</span>';
                          } elseif ($row->KONTRAK_KERJA_APPROVAL == '3') {
                            echo '<span class="badge bg-primary">Submit</span>';
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
                      <th>NAMA</th>
                      <th>MAID CODE</th>
                      <th>PEKERJAAN</th>
                      <th>DOK TKI</th>
                      <th>ASSIGN PEKERJAAN</th>
                      <th>SURAT PERJANJIAN</th>
                      <th>KONTRAK KERJA</th>
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