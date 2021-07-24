  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Jenis Dokumen</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="<?php echo base_url('index.php/master/Dokumen');?>">Master Jenis Dokumen</a></li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-doc">Tambah Jenis Dokumen Baru</button>
              </div>
              <div class="card-body">
                <table id="non_export" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>JENIS DOKUMEN</th>
                      <th>ALIAS</th>
                      <th>TIPE</th>
                      <th>TANGGAL DIBUAT</th>
                      <th>DIBUAT OLEH</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_doc->result() as $row ): ?>
                    <tr>
                      <td><?php echo $row->NAMA_DOKUMEN;?></td>
                      <td><?php echo $row->ALIAS;?></td>
                      <td><?php echo '<span class="badge bg-success">'.$row->JENIS.'</span>';?></td>
                      <td><?php echo $row->INSERT_DATE;?></td>
                      <td><?php echo $row->CREATED_BY;?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>JENIS DOKUMEN</th>
                      <th>ALIAS</th>
                      <th>TIPE</th>
                      <th>TANGGAL DIBUAT</th>
                      <th>DIBUAT OLEH</th>
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
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Log Jenis Dokumen</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Kegiatan</th>
                      <th>Catatan</th>
                      <th>Created By</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_log_doc_type->result() as $row ): ?>
                    <tr>
                      <td><?php echo $row->KEGIATAN; ?></td>
                      <td><?php echo $row->CATATAN; ?></td>
                      <td><?php echo $row->NAMA; ?></td>
                      <td><?php echo $row->INSERT_DATE; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-add-doc">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="<?php echo base_url('index.php/data/Data_dokumen/insert_doc_type');?>" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Jenis Dokumen Baru</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Nama Dokumen</label>
                  <input type="text" class="form-control" placeholder="Nama Dokumen" name="nama_dokumen" id="nama_dokumen" required>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Alias</label>
                  <input type="text" class="form-control" placeholder="Alias" name="alias" id="alias">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Tipe Dokumen</label>
                  <select class="custom-select rounded-0" id="jenis" name="jenis">
                    <option value="0">REGULAR</option>
                    <option value="1">DOKUMEN WAJIB TKI</option>
                  </select>
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