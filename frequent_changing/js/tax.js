$(function () {
    "use strict";


    $(document).on('submit', '#restaurant_setting_form', function() {
        let error = 0;
        let outlet_name = $('#outlet_name');
        let address = $('#address');
        let phone = $('#phone');
        let collect_tax_yes = $('#collect_tax_yes');
        let collect_tax_no = $('#collect_tax_no');
        let tax_title = $('#tax_title');
        let tax_registration_no = $('#tax_registration_no');
        let tax_is_gst_yes = $('#tax_is_gst_yes');
        let tax_is_gst_no = $('#tax_is_gst_no');
        let state_code = $('#state_code')

        if (!collect_tax_yes.is(':checked') && !collect_tax_no.is(':checked')) {
            error++;
        }
        if (collect_tax_yes.is(':checked')) {
            if (tax_title.val() == "") {
                error++;
                $('#tax_title_error').fadeIn();
            }
            if (tax_registration_no.val() == "") {
                error++;
                $('#tax_registration_no').fadeIn();
            }
            if (!tax_is_gst_yes.is(':checked') && !tax_is_gst_no.is(':checked')) {
                error++;
            }
            if (tax_is_gst_yes.is(':checked')) {
                if (state_code.val() == "") {
                    error++;
                    $('#state_code_error').fadeIn();
                }
            }
        }

    });
    
    $(document).on('click', '.remove_this_tax_row', function () {
        let this_row = $(this);
        let this_row_id = this_row.attr('id').substr(20);
        $('#tax_row_' + this_row_id).remove();
        let j = 1;
        $('.remove_this_tax_row').each(function (i, obj) {
            $(this).attr('id', 'remove_this_tax_row_' + j);
            $(this).parent().parent().attr('id', 'tax_row_' + j);
            $(this).parent().parent().find('td:first-child').text(j);
            j++;
        });
    });
    $(document).on('click', '#remove_all_taxes', function () {
        $('.tax_single_row').remove();
    });
    $(document).on('click', '#collect_tax_yes', function() {
        $('#tax_yes_section').addClass('d-block');
        $('#tax_yes_section').removeClass('d-none');
    });
    $(document).on('click', '#collect_tax_no', function() {
        $('#tax_yes_section').addClass('d-none');
        $('#tax_yes_section').removeClass('d-block');
    });


    function show_hide_div() {
        let tax_is_gst = $("input[type='radio'][name='tax_is_gst']:checked").val();
        if(tax_is_gst=="Yes"){
            $(".gst_div").fadeIn();
        }else{
            $(".gst_div").fadeOut();
        }
    }
    show_hide_div();

    $(document).on('click', '#tax_is_gst_yes', function() {
        $('#gst_yes_section').fadeIn();
        show_hide_div();
    });
    $(document).on('click', '#tax_is_gst_no', function() {
        $('#gst_yes_section').fadeOut()
        show_hide_div();

    });
    $(document).on('click','#add_tax',function(){
        let table_tax_body = $('#tax_table_body');
        let tax_body_row_length = table_tax_body.find('tr').length;
        let new_row_number = tax_body_row_length+1;
        let show_tax_row = '';
        show_tax_row += '<tr class="tax_single_row" id="tax_row_'+new_row_number+'">';
        show_tax_row += '<td valign="middle">'+new_row_number+'</td>';
        show_tax_row += '<td><input type="text" placeholder="Tax Name" name="taxes[]" class="form-control check_required m-0"></td><td><input type="text" placeholder="Tax Rate" onfocus="select()" name="tax_rate[]" class="form-control check_required integerchk" value=""></td>';
        show_tax_row += '<td><button type="button" class="remove_this_tax_row txt_25 new-btn-danger h-40" id="remove_this_tax_row_'+new_row_number+'" ><iconify-icon icon="solar:trash-bin-minimalistic-broken" width="18"></iconify-icon> </button></td>' +'';
        show_tax_row += '</tr>';
        table_tax_body.append(show_tax_row);
    });


    $(document).on('change', 'input[type=radio][name=collect_tax]', function() {
        if (this.value == 'Yes') {
            $('#vat_reg_no_container').show();
        } else if (this.value == 'No') {
            $('#vat_reg_no_container').hide();
        }
    });


});