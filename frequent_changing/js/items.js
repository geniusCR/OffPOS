
$(function () {
  "use strict"
  let category_id = $("#category_id").val();
  let supplier_id = $("#supplier_id").val();
  let get_csrf_hash = $(".get_csrf_hash").val();
  let base_url = $("#base_url_").val();

  let copy_db = $('#copy_db_exp').val();
  let print_db = $('#print_db_exp').val();
  let excel_db = $('#excel_db_exp').val();
  let csv_db = $('#csv_db_exp').val();
  let pdf_db = $('#pdf_db_exp').val();

  initTooltips();
  function initTooltips() {
    $('[data-toggle="tooltip"]').tooltip();
  }

  //get data using ajax datatable
  $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    ordering: true,
    paging: true,
    
    ajax: {
      url: base_url + "Item/getAjaxData",
      type: "POST",
      dataType: "json",
      data: {
        category_id: category_id,
        supplier_id: supplier_id,
        get_csrf_token_name: get_csrf_hash,
      },
    },
    columnDefs: [
      { orderable: true, targets: [ 4, 6, 7 ] }
    ],

    dom: '<"top-left-item col-sm-12 col-md-6"lf> <"top-right-item col-sm-12 col-md-6"B> t <"bottom-left-item col-sm-12 col-md-6 "i><"bottom-right-item col-sm-12 col-md-6 "p>',
    buttons: [{
          extend: "print",
          text: '<span style="display: flex; align-items-center; gap: 8px;"><iconify-icon icon="solar:printer-broken" width="16"></iconify-icon> '+print_db+'</span>',
          titleAttr: "print",
      },
      {
          extend: "copyHtml5",
          text: '<span style="display: flex; align-items-center; gap: 8px;"><iconify-icon icon="solar:copy-broken" width="16"></iconify-icon> '+copy_db+'</span>',
          titleAttr: "Copy",
      },
      {
          extend: "excelHtml5",
          text: '<span style="display: flex; align-items-center; gap: 8px;"><iconify-icon icon="icon-park-solid:excel" width="16"></iconify-icon> '+excel_db+'</span>',
          titleAttr: "Excel",
      },
      {
          extend: "csvHtml5",
          text: '<span style="display: flex; align-items-center; gap: 8px;"><iconify-icon icon="teenyicons:csv-outline" width="16"></iconify-icon> '+csv_db+'</span>',
          titleAttr: "CSV",
      },
      {
          extend: "pdfHtml5",
          text: '<span style="display: flex; align-items-center; gap: 8px;"><iconify-icon icon="teenyicons:pdf-outline" width="16"></iconify-icon> '+pdf_db+'</span>',
          titleAttr: "PDF",
      },

      
    ],

    language: {
      paginate: {
        previous: "Previous",
        next: "Next",
      }
    },
    // Use drawCallback to initialize tooltips after each draw
    // Use initComplete to initialize tooltips after DataTable initialization is complete
    initComplete: function() {
      $('#datatable [data-bs-toggle="tooltip"]').tooltip();
    },

  });

  $(document).on('click', '#view_variation', function(){
    $("#variation_view_modal").modal('show');
    let variation_html = $(this).parent().find('#variation_html').html();
    let variation_name = $(this).parent().find('.get_variation_name').text();
    $("#modal_variation_html_set").html("");
    $("#modal_variation_html_set").html(variation_html);
    $(".variation_name_set").html("");
    $(".variation_name_set").html(variation_name);
  });

  $(document).on('click', '.m_close_trigger',function () {
    $('.modal').hide();
    $('.modal-backdrop').attr('class', '');
  });

  $(document).on('click', '.checkbox_itemAll', function(e){
    let checked = $(this).is(':checked');
    if (checked) {
      $(".checkbox_item").each(function () {
        $(this).prop("checked", true);
      });
      $(".checkbox_itemAll").prop("checked", true);
    } else {
      $(".checkbox_item").each(function () {
        $(this).prop("checked", false);
      });
      $(".checkbox_itemAll").prop("checked", false);
    }
  });
  $(document).on('click', '.checkbox_item', function(e){
    let menu_id = $(this).attr('data-menu_id');
    if ($(".checkbox_item").length == $(".checkbox_item:checked").length) {
      $(".checkbox_itemAll").prop("checked", true);
      if($(this).is(':checked')){
        $("#qty"+menu_id).val(1);
        $("#qty"+menu_id).prop("disabled", false);
      }else{
        $("#qty"+menu_id).prop("disabled", true);
        $("#qty"+menu_id).val('');
      }
    } else {
      $(".checkbox_itemAll").prop("checked", false);
      if($(this).is(':checked')){
        $("#qty"+menu_id).val(1);
        $("#qty"+menu_id).prop("disabled", false);
      }else{
        $("#qty"+menu_id).prop("disabled", true);
        $("#qty"+menu_id).val('');
      }
    }
  });

});
