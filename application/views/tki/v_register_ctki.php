  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pendaftaran Calon TKI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">TKI</a></li>
              <li class="breadcrumb-item active">Pendaftaran Calon TKI</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form action="<?php echo base_url('index.php/data/Data_tki/insert_tki/INSERT');?>" method="post" enctype="multipart/form-data">
      <section class="content">
        <div class="container-fluid">
          <?php echo $this->session->flashdata('message');?>
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Diri Calon TKI</h3>
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
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnama">Nama</label>
                        <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' required id="inputnama" placeholder="Nama" name="nama" maxlength="100">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnik">NIK</label>
                        <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder="NIK" name="nik" maxlength="16">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputmaidcode">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin">
                          <option value="L">LAKI - LAKI</option>
                          <option value="P">PEREMPUAN</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputpassport">Nomor Passport</label>
                        <input type="text" class="form-control" required id="inputpassport" placeholder="Nomor Passport" name="passport" maxlength="11">
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
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kewarganegaraan</label>
                        <select class="form-control" name="kewarganegaraan">
                          <option value="WNI">WNI</option>
                          <option value="WNA">WNA</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Negara Asal</label>
                        <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Negara Asal" name="negara_asal" maxlength="50">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Agama</label>
                        <select class="form-control" name="agama">
                          <option value="ISLAM">Islam</option>
                          <option value="KRISTEN PROTESTAN">Kristen Protestan</option>
                          <option value="KATOLIK">Katolik</option>
                          <option value="HINDU">Hindu</option>
                          <option value="BUDDHA">Buddha</option>
                          <option value="KONG HU CU">Kong Hu Cu</option>
                          <option value="-">Lainnya</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select class="form-control" name="pendidikan_terakhir">
                          <option value="SD">SD</option>
                          <option value="SMP">SMP</option>
                          <option value="SMA">SMA</option>
                          <option value="D1">D1</option>
                          <option value="D2">D2</option>
                          <option value="D3">D3</option>
                          <option value="D4">D4</option>
                          <option value="S1">S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                          <option value="-">Lainnya</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tinggi Badan</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Tinggi Badan" name="tinggi_badan" maxlength="3">
                          <div class="input-group-append">
                            <span class="input-group-text">CM</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Berat Badan</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Berat Badan" name="berat_badan" maxlength="3">
                          <div class="input-group-append">
                            <span class="input-group-text">KG</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnama">Jumlah Saudara</label>
                        <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Jumlah Saudara" name="jml_saudara" maxlength="2">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnik">Anak Ke</label>
                        <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Anak Ke" name="anak_ke" maxlength="2">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnama">Status Nikah</label>
                        <select class="form-control" name="status_nikah">
                          <option value="N">Belum</option>
                          <option value="Y">Sudah</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnik">Jumlah Anak</label>
                        <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Jumlah Anak" name="jml_anak" maxlength="2">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Alamat Calon TKI</h3>
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
                        <label for="inputnama">Jenis Alamat</label>
                        <select class="form-control" name="jenis_alamat">
                          <option value="1">Sesuai KTP</option>
                          <option value="2">Tempat Tinggal Saat Ini</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="inputnik">Jalan</label>
                        <textarea class="form-control" rows="3" placeholder="Alasan.." required name="alamat"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputmaidcode">RT</label>
                        <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="inputmaidcode" placeholder="RT" name="RT" maxlength="3">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputpassport">RW</label>
                        <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="inputpassport" placeholder="RW" name="RW" maxlength="3">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kelurahan</label>
                        <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Kelurahan" name="kelurahan" maxlength="50">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kecamatan</label>
                        <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Kecamatan" name="kecamatan" maxlength="50">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kota</label>
                        <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Kota" name="kota" maxlength="50">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Provinsi" name="provinsi" maxlength="50">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Kode Pos" name="kd_pos" maxlength="50">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Desa</label>
                        <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Desa" name="desa" maxlength="50">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
                <div class="card">
              <div class="card-header">
                <h3 class="card-title">Dokumen dan Kelengkapan</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Dokumen</th>
                      <th>Upload</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $j = 0; $cek_id_jenis_dok = '';?>
                    <?php foreach($data_jenis_dok->result() as $row ): ?>
                    <tr>
                      <td><?php echo $row->NAMA_DOKUMEN;?></td>
                      <td>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file<?php echo $row->ID;?>">
                            <label class="custom-file-label" >Choose file</label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php 
                    if ($j == 0) {
                      $cek_id_jenis_dok = $row->ID;
                    } else {
                      $cek_id_jenis_dok = $row->ID.','.$cek_id_jenis_dok;
                    }
                    ?>
                    <?php $j++;?>
                    <?php endforeach;?>
                    <input type="hidden" readonly value = "<?php echo $cek_id_jenis_dok;?>" name="id_jenis_dok">
                    <input type="hidden" readonly value = "<?php echo $j;?>" name="count_jenis_dok">
                  </tbody>
                </table>
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
                <div class="card-body row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block" onclick="clicked(event)">SUBMIT DATA CALON TKI</button>
                  </div>
                </div>
              </div>
              <!-- /.card --> 

              <!-- general form elements disabled -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Kualifikasi</h3>
                  <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php $i = 0; $cek_id_kualifikasi = '';?>
                  <?php foreach($data_kualifikasi->result() as $row ): ?>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label><?php echo $row->PERTANYAAN;?></label>
                          <input type="hidden" value = "<?php echo $row->ID;?>" name="id_pertanyaan">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <?php 
                      if ($row->JENIS == '1') {
                        echo '<div class="col-sm-2">
                        <div class="form-group">
                        <div class="form-check">
                        <input class="form-check-input" type="radio" value="Y" name="jawaban'.$row->ID.'">
                        <label class="form-check-label">YA</label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" value="N" name="jawaban'.$row->ID.'">
                        <label class="form-check-label">TIDAK</label>
                        </div>
                        </div>
                        </div>
                        <div class="col-sm-10">
                        <div class="form-group">
                        <textarea class="form-control" rows="1" placeholder="Alasan.." name="keterangan'.$row->ID.'"></textarea>
                        </div>
                        </div>';
                      } else {
                        echo '<div class="col-sm-12">
                        <div class="form-group">
                        <textarea class="form-control" rows="1" placeholder="Jawaban.." name="keterangan'.$row->ID.'"></textarea>
                        </div>
                        </div>';
                      }

                      ?>
                    </div>
                    <?php 
                    if ($i == 0) {
                      $cek_id_kualifikasi = $row->ID;
                    } else {
                      $cek_id_kualifikasi = $row->ID.','.$cek_id_kualifikasi;
                    }
                    ?>
                    <?php $i++;?>
                  <?php endforeach; ?>
                  <input type="hidden" value = "<?php echo $cek_id_kualifikasi;?>" name="id_kualifikasi">
                  <input type="hidden" value = "<?php echo $i;?>" name="count_kualifikasi">
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card --> 
              <div class="card">
                <div class="card-body row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block" onclick="clicked(event)">SUBMIT DATA CALON TKI</button>
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