  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php echo $this->session->flashdata('dashboard');?>
        <?php if ($_SESSION['logged_in']['role'] == '1') { ?>
          <?php foreach($count_dashboard->result() as $row ): ?>
            <div class="row">
              <div class="col-lg-3 col-6">
                <a href="<?php echo base_url('index.php/Tki/approve');?>">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_CTKI;?></h3>

                    <p>CTKI Perlu Disetujui</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-list"></i>
                  </div>
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_PERJANJIAN_APPROVED;?></h3>

                    <p>Perjanjian Disetujui</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-check"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_PERJANJIAN_NEW;?></h3>

                    <p>Perjanjian Perlu Dibuat</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-file"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_PERJANJIAN_REJECTED;?></h3>

                    <p>Perjanjian Ditolak</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-exclamation"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
          <?php endforeach;?>
          <!-- /.row -->
          <div class="row">
            <div class="col-md-5">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">CTKI Perlu Disetujui</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Penyalur</th>
                          <th>Nama</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($ctki_unapprove->result() != FALSE) { foreach($ctki_unapprove->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA_PERUSAHAAN;?></td>
                            <td><?php echo $row->NAMA;?></td>
                            <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Tki/detail/').$row->ID;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="3" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Surat Perjanjian Perlu Dibuat</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Pekerjaan</th>
                          <th>Penyalur</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($perjanjian_notcreated->result() != FALSE) { foreach($perjanjian_notcreated->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA_TKI;?></td>
                            <td><?php echo $row->PEKERJAAN;?></td>
                            <td><?php echo $row->PENYALUR;?></td>
                            <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Pekerjaan/detail/').$row->ID_JUSTIFIKASI;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="4" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <?php foreach($count_job->result() as $row ): ?>
          <div class="row">
            <div class="col-12 col-sm-4 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-handshake"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pekerjaan Aktif</span>
                  <span class="info-box-number"><?php echo $row->PEKERJAAN_AKTIF;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-4 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pekerjaan Selesai</span>
                  <span class="info-box-number"><?php echo $row->PEKERJAAN_SELESAI;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-4 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pekerjaan Dibatalkan</span>
                  <span class="info-box-number"><?php echo $row->PEKERJAAN_DIBATALKAN;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <?php endforeach; ?>
          <div class="row">
            <div class="col-md-5">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Penyalur Belum Disetujui</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Perusahaan</th>
                          <th>Nama</th>
                          <th>AKSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($penyalur_unapprove->result() != FALSE) { foreach($penyalur_unapprove->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA_PERUSAHAAN;?></td>
                            <td><?php echo $row->NAMA;?></td>
                            <td><div class="btn-group"><a target="_blank" href="#" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="3" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Penyalur Ditolak</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Perusahaan</th>
                          <th>Catatan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($penyalur_rejected->result() != FALSE) { foreach($penyalur_rejected->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA;?></td>
                            <td><?php echo $row->NAMA_PERUSAHAAN;?></td>
                            <td><?php echo $row->CATATAN;?></td>
                            <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Penyalur/detail/').$row->ID;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="4" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-md-5">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Surat Perjanjian Belum Disetujui</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Pekerjaan</th>
                          <th>Penyalur</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($perjanjian_unapprovetab->result() != FALSE) { foreach($perjanjian_unapprovetab->result() as $row ): ?>
                        <tr>
                          <td><?php echo $row->NAMA_TKI;?></td>
                          <td><?php echo $row->PEKERJAAN;?></td>
                          <td><?php echo $row->PENYALUR;?></td>
                        </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="3" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Surat Perjanjian Ditolak</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Pekerjaan</th>
                          <th>Penyalur</th>
                          <th>Alasan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($perjanjian_rejectedtab->result() != FALSE) { foreach($perjanjian_rejectedtab->result() as $row ): ?>
                        <tr>
                          <td><?php echo $row->NAMA_TKI;?></td>
                          <td><?php echo $row->PEKERJAAN;?></td>
                          <td><?php echo $row->PENYALUR;?></td>
                          <td><?php echo $row->CATATAN;?></td>
                          <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Pekerjaan/detail/').$row->ID_JUSTIFIKASI;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                        </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="5" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        <?php } ?>
        <?php if ($_SESSION['logged_in']['role'] == '2') { ?>
          <?php foreach($count_dashboard->result() as $row ): ?>
            <div class="row">
              <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $row->TKI;?></h3>

                    <p>Total TKI</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $row->PENYALUR;?></h3>

                    <p>Total Penyalur</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-male"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php echo $row->PERUSAHAAN;?></h3>

                    <p>Total Perusahaan</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-building"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
          <?php endforeach; ?>
            <!-- /.row -->
          <div class="row">
            <div class="col-md-5">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Kontrak Kerja Perlu Dibuat</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Pekerjaan</th>
                          <th>Penyalur</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($kontrak_notcreated->result() != FALSE) { foreach($kontrak_notcreated->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA_TKI;?></td>
                            <td><?php echo $row->PEKERJAAN;?></td>
                            <td><?php echo $row->PENYALUR;?></td>
                            <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Pekerjaan/detail/').$row->ID_JUSTIFIKASI;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="4" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Kontrak Kerja Ditolak</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Pekerjaan</th>
                          <th>Catatan</th>
                          <th>Ditolak Oleh</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($kontrak_rejected->result() != FALSE) { foreach($kontrak_rejected->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA_TKI; ?></td>
                            <td><?php echo $row->PEKERJAAN; ?></td>
                            <td><?php echo $row->CATATAN; ?></td>
                            <td><?php echo $row->APPROVED_BY; ?></td>
                            <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Pekerjaan/detail/').$row->ID_JUSTIFIKASI;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="5" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <?php foreach($count_job->result() as $row ): ?>
          <div class="row">
            <div class="col-12 col-sm-4 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-handshake"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pekerjaan Aktif</span>
                  <span class="info-box-number"><?php echo $row->PEKERJAAN_AKTIF;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-4 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pekerjaan Selesai</span>
                  <span class="info-box-number"><?php echo $row->PEKERJAAN_SELESAI;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-4 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pekerjaan Dibatalkan</span>
                  <span class="info-box-number"><?php echo $row->PEKERJAAN_DIBATALKAN;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <?php endforeach; ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Assign Pekerjaan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Pekerjaan Yang Diajukan</th>
                          <th>Penyalur</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($pekerjaan_notcreated->result() != FALSE) { foreach($pekerjaan_notcreated->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA_TKI; ?></td>
                            <td><?php echo $row->PEKERJAAN; ?></td>
                            <td><?php echo $row->PENYALUR; ?></td>
                            <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Pekerjaan/detail/').$row->ID_JUSTIFIKASI;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="5" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

        <?php } ?>
        <?php if ($_SESSION['logged_in']['role'] == '3') { ?>
          <?php foreach($count_dashboard->result() as $row ): ?>
            <div class="row">
              <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_CTKI;?></h3>

                    <p>Calon TKI Belum Disetujui</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-clock"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_TKI;?></h3>

                    <p>Total TKI</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $row->MY_TKI;?></h3>

                    <p>Total TKI Yang Saya Daftarkan</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-check"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
          <?php endforeach; ?>
          <div class="row">
            <div class="col-md-5">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">CTKI Belum Disetujui</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>TTL</th>
                          <th>Kewarganegaraan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($ctki_unapprove->result() != FALSE) { foreach($ctki_unapprove->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA;?></td>
                            <td><?php echo $row->TTL;?></td>
                            <td><?php echo $row->KEWARGANEGARAAN;?></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="3" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">CTKI Ditolak</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Catatan</th>
                          <th>Ditolak Oleh</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($ctki_rejected->result() != FALSE) { foreach($ctki_rejected->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->NAMA; ?></td>
                            <td><?php echo $row->CATATAN; ?></td>
                            <td><?php echo $row->NAMA_USER; ?></td>
                            <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Tki/detail/').$row->ID;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="4" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <?php foreach($count_job->result() as $row ): ?>
          <div class="row">
            <div class="col-12 col-sm-4 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-handshake"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pekerjaan Aktif</span>
                  <span class="info-box-number"><?php echo $row->PEKERJAAN_AKTIF;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-4 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pekerjaan Selesai</span>
                  <span class="info-box-number"><?php echo $row->PEKERJAAN_SELESAI;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-4 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pekerjaan Dibatalkan</span>
                  <span class="info-box-number"><?php echo $row->PEKERJAAN_DIBATALKAN;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <?php endforeach; ?>
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Perjanjian Perlu Disetujui</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Pekerjaan</th>
                          <th>Dibuat Oleh</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($approve_perjanjian->result() != FALSE) { foreach($approve_perjanjian->result() as $row ): ?>
                        <tr>
                          <td><?php echo $row->NAMA_TKI;?></td>
                          <td><?php echo $row->PEKERJAAN;?></td>
                          <td><?php echo $row->CREATED_BY;?></td>
                          <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Pekerjaan/detail/').$row->ID_JUSTIFIKASI;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                        </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="3" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Kontrak Kerja Perlu Disetujui</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Pekerjaan</th>
                          <th>Dibuat Oleh</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($approve_kontrak->result() != FALSE) { foreach($approve_kontrak->result() as $row ): ?>
                        <tr>
                          <td><?php echo $row->NAMA_TKI;?></td>
                          <td><?php echo $row->PEKERJAAN;?></td>
                          <td><?php echo $row->CREATED_BY;?></td>
                          <td><div class="btn-group"><a target="_blank" href="<?php echo base_url('index.php/Pekerjaan/detail/').$row->ID_JUSTIFIKASI;?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></div></td>
                        </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="4" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        <?php } elseif ($_SESSION['logged_in']['role'] == '0') { ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Audit</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <div class="card-body">
                    <table id="tabelAudit" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Activity</th>
                          <th>Data</th>
                          <th>Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($audit->result() != FALSE) { foreach($audit->result() as $row ): ?>
                          <tr>
                            <td><?php echo $row->USER;?></td>
                            <td><?php echo $row->JENIS;?></td>
                            <td><?php echo $row->CATATAN;?></td>
                            <td><?php echo $row->INSERT_DATE;?></td>
                          </tr>
                        <?php endforeach; } else { ?>
                          <tr>
                            <td colspan="4" align="center">Tidak Ada Data</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->