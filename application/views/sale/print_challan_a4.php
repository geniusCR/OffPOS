<?php
$lng = $this->session->userdata('language');
$ln_text = isset($lng) && $lng && $lng=="bangla"?"bangla":'';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo escape_output($sale_object->sale_no); ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/local/google_font.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/print_invoice_a4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/inv_common.css">
</head>
<body>
    <div id="wrapper" class="m-auto border-2s-e4e5ea br-5 p-30">
        <div class="d-flex justify-content-between">
            <div>
                <h3 class="pb-7"><?php echo escape_output($this->session->userdata('business_name')); ?></h3>
                <p class="pb-7 f-w-500 color-71"><?php echo escape_output($outlet_info->outlet_name); ?></p>
                <p class="pb-7 f-w-500 color-71"><?php echo escape_output($outlet_info->address); ?></p>
                <p class="pb-7 f-w-500 color-71"><?php echo lang('email');?>: <?php echo escape_output($outlet_info->email); ?></p>
                <p class="pb-7 f-w-500 color-71"><?php echo lang('phone');?>: <?php echo escape_output($outlet_info->phone); ?></p>
                <?php if($this->session->userdata('collect_tax') == 'Yes'){ ?>
                    <p class="pb-7 f-w-900 rgb-71"><?php echo $this->session->userdata('tax_title'); ?>: <?php echo $this->session->userdata('tax_registration_no'); ?></p>
                <?php } ?>
            </div>
            <div class="d-flex align-items-center">
                <div class="m-auto">
                    <?php
                        $invoice_logo = $this->session->userdata('invoice_logo');
                        if($invoice_logo):
                    ?>
                        <img src="<?=base_url()?>uploads/site_settings/<?=escape_output($invoice_logo)?>">
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </div>
        <div class="text-center py-10">
            <h2><?php echo lang('Challan');?></h2>
        </div>
        <div>
            <h4 class="pb-7"><?php echo lang('bill_to');?>:</h4>
            <div class="d-flex justify-content-between">
                <div>
                    <?php if($sale_object->customer_name != '') {?>
                    <p class="pb-7"><?php echo lang('name');?>: <?php echo escape_output($sale_object->customer_name) ?></p>
                    <?php } ?>
                    <?php if($customer_info->address != '') {?>
                    <p class="pb-7 f-w-500 color-71"><?php echo lang('address');?>: <?php echo escape_output($customer_info->address) ?></p>
                    <?php } ?>
                    <?php if($customer_info->phone != '') {?>
                    <p class="pb-7 f-w-500 color-71"><?php echo lang('phone');?>: <?php echo escape_output($customer_info->phone) ?></p>
                    <?php } ?>
                    <?php if ($customer_info->gst_number != '') { ?>
                    <p class="pb-7 f-w-500 color-71"><?php echo lang('gst_no');?>: <?php echo escape_output($customer_info->gst_number) ?></p>
                    <?php } ?>
                </div>
                <div class="text-rigth">
                    <p class="pb-7">
                        <span class="f-w-600"><?php echo lang('invoice_no');?>:</span> 
                        <?php echo escape_output($sale_object->sale_no);?>
                    </p>
                    <p class="pb-7 f-w-500 color-71"> 
                        <span class="f-w-600"><?php echo lang('date');?>:</span> 
                        <?php echo date($this->session->userdata('date_format'), strtotime($sale_object->sale_date ?? '')) ?>
                    </p>
                </div>
            </div>
        </div>
        <div>
            <table class="table w-100 mt-20">
                <thead class="br-3 bg-00c53">
                    <tr>
                        <th class="w-5 ps-5"><?php echo lang('sn');?></th>
                        <th class="w-30"><?php echo lang('item_name');?></th>
                        <th class="w-20"><?php echo lang('unit_price');?></th>
                        <th class="w-15"><?php echo lang('qty');?></th>
                        <th class="w-10"><?php echo lang('discount');?></th>
                        <th class="w-20 text-right pr-5"><?php echo lang('total');?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (isset($sale_object->items)) :
                        $i = 1;
                        $totalItems = 0;
                        foreach ($sale_object->items as $row) :
                            $totalItems++;

                            $combo_items = getComboItemByItemSaleId($row->sales_details_id);
                        ?>
                            <tr>
                                <td class="ps-5"><?php echo $i++; ?></td>
                                <td>
                                <?php
                                    echo $row->item_name.($row->brand_name?' - '.$row->brand_name:'');
                                    echo (($row->menu_note || $row->warranty || $row->guarantee)?"<br>":'');
                                ?>
                                <span class="short_note">
                                    <?=isset($row->menu_note) && $row->menu_note? lang('note').": " .$row->menu_note.", ":''?>
                                </span>
                                
                                
                                <?php if(($row->item_type == 'IMEI_Product' || $row->item_type == 'Serial_Product' || $row->item_type == 'Medicine_Product') && $row->expiry_imei_serial){ ?>
                                    <p class="short_note"><?php echo checkItemShortType($row->item_type)  ?>: <?php echo trim($row->expiry_imei_serial); ?></p>
                                <?php } ?>

                                <?php 
                                $warranty_date = '';
                                if($row->warranty_date == "day"){
                                    $warranty_date = "Day";
                                }elseif($row->warranty_date == "month"){
                                    $warranty_date = "Month";
                                }elseif($row->warranty_date == "year"){
                                    $warranty_date = "Year";
                                }
                                ?>
                                <?php if($row->warranty != 0){ ?>
                                <p class="text-muted short_note">
                                    <?php echo lang('warranty_expire');?>: <?php echo escape_output($row->warranty) . ' ' . $row->warranty_date ?><?php echo escape_output($row->warranty) > 3 ? 's' : '' ?>
                                </p> 
                                <p class="text-muted short_note">
                                    <?php echo lang('will_expire');?> <?= date($this->session->userdata('date_format'), strtotime(dateMonthYearFinder($row->warranty, $warranty_date, $sale_object->sale_date))) ?>
                                </p>
                                <?php } ?>
                                <?php 
                                $guarantee_date = '';
                                if($row->guarantee_date == "day"){
                                    $guarantee_date = "Day";
                                }elseif($row->guarantee_date == "month"){
                                    $guarantee_date = "Month";
                                }elseif($row->guarantee_date == "year"){
                                    $guarantee_date = "Year";
                                }
                                ?>
                                <?php if($row->guarantee != 0){ ?>
                                <p class="text-muted short_note">
                                    <?php echo lang('guarantee_expire');?>: <?php echo escape_output($row->guarantee) . ' ' . $row->guarantee_date ?><?php echo escape_output($row->guarantee) > 3 ? 's' : '' ?>
                                </p>
                                <p class="text-muted short_note">
                                    <?php echo lang('will_expire');?> <?= date($this->session->userdata('date_format'), strtotime(dateMonthYearFinder($row->guarantee, $guarantee_date, $sale_object->sale_date))) ?>
                                </p>
                                <?php } ?>
                                </td>
                                <td><?=getAmtCustom($ln_text=="bangla"?banglaNumber($row->menu_unit_price):$row->menu_unit_price)?></td>
                                <td>
                                    <?=($ln_text=="bangla"?banglaNumber($row->qty):$row->qty)?>
                                    <?=unitName(getSaleUnitIdByIgId($row->food_menu_id))?>
                                </td>
                                <td>
                                    <?php 
                                    if(checkPercentageOrPlain($row->menu_discount_value)){
                                        echo escape_output($row->menu_discount_value);
                                    }else{
                                        echo getAmtCustom($ln_text=="bangla"?banglaNumber($row->menu_discount_value):$row->menu_discount_value);
                                    }
                                    ?>
                                </td>
                                <td class="text-right"><?php echo getAmtCustom($ln_text=="bangla"?banglaNumber($row->menu_price_with_discount):$row->menu_price_with_discount); ?></td>
                            </tr>

                            <?php
                            if($combo_items){
                                foreach($combo_items as $k=>$combo){ 
                                    if($combo->show_in_invoice == 'Yes'){
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $combo->item_name ?></td>
                                    <td><?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber($combo->combo_item_price):$combo->combo_item_price) ?></td>
                                    <td><?php echo $combo->combo_item_qty ?></td>
                                    <td></td>
                                    <td class="text-right"><?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber((int)$combo->combo_item_qty * (int)$combo->combo_item_price) : (int)$combo->combo_item_qty * (int)$combo->combo_item_price)?></td>
                                </tr>
                            <?php }}} ?>


                <?php   
                    endforeach;
                    endif;
                ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-100">
            <div>
                <p class="color-71 d-inline b-t-1p-e4e5ea pt-10"><?php echo lang('authorized_signature');?></p>
            </div>
        </div>
        <div class="d-flex justify-content-center pt-30">
            <button onclick="window.print();" type="button" class="print-btn"><?php echo lang('print');?></button>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>frequent_changing/js/onload_print.js"></script>
</body>
</html>