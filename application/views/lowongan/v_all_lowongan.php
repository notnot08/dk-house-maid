  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lowongan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="<?php echo base_url('index.php/master/Lowongan');?>">Lowongan</a></li>
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
                <?php if ($_SESSION['logged_in']['role'] != '3') { ?>
                  <a href="<?php echo base_url('index.php/master/Lowongan/add');?>" class="btn btn-primary">Tambah Lowongan Baru</a>
                <?php } else { echo "Lowongan"; } ?>
              </div>
              <div class="card-body">
                <table id="non_export" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>PEKERJAAN</th>
                      <th>JENIS</th>
                      <th>NEGARA</th>
                      <th>PENERIMA JASA</th>
                      <th>KETERSEDIAAN</th>
                      <th>SLOT TKI</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_result->result() as $row ): ?>
                      <tr>
                        <td><?php echo $row->PEKERJAAN;?></td>
                        <td><?php echo $row->JENIS;?></td>
                        <td><?php echo $row->NEGARA;?></td>
                        <td><?php echo $row->PENERIMA_JASA;?></td>
                        <td><?php if ($row->IS_USED == 'N') {
                          echo '<span class="badge bg-success">'.$row->IS_USED2.'</span>';
                        } elseif($row->IS_USED == 'Y') {
                          echo '<span class="badge bg-danger">'.$row->IS_USED2.'</span>';
                        }
                        ?></td>
                        <td><?php echo $row->SLOT_PEKERJAAN;?></td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="#">Deactivate Kualifikasi</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>PEKERJAAN</th>
                      <th>JENIS</th>
                      <th>NEGARA</th>
                      <th>PENERIMA JASA</th>
                      <th>KETERSEDIAAN</th>
                      <th>SLOT TKI</th>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->