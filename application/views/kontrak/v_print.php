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

            <?php foreach($data_kontrak->result() as $row ): $id_kontrak = $row->ID; ?>
              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <div class="login-logo">
                  <h3><strong>SURAT PERJANJIAN KONTRAK KERJA</strong></h3>
                  <h6><strong>No. <?php echo $row->NO_KONTRAK;?></strong></h6>
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
                      Yang bertanda tangan dibawah ini:<br>
                      <table>
                        <tr>
                          <td>Nama Perusahaan <?php echo $b;?></td>
                          <td>: <?php echo $row->NAMA_PERUSAHAAN;?></td>
                        </tr>
                        <tr>
                          <td>Alamat Perusahaan <?php echo $b;?></td>
                          <td>: <?php echo $row->ALAMAT_PERUSAHAAN;?></td>
                        </tr>
                      </table>
                      Selanjutnya disebut sebagai PIHAK PERTAMA<br><br>
                      <table>
                        <tr>
                          <td>Nama TKI <?php echo $a;?></td>
                          <td>: <?php echo $row->NAMA_PIHAK2;?></td>
                        </tr>
                        <tr>
                          <td>NIK TKI</td>
                          <td>: <?php echo $row->NIK_PIHAK2?></td>
                        </tr>
                        <tr>
                          <td>Alamat TKI</td>
                          <td>: <?php echo $row->ALAMAT_PIHAK2?></td>
                        </tr>
                      </table>
                      Selanjutnya disebut sebagai PIHAK KEDUA<br><br>
                    </address>
                    <address>
                      Dengan ini kedua belah pihak telah menyatakan sepakat untuk mengadakan Perjanjian Kontrak Kerja selama <?php echo $row->LAMA_KONTRAK; ?> <?php echo strtolower($row->SATUAN_LAMA_KONTRAK); ?>.<br>
                      Dengan syarat dan ketentuan sebagai berikut: <br><br>
                    </address>
                    <div class="login-logo">
                      <h5><strong>MASA BERLAKU PERJANJIAN</strong></h5>
                    </div>
                    <address>
                      Perjanjian ini berlaku selama <?php echo $row->LAMA_KONTRAK; ?> <?php echo strtolower($row->SATUAN_LAMA_KONTRAK); ?> dimulai sejak tanggal <?php echo $row->TANGGAL_MULAI2; ?> hingga berakhirnya pada tanggal <?php echo $row->TANGGAL_SELESAI2; ?>.<br>
                    </address>
                    <div class="login-logo">
                      <h5><strong>WAKTU KERJA</strong></h5>
                    </div>
                    <address>
                      Pihak pertama memiliki jam kerja <?php echo $row->JAM_PERHARI;?> jam perhari atau <?php echo ($row->JAM_PERHARI)*($row->WAKTU_KERJA);?> jam perminggu.<br>
                    </address>
                    <div class="login-logo">
                      <h5><strong>GAJI, TUNJANGAN, INSENTIF DAN LEMBUR</strong></h5>
                    </div>
                    <address>
                      Kedua belah pihak sepakat untuk melakukan kerjasama yang dituangkan dalam suatu naskah perjanjian kerjasama dengan ketentuan sebagai berikut.<br>
                      <ol>
                        <li>Gaji pokok akan diberikan setiap tanggal <?php echo $row->TGL_PEMBERIAN_GAJI;?> tiap bulan dengan jumlah Rp. <?php echo $row->JUMLAH_GAPOKF; ?></li>
                        <li>Tunjangan kesehatan sebesar Rp. <?php echo $row->TUNJANGAN_KESEHATANF; ?>/bulan.</li>
                        <li>Tunjangan transportasi sebesar Rp. <?php echo $row->TUNJANGAN_TRANSPORTASIF; ?>/bulan.</li>
                        <li>Kerajinan dalam bekerja sebesar Rp. <?php echo $row->UANG_KERAJINANF; ?>/bulan.</li>
                      </ol>
                    </address>
                    <div class="login-logo">
                      <h5><strong>BIAYA PENGOBATAN</strong></h5>
                    </div>
                    <address>
                      Pada akhir tahun PIHAK KEDUA akan mendapatkan penggantian Biaya Pengobatan sebesar Rp. <?php echo $row->BIAYA_PENGOBATANF;?>.<br>
                    </address>
                    <div class="login-logo">
                      <h5><strong>CUTI TAHUNAN</strong></h5>
                    </div>
                    <address>
                      PIHAK KEDUA akan mendapatkan cuti kerja selama <?php echo $row->CUTI_TAHUNAN;?> hari, untuk masa kerja selama 1 (satu) tahun setelah masa Kontrak Kerja tahun pertama habis.<br>
                    </address>
                    <div class="login-logo">
                      <h5><strong>PENGUNDURAN DIRI</strong></h5>
                    </div>
                    <address>
                      PIHAK KEDUA dapat mengundurkan diri setelah memenuhi masa kerja selama <?php echo $row->SYARAT_UNDURDIRI;?> bulan dengan cara membuat surat pengunduran diri paling lambat <?php echo $row->WAKTU_UNDURDIRI;?> bulan sebelumnya. Jika ini terjadi, PIHAK KEDUA tidak akan mendapatkan tunjangan dan insentif lainnya, hanya mendapatkan gaji sesuai dengan waktu aktif kerja terakhir.<br>
                    </address>
                    <div class="login-logo">
                      <h5><strong>PEMUTUSAN HUBUNGAN KERJA</strong></h5>
                    </div>
                    <address>
                      PIHAK PERTAMA memiliki hak untuk memutuskan hubungan kerja kapanpun kepada PIHAK KEDUA dan tidak wajib memberikan pesangon dalam bentuk apapun, apabila PIHAK KEDUA melakukan tindakan pelanggaran atau hal - hal yang dianggap dapat merugikan Perusahaan.<br>
                    </address>
                    <div class="login-logo">
                      <h5><strong>PERATURAN KEDISIPLINAN DAN KETERTIBAN PERUSAHAAN</strong></h5>
                    </div>
                    <address>
                      PIHAK KEDUA sanggung dan wajib mengikuti segala peraturan yang sudah ditetapkan oleh perusahaan. Apabila ada tindakan yang terbukti melanggar pertaturan tersebut, maka akan diberikan Surat Peringatan maksimal 2 (dua) kali peringatan. Selanjutnya jika masih melakukan pelanggaran pada kali ke 3 (tiga), maka PIHAK PERTAMA berhak memberikan sanksi pemutusan hubungan kerja yang kemudian tanpa diberikan gaji dan tunjangan.<br>
                    </address>
                    <br>Surat Perjanjian Kontrak Kerja ini telah ditandatangani dan disepakati oleh Kedua Belah Pihak secara sadar dan tanpa ada unsur paksaan dari pihak manapun.<br> <br> 
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
                    <td align="center">Jakarta, <?php echo $row->TGL_PENGESAHAN2;?></td>
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
                      <td align="center">(<?php echo $row->PIHAK_PERTAMA?>)</td>
                      <td align="center">(<?php echo $row->PIHAK_KEDUA?>)</td>
                    </tr>
                  </table>
                  <br>
                  <br>
                  <br>
                <?php endforeach;?>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
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
