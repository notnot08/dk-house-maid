  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pendaftaran Penyalur</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Penyalur</a></li>
              <li class="breadcrumb-item active">Pendaftaran Penyalur</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form action="<?php echo base_url('index.php/data/Data_penyalur/insert_penyalur/INSERT');?>" method="post" enctype="multipart/form-data">
      <section class="content">
        <div class="container-fluid">
          <?php echo $this->session->flashdata('message');?>
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Diri Penyalur</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="inputnama">Nama</label>
                        <input type="text" class="form-control" required id="inputnama" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Nama" name="nama" maxlength="100">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnama">NPWP</label>
                        <input type="text" class="form-control" id="inputnama" placeholder="NPWP" name="npwp" maxlength="20">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnik">NIK</label>
                        <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="inputnik" required id="inputnik" placeholder="NIK" name="nik" maxlength="16">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' required placeholder="Tempat Lahir" name="tempat_lahir" maxlength="50">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" required name="tanggal_lahir">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="inputmaidcode">Alamat</label>
                        <textarea class="form-control" rows="2" placeholder="Alamat.." name="alamat"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->              
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pilih Perusahaan</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <div class="form-group">
                          <label>Perusahaan Asal Penyalur</label>
                          <select class="form-control select2" style="width: 100%;" name="id_group">
                            <option selected="selected" value="ERROR">Pilih Perusahaan Asal</option>
                            <?php foreach($data_perusahaan->result() as $row ): ?>
                              <option value="<?php echo $row->ID;?>"><?php echo $row->NAMA_PERUSAHAAN;?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card --> <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '1') { ?>
                <div class="card">
                  <div class="card-body row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-block" onclick="clicked(event)">SUBMIT DATA PENYALUR</button>
                    </div>
                  </div>
                </div>
                <!-- /.card --> 
              <?php } ?>
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