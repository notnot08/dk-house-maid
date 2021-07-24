  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail TKI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">TKI</a></li>
              <li class="breadcrumb-item active">Detail TKI</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>    

    <!-- Main content -->
    <form action="<?php echo base_url('index.php/data/Data_tki/insert_tki/UPDATE');?>" method="post" enctype="multipart/form-data">
      <section class="content">
        <div class="container-fluid">
          <?php echo $this->session->flashdata('message');?>
          <?php foreach($data_tki->result() as $row ): ?>
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h5>Status Pengajuan TKI</h5>
                    <h6><?php echo $row->STATUS_APPROVE;?></h6>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h5>Pengaju TKI</h5>
                    <h6><?php echo $row->NAMA_PENGAJU;?></h6>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h5>Naungan Perusahaan</h5>
                    <h6><?php echo $row->NAMA_PERUSAHAAN;?></h6>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h5>Tanggal Dibuat</h5>
                    <h6><?php echo $row->INSERT_DATE;?></h6>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
          <?php endforeach; ?>
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Diri Calon TKI</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?php foreach($data_tki->result() as $row ): $id_tki = $row->ID; $approve = $row->APPROVE; $catatan = $row->CATATAN;?>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnama">Nama</label>
                          <input type="text" class="form-control"  id="inputnama" placeholder="Nama" name="nama" maxlength="100" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' value="<?php echo $row->NAMA;?>">
                          <input type="hidden" class="form-control"  id="inputnama" placeholder="Nama" name="id_tki" maxlength="100" value="<?php echo $id_tki;?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">NIK</label>
                          <input type="text" class="form-control"  class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="inputnik" placeholder="NIK" name="nik" maxlength="16" value="<?php echo $row->NIK;?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="inputmaidcode">Maid Code</label>
                          <input type="text" class="form-control" readonly id="inputmaidcode" placeholder="Maid Code" name="maid_code" maxlength="11" value="<?php echo $row->MAID_CODE;?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="inputmaidcode">Jenis Kelamin</label>
                          <input type="text" class="form-control"  id="inputmaidcode" placeholder="..." name="jenis_kelamin" maxlength="50" value="<?php if($row->JENIS_KELAMIN == 'L'){echo 'LAKI - LAKI';} elseif($row->JENIS_KELAMIN == 'P'){echo 'PEREMPUAN';}?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="inputpassport">Nomor Passport</label>
                          <input type="text" class="form-control"  id="inputpassport" placeholder="Nomor Passport" name="passport" maxlength="11" value="<?php echo $row->PASSPORT;?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tempat Lahir</label>
                          <input type="text" class="form-control"  placeholder="Tempat Lahir" name="tempat_lahir" maxlength="50" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' value="<?php echo $row->TEMPAT_LAHIR;?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tanggal Lahir</label>
                          <input type="date" class="form-control"  name="tanggal_lahir" value="<?php echo $row->TANGGAL_LAHIR;?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Kewarganegaraan</label>
                          <select class="form-control" name="kewarganegaraan" >
                            <option value="<?php echo $row->KEWARGANEGARAAN;?>"><?php echo $row->KEWARGANEGARAAN;?></option>
                            <option value="<?php echo $row->KEWARGANEGARAAN;?>">--</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Negara Asal</label>
                          <input type="text" class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Negara Asal" name="negara_asal" maxlength="50" value="<?php echo $row->NEGARA_ASAL;?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Agama</label>
                          <select class="form-control" name="agama" >
                            <option value="<?php echo $row->AGAMA;?>"><?php echo $row->AGAMA;?></option>
                            <option value="<?php echo $row->AGAMA;?>">--</option>
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
                          <select class="form-control" name="pendidikan_terakhir" >
                            <option value="<?php echo $row->PENDIDIKAN_TERAKHIR;?>"><?php echo $row->PENDIDIKAN_TERAKHIR;?></option>
                            <option value="<?php echo $row->PENDIDIKAN_TERAKHIR;?>">--</option>
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
                            <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="Tinggi Badan" name="tinggi_badan" maxlength="3" value="<?php echo $row->TINGGI_BADAN;?>">
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
                            <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="Berat Badan" name="berat_badan" maxlength="3" value="<?php echo $row->BERAT_BADAN;?>">
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
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="Jumlah Saudara" name="jml_saudara" maxlength="2" value="<?php echo $row->JML_SAUDARA;?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Anak Ke</label>
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="Anak Ke" name="anak_ke" maxlength="2" value="<?php echo $row->ANAK_KE;?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnama">Status Nikah</label>
                          <select class="form-control" name="status_nikah" >
                            <option value="<?php echo $row->STATUS_NIKAH;?>"><?php if($row->STATUS_NIKAH == 'N'){echo "Belum";} else{ echo "Sudah";} ?></option>
                            <option value="<?php echo $row->STATUS_NIKAH;?>">--</option>
                            <option value="N">Belum</option>
                            <option value="Y">Sudah</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputnik">Jumlah Anak</label>
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="Jumlah Anak" name="jml_anak" maxlength="2" value="<?php echo $row->JML_ANAK;?>">
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach;?>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Alamat Calon TKI</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?php foreach($data_alamat->result() as $row ): ?>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="inputnama">Jenis Alamat</label>
                          <select class="form-control" name="jenis_alamat" >
                            <option value="<?php echo $row->JENIS_ALAMAT?>"><?php echo $row->DJENIS_ALAMAT;?></option>
                            <option value="<?php echo $row->JENIS_ALAMAT?>">--</option>
                            <option value="1">Sesuai KTP</option>
                            <option value="2">Tempat Tinggal Saat Ini</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="inputnik">Jalan</label>
                          <textarea class="form-control" rows="3"  placeholder="Alamat.." required name="alamat"><?php echo $row->JALAN?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputmaidcode">RT</label>
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  id="inputmaidcode" placeholder="RT" name="rt" maxlength="3" value="<?php echo $row->RT?>">
                          <input type="hidden" class="form-control" id="inputmaidcode" placeholder="RT" name="id_alamat" maxlength="3" value="<?php echo $row->ID; ?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputpassport">RW</label>
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  id="inputpassport" placeholder="RW" name="rw" maxlength="3" value="<?php echo $row->RW?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Kelurahan</label>
                          <input type="text" class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Kelurahan" name="kelurahan" maxlength="50" value="<?php echo $row->KELURAHAN?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Kecamatan</label>
                          <input type="text" class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Kecamatan" name="kecamatan" maxlength="50" value="<?php echo $row->KECAMATAN?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Kota</label>
                          <input type="text" class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Kota" name="kota" maxlength="50" value="<?php echo $row->KOTA?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Provinsi</label>
                          <input type="text" class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Provinsi" name="provinsi" maxlength="50" value="<?php echo $row->PROVINSI?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Kode Pos</label>
                          <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="Kode Pos" name="kd_pos" maxlength="50" value="<?php echo $row->KD_POS?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Desa</label>
                          <input type="text" class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Desa" name="desa" maxlength="50" value="<?php echo $row->DESA?>">
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach;?>
                <!-- /.card-body -->
              </div>
              <div class="card">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Dokumen dan Kelengkapan</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Dokumen</th>
                          <th>File</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $j = 0; $cek_id_jenis_dok = '';?>
                        <?php foreach($data_dokumen->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA_DOKUMEN;?></td>
                            <?php if ($row->ID == '-') { ?>
                                <td>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="file<?php echo $row->ID_JENIS_DOK;?>">
                                      <label class="custom-file-label" >Choose file</label>
                                    </div>
                                  </div>
                                </td>
                              <?php  } else { ?>
                                <td><div class="btn-group">
                                  <a target="_blank" href="<?php echo base_url().$row->PATH.'/'.$row->FILE;?>" class="btn btn-success"><i class="fas fa-eye"></i></a> <a href="<?php echo base_url('index.php/File/download/').$row->ID;?>" class="btn btn-primary"><i class="fas fa-download"></i></a> <a href="<?php echo base_url('index.php/File/delete/tki/').$row->ID;?>" class="btn btn-danger" onclick="clicked(event)"><i class="fas fa-trash"></i></a>
                                </div></td>
                              <?php }
                              ?>

                            </tr>
                            <?php 
                            if ($row->ID == '-') {
                              if ($j == 0) {
                                $cek_id_jenis_dok = $row->ID_JENIS_DOK;
                              } else {
                                $cek_id_jenis_dok = $row->ID_JENIS_DOK.','.$cek_id_jenis_dok;
                              }
                            ?>
                            <?php $j++; }?>
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
                <!-- /.card --> 

              </div>
              <!--/.col (left) -->
              <!-- right column -->
              <div class="col-md-6">
                <?php if ($approve == '2') { ?>
                  <div class="card">
                    <div class="card-body row">
                      <div class="col-md-12">
                        <textarea class="form-control" rows="2" readonly placeholder="Catatan.."><?php echo $catatan;?></textarea>
                      </div>
                    </div>
                  </div>
                <?php }  ?>
                  <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '3') { ?>
                    <div class="card">
                      <div class="card-body row">
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-primary btn-block" onclick="clicked(event)">EDIT DATA</button>
                        </div>
                      </div>
                    </div>
                  <?php }  ?>
                  <!-- /.card --> 
                <!-- Form Element sizes -->
                <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '1') { ?>
                  <?php if ($approve == '0') { ?>
                    <div class="card">
                      <div class="card-body row">
                        <div class="col-md-6">
                          <a href="<?php echo base_url('index.php/data/Data_tki/approve_tki/').$id_tki.'/1';?>" onclick="clicked(event)" class="btn btn-success btn-block">SETUJUI DATA CALON TKI</a>
                        </div>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal-reject-tki">TOLAK DATA CALON TKI</button>
                        </div>
                      </div>
                    </div>
                    <!-- /.card --> 
                  <?php } } ?>

                  <!-- general form elements disabled -->
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Kualifikasi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <?php $i = 0; $cek_id = '';?>
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
                          if ($row->ID_KUALIFIKASI != '-') {
                            if ($row->JENIS == '1') {
                              if ($row->JAWABAN == 'IYA') {
                                  $yes = 'checked';
                                  $no = '';
                                } elseif ($row->JAWABAN == 'TIDAK') {
                                  $yes = '';
                                  $no = 'checked';
                                } else {
                                  $yes = '';
                                  $no = '';
                                }
                                echo '<div class="col-sm-2">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" value="Y" name="jawaban'.$row->ID.'"'.$yes.'>
                                <label class="form-check-label">YA</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" value="N" name="jawaban'.$row->ID.'"'.$no.'>
                                <label class="form-check-label">TIDAK</label>
                                </div>
                                </div>
                                <div class="col-sm-10">
                                <div class="form-group">
                                <div class="input-group mb-3">

                                <input type="text" class="form-control" placeholder="Jawaban.." name="keterangan'.$row->ID.'" value="'.$row->KETERANGAN.'">
                                </div>
                                </div>
                                </div>';
                            } else {
                              echo '<div class="col-sm-12">
                              <div class="form-group">
                              <textarea class="form-control" rows="1" placeholder="Jawaban.." name="keterangan'.$row->ID.'">'.$row->KETERANGAN.'</textarea>
                              </div>
                              </div>';
                            }
                          } else {
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
                          }

                          ?>
                        </div>
                        <?php 
                        if ($i == 0) {
                          $cek_id = $row->ID;
                        } else {
                          $cek_id = $row->ID.','.$cek_id;
                        }
                        ?>
                        <?php $i++;?>
                      <?php endforeach; ?>
                      <input type="hidden" value = "<?php echo $cek_id;?>" name="id_kualifikasi">
                      <input type="hidden" value = "<?php echo $i;?>" name="count_kualifikasi">
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card --> 
                  <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '1') { ?>
                    <?php if ($approve == '0') { ?>
                      <div class="card">
                        <div class="card-body row">
                          <div class="col-md-6">
                            <a href="<?php echo base_url('index.php/data/Data_tki/approve_tki/').$id_tki.'/1';?>" onclick="clicked(event)" class="btn btn-success btn-block">SETUJUI DATA CALON TKI</a>
                          </div>
                          <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal-reject-tki">TOLAK DATA CALON TKI</button>
                          </div>
                        </div>
                      </div>
                      <!-- /.card --> 
                    <?php } } ?>
                    <?php if ($approve == '2') { ?>
                  <div class="card">
                    <div class="card-body row">
                      <div class="col-md-12">
                        <textarea class="form-control" rows="2" readonly placeholder="Catatan.."><?php echo $catatan;?></textarea>
                      </div>
                    </div>
                  </div>
                <?php }  ?>
                  <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '3') { ?>
                    <div class="card">
                      <div class="card-body row">
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-primary btn-block" onclick="clicked(event)">EDIT DATA</button>
                        </div>
                      </div>
                    </div>
                  <?php }  ?>
                  <!-- /.card --> 
                    </div>
                    <!--/.col (right) -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-md-12">
                      <!-- The time line -->
                      <div class="timeline">
                        <!-- timeline time label -->
                        <div class="time-label">
                          <span class="bg-blue">Catatan</span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <?php foreach($data_timeline->result() as $row ): ?>
                        <div>
                          <i class="fas fa-circle bg-green"></i>
                          <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> <?php echo $row->INSERT_DATE;?></span>
                            <h3 class="timeline-header"><?php echo $row->USER;?> - <?php echo strtolower($row->MESSAGE);?></h3>
                            <?php if ($row->REMARK != NULL || $row->REMARK != '') { ?>
                            <div class="timeline-body">
                              <?php echo $row->REMARK;?>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                      <?php endforeach;?>
                        <div>
                          <i class="fas fa-clock bg-gray"></i>
                        </div>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                </div><!-- /.container-fluid -->
              </section>
            </form>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
          <div class="modal fade" id="modal-reject-tki">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <form action="<?php echo base_url('index.php/data/Data_tki/approve_tki/').$id_tki.'/2';?>" method="post">
                  <div class="modal-header">
                    <h4 class="modal-title">ALASAN TOLAK DATA CTKI</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control" rows="2" placeholder="Alasan Ditolak.." name="alasan"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="clicked(event)">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
<!-- /.modal -->