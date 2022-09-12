"use strict";
if (!get_data) {
  var get_data = null;
}
$("[data-checkboxes]").each(function () {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function () {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if (role == 'dad') {
      if (me.is(':checked')) {
        all.prop('checked', true);
      } else {
        all.prop('checked', false);
      }
    } else {
      if (checked_length >= total) {
        dad.prop('checked', true);
      } else {
        dad.prop('checked', false);
      }
    }
  });
});

$("#table-1").dataTable({
  "dom": 'Blfrtip',
  initComplete: function () {
    var $buttons = $('.dt-buttons').hide();
    $('#exportLink').on('change', function () {
      var btnClass = $(this).find(":selected")[0].id ?
        '.buttons-' + $(this).find(":selected")[0].id :
        null;
      if (btnClass) $buttons.find(btnClass).click();
    })
  },
  "buttons": [{
      extend: 'excel',
      footer: false,
      text: '<i class="fa fa-files-o"></i> Export Excel ',
      className: 'btn btn-warning btn-sm mb-5',
      exportOptions: {
        columns: "thead th:not(.hide-export)"
      }
    },
    {
      extend: 'pdf',
      footer: false,
      text: '<i class="fa fa-file-pdf-o"></i> Export PDF',
      className: 'btn btn-warning btn-sm mb-5',
      exportOptions: {
        columns: "thead th:not(.hide-export)"
      },
    }
  ]
});
$("#table-2").dataTable();

$("#table-2-ss").dataTable({
  "processing": true, //Feature control the processing indicator.
  "serverSide": true, //Feature control DataTables' servermside processing mode.
  //"order": [], //Initial no order.
  "iDisplayLength": 10,
  "ordering": true,
  "ajax": {
    "url": get_data,
    "type": "POST",
  }
});

var table = $("#table-1-ss").dataTable({
  "dom": 'Blfrtip',
  initComplete: function () {
    var $buttons = $('.dt-buttons').hide();
    $('#exportLink').on('change', function () {
      var btnClass = $(this).find(":selected")[0].id ?
        '.buttons-' + $(this).find(":selected")[0].id :
        null;
      if (btnClass) $buttons.find(btnClass).click();
    })
  },
  "columnDefs": [{
    targets: "_all",
    orderable: false,
  }],
  "processing": true, //Feature control the processing indicator.
  "serverSide": true, //Feature control DataTables' servermside processing mode.
  //"order": [], //Initial no order.
  "iDisplayLength": 10,
  "ordering": true,
  "ajax": {
    "url": get_data,
    "type": "POST",
  },
  "buttons": [{
      extend: 'excel',
      footer: false,
      text: '<i class="fa fa-files-o"></i> Export Excel ',
      className: 'btn btn-warning btn-sm mb-5',
      exportOptions: {
        columns: "thead th:not(.hide-export)"
      },
      action: newexportaction
    },
    {
      extend: 'pdf',
      footer: false,
      text: '<i class="fa fa-file-pdf-o"></i> Export PDF',
      className: 'btn btn-warning btn-sm mb-5',
      exportOptions: {
        columns: "thead th:not(.hide-export)"
      },
      action: newexportaction
    }
  ]



});
var total_th = $('#table-1-ss thead th').length - 1;
$('#table-1-ss thead th').each(function (index) {
  if (index < total_th) {
    var title = $(this).text();
    $(this).html(title + '</br> <input type="text" class="col-search-input form-control form-control-sm" placeholder="Search ' + title + '" />');
  }

});

table.api().columns().every(function () {
  var table = this;
  $('input', this.header()).on('keyup change clear', function () {
    if (table.search() !== this.value) {
      table.search(this.value).draw();
    }
  });
});


function newexportaction(e, dt, button, config) {
  var self = this;
  var oldStart = dt.settings()[0]._iDisplayStart;
  dt.one('preXhr', function (e, s, data) {
    // Just this once, load all data from the server...
    data.start = 0;
    data.length = 2147483647;
    dt.one('preDraw', function (e, settings) {
      // Call the original action function
      if (button[0].className.indexOf('buttons-copy') >= 0) {
        $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
      } else if (button[0].className.indexOf('buttons-excel') >= 0) {
        $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
          $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
          $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
      } else if (button[0].className.indexOf('buttons-csv') >= 0) {
        $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
          $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
          $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
      } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
        $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
          $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
          $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
      } else if (button[0].className.indexOf('buttons-print') >= 0) {
        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
      }
      dt.one('preXhr', function (e, s, data) {
        // DataTables thinks the first item displayed is index 0, but we're not drawing that.
        // Set the property to what it was before exporting.
        settings._iDisplayStart = oldStart;
        data.start = oldStart;
      });
      // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
      setTimeout(dt.ajax.reload, 0);
      // Prevent rendering of the full data to the DOM
      return false;
    });
  });
  // Requery the server with the new one-time export settings
  dt.ajax.reload();
}