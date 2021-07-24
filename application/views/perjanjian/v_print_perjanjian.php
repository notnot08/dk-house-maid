<?php

setlocale(LC_TIME, 'id_ID.utf8');

$hariIni = new DateTime(); ?>
<?php foreach($data_perjanjian->result() as $row ): $id_perjanjian = $row->ID; $id_dokumen = $row->ID_DOKUMEN; $nomor_surat = $row->NOMOR_SURAT; endforeach;?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <?php echo $this->session->flashdata('message');?>
      <div class="row">
        <div class="col-12">
          <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            Halaman ini hanya untuk tampilan preview. Klik tombol print dibawah untuk mencetak surat perjanjian.
          </div>

          <?php foreach($data_perjanjian->result() as $row ): $id_perjanjian = $row->ID_PERJANJIAN; ?>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="login-logo">
                <h3><strong>Surat Perjanjian</strong></h3>
                <h6><strong>No. <?php echo $row->NOMOR_SURAT;?></strong></h6>
              </div>
              <div class="row">
                <div class="col-12">
                  <h4>
                    <!-- <i class="fas fa-globe"></i> AdminLTE, Inc. -->
                    <small class="float-right">Tanggal Cetak: <?php echo strftime('%A, %d %B %Y %H:%M', $hariIni->getTimestamp()) . '<br>';?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <br>
              <br>
              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                  <?php $a = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?>
                  <?php $b = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?>
                  <address>
                    <table>
                      <tr>
                        <td>Nomor <?php echo $b;?></td>
                        <td>: <?php echo $row->NO;?></td>
                      </tr>
                    </table>
                    Pada tanggal <?php echo $row->TANGGAL_PENGESAHAN?><br>
                    yang bertanggung jawab dibawah ini<br><br>
                    <table>
                      <tr>
                        <td>Nama <?php echo $a;?></td>
                        <td>: <?php echo $row->NAMA_PJ;?></td>
                      </tr>
                      <tr>
                        <td>NIK</td>
                        <td>: <?php echo $row->NIK_PJ?></td>
                      </tr>
                      <tr>
                        <td>Jabatan</td>
                        <td>: <?php echo $row->JABATAN_PJ?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>: <?php echo $row->ALAMAT_PJ?></td>
                      </tr>
                    </table>
                  </address>
                  <address>
                    Berdasarkan Surat Keputusan: SK Nomor: <?php echo $row->NOMOR_SK;?> Tanggal: <?php echo $row->TANGGAL_SK; ?> dalam hal ini bertindak untuk dan atas nama Jabatan, yang selanjutnya dalam perjanjian ini disebut sebagai <strong>PIHAK PERTAMA</strong>.<br>
                  </address>
                  <address>
                    <table>
                      <tr>
                        <td>Nama <?php echo $a;?></td>
                        <td>: <?php echo $row->NAMA_TKI?></td>
                      </tr>
                      <tr>
                        <td>NIK</td>
                        <td>: <?php echo $row->NIK_TKI?></td>
                      </tr>
                      <tr>
                        <td>Negara Tujuan</td>
                        <td>: <?php echo $row->NEGARA_TUJUAN;?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>: <?php echo $row->ALAMAT_TKI?></td>
                      </tr>
                    </table>
                  </address>
                  Yang selanjutnya disebut <strong>PIHAK PERTAMA</strong>.<br>
                  Kedua belah pihak sepakat untuk melakukan kerjasama yang dituangkan dalam suatu naskah perjanjian kerjasama dengan ketentuan sebagai berikut.<br>
                  <ol>
                    <li>Sponsor akan memberikan Fee sebesar Rp.5.000.000,00 (Lima Juta Rupiah).</li>
                    <li>Sponsor dan CTKI akan mengganti rugi jika putus kontrak.</li>
                    <li>Sponsor akan bertanggung jawab jika terjadi suatu masalah terhadap CTKI.</li>
                  </ol>
                  <br>Demikian surat perjanjian ini dibuat dengan kondisi sehat dan sadar tanpa adanya paksaan dari pihak manapun.<br> <br> 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <table width="100%">
                <tr>
                 <td align="center">&nbsp;</td>
                 <td align="center">&nbsp;</td>
               </tr>       
               <tr>
                 <td align="center"></td>
                 <td align="center">Jakarta, <?php echo $row->TANGGAL_PENGESAHAN;?></td>
               </tr>
               <tr>
                 <td align="center">&nbsp;</td>
                 <td align="center">&nbsp;</td>
               </tr>
               <tr>
                 <td align="center"><strong>PIHAK PERTAMA<strong></td>
                   <td align="center"><strong>PIHAK KEDUA<strong></td>
                   </tr>
                   <tr>
                     <td align="center">&nbsp;</td>
                     <td align="center">&nbsp;</td>
                   </tr>
                   <tr>
                     <td align="center">&nbsp;</td>
                     <td align="center">&nbsp;</td>
                   </tr>
                   <tr>
                     <td align="center">(<?php echo $row->NAMA_PJ?>)</td>
                     <td align="center">(<?php echo $row->NAMA_TKI?>)</td>
                   </tr>
                 </table>
                 <br>
                 <br>
                 <br>

                 
                 <!-- this row will not appear when printing -->
                 <div class="row no-print">
                  <div class="col-12">
                    <a href="<?php echo base_url('index.php/Perjanjian/print/').$this->uri->segment('3');?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <?php if ($_SESSION['logged_in']['role'] == '0' || $_SESSION['logged_in']['role'] == '3') { ?>
                      <?php if ($row->SURAT_PERJANJIAN_APPROVAL != '1') { if ($row->SURAT_PERJANJIAN_APPROVAL != '0') { if ($row->SURAT_PERJANJIAN_APPROVAL != '2') { ?>
                        <a href="<?php echo base_url('index.php/data/Data_perjanjian/approve_perjanjian/SET1/').$this->uri->segment('3');?>" onclick="clicked(event)" class="btn btn-success float-right">SETUJUI SURAT PERJANJIAN</a>
                        <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-reject-surat">TOLAK SURAT PERJANJIAN</button>
                      <?php } } } }?>
                    </div>
                  </div>
                  <!-- /.invoice -->
                <?php endforeach;?>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
      </div>
      <!-- /.content-wrapper -->
      <div class="modal fade" id="modal-reject-surat">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="<?php echo base_url('index.php/data/Data_perjanjian/approve_perjanjian/SET2/').$this->uri->segment('3');?>" method="post">
              <div class="modal-header">
                <h4 class="modal-title">ALASAN TOLAK SURAT PERJANJIAN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <!-- <label>Username</label> -->
                      <textarea class="form-control" rows="2" placeholder="Alasan Ditolak.." name="catatan"></textarea>
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