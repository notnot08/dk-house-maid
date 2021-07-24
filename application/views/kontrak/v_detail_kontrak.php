  <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '2') { ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Kontrak</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Kontrak</a></li>
              <li class="breadcrumb-item active">Detail Kontrak</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    
    <!-- Main content -->
    <form action="<?php echo base_url('index.php/data/Data_kontrak/generate_nomor_kontrak');?>" method="post" enctype="multipart/form-data">
      <section class="content">
        <div class="container-fluid">
          <?php echo $this->session->flashdata('message');?>
          <?php foreach($data_kontrak->result() as $row ): ?>
            <div class="row">
              <div class="col-md-12">
                <!-- Form Element sizes -->              
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Kepala Surat Kontrak Kerja</h3>
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
                              <input type="hidden" class="form-control" value="<?php echo $row->ID;?>" readonly name="id_kontrak" maxlength="3">
                              <input type="hidden" class="form-control" value="<?php echo $row->ID_JUSTIFIKASI;?>" readonly name="id_justifikasi" maxlength="3">
                              <input type="hidden" class="form-control" value="<?php echo $row->ID_PEKERJAAN;?>" readonly name="id_pekerjaan" maxlength="3">
                              <input type="text" class="form-control" value="<?php echo $row->NO;?>" readonly maxlength="3">
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="inputnik">Nomor Kontrak</label>
                          <input type="text" class="form-control" readonly value="<?php echo $row->NO_KONTRAK;?>" id="inputnik" maxlength="12">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Tanggal Pengesahan Kontrak</label>
                          <input type="date" required class="form-control" id="inputnik" name="tgl_pengesahan" value="<?php echo $row->TGL_PENGESAHAN;?>">
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
                    <h3 class="card-title">Pihak Pertama</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="inputnik">Nama Perusahaan</label>
                          <input type="text" class="form-control" required readonly name="pihak_pertama" value="<?php echo $row->NAMA_PERUSAHAAN;?>">
                          <input type="hidden" class="form-control" required name="id_perusahaan" readonly value="<?php echo $row->ID_PERUSAHAAN;?>">
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="inputnik">Alamat Perusahaan</label>
                          <textarea class="form-control" rows="1" readonly><?php echo $row->ALAMAT_PERUSAHAAN;?></textarea>
                        </div>
                        <!-- /.form-group -->
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Masa Berlaku Kontrak Kerja</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Berlaku Selama</label>
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="Angka.." name="lama_kontrak" maxlength="2" value="<?php echo $row->LAMA_KONTRAK2;?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label>Satuan Lama</label>
                        <select class="custom-select rounded-0" name="satuan_lama_kontrak">
                          <option value="<?php echo $row->SATUAN_LAMA_KONTRAK2;?>"><?php echo $row->SATUAN_LAMA_KONTRAK2;?></option>
                          <option value="bulan">--</option>
                          <option value="hari">HARI</option>
                          <option value="minggu">MINGGU</option>
                          <option value="bulan">BULAN</option>
                          <option value="tahun">TAHUN</option>
                        </select>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Tanggal Mulai</label>
                          <input type="date" class="form-control" required name="tanggal_mulai" maxlength="16" value="<?php echo $row->TANGGAL_MULAI;?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Tanggal Selesai</label>
                          <input type="date" class="form-control" required name="tanggal_selesai" maxlength="16" value="<?php echo $row->TANGGAL_SELESAI;?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Syarat Pengunduran Diri</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Masa kerja yang harus dipenuhi</label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder=".." name="syarat_undurdiri" maxlength="2" value="<?php echo $row->SYARAT_UNDURDIRI;?>">
                              <div class="input-group-append">
                                <span class="input-group-text">Bulan</span>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Minimal bulan membuat surat pengunduran</label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder=".." name="waktu_undurdiri" maxlength="2" value="<?php echo $row->WAKTU_UNDURDIRI;?>">
                              <div class="input-group-append">
                                <span class="input-group-text">Bulan</span>
                              </div>
                            </div>
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
                          <input type="text" class="form-control" readonly required placeholder="Nama" name="pihak_kedua" value="<?php echo $row->NAMA_PIHAK2;?>" maxlength="100">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">NIK</label>
                          <input type="text" class="form-control" readonly required placeholder="NIK" value="<?php echo $row->NIK_PIHAK2;?>" maxlength="16">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputmaidcode">Tempat, Tanggal Lahir</label>
                          <input type="text" class="form-control" readonly required placeholder="Tempat, Tanggal Lahir" value="<?php echo $row->LAHIR_PIHAK2;?>" maxlength="100">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputpassport">Alamat</label>
                          <textarea class="form-control" rows="1" readonly required placeholder="Alamat.."><?php echo $row->ALAMAT_PIHAK2; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card --> 
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Waktu Kerja dan Cuti</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Waktu Kerja</label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder="..." name="waktu_kerja" maxlength="2" value="<?php echo $row->WAKTU_KERJA2; ?>">
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
                              <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder=".." name="jam_perhari" maxlength="2" value="<?php echo $row->JAM_PERHARI2;?>">
                              <div class="input-group-append">
                                <span class="input-group-text">Jam</span>
                                <span class="input-group-text">Per Hari</span>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Jumlah Cuti Tahunan</label>
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder=".." name="cuti_tahunan" maxlength="2" value="<?php echo $row->CUTI_TAHUNAN2;?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Gaji, Tunjangan, Insentif, Lembur, dan Biaya Pengobatan</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Tanggal Pemberian Gaji</label>
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder="..." name="tgl_pemberian_gaji" maxlength="2" value="<?php echo $row->TGL_PEMBERIAN_GAJI; ?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Gaji Pokok</label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder="Nominal Saja" name="jumlah_gapok" maxlength="9" value="<?php echo $row->JUMLAH_GAPOK2; ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">Per Bulan</span>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tunjangan Kesehatan</label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder="Nominal Saja" name="tunjangan_kesehatan" maxlength="9" value="<?php echo $row->TUNJANGAN_KESEHATAN2; ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">Per Bulan</span>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tunjangan Transportasi</label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder="Nominal Saja" name="tunjangan_transportasi" maxlength="9" value="<?php echo $row->TUNJANGAN_TRANSPORTASI2;?>">
                              <div class="input-group-append">
                                <span class="input-group-text">Per Bulan</span>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Kerajinan Dalam Bekerja</label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder="Nominal Saja" name="uang_kerajinan" maxlength="9" value="<?php echo $row->UANG_KERAJINAN2; ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">Per Bulan</span>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Biaya Pengobatan</label>
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required id="inputnik" placeholder="Nominal Saja" name="biaya_pengobatan" maxlength="9" value="<?php echo $row->BIAYA_PENGOBATAN2;?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-body row">
                    <div class="col-md-6">
                      <input type="submit" value="SIMPAN" name="jenis_aksi" class="btn btn-success btn-block" <?php if ($row->KONTRAK_KERJA_APPROVAL == '3' || $row->KONTRAK_KERJA_APPROVAL == '1' || $row->KONTRAK_KERJA_APPROVAL == NULL){ echo "disabled"; }?> onclick="clicked(event)">
                    </div>
                    <div class="col-md-6">
                      <input type="submit" value="AJUKAN" name="jenis_aksi" class="btn btn-primary btn-block" <?php if ($row->KONTRAK_KERJA_APPROVAL == '3' || $row->KONTRAK_KERJA_APPROVAL == '1' || $row->KONTRAK_KERJA_APPROVAL == NULL){ echo "disabled"; }?> onclick="clicked(event)">
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