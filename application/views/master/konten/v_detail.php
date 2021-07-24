  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Konten</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/master/Konten');?>">Master Konten</a></li>
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
            <?php foreach($data_result->result() as $row ): ?>
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Edit Konten</h3>
                </div>
                <!-- /.card-header -->
                <form action="<?php echo base_url('index.php/data/Data_konten/edit_konten/').$row->ID;?>" method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Judul</label>
                          <input type="text" class="form-control" placeholder="Judul" name="judul" id="judul" value="<?php echo $row->JUDUL; ?>">
                          <input type="hidden" readonly class="form-control" placeholder="ID USER" name="id_user" id="id_user" value="<?php echo $row->ID; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Jenis Konten</label>
                          <select class="custom-select rounded-0" id="jenis" name="jenis">
                          <option value="<?php echo $row->JENIS_KONTEN; ?>"><?php if($row->JENIS_KONTEN == '1'){ echo "Pengumuman"; } elseif ($row->JENIS_KONTEN == '2') {
                            echo "Karir"; } elseif ($row->JENIS_KONTEN == '3') { echo "Berita"; } ?></option>
                        </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <textarea id="summernote" name="paragraph">
                          <?php echo $row->DESKRIPSI; ?>
                        </textarea>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-secondary" onclick="clicked(event)">EDIT</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            <?php endforeach; ?>

          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Log Aktivitas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Kegiatan</th>
                      <th>Catatan</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
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