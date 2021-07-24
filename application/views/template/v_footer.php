<footer class="main-footer no-print">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/backend/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url();?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url();?>assets/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/backend/plugins/select2/js/select2.full.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>assets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/backend/dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url();?>assets/backend/plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="<?php echo base_url();?>assets/backend/plugins/codemirror/codemirror.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/codemirror/mode/css/css.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/codemirror/mode/xml/xml.js"></script>
<script src="<?php echo base_url();?>assets/backend/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/backend/dist/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/backend/js/datatables.js"></script>
<script src="<?php echo base_url();?>assets/backend/js/optionform.js"></script>
<script>
  function clicked(e)
  {
      if(!confirm('Apakah anda yakin?')) {
          e.preventDefault();
      }
  }

$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
</body>
</html>