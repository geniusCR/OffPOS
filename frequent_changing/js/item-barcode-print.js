
$(function () {
  "use strict"
  $(document).on('click', '#print_barcode_wrap', function (e) { 
    let printContents = document.getElementById('barcode_wrap').innerHTML;
    let originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  });
  $(document).on('click', '#label_print_wrap', function (e) { 
    let printContents = document.getElementById('label_barcode_wrap').innerHTML;
    let originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  });

});