<?php
$lng = $this->session->userdata('language');
$ln_text = isset($lng) && $lng && $lng=="bangla"?"bangla":'';

$tax = '';
$inv_prev_due = 0;
if($sale_object->sale_vat_objects != ''){
    $tax = json_decode($sale_object->sale_vat_objects);
}

$letter_head_gap = $this->session->userdata('letter_head_gap');
$letter_footer_gap = $this->session->userdata('letter_footer_gap');

$head =  str_replace("px","", $letter_head_gap);
$foot =  str_replace("px","", $letter_footer_gap);
$slice_number = 842 - ((int)$head + (int)$foot);
$head_slice_sum = $head + $slice_number;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo escape_output($sale_object->sale_no); ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/local/google_font.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/print_invoice_letterhead.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/inv_common.css">
</head>
<body>

    <div class="page-header" style="height: <?php echo escape_output($letter_head_gap)?>;">
    </div>
    <div class="page-footer" style="height: <?php echo escape_output($letter_footer_gap)?>;">
    </div>


    <table class="w-100">
        <thead>
            <tr>
                <td>
                    <div class="page-header-space" style="height: <?php echo escape_output($letter_head_gap)?>;"></div>
                </td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                <div id="wrapper" class="m-auto border-2s-e4e5ea br-5 br-5 px-30 py-15">
                    <div>
                        <?php if($customer_info->name != '') {?>
                        <p class="pb-3 color-71">
                            <span class="f-w-600"><?php echo lang('bill_to');?>:</span> <?php echo escape_output($customer_info->name) ?>
                        </p>
                        <?php } ?>
                        <div class="d-flex justify-content-between">
                            <div>
                                <?php if($customer_info->address != '') {?>
                                <p class="pb-3 color-71">
                                    <span class="f-w-600"><?php echo lang('address');?>:</span> <?php echo escape_output($customer_info->address) ?>
                                </p>
                                <?php } ?>
                                <?php if($customer_info->phone != '') {?>
                                <p class="pb-3 color-71">
                                    <span class="f-w-600"><?php echo lang('phone');?>:</span> <?php echo escape_output($customer_info->phone) ?>
                                </p>
                                <?php } ?>
                                <?php if ($customer_info->gst_number != '') { ?>
                                <p class="pb-3 color-71">
                                    <span class="f-w-600"><?php echo lang('gst_no');?>:</span> <?php echo escape_output($customer_info->gst_number) ?>
                                </p>
                                <?php } ?>
                            </div>
                            <div class="text-rigth">
                                <p class="pb-3 f-w-500 color-71"> 
                                    <span class="f-w-600"><?php echo lang('date');?>:</span> 
                                    <?php echo dateFormat($servicing_details->added_date) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <table class="table w-100">
                            <thead class="br-3 bg-00c53">
                                <tr>
                                    <th class="w-5 ps-5"><?php echo lang('sn');?></th>
                                    <th class="w-30"><?php echo lang('product_name');?></th>
                                    <th class="w-20 text-center"><?php echo lang('servicing_charge');?></th>
                                    <th class="w-15 text-center"><?php echo lang('paid_amount');?></th>
                                    <th class="w-15 text-center"><?php echo lang('due_amount');?></th>
                                    <th class="w-15 text-right pr-10"><?php echo lang('status');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo 1 ?></td>
                                    <td><?php echo escape_output($servicing_details->product_name);?></td>
                                    <td class="text-center">
                                        <?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber($servicing_details->servicing_charge) : $servicing_details->servicing_charge)?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber($servicing_details->paid_amount) : $servicing_details->paid_amount) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber($servicing_details->due_amount) : $servicing_details->due_amount) ?>
                                    </td>
                                    <td class="text-right">
                                        <?php if($servicing_details->status == 'Received'){?>
                                            <span class="pending-status"><?php echo escape_output($servicing_details->status) ?></span>
                                        <?php } else if($servicing_details->status == 'Delivered'){ ?>
                                            <span class="success-status"><?php echo escape_output($servicing_details->status) ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center pt-30">
                        <button onclick="window.print();" type="button" class="print-btn no-print"><?php echo lang('print');?></button>
                    </div>
                </div>  
                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td>
                    <div class="page-footer-space" style="height: <?php echo escape_output($letter_footer_gap)?>;"></div>
                </td>
            </tr>
        </tfoot>
    </table>



    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>frequent_changing/js/onload_print.js"></script>
</body>
</html>