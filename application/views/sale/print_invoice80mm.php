<?php
$lng = $this->session->userdata('language');
$ln_text = isset($lng) && $lng && $lng == "bangla" ? "bangla" : '';
$tax = '';
$inv_prev_due = 0;
if($sale_object->sale_vat_objects != ''){
    $tax = json_decode($sale_object->sale_vat_objects);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo escape_output($sale_object->sale_no); ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/local/google_font.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/print_invoice80mm.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/inv_common.css">
</head>
<body>
    <div id="wrapper" class="m-auto border-2s-e4e5ea br-5 p-15">
        <div class="d-flex justify-content-center">
            <?php
                $invoice_logo = $this->session->userdata('invoice_logo');
                if($invoice_logo):
            ?>
                <img src="<?=base_url()?>uploads/site_settings/<?=escape_output($invoice_logo)?>">
            <?php
                endif;
            ?>
        </div>
        <div class="text-center">
            <h3 class="font-size-20"><?php echo escape_output($this->session->userdata('business_name')); ?></h3>
            <h4 class="pb-7 font-size-15"><?php echo escape_output($outlet_info->outlet_name); ?></h4>
            <p class="f-w-500 color-71 font-size-13"><?php echo escape_output($outlet_info->address); ?></p>
            <p class="f-w-500 color-71 font-size-13"><?php echo lang('email');?>: <?php echo escape_output($outlet_info->email); ?></p>
            <p class="f-w-500 color-71 font-size-13"><?php echo lang('phone');?>: <?php echo escape_output($outlet_info->phone); ?></p>
            <?php if($this->session->userdata('collect_tax') == 'Yes'){ ?>
                <p class="pb-7 f-w-900 rgb-71"><?php echo $this->session->userdata('tax_title'); ?>: <?php echo $this->session->userdata('tax_registration_no'); ?></p>
            <?php } ?>
        </div>

        <div class="text-center py-10">
            <h3 class="font-size-20"><?php echo lang('invoice');?></h3>
        </div>
        <div>
            <div class="d-flex justify-content-between">
                <div>
                    <?php if($customer_info->name != ''){ ?>
                    <p class="f-w-500 color-71 font-size-13"><span class="f-w-600"><?php echo lang('bill_to');?>:</span> <?php echo escape_output($customer_info->name) ?></p>
                    <?php } ?>
                    <?php if($customer_info->address != ''){ ?>
                    <p class="f-w-500 color-71 font-size-13"><span class="f-w-600"><?php echo lang('address');?>:</span> <?php echo escape_output($customer_info->address) ?></p>
                    <?php } ?>
                    <?php if($customer_info->phone != ''){ ?>
                    <p class="f-w-500 color-71 font-size-13"><span class="f-w-600"><?php echo lang('phone');?>:</span> <?php echo escape_output($customer_info->phone) ?></p>
                    <?php } ?>
                    <?php if($customer_info->gst_number != ''){ ?>
                    <p class="f-w-500 color-71 font-size-13"><span class="f-w-600"><?php echo lang('gst_no');?>:</span> <?php echo escape_output($customer_info->gst_number) ?></p>
                    <?php } ?>
                </div>
                <div class="text-rigth">
                    <p class="f-w-500 color-71 font-size-13"><span class="f-w-600"><?php echo lang('invoice_no');?>:</span> 
                    <?php echo escape_output($sale_object->sale_no);?></p>
                    <p class="f-w-500 color-71 font-size-13"> <span class="f-w-600"><?php echo lang('date');?>:</span> <?= date($this->session->userdata('date_format'), strtotime($sale_object->sale_date ?? '')) ?></p>
                </div>
            </div>
        </div>
        <div class="tharmal_table">
            <table class="table w-100 mt-20">
                <thead class="br-3">
                    <tr>
                        <th class="w-5"><?php echo lang('sn');?></th>
                        <th class="w-30"><?php echo lang('item');?> - <?php echo lang('code');?> - <?php echo lang('brand');?></th>
                        <th class="w-20"><?php echo lang('unit_price');?></th>
                        <th class="w-15"><?php echo lang('qty');?></th>
                        <th class="w-10"><?php echo lang('discount');?></th>
                        <th class="w-20 text-right"><?php echo lang('total');?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (isset($sale_object->items)) :
                        $i = 1;
                        $totalItems = 0;
                        $totalQty = 0;
                        $unitprice_sum = 0;
                        $discount_sum = 0;
                        $taxSum = 0;
                        $total_discount_amount = 0;

                        foreach ($sale_object->items as $row) :
                            $totalItems++;
                            $unitprice_sum = $unitprice_sum + $row->menu_unit_price;
                            $discount_sum = $discount_sum + (int)$row->menu_discount_value;
                            $totalQty = $totalQty+$row->qty;
                            $total_discount_amount += $row->discount_amount;
                            $combo_items = getComboItemByItemSaleId($row->sales_details_id);
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td>
                                <?php
                                    echo getItemNameCodeBrandByItemId($row->food_menu_id); echo escape_output($row->alternative_name) ? ' (' . $row->alternative_name . ')' : '';
                                ?>
                                <?php if($row->menu_note){ ?>
                                <div class="short_note">
                                    <?=isset($row->menu_note) && $row->menu_note? lang('note').": " .$row->menu_note.", ":''?>
                                </div>
                                <?php } ?>

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
                                    echo escape_output($row->menu_discount_value). ' (' . getAmtCustom($row->discount_amount) . ')';
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
                <tfoot>
                    <tr>
                        <th></th>
                        <th class="text-right pr-10" colspan="2"><?php echo lang('total');?></th>
                        <th><?= ($ln_text=="bangla" ? banglaNumber($totalItems) : $totalItems) ?> (<?php echo ($ln_text=="bangla" ? banglaNumber($totalQty) : $totalQty)?>)</th>
                        <th><?php echo escape_output(getAmtCustom($total_discount_amount)); ?></th>
                        <th class="text-right"><?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber($sale_object->sub_total) : $sale_object->sub_total)?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="">
            <div>
                <?php
                    if($sale_object->previous_due > 0){
                        $inv_prev_due = absCustom($sale_object->previous_due);
                ?>
                <div class="d-flex justify-content-between">
                    <p class="f-w-600 font-size-13"><?php echo lang('previous_balance');?></p>
                    <p class="font-size-13"><?php echo getAmtCustom($ln_text=="bangla"?banglaNumber($inv_prev_due):  $inv_prev_due)?> (Debit)</p>
                </div>
                <?php } else if ($sale_object->previous_due < 0){ 
                    $inv_prev_due = absCustom($sale_object->previous_due);
                    
                    ?>
                    <div class="d-flex justify-content-between">
                        <p class="f-w-600 font-size-13"><?php echo lang('previous_balance');?></p>
                        <p class="font-size-13"><?php echo getAmtCustom($ln_text=="bangla"?banglaNumber($inv_prev_due):  $inv_prev_due)?> (Credit)</p>
                    </div>
                <?php } else{ ?>
                    <div class="d-flex justify-content-between">
                        <p class="f-w-600 font-size-13"><?php echo lang('previous_balance');?></p>
                        <p class="font-size-13"><?php echo getAmtCustom($ln_text=="bangla"?banglaNumber($sale_object->previous_due):  $sale_object->previous_due)?></p>
                    </div>
                <?php } ?>




                <?php
                    if($sale_object->sub_total) {
                ?>
                <div class="d-flex justify-content-between">
                    <p class="f-w-600 font-size-13"><?php echo lang('subtotal');?></p>
                    <p class="font-size-13"><?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber($sale_object->sub_total) : $sale_object->sub_total)?></p>
                </div>
                <?php
                    }
                ?>

                <?php if($tax) {
                    $i = 0;
                    foreach($tax as $t){ 
                        if($t->tax_field_amount > 0){  
                            $i++;
                            $taxSum += $t->tax_field_amount;
                ?>
                <div class="d-flex justify-content-between border-bottom-dotted-gray <?php echo escape_output($i) == 1 ? 'border-top-dotted-gray' : '' ?>">
                    <p class="f-w-600 font-size-13"><?php echo escape_output($t->tax_field_type) ?></p>
                    <p class="font-size-13"><?php echo escape_output(getAmtCustom($t->tax_field_amount));?></p>
                </div>
                <?php } } } ?>

                <?php if($sale_object->delivery_charge > 0){?>
                <div class="d-flex justify-content-between">
                    <p class="f-w-600 font-size-13"><?php echo lang('charge');?> (<?php echo escape_output($sale_object->charge_type) == 'delivery' ? 'Delivery' : 'Service'; ?>)</p>
                    <p class="font-size-13"><?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber($sale_object->delivery_charge) : $sale_object->delivery_charge)?></p>
                </div>
                <?php } ?>


                <?php if($sale_object->sub_total_discount_amount > 0){?>
                <div class="d-flex justify-content-between">
                    <p class="f-w-600 font-size-13"><?php echo lang('discount');?></p>
                    <p class="font-size-13"><?php echo escape_output(getAmtCustom($sale_object->sub_total_discount_amount));?></p>
                </div>
                <?php } ?>

                <?php
                    if($sale_object->rounding) {
                ?>
                <div class="d-flex justify-content-between border-bottom-dotted-gray">
                    <p class="font-size-13 f-w-600"><?php echo lang('rounding');?></p>
                    <?php if($sale_object->rounding < 0){
                        $rounding_amt = $sale_object->rounding;
                    } else if($sale_object->rounding > 0){
                        $rounding_amt = '+ ' . $sale_object->rounding;
                    }else{
                        $rounding_amt = 0;
                    }
                    ?>
                    <p class="font-size-13"><?php echo $rounding_amt ?></p>
                </div>
                <?php
                    }
                ?>


                <?php
                    if($sale_object->total_payable) {
                ?>
                <div class="d-flex justify-content-between border-bottom-dotted-gray">
                    <p class="font-size-13 f-w-600"><?php echo lang('total_payable');?></p>
                    <?php 
                        $totalpayable = ($sale_object->total_payable);
                    ?>
                    <p class="font-size-13"><?php echo getAmtCustom($ln_text=="bangla"?banglaNumber($totalpayable):$totalpayable) ?></p>
                </div>
                <?php
                    }
                ?>



                <?php
                    if($sale_object->paid_amount) {
                ?>
                <div class="d-flex justify-content-between">
                    <p class="f-w-600 font-size-13"><?php echo lang('paid_amount');?></p>
                    <p class="font-size-13"><?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber($sale_object->paid_amount):$sale_object->paid_amount) ?></p>
                </div>
                <?php
                    }
                ?>


                <?php
                    if($sale_object->due_amount > 0) {
                ?>
                <div class="d-flex justify-content-between">
                    <p class="f-w-600 font-size-13"><?php echo lang('due_amount');?></p>
                    <p class="font-size-13"><?php echo getAmtCustom($ln_text=="bangla"?banglaNumber($sale_object->due_amount):$sale_object->due_amount) ?></p>
                </div>
                <?php }?>

                

                <?php
                if($sale_object->due_amount < 0) {  
                    $due_reveive  = 0;
                    $advance_receive = 0;
                    if(absCustom($sale_object->due_amount) <= $inv_prev_due){
                        $due_reveive  = $sale_object->due_amount;
                    }
                    if(absCustom($sale_object->due_amount) > $inv_prev_due){
                        $due_reveive = $inv_prev_due;
                        $advance_receive = absCustom($sale_object->due_amount) - $inv_prev_due;
                    } ?>
                    <div class="d-flex justify-content-between ">
                        <p class="f-w-600 font-size-13"><?php echo lang('due_receive');?></p>
                        <p><?php echo getAmtCustom($ln_text=="bangla"?banglaNumber(absCustom($due_reveive) ? absCustom($due_reveive) : 0 ): (absCustom($due_reveive) ? absCustom($due_reveive) : 0)); ?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="f-w-600 font-size-13"><?php echo lang('advance_receive');?></p>
                        <p><?php echo getAmtCustom($ln_text=="bangla"?banglaNumber(absCustom($advance_receive) ? absCustom($advance_receive) : 0 ): (absCustom($advance_receive) ? absCustom($advance_receive) : 0)); ?></p>
                    </div>
                <?php } ?>



                <div class="d-flex justify-content-between border-bottom-dotted-gray border-top-dotted-gray">
                    <p class="f-w-600 font-size-13"><?php echo lang('payment_method');?></p>
                </div>
                <?php
                    $outlet_id = $this->session->userdata('outlet_id');
                    $salePaymentDetails = salePaymentDetails($sale_object->id,$outlet_id);
                    if(isset($salePaymentDetails) && $salePaymentDetails):
                    $payment_details = "";
                    foreach($salePaymentDetails as $p_name):
                        if($p_name->payment_details){
                            $payment_details = explode(",",$p_name->payment_details);
                        }
                ?>
                <div class="d-flex justify-content-between">
                    <p class="f-w-600 font-size-13">
                        <?php echo escape_output($p_name->payment_name); ?> 
                        <?php 
                        if($p_name->payment_details != ''){
                            foreach($payment_details as $key=>$details){
                            ?> 
                            <span class="font-size-10"><?php echo $details != '' ? ($key === array_key_last($payment_details) ? $details : $details . ',' ) : '';?>
                            </span>
                        <?php } }?>
                    </p>
                    <?php if($p_name->multi_currency){?>
                        <p class="font-size-13"><?php echo getAmtCustom($sale_object->paid_amount); ?></p>
                    <?php } else { ?>
                        <p class="font-size-13"><?php echo getAmtCustom($p_name->amount); ?></p>
                    <?php } ?>
                </div>
                <div class="d-flex justify-content-center pt-5">
                    <?php 
                        $currency = $this->session->userdata('currency');
                        $description = '';
                        if($p_name->payment_id == 8){
                            $description = "(Usage: $p_name->usage_point)";
                        }else if($p_name->multi_currency){
                            $description = "Paid in $p_name->multi_currency $p_name->amount where 1 $currency =  $p_name->multi_currency_rate";
                        }
                    ?>
                    <p class="font-size-13"><?php echo $description; ?></p>
                </div>
                <?php
                    endforeach;
                    endif;
                ?>

                <?php
                    if($sale_object->given_amount && $sale_object->change_amount) {
                ?>
                <div class="d-flex justify-content-center">
                    <p class="f-w-600 font-size-13"><?php echo lang('given_amount');?>: <?php echo getAmtCustom($ln_text=="bangla" ? banglaNumber($sale_object->given_amount) : $sale_object->given_amount) ?></p>
                </div>
                <?php }  ?>

                <?php
                    if($sale_object->change_amount) {
                ?>
                <div class="d-flex justify-content-center">
                    <p class="f-w-600 font-size-13"><?php echo lang('change_amount');?>: <?php echo getAmtCustom($ln_text=="bangla"?banglaNumber($sale_object->change_amount):$sale_object->change_amount) ?></p>
                </div>
                <?php }  ?>


            </div>
        </div>
        <div class="mt-30">
            <p><?php echo $this->session->userdata('term_conditions'); ?></p>
        </div>
        <?php
        $file_path = base_url() . 'uploads/qr_code/'. $sale_object->id . '.png';
         if($this->session->userdata('inv_qr_code_status') == 'Enable' && file_exists($file_path)){ ?>
        <div class="d-flex justify-content-center pt-30">
            <div>
                <img width="80" height="80" src="<?php echo base_url()?>uploads/qr_code/<?php echo escape_output($sale_object->id)?>.png">
            </div>
        </div>
        <?php } ?>

        <div class="d-flex justify-content-center pt-30">
            <div>
                <p class="font-size-15"><?php echo $this->session->userdata('invoice_footer'); ?></p>
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