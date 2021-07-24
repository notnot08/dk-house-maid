  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah <?php echo $jenis_detail; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/master/Konten');?>">Master Konten</a></li>
              <li class="breadcrumb-item active"><a href="#">Tambah <?php echo $jenis_detail; ?></a></li>
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
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Tambah <?php echo $jenis_detail; ?></h3>
                </div>
                <!-- /.card-header -->
                <form action="<?php echo base_url('index.php/data/Data_konten/add_konten/')?>" method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Judul</label>
                          <input type="text" class="form-control" placeholder="Judul <?php echo $jenis_detail; ?>" name="judul" id="judul">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Jenis Konten</label>
                          <select class="custom-select rounded-0" id="jenis" name="jenis">
                          <option value="<?php echo $jenis;?>"><?php echo $jenis_detail; ?></option>
                        </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <textarea id="summernote" name="paragraph" placeholder="...">
                        </textarea>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-secondary" onclick="clicked(event)">Publish <?php echo $jenis_detail; ?></button>
                  </div>
                </form>
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