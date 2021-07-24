  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Pekerjaan TKI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/Pekerjaan/pengajuan');?>">Pekerjaan</a></li>
              <li class="breadcrumb-item active">Assign Pekerjaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form action="<?php echo base_url('index.php/data/Data_pekerjaan/assign_pekerjaan');?>" method="post">
      <section class="content">
        <div class="container-fluid">
          <?php echo $this->session->flashdata('message');?>
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pekerjaan Yang Tersedia</h3>
                </div>
                <div class="card-body table-responsive p-0">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Pekerjaan</th>
                          <th>Jenis Pekerjaan</th>
                          <th>Penerima Jasa</th>
                          <th>Negara</th>
                          <th>Slot Pekerjaan</th>
                          <th>Pilih</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($data_pekerjaan->result() != FALSE) { foreach($data_pekerjaan->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->JOB;?></td>
                            <td><?php echo $row->PEKERJAAN;?></td>
                            <td><?php echo $row->PENERIMA_JASA;?></td>
                            <td><?php echo $row->NEGARA;?></td>
                            <td><?php echo $row->SLOT_PEKERJAAN;?></td>
                            <td><input class="form-check-input" required value="<?php echo $row->ID;?>" type="radio" name="id_lowongan">
                          <label class="form-check-label">Pilih</label></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <!-- <td colspan="6" align="center">Tidak Lowongan</td> -->
                            <td colspan="6"><a href="<?php echo base_url('index.php/master/Lowongan/add'); ?>" target="_blank" class="btn btn-primary btn-block">Belum Ada Lowongan, Tambah Lowongan</a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="id_justifikasi" readonly value="<?php echo $id_justifikasi;?>">
                        <button type="submit" class="btn btn-primary btn-block" <?php if ($data_pekerjaan->result() == FALSE) { echo 'disabled';}?> onclick="clicked(event)">ASSIGN PEKERJAAN</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->