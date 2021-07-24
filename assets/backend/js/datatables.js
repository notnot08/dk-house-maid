(function ($) {
  'use strict'
  $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  $("#non_export").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["colvis"]
    }).buttons().container().appendTo('#non_export_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $("#tabelAudit").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "order": [[ 3, "desc" ]],
      "buttons": ["excel", "pdf", "colvis"]
    }).buttons().container().appendTo('#tabelAudit_wrapper .col-md-6:eq(0)');

  })(jQuery)