  <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '1') { ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Surat Perjanjian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Calon TKI</a></li>
              <li class="breadcrumb-item active">Pendaftaran Calon TKI</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    
    <!-- Main content -->
    <form action="<?php echo base_url('index.php/data/Data_perjanjian/generate_nomor_perjanjian');?>" method="post" enctype="multipart/form-data">
      <section class="content">
        <div class="container-fluid">
          <?php echo $this->session->flashdata('message');?>
          <?php foreach($data_perjanjian->result() as $row ): ?>
            <div class="row">
              <div class="col-md-12">
                <!-- Form Element sizes -->              
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Kepala Surat</h3>
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
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Nomor</label>
                            <div class="input-group mb-3">
                              <div class="input-group-append">
                                <span class="input-group-text">NO</span>
                              </div>
                              <input type="hidden" class="form-control" value="<?php echo $this->uri->segment('3');?>" readonly name="id_perjanjian" maxlength="3">
                              <input type="hidden" class="form-control" value="<?php echo $row->ID_JUSTIFIKASI;?>" readonly name="id_justifikasi" maxlength="3">
                              <input type="text" class="form-control" value="<?php echo $row->NO;?>" readonly maxlength="3">
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="inputnik">Nomor Surat</label>
                          <input type="text" class="form-control" readonly value="<?php echo $row->NOMOR_SURAT;?>" id="inputnik" name="nik" maxlength="16">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Tanggal Perjanjian</label>
                          <input type="date" class="form-control" id="inputnik" name="tanggal_perjanjian" maxlength="16" value="<?php echo $row->TANGGAL_PENGESAHAN2?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card --> 
              </div>
              <!--/.col (right) -->
              <!-- left column -->
              <div class="col-md-6">
                <!-- general form elements -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Pihak Pertama/Yang Bertanggung Jawab</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnama">Nama</label>
                          <input type="text" class="form-control" required id="inputnama" value="<?php echo $row->PIHAK1;?>" placeholder="Nama" name="nama_pj" maxlength="100">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">NIK</label>
                          <input type="text" class="form-control" required id="inputnik" value="<?php echo $row->NIK_PIHAK?>" placeholder="NIK" name="nik_pj" maxlength="16">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputmaidcode">Jabatan</label>
                          <input type="text" class="form-control" required id="inputmaidcode" value="<?php echo $row->JABATAN?>" placeholder="Jabatan" name="jabatan_pj" maxlength="100">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputpassport">Alamat</label>
                          <textarea class="form-control" rows="1" placeholder="Alamat..." required name="alamat_pj"><?php echo $row->ALAMAT_PIHAK1;?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Surat Keputusan</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Nomor</label>
                          <input type="text" class="form-control" required id="inputnik" placeholder="SK" name="nomor_sk" maxlength="16" value="<?php echo $row->NOMOR_SK?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Tanggal</label>
                          <input type="date" class="form-control" required id="inputnik" name="tanggal_sk" maxlength="16" value="<?php echo $row->TANGGAL_SK2?>">
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
                <!-- Form Element sizes -->              
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Pihak Kedua</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnama">Nama</label>
                          <input type="text" class="form-control" readonly id="inputnama" placeholder="Nama" value="<?php echo $row->NAMA_TKI?>" maxlength="100">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">NIK</label>
                          <input type="text" class="form-control" readonly id="inputnik" placeholder="NIK" value="<?php echo $row->NIK_TKI?>" maxlength="16">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputmaidcode">Negara Tujuan</label>
                          <input type="text" class="form-control" required readonly id="inputmaidcode" placeholder="Negara Tujuan" value="<?php echo $row->NEGARA;?>" name="negara_tujuan" maxlength="11">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputpassport">Alamat</label>
                          <textarea class="form-control" rows="1" readonly placeholder="Alamat.." required name="alamat_tki"><?php echo $row->ALAMAT_TKI?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card --> 
               <!--  <div class="card">
                  <div class="card-body row">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-primary btn-block" <?php if ($row->SURAT_PERJANJIAN_APPROVAL == '3' || $row->SURAT_PERJANJIAN_APPROVAL == '1'){ echo "disabled"; }?> onclick="clicked(event)">SUBMIT SURAT PERJANJIAN</button>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-primary btn-block" <?php if ($row->SURAT_PERJANJIAN_APPROVAL == '3' || $row->SURAT_PERJANJIAN_APPROVAL == '1'){ echo "disabled"; }?> onclick="clicked(event)">SUBMIT SURAT PERJANJIAN</button>
                    </div>
                  </div>
                </div> -->
                <div class="card">
                  <div class="card-body row">
                    <div class="col-md-6">
                      <input type="submit" value="SIMPAN" name="jenis_aksi" class="btn btn-success btn-block" <?php if ($row->SURAT_PERJANJIAN_APPROVAL == '3' || $row->SURAT_PERJANJIAN_APPROVAL == '1' || $row->SURAT_PERJANJIAN_APPROVAL == NULL){ echo "disabled"; }?> onclick="clicked(event)">
                    </div>
                    <div class="col-md-6">
                      <input type="submit" value="AJUKAN" name="jenis_aksi" class="btn btn-primary btn-block" <?php if ($row->SURAT_PERJANJIAN_APPROVAL == '3' || $row->SURAT_PERJANJIAN_APPROVAL == '1' || $row->SURAT_PERJANJIAN_APPROVAL == NULL){ echo "disabled"; }?> onclick="clicked(event)">
                    </div>
                  </div>
                </div>
              </div>
              <!--/.col (right) -->
            </div>
            <!-- /.row -->
          <?php endforeach;?>
        </div><!-- /.container-fluid -->
      </section>
    </form>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  <?php } ?>