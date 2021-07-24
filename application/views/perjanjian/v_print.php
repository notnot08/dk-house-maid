<?php

setlocale(LC_TIME, 'id_ID.utf8');

$hariIni = new DateTime(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title;?> | Housemaid</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php foreach($data_perjanjian->result() as $row ): ?>
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
                  Berdasarkan Surat Keputusan: SK Nomor: 09 Tanggal: 09/09/1998 dalam hal ini bertindak untuk dan atas nama Jabatan, yang selanjutnya dalam perjanjian ini disebut sebagai <strong>PIHAK PERTAMA</strong>.<br>
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
               <td align="center">Jakarta, 12 Desember 2020</td>
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
          </div>
          <!-- /.invoice -->
          <?php endforeach;?>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
