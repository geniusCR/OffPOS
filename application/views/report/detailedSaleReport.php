<!-- shuvo -->
<link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/report.css">

<div class="main-content-wrapper">

    <section class="content-header">
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header mt-2"><?php echo lang('detailed_sale_report'); ?></h3>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('report'), 'secondSection'=> lang('detailed_sale_report')])?>
        </div>
    </section>


    <div class="box-wrapper">
    
        <!-- Report Header Start -->
        <div class="report_header">
            <h3 class="company_name"><?php echo escape_output($this->session->userdata('business_name'));?> </h3>
            <h5 class="outlet_info">
                <strong><?php echo lang('detailed_sale_report'); ?></strong>
            </h5>
            <?php if(isset($outlet_id) && $outlet_id){
                $outlet_info = getOutletInfoById($outlet_id); 
            }?>
            <h5 class="outlet_info">
                <?php if(isset($outlet_id) && $outlet_id){ ?>
                    <strong><?php echo lang('outlet'); ?>: </strong> <?= escape_output($outlet_info->outlet_name); ?>
                <?php }?>
            </h5>
            <h5 class="outlet_info">
                <?php if(isset($outlet_id) && $outlet_id){ ?>
                    <strong><?php echo lang('address'); ?>: </strong> <?= escape_output($outlet_info->address); ?>
                <?php } ?>
            </h5>
            <h5 class="outlet_info">
                <?php if(isset($outlet_id) && $outlet_id){ ?>
                    <strong><?php echo lang('email'); ?>: </strong> <?= escape_output($outlet_info->email); ?>
                <?php } ?>
            </h5>
            <h5 class="outlet_info">
                <?php if(isset($outlet_id) && $outlet_id){ ?>
                    <strong><?php echo lang('phone'); ?>: </strong> <?= escape_output($outlet_info->phone); ?>
                <?php } ?>
            </h5>
            <?php if(isset($start_date) && $start_date != '' && $start_date != '1970-01-01' || isset($end_date) && $end_date != '' && $end_date != '1970-01-01'){ ?>
            <h5 class="outlet_info">
                <strong><?php echo lang('date');?>:</strong>
                <?php
                    if(!empty($start_date) && $start_date != '1970-01-01') {
                        echo dateFormat($start_date);
                    }
                    if((isset($start_date) && isset($end_date)) && ($start_date != '1970-01-01' && $end_date != '1970-01-01')){
                        echo ' - ';
                    }
                    if(!empty($end_date) && $end_date != '1970-01-01') {
                        echo dateFormat($end_date);
                    }
                ?>
            </h5>
            <?php } ?>
            <h5 class="outlet_info">
                <?php if(isset($user_id) && $user_id){ ?>
                    <strong><?php echo lang('employee'); ?>: </strong> <?php echo getUserName($user_id); ?>
                <?php }else if(isset($user_id) && $user_id == ''){ ?>
                    <strong><?php echo lang('employee'); ?>: </strong> <?php echo lang('all'); ?>
                <?php } ?>
            </h5>
            <h5 class="outlet_info">
                <?php if(isset($report_generate_time) && $report_generate_time){
                    echo $report_generate_time;
                } ?>
            </h5>
        </div>
        <!-- Report Header End -->

        <div class="table-box">
            <div class="box-body">
                <div class="table-responsive">

                <input type="hidden" class="datatable_name"  data-filter="yes" data-title="<?php echo lang('detailed_sale_report'); ?>" data-id_name="datatable">

                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="op_width_2_p op_center"><?php echo lang('sn'); ?></th>
                                <th><?php echo lang('invoice_no'); ?></th>
                                <th><?php echo lang('date_and_time'); ?></th>
                                <th class="text-center"><?php echo lang('total_items'); ?></th>
                                <th><?php echo lang('items'); ?></th>
                                <th class="text-center"><?php echo lang('subtotal'); ?></th>
                                <th class="text-center"><?php echo lang('discount'); ?></th>
                                <th class="text-center"><?php echo lang('tax'); ?></th>
                                <th class="text-center"><?php echo lang('g_total'); ?></th>
                                <th class="text-center"><?php echo lang('paid_amount'); ?></th>
                                <th class="text-center"><?php echo lang('due_amount'); ?></th>
                                <th><?php echo lang('payment_method'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pGrandTotal = 0;
                            $subGrandTotal = 0;
                            $itemsGrandTotal = 0;
                            $disGrandTotal = 0;
                            $vatGrandTotal = 0;
                            $total_prevous = 0;
                            $paidTotal = 0;
                            $dueTotal = 0;
                            if (isset($detailedSaleReport)):
                                foreach ($detailedSaleReport as $key => $value) {
                                    $pGrandTotal+=$value->total_payable;
                                    $subGrandTotal+=$value->sub_total;
                                    $itemsGrandTotal+=$value->total_items;
                                    $disGrandTotal+=$value->total_discount_amount;
                                    $vatGrandTotal+=$value->vat;
                                    $paidTotal+=$value->paid_amount;
                                    $dueTotal+=$value->due_amount;
                                    $total_prevous+= 0;
                                    $key++;
                                    ?>
                                    <tr>
                                        <td class="op_center"><?php echo $key; ?></td>
                                        <td><?php echo escape_output($value->sale_no) ?></td>
                                        <td><?php echo dateFormat($value->date_time) ?></td>
                                        <td class="text-center"><?php echo escape_output($value->total_items) ?></td>
                                        <td>
                                            <?php
                                            echo "<strong>Name(Code)-Qty-Price-Discount-Total</strong>" . "<br>";
                                            foreach ($value->items as $key1 => $value1) {
                                                echo getItemParentAndChildNameCode($value1->food_menu_id) . '-' .$value1->qty . '-' . $value1->menu_unit_price . '-' . $value1->menu_discount_value . '-' .$value1->menu_price_with_discount;
                                                if($key1 < (sizeof($value->items) -1)){
                                                    echo "<br>";
                                                }
                                            }
                                            ?>

                                        </td>
                                        <td class="text-center"><?php echo getAmtCustom($value->sub_total) ?></td>
                                        <td class="text-center"><?php echo getAmtCustom($value->total_discount_amount) ?></td>
                                        <td class="text-center"><?php echo getAmtCustom($value->vat) ?></td>
                                        <td class="text-center"><?php echo getAmtCustom($value->total_payable) ?></td>
                                        <td class="text-center"><?php echo getAmtCustom($value->paid_amount) ?></td>
                                        <td class="text-center"><?php echo getAmtCustom($value->due_amount) ?></td>
                                        <td>
                                            <?php 
                                                $payments = getAllPaymentMethodBySaleId($value->id);
                                                if($payments){
                                                    foreach($payments as $payment){
                                                        echo escape_output($payment->payment_name). ":" . $payment->amount . "<br>";
                                                    }
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    
                                }
                            endif;
                            ?>
                            <tr>
                                <th></th>
                                <th></th>
                                <th class="text-right"><?php echo lang('total'); ?> </th>
                                <th class="text-center"><?= $itemsGrandTotal ?></th>
                                <th></th>
                                <th class="text-center"><?= getAmtCustom($subGrandTotal) ?></th>
                                <th class="text-center"><?= getAmtCustom($disGrandTotal) ?></th>
                                <th class="text-center"><?= getAmtCustom($vatGrandTotal) ?></th>
                                <th class="text-center"><?= getAmtCustom($pGrandTotal) ?></th>
                                <th class="text-center"><?= getAmtCustom($paidTotal) ?></th>
                                <th class="text-center"><?= getAmtCustom($dueTotal) ?></th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>










<div class="filter-overlay"></div>
<div id="product-filter" class="filter-modal">
    <div class="filter-modal-body">
        <header>
                <h3 class="filter-modal-title"><span><?php echo lang('FilterOptions'); ?></span></h3>
                <button type="button" class="close-filter-modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i data-feather="x"></i>
                    </span>
                </button>
        </header>
        <?php echo form_open(base_url() . 'Report/detailedSaleReport') ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-2">
                <div class="form-group">
                    <input  autocomplete="off" type="text" name="startDate" id="startDate" readonly class="form-control customDatepicker" placeholder="<?php echo lang('start_date'); ?>" value="<?php echo set_value('startDate'); ?>">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-2">
                <div class="form-group">
                    <input  autocomplete="off" type="text" id="endDate" name="endDate" readonly class="form-control customDatepicker" placeholder="<?php echo lang('end_date'); ?>" value="<?php echo set_value('endDate'); ?>">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-2">
                <div class="form-group">
                    <select  class="form-control select2 op_width_100_p" id="user_id" name="user_id">
                        <?php
                            $role = $this->session->userdata('role');
                            if($role == '1'){
                        ?>
                        <option value=""><?php echo lang('select_employee') ?></option>
                        <?php } ?>
                        <?php
                        foreach ($users as $value) {
                            ?>
                            <option value="<?php echo escape_output($value->id) ?>" <?php echo set_select('user_id', $value->id); ?>><?php echo escape_output($value->full_name) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php
                if(isLMni()):
            ?>
            <div class="col-sm-12 col-md-6 mb-2">
                <div class="form-group">
                    <select  class="form-control select2 ir_w_100" id="outlet_id" name="outlet_id">
                        <?php
                            $role = $this->session->userdata('role');
                            if($role == '1'){
                        ?>
                        <option value=""><?php echo lang('select_outlet') ?></option>
                        <?php } ?>
                        <?php
                        $outlets = getOutletsForReport();
                        foreach ($outlets as $value):
                            ?>
                            <option <?= set_select('outlet_id',$value->id)?>  value="<?php echo escape_output($value->id) ?>"><?php echo escape_output($value->outlet_name) ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <?php
                endif;
            ?>
            <div class="clear-fix"></div>

            <div class="col-12 mb-2">
                <button type="submit" name="submit" value="submit" class="new-btn">
                    <iconify-icon icon="solar:hourglass-broken" width="22"></iconify-icon>
                    <?php echo lang('submit'); ?>
                </button>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->view('updater/reuseJs_w_pagination'); ?>