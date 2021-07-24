  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Penyalur</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Penyalur</a></li>
              <li class="breadcrumb-item active">Detail Penyalur</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form action="<?php echo base_url('index.php/data/Data_penyalur/insert_penyalur/UPDATE');?>" method="post" enctype="multipart/form-data">
      <section class="content">
        <div class="container-fluid">
          <?php echo $this->session->flashdata('message');?>
          <?php foreach($data_penyalur->result() as $row ): $id_penyalur = $row->ID_PENYALUR; $approve = $row->APPROVE; $catatan = $row->CATATAN;?>
            <div class="row">
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h5>Status Pengajuan Penyalur</h5>
                    <h6><?php echo $row->APPROVE_PROGRESS;?></h6>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h5>Pengaju Penyalur</h5>
                    <h6><?php echo $row->NAMA_PENGAJU;?></h6>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h5>Tanggal Diajukan</h5>
                    <h6><?php echo $row->INSERT_DATE;?></h6>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <div class="row">
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h5>Naungan Perusahaan</h5>
                    <h6><?php echo $row->NAMA_PERUSAHAAN;?></h6>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h5>Username Penyalur</h5>
                    <h6><?php if ($row->USERNAME == NULL) {
                      echo "<a href='#'>GENERATE AKUN PENYALUR</a>";
                    } else { echo $row->USERNAME; } ?></h6>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <div class="row">
              <!-- left column -->
              <div class="col-md-6">
                <!-- general form elements -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Data Diri Penyalur</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="inputnama">Nama</label>
                            <input type="text" class="form-control" <?php if ($approve != '2') { echo 'readonly';} ?> id="inputnama" name="nama" placeholder="Nama" value="<?php echo $row->NAMA_PENYALUR; ?>">
                            <input type="hidden" class="form-control" <?php if ($approve != '2') { echo 'readonly';} ?> id="inputnama" name="id_penyalur" placeholder="Nama" value="<?php echo $id_penyalur; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="inputnama">NPWP</label>
                            <input type="text" class="form-control" <?php if ($approve != '2') { echo 'readonly';} ?> id="inputnama" name="npwp" placeholder="NPWP" value="<?php echo $row->NPWP; ?>">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="inputnik">NIK</label>
                            <input type="text" class="form-control" <?php if ($approve != '2') { echo 'readonly';} ?> id="inputnik" name="nik" placeholder="NIK" value="<?php echo $row->NIK; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="inputmaidcode">Tempat Lahir</label>
                            <input type="text" class="form-control" <?php if ($approve != '2') { echo 'readonly';} ?> id="inputmaidcode" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $row->TEMPAT_LAHIR; ?>">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="inputpassport">Tanggal Lahir</label>
                            <input type="date" class="form-control" <?php if ($approve != '2') { echo 'readonly';} ?> id="inputpassport" name="tanggal_lahir" value="<?php echo $row->TANGGAL_LAHIR; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="inputmaidcode">Alamat</label>
                            <textarea class="form-control" rows="2" <?php if ($approve != '2') { echo 'readonly';} ?> placeholder="Alamat.." name="alamat"><?php echo $row->ALAMAT; ?></textarea>
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
                <?php if ($approve == '2') { ?>
                  <div class="card">
                    <div class="card-body row">
                      <div class="col-md-12">
                        <textarea class="form-control" rows="2" readonly placeholder="Catatan.."><?php echo $catatan;?></textarea>
                      </div>
                    </div>
                  </div>
                  <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '1') { ?>
                    <div class="card">
                      <div class="card-body row">
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-primary btn-block" onclick="clicked(event)">SUBMIT DATA PENYALUR</button>
                        </div>
                      </div>
                    </div>
                  <?php }  ?>
                  <!-- /.card --> 
                <?php }  ?>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Keterangan Penyalur</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputmaidcode">Jenis</label>
                          <input type="text" class="form-control" readonly id="inputmaidcode" placeholder="Jenis" name="maid_code" value="<?php echo $row->KET;?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="inputpassport">Perusahaan</label>
                          <?php if ($approve != '2') { ?>
                            <input type="text" class="form-control" readonly id="inputpassport" placeholder="Perusahaan" name="passport" value="<?php echo $row->NAMA_PERUSAHAAN;?>">
                          <?php } elseif ($approve == '2') { ?>
                            <select class="form-control select2" style="width: 100%;" name="id_group">
                              <option selected="selected" value="<?php echo $row->ID_GROUP;?>"><?php echo $row->NAMA_PERUSAHAAN;?></option>
                              <option value="ERROR">--Pilih Perusahaan Asal--</option>
                              <?php foreach($data_perusahaan->result() as $row ): ?>
                                <option value="<?php echo $row->ID;?>"><?php echo $row->NAMA_PERUSAHAAN;?></option>
                              <?php endforeach; ?>
                            </select>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card --> 
                <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '2') { ?>
                  <?php if ($approve == '0') { ?>
                    <div class="card">
                      <div class="card-body row">
                        <div class="col-md-6">
                          <a href="<?php echo base_url('index.php/data/Data_penyalur/approve_penyalur/').$id_penyalur.'/1';?>" onclick="clicked(event)" class="btn btn-success btn-block">SETUJUI PENYALUR</a>
                        </div>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal-reject-penyalur">TOLAK PENYALUR</button>
                        </div>
                      </div>
                    </div>
                    <!-- /.card --> 
                  <?php } } ?>
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

    <div class="modal fade" id="modal-reject-penyalur">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="<?php echo base_url('index.php/data/Data_penyalur/approve_penyalur/').$id_penyalur.'/2';?>" method="post">
            <div class="modal-header">
              <h4 class="modal-title">ALASAN TOLAK PENYALUR</h4>
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