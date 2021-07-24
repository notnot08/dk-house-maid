(function ($) {
  'use strict'
  function clicked(e)
  {
      if(!confirm('Apakah anda yakin?')) {
          e.preventDefault();
      }
  }

  })(jQuery)