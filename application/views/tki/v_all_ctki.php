  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data TKI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">TKI</a></li>
              <li class="breadcrumb-item active">Data TKI</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php echo $this->session->flashdata('message');?>
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
        <?php } else { ?>
          <?php foreach($count_dashboard->result() as $row ): ?>
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_CTKI;?></h3>

                    <p>Total CTKI</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_TKI;?></h3>

                    <p>Total TKI Diterima</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_TKI_REJECTED;?></h3>

                    <p>Total TKI Ditolak</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3><?php echo $row->COUNT_TKI_ALL;?></h3>

                    <p>Total TKI</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
          <?php endforeach; ?>
        <?php } ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>NAMA</th>
                      <th>MAID CODE</th>
                      <th>PERUSAHAAN ASAL</th>
                      <th>STATUS</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_tki->result() as $row ): ?>
                      <tr>
                        <td><?php echo $row->NAMA; ?></td>
                        <td><?php echo $row->MAID_CODE; ?></td>
                        <td><?php echo $row->NAMA_PERUSAHAAN; ?></td>
                        <td><?php if ($row->APPROVE == '0') {
                          echo '<span class="badge bg-primary">'.$row->STATUS_PROGRESS.'</span>';
                        } elseif ($row->APPROVE == '1') {
                          echo '<span class="badge bg-success">'.$row->STATUS_PROGRESS.'</span>';
                        } elseif ($row->APPROVE == '2') {
                          echo '<span class="badge bg-warning">'.$row->STATUS_PROGRESS.'</span>';
                        }
                        ?>
                      </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="<?php echo base_url('index.php/Tki/detail/'); echo $row->ID;?>">Detail</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>NAMA</th>
                  <th>MAID CODE</th>
                  <th>PERUSAHAAN ASAL</th>
                  <th>STATUS</th>
                  <th>AKSI</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->