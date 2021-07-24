  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Pengajuan Pekerjaan TKI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/Pekerjaan/pengajuan');?>">Pekerjaan</a></li>
              <li class="breadcrumb-item active">Detail Pengajuan Pekerjaan TKI</li>
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
          <?php foreach($data_justifikasi->result() as $row ): ?>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="card-body box-profile">
                <div class="text-center">
                  <i class="fas fa-users fa-6x"></i>
                </div>
                <p class="profile text-center">Data dan Dokumen Approval</p>
                <p class="text-muted text-center">
                  <?php if ($row->STATUS_DATA_DIRI_APPROVAL == '0') { ?>
                    <span class="badge bg-warning"><?php echo $row->DATA_DIRI_APPROVAL;?></span>
                  <?php } elseif ($row->STATUS_DATA_DIRI_APPROVAL == '1') { ?>
                    <span class="badge bg-success"><?php echo $row->DATA_DIRI_APPROVAL;?> BY: <?php echo $row->APPROVED_BY_1;?></span>
                  <?php } elseif ($row->STATUS_DATA_DIRI_APPROVAL == '2') { ?>
                    <span class="badge bg-danger"><?php echo $row->DATA_DIRI_APPROVAL;?> BY: <?php echo $row->APPROVED_BY_1;?></span>
                  <?php } ?> 
                </p>
                <p class="text-muted text-center"><?php echo $row->APPROVED_DATE_1;?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="card-body box-profile">
                <div class="text-center">
                  <i class="fas fa-search fa-6x"></i>
                </div>
                <p class="profile text-center">Assign Pekerjaan</p>
                <p class="text-muted text-center">
                  <?php if ($row->ID_LOWONGAN == NULL) { ?>
                    <span class="badge bg-warning">PEKERJAAN BELUM DI-<i>ASSIGN</i></span>
                  <?php } elseif ($row->ID_LOWONGAN != NULL) { ?>
                    <span class="badge bg-success"><i>ASSIGNED</i> BY: <?php echo $row->ASSIGNED_BY;?></span>
                  <?php } ?>
                </p>
                <p class="text-muted text-center"><?php echo $row->ASSIGNED_DATE;?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="card-body box-profile">
                <div class="text-center">
                  <i class="fas fa-handshake fa-6x"></i>
                </div>
                <p class="profile text-center">Surat Perjanjian Approval</p>
                <p class="text-muted text-center">
                  <?php if ($row->STATUS_SURAT_PERJANJIAN_APPROVAL == '0') { ?>
                    <span class="badge bg-warning"><?php echo $row->SURAT_PERJANJIAN_APPROVAL;?></span>
                  <?php } elseif ($row->STATUS_SURAT_PERJANJIAN_APPROVAL == '1') { ?>
                    <span class="badge bg-success"><?php echo $row->SURAT_PERJANJIAN_APPROVAL;?> BY: <?php echo $row->APPROVED_BY_2;?></span>
                  <?php } elseif ($row->STATUS_SURAT_PERJANJIAN_APPROVAL == '2') { ?>
                    <span class="badge bg-danger"><?php echo $row->SURAT_PERJANJIAN_APPROVAL;?> BY: <?php echo $row->APPROVED_BY_2;?></span>
                  <?php } elseif ($row->STATUS_SURAT_PERJANJIAN_APPROVAL == '3') { ?>
                    <span class="badge bg-primary"><?php echo $row->SURAT_PERJANJIAN_APPROVAL;?></span>
                  <?php } ?> 
                </p>
                <p class="text-muted text-center"><?php echo $row->APPROVED_DATE_2;?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="card-body box-profile">
                <div class="text-center">
                  <i class="fas fa-file-contract fa-6x"></i>
                </div>
                <p class="profile text-center">Kontrak Kerja Approval</p>
                <p class="text-muted text-center">
                  <?php if ($row->STATUS_KONTRAK_KERJA_APPROVAL == '0') { ?>
                    <span class="badge bg-warning"><?php echo $row->KONTRAK_KERJA_APPROVAL;?></span>
                  <?php } elseif ($row->STATUS_KONTRAK_KERJA_APPROVAL == '1') { ?>
                    <span class="badge bg-success"><?php echo $row->KONTRAK_KERJA_APPROVAL;?> BY: <?php echo $row->APPROVED_BY_3;?></span>
                  <?php } elseif ($row->STATUS_KONTRAK_KERJA_APPROVAL == '2') { ?>
                    <span class="badge bg-danger"><?php echo $row->KONTRAK_KERJA_APPROVAL;?> BY: <?php echo $row->APPROVED_BY_3;?></span>
                  <?php } elseif ($row->STATUS_KONTRAK_KERJA_APPROVAL == '3') { ?>
                    <span class="badge bg-primary"><?php echo $row->KONTRAK_KERJA_APPROVAL;?></span>
                  <?php } ?> 
                </p>
                <p class="text-muted text-center"><?php echo $row->APPROVED_DATE_3;?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.col -->

          </div>
          <?php
          $status = $row->STATUS;
          $progress_stat2 = $row->PROGRESS_STAT;
          $progress_stat3 = $row->PROGRESS;

          if($progress_stat2 == '5'){ $progress_stat = "danger";} elseif($progress_stat2 == '6'){$progress_stat = "warning";} else{ $progress_stat = "success";}
            /*if ($row->STATUS_DATA_DIRI_APPROVAL == '1') {
              if ($row->STATUS_SURAT_PERJANJIAN_APPROVAL == '1') {
                if ($row->STATUS_KONTRAK_KERJA_APPROVAL == '1') {
                  $progress = '100';
                } else {
                  $progress = '63';
                }
              } else {
                $progress = '37';
              }
            } else {
              $progress = '12';
            }*/
            if ($row->STATUS_DATA_DIRI_APPROVAL == '1') {
              if ($row->ID_LOWONGAN != NULL) {
                if ($row->STATUS_SURAT_PERJANJIAN_APPROVAL == '1') {
                  if ($row->STATUS_KONTRAK_KERJA_APPROVAL == '1') {
                    $progress = '100';
                  } else {
                    $progress = '63';
                  }
                } else {
                  $progress = '37';
                }
              } else {
                $progress = '12';
              }
            } else {
              $progress = '0';
            }
            ?>
            <div class="card">
              <div class="card-body p-0">
                <div class="row">
                  <div class="col-md-12">
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar bg-<?php echo $progress_stat;?>" style="width: <?php echo $progress;?>%"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php 
            $status_dokumen_app = $row->STATUS_DATA_DIRI_APPROVAL;
            $status_perjanjian_app = $row->STATUS_SURAT_PERJANJIAN_APPROVAL;
            $status_kontrak_app = $row->STATUS_KONTRAK_KERJA_APPROVAL;
            $status_stat = $row->STATUS_STAT;
            $id_justifikasi = $row->ID;
            $id_perjanjian = $row->ID_PERJANJIAN;
            $id_kontrak = $row->ID_KONTRAK;
            $pekerjaan = $row->PEKERJAAN;
            $negara = $row->NEGARA;
            $id_lowongan = $row->ID_LOWONGAN;
            $id_pekerjaan = $row->ID_PEKERJAAN;
          endforeach;?>
          <!-- /.row -->
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '3') { if ($status == '1') { ?>
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <a href="<?php echo base_url('index.php/data/Data_pekerjaan/changestatus_progresspekerjaan/5/').$id_justifikasi;?>" onclick="clicked(event)" class="btn btn-danger btn-block <?php if($progress_stat2 == '0' || $status_kontrak_app == '1'){echo "disabled-link";}?>">BATALKAN PEKERJAAN</a>
                      </div>
                      <div class="col-sm-6">
                        <a href="<?php echo base_url('index.php/data/Data_pekerjaan/changestatus_progresspekerjaan/0/').$id_justifikasi;?>" onclick="clicked(event)" class="btn btn-success btn-block">SELESAIKAN PEKERJAAN</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } } ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Status Pengajuan Pekerjaan</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnama">Status</label>
                        <input type="text" class="form-control" id="inputnama" readonly value="<?php echo $status_stat;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnama">Progress</label>
                        <input type="text" class="form-control" id="inputnama" readonly value="<?php echo $progress_stat3;?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Diri TKI</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <?php foreach($data_tki->result() as $row ): $id_tki = $row->ID;?>
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
                          <label for="inputmaidcode">Maid Code</label>
                          <input type="text" class="form-control" id="inputmaidcode" placeholder="Maid Code" readonly value="<?php echo $row->MAID_CODE?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <a href="<?php echo base_url('index.php/Tki/detail/').$id_tki;?>" class="btn btn-primary btn-block">LIHAT DETAIL TKI</a>
                      </div>
                    </div>
                  <?php endforeach;?>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pengajuan Pekerjaan</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnama">Sebagai</label>
                        <input type="text" class="form-control" id="inputnama" placeholder="Nama" readonly value="<?php echo $pekerjaan;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="inputnama">Negara Tujuan</label>
                        <input type="text" class="form-control" id="inputnama" readonly value="<?php echo $negara;?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '2') { if ($id_lowongan == NULL) { ?>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Assign Pekerjaan</h3>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo base_url('index.php/Pekerjaan/assign');?>" method="post">
                      <input type="hidden" class="form-control" name="id_justifikasi" readonly value="<?php echo $id_justifikasi;?>">
                      <input type="hidden" class="form-control" name="id_pekerjaan" readonly value="<?php echo $id_pekerjaan;?>">
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block <?php if($status_dokumen_app == '0'){echo "disabled-link";}?>" onclick="clicked(event)">ASSIGN PEKERJAAN</button>
                      </div>
                    </form>
                  </div>
                </div>
              <?php } } ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Surat Perjanjian</h3>
                </div>

                <!-- /.card-body -->
                <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '1') { ?>
                  <div class="card-body">
                    <?php
                    if ($id_lowongan != NULL) {
                      if ($status_dokumen_app == '0') { ?>
                        <div class="col-md-12">
                          <button type="button" class="btn btn-warning btn-block">DATA DAN DOKUMEN BELUM DI APPROVE</button>
                        </div>
                      <?php } elseif ($status_dokumen_app == '1') { ?>
                        <?php if ($status_perjanjian_app == '0' || $status_perjanjian_app == '1' || $status_perjanjian_app == '3') { ?>
                          <div class="col-md-12">
                            <a href="<?php echo base_url('index.php/Perjanjian/detail/').$id_perjanjian;?>" class="btn btn-success btn-block">LIHAT SURAT PERJANJIAN</a>
                          </div>
                        <?php } elseif ($status_perjanjian_app == '2') { ?>
                          <div class="col-md-12">
                            <a href="<?php echo base_url('index.php/Perjanjian/detail/').$id_perjanjian;?>" class="btn btn-warning btn-block">EDIT SURAT PERJANJIAN</a>
                          </div>
                        <?php } elseif ($status_perjanjian_app == NULL) { ?>
                          <div class="col-md-12">
                            <a href="<?php echo base_url('index.php/data/Data_perjanjian/set_perjanjian/').$this->uri->segment('3').'/'.$id_tki;?>" onclick="clicked(event)" class="btn btn-primary btn-block">BUAT SURAT PERJANJIAN</a>
                          </div>
                        <?php }
                      } elseif ($status_dokumen_app == '2') { ?>
                        <div class="col-md-12">
                          <button type="button" class="btn btn-danger btn-block">DATA DAN DOKUMEN TKI DITOLAK</button>
                        </div>
                      <?php } }
                      ?>
                    </div>
                  <?php } else { ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <?php
                      if ($status_dokumen_app == '0') { ?>
                        <div class="col-md-12">
                          <button type="button" class="btn btn-warning btn-block">DATA DAN DOKUMEN BELUM DI APPROVE</button>
                        </div>
                      <?php } elseif ($status_dokumen_app == '1') { ?>
                        <?php if ($status_perjanjian_app == '0' || $status_perjanjian_app == '1' || $status_perjanjian_app == '3') { ?>
                          <div class="col-md-12">
                            <a href="<?php echo base_url('index.php/Perjanjian/detail/').$id_perjanjian;?>" class="btn btn-success btn-block">LIHAT SURAT PERJANJIAN</a>
                          </div>
                        <?php } elseif ($status_perjanjian_app == NULL) { ?>
                        <?php }
                      } elseif ($status_dokumen_app == '2') { ?>
                        <div class="col-md-12">
                          <button type="button" class="btn btn-danger btn-block">DATA DAN DOKUMEN TKI DITOLAK</button>
                        </div>
                      <?php }
                      ?>
                    </div>
                  <?php } ?>
                </div>
                <!-- /.card --> 
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Kontrak Kerja</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '2') { 
                      if ($status_dokumen_app == '1') {
                        if ($status_perjanjian_app == '1') { 
                          if ($status_kontrak_app == NULL) {?>
                            <div class="col-md-12">
                              <a href="<?php echo base_url('index.php/data/Data_kontrak/set_kontrak/').$this->uri->segment('3');?>" onclick="clicked(event)" class="btn btn-primary btn-block">BUAT KONTRAK KERJA</a>
                            </div>
                          <?php } else { ?>
                            <div class="col-md-12">
                              <a href="<?php echo base_url('index.php/Kontrak/detail/').$id_kontrak;?>" class="btn btn-success btn-block">LIHAT KONTRAK KERJA</a>
                            </div>
                          <?php }
                          ?>
                        <?php } } } else {
                          if ($status_dokumen_app == '1') {
                            if ($status_perjanjian_app == '1') { 
                              if ($status_kontrak_app == '3' || $status_kontrak_app == '1') { ?>
                                <div class="col-md-12">
                                  <a href="<?php echo base_url('index.php/Kontrak/detail/').$id_kontrak;?>" class="btn btn-success btn-block">LIHAT KONTRAK KERJA</a>
                                </div>
                              <?php }  ?>
                              <?php
                            }
                          }
                        } 
                        ?>
                      </div>
                      <!-- /.card-body -->
                    </div>
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
            <!-- /.content -->
          </div>
  <!-- /.content-wrapper -->