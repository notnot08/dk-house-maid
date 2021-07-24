  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Lowongan Pekerjaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('');?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/master/Lowongan');?>">Lowongan</a></li>
              <li class="breadcrumb-item active">Tambah Lowongan Pekerjaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form action="<?php echo base_url('index.php/data/Data_lowongan/insert_lowongan/INSERT');?>" method="post" enctype="multipart/form-data">
      <section class="content">
        <div class="container-fluid">
          <?php echo $this->session->flashdata('message');?>
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- Form Element sizes -->
              <div class="card">
                <div class="card-body row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block" onclick="clicked(event)">SUBMIT LOWONGAN</button>
                  </div>
                </div>
              </div>
              <!-- /.card --> 

              <!-- general form elements disabled -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Lowongan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Judul Lowongan</label>
                  <input type="text" class="form-control" required placeholder="Judul" name="job" maxlength="200">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Jenis Pekerjaan</label>
                  <select class="form-control select2" style="width: 100%;" name="jenis_pekerjaan">
                    <?php foreach($data_pekerjaan_aktif->result() as $row ): ?>
                    <option selected="selected" value="<?php echo $row->ID;?>"><?php echo $row->PEKERJAAN;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Detail Pekerjaan</label>
                  <textarea class="form-control" rows="2" placeholder="Detail Pekerjaan..." name="deskripsi" required></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Negara</label>
                  <select class="form-control select2" style="width: 100%;" name="negara">
                    <?php foreach($data_negara->result() as $row ): ?>
                      <option value="<?php echo $row->CODE;?>"><?php echo $row->NEGARA;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" rows="1" placeholder="Alamat..." name="alamat"required></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Penerima Jasa</label>
                  <input type="text" class="form-control" required placeholder="Judul" name="penerima_jasa" maxlength="100">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Jenis Penerima Jasa</label>
                  <select class="form-control" name="jenis_penerima_jasa">
                    <option value="N">Rumah Tangga</option>
                    <option value="Y">Non Rumah Tangga</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email Penerima Jasa</label>
                  <input type="email" class="form-control" required placeholder="Email" name="email" maxlength="100">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Kode Penerima Jasa</label>
                  <input type="text" class="form-control" required placeholder="NPWP Jika Perusahaan, NIK Jika Rumah Tangga" name="kode_pj" maxlength="20">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Lama Pekerjaan</label>
                  <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="Angka Saja" name="lama_bekerja" maxlength="2">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Satuan Lama Pekerjaan</label>
                  <select class="form-control" name="satuan_lama_bekerja">
                    <option value="MINGGU">MINGGU</option>
                    <option value="BULAN">BULAN</option>
                    <option value="TAHUN">TAHUN</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Gaji Pokok</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="Nominal Saja" name="jumlah_gapok" maxlength="9">
                    <div class="input-group-append">
                      <span class="input-group-text">Per Bulan</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Tunjangan Kesehatan</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="Nominal Saja" name="tunjangan_kesehatan" maxlength="9">
                    <div class="input-group-append">
                      <span class="input-group-text">Per Bulan</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Tunjangan Transportasi</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="Nominal Saja" name="tunjangan_transportasi" maxlength="9">
                    <div class="input-group-append">
                      <span class="input-group-text">Per Bulan</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Uang Kerajinan</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="Nominal Saja" name="uang_kerajinan" maxlength="9">
                    <div class="input-group-append">
                      <span class="input-group-text">Per Bulan</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Biaya Pengobatan</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="Nominal Saja" name="biaya_pengobatan" maxlength="9">
                    <div class="input-group-append">
                      <span class="input-group-text">Per Bulan</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Cuti Tahunan</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder=".." name="cuti_tahunan" maxlength="2">
                    <div class="input-group-append">
                      <span class="input-group-text">Per Tahun</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Waktu Kerja</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder="..." name="waktu_kerja" maxlength="2">
                    <div class="input-group-append">
                      <span class="input-group-text">Hari</span>
                      <span class="input-group-text">Per Minggu</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Waktu Kerja</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="..." name="jam_perhari" maxlength="2">
                    <div class="input-group-append">
                      <span class="input-group-text">Jam</span>
                      <span class="input-group-text">Per Hari</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Slot</label>
                  <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnama" placeholder="Jumlah pekerja yang dibutuhkan" name="slot" maxlength="2">
                </div>
              </div>
            </div>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-body row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block" onclick="clicked(event)">SUBMIT LOWONGAN</button>
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