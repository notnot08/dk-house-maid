  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengajuan Pekerjaan TKI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/Pekerjaan/pengajuan');?>">Pekerjaan</a></li>
              <li class="breadcrumb-item active">Pengajuan Pekerjaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form action="<?php echo base_url('index.php/data/Data_pekerjaan/insert_justifikasi');?>" method="post">
      <section class="content">
        <div class="container-fluid">
          <?php echo $this->session->flashdata('message');?>
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Diri TKI</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <?php foreach($data_tki->result() as $row ): ?>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnama">Nama</label>
                          <input type="text" class="form-control" id="inputnama" placeholder="Nama" readonly value="<?php echo $row->NAMA?>">
                          <input type="hidden" class="form-control" readonly name="id_tki" value="<?php echo $row->ID?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">NIK</label>
                          <input type="text" class="form-control" id="inputnik" placeholder="NIK" readonly value="<?php echo $row->NIK?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputmaidcode">Maid Code</label>
                          <input type="text" class="form-control" id="inputmaidcode" placeholder="Maid Code" readonly value="<?php echo $row->MAID_CODE?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputpassport">Nomor Passport</label>
                          <input type="text" class="form-control" id="inputpassport" placeholder="Nomor Passport" readonly value="<?php echo $row->PASSPORT?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tempat Lahir</label>
                          <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" readonly value="<?php echo $row->TEMPAT_LAHIR?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tanggal Lahir</label>
                          <input type="date" class="form-control" name="tanggal_lahir" readonly value="<?php echo $row->TANGGAL_LAHIR?>">
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                    <?php foreach($data_tki2->result() as $row ): ?>
                    <input type="hidden" class="form-control" name="approval" readonly value="<?php echo $row->APPROVAL?>">
                    <?php endforeach; ?>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

              </div>
              <!--/.col (left) -->
              <!-- right column -->
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="inputmaidcode">Pekerjaan Yang Ingin Diajukan</label>
                          <select class="form-control select2" style="width: 100%;" name="jenis_pekerjaan">
                            <option selected="selected" value="ERROR">Pilih Jenis Pekerjaan</option>
                            <?php foreach($data_active_job->result() as $row ): ?>
                              <option value="<?php echo $row->ID?>"><?php echo $row->PEKERJAAN?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="inputmaidcode">Catatan</label>
                          <textarea class="form-control" rows="3" placeholder="Catatan.." name="catatan"></textarea>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                </div>
                <!-- /.card --> 
                <div class="card">
                  <div class="card-body row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-block" onclick="clicked(event)">SUBMIT PENGAJUAN</button>
                    </div>
                  </div>
                </div>
                <!-- /.card --> 
              </div>
              <!--/.col (right) -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
      </form>
      <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->