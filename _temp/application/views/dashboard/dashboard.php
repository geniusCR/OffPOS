<?php
    $is_arabic = isArabic();
?>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/jquery.spincrement.js"></script>
<script src="<?php echo base_url(); ?>assets/POS/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/local/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/local/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/local/daterangepicker.css">
<input type="hidden" id="outlet_id_dashboard" value="<?php echo escape_output($this->session->userdata('outlet_id'));?>">
<script src="<?php echo base_url(); ?>assets/bower_components/graph/chart.min.js"></script>
  <div class="main-content-wrapper">
    <form method="POST" action="<?php echo base_url()?>Dashboard/dashboard">
    <div class="row">
      <div class="col-xl-12">
        <section dir="<?php echo escape_output($is_arabic) =='Yes' ? 'rtl' : 'ltr'?>" class="content-header mb-2 dashboardDateRangeWrap">
          <h3 class="d-flex align-items-center top-left-header <?php echo $is_arabic == 'Yes' ? 'ps-2' : 'pe-2' ?>">
            <span><?php echo lang('dashboard'); ?></span>
            <span class="business_int <?php echo $is_arabic == 'Yes' ? 'pe-2' : '' ?>"><?php echo lang('Business_Intelligence');?></span>
          </h3>
          <div class="dashboardDateRange">
            <input  autocomplete="off" type="text" id="start_date" name="startDate" readonly class="form-control customDatepicker <?php echo $is_arabic == 'Yes' ? 'ms-2' : 'me-2' ?>" placeholder="<?php echo lang('start_date'); ?>" value="<?php echo isset($_POST['startDate']) && $_POST['startDate'] ? $_POST['startDate'] : date("Y-m-d", strtotime("-1 month")) ?>">
            <input  autocomplete="off" type="text" id="end_date" name="endDate" readonly class="form-control customDatepicker <?php echo $is_arabic == 'Yes' ? 'ms-2' : 'me-2' ?>" placeholder="<?php echo lang('end_date'); ?>" value="<?php echo isset($_POST['endDate']) && $_POST['endDate'] ? $_POST['endDate'] : date('Y-m-d') ?>">
            <button type="submit" class="btn new-btn h-40" id="dashboard_search">
              <iconify-icon icon="heroicons-solid:search" width="18"></iconify-icon> <?php echo lang('search'); ?></button>
          </div>
        </section>
      </div>
    </div>
    </form>


    <section class="content">
      <div class="intelligence_card_wrap">
        <div class="intelligence_card">
          <a class="text-dec-none" href="javascript:void(0)">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('today');?></p>
                      <h3>
                        <?php
                          $date = date('Y-m-d');
                          $formatted_date = date('d, F', strtotime($date));
                          echo $formatted_date;
                        ?>
                      </h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:calendar-date-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
        <div class="intelligence_card">
          <a class="text-dec-none" href="javascript:void(0)">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('revenue');?></p>
                      <h3 class="card-el first-el set_today_total_1"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:dollar-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
        <div class="intelligence_card">
          <a class="text-dec-none" href="javascript:void(0)">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('net_profit');?></p>
                      <h3 class="card-el first-el set_today_total_2"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:dollar-minimalistic-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
        <div class="intelligence_card">
          <a class="text-dec-none" href="javascript:void(0)">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('transaction');?></p>
                      <h3 class="card-el first-el set_today_total_3"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:transfer-vertical-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
        <div class="intelligence_card">
          <a class="text-dec-none" href="javascript:void(0)">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('customers');?></p>
                      <h3 class="card-el first-el set_today_total_4"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:users-group-rounded-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
        <div class="intelligence_card">
          <a class="text-dec-none" href="javascript:void(0)">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('average_receipt');?></p>
                      <h3 class="card-el first-el set_today_total_5"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:soundwave-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
      </div>
    </section>
    



    <div class="row intelligence_bar">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="box box-info">
          <div class="p-3">
            <table>
              <tr>
                <td>
                  <h3 class="sale_report_header dashboard_w_3 revenue_phone"><?php echo lang('Revenue')?></h3>
                </td>
                <td>
                  <table>
                    <tr>
                      <td data-type="day" class="get_date_by_custom_btn custom_td custom_td_active"><?php echo lang('day')?></td>
                      <td data-type="week" class="get_date_by_custom_btn custom_td"><?php echo lang('week')?></td>
                      <td data-type="month" class="get_date_by_custom_btn custom_td"><?php echo lang('month')?></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
          <div>
            <canvas height="220" id="day_week_month_chart_report"></canvas>
          </div>
        </div>
      </div>
      <div class="intelligence_card_wrap2">
        <div class="intelligence_card2">
          <a class="text-dec-none get_graph_data active" href="javascript:void(0)" data-action_type="revenue" data-text="<?php echo lang('Revenue')?>">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('revenue');?></p>
                      <h3 class="card-el first-el spincrement set_total_1"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:dollar-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
        <div class="intelligence_card2">
          <a class="text-dec-none get_graph_data" href="javascript:void(0)" data-action_type="profit" data-text="<?php echo lang('net_profit')?>">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('net_profit');?></p>
                      <h3 class="card-el first-el spincrement set_total_2"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:dollar-minimalistic-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
        <div class="intelligence_card2">
          <a class="text-dec-none get_graph_data" href="javascript:void(0)" data-action_type="transactions" data-text="<?php echo lang('Transactions')?>">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('transaction');?></p>
                      <h3 class="card-el first-el spincrement set_total_3"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:transfer-vertical-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
        <div class="intelligence_card2">
          <a class="text-dec-none get_graph_data" href="javascript:void(0)" data-action_type="customers" data-text="<?php echo lang('customers')?>">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('customers');?></p>
                      <h3 class="card-el first-el spincrement set_total_4"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:users-group-rounded-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
        <div class="intelligence_card2">
          <a class="text-dec-none get_graph_data" href="javascript:void(0)" data-action_type="average_receipt" data-text="<?php echo lang('avarage_receipt')?>">
              <div class="small-box box4column">
                  <div class="inner b-l-primary">
                      <p><?php echo lang('average_receipt');?></p>
                      <h3 class="card-el first-el spincrement set_total_5"><?php echo getAmtPre(0) ?></h3>
                  </div>
                  <div class="icon">
                    <iconify-icon icon="solar:soundwave-broken"></iconify-icon>
                  </div>
              </div>
          </a>
        </div>
      </div>
    </div>

    
    <section class="content operational_comparision">
      <div class="row">
        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header">
              <iconify-icon icon="solar:chart-broken" width="22" class="me-2"></iconify-icon>
              <h3 class="box-title"><?php echo lang('operational_comparision'); ?> (<?php echo lang('this_month'); ?>)</h3>
            </div>
            <div class="box-body op_height_280">
                <div class="chart">
                  <div class="chart op_height_250" id="operational_comparision"></div>
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="box box-info">
              <div class="box-header">
                  <iconify-icon icon="solar:danger-broken" width="22" class="me-2"></iconify-icon>
                  <h3 class="box-title"><?php echo lang('items_alert'); ?>/<?php echo lang('low_stock'); ?></h3>
              </div>
              <div class="box-body op_height_280 dashboard-alert-stock">
                  <div class="d-flex justify-content-between align-items-cneter outer-header-wrap">
                    <span class="w-25"><?php echo lang('item'); ?>(<?php echo lang('code'); ?>)</span>
                    <span class="w-50"><?php echo lang('stock_segmentation'); ?></span>
                    <span class="w-25"><?php echo lang('current_stock'); ?></span>
                  </div>
                  <ul class="low-stock-wrapper">
                    <?php 
                    if(isset($low_stock_items) && $low_stock_items){
                        $alertQtySum = 0;
                        $purchasePriceTotal = 0;
                        foreach($low_stock_items as $key=>$item){
                            $generalStock = 0;
                            $purchasePriceSum = 0;
                            $purchaseUnitSum = 0;
                            $saleUnitSum = 0;
                            $itemStockAlertCls = '';
                            if($item->type != 'Variation_Product'){
                                if(((int)$item->stock_qty - (int)$item->out_qty) < $item->alert_quantity){
                                    $itemStockAlertCls = '';
                                    $alertQtySum ++;
                                }
                            }
                            if($item->type == 'General_Product' || $item->type == 'Installment_Product'){
                                $generalStock = ((int)$item->stock_qty - (int)$item->out_qty);
                                $genConvertedPrice = (float)$item->last_three_purchase_avg / (int)$item->conversion_rate;
                                $purchasePriceSum = ($genConvertedPrice) * $generalStock;
                                if($item->unit_type == '1'){
                                    $saleUnitSum = (int)$generalStock;
                                } else if($item->unit_type == '2'){
                                    $purchaseUnitSum = (int)((int)$generalStock / $item->conversion_rate);
                                    $saleUnitSum = ((int)$generalStock) % $item->conversion_rate;
                                }
                            }
                    ?>
                    <li class="d-flex justify-content-between align-items-cneter mb-2 low-single-items"> 
                        <p class="w-25"><?php echo escape_output($item->name) . '(' . escapeQuot($item->code) . ')'  ?></p>
                        <div class="w-50">
                            <?php if($item->type == 'Variation_Product'){ ?>
                                <div class="lowStockInnerTable">
                                    <ul>
                                        <li>
                                            <div><?php echo lang('item'); ?>(<?php echo lang('code'); ?>)</div>
                                            <div><?php echo lang('quantity'); ?></div>
                                        </li>
                                        <?php
                                        if($item->variations){
                                            $variations = explode("||", $item->variations);
                                            foreach($variations as $m=>$variation){
                                                $variation_d = explode("|", $variations[$m]);
                                                $variationStock = ((int)$variation_d[4] - (int)$variation_d[5]); /* $variation_d[4]Stock In - $variation_d[5]Stock Out = Current Stock  */
                                                $generalStock += $variationStock;
                                                $variationAlert = (int)($variation_d[2]); /* $variation_d[2] = Aleart Quantity */
                                                $variationConvertedPrice = ($variation_d[3] / $item->conversion_rate); /* $variation_d[3] = Last 3 Purchase AVG */
                                                $purchasePriceSum +=  $variationConvertedPrice * $variationStock; /* Unit Price * Stock = Stock Amount */
                                                $vItemStockAlertCls = '';
                                                if($variationStock < $variationAlert){
                                                    $vItemStockAlertCls = ''; /* Alert Class */
                                                    $alertQtySum ++;
                                            
                                                    $vQtyWithUnit = '';
                                                    if($item->unit_type == '1'){
                                                        $saleUnitSum += $variationStock;
                                                        $vQtyWithUnit = escape_output(getAmtPCustom($variationStock)) . ' ' . $item->sale_unit;
                                                    } else if($item->unit_type == '2'){
                                                        $purchaseUnitSum += ((int)$variationStock / $item->conversion_rate);
                                                        $saleUnitSum += (((int)$variationStock) % $item->conversion_rate);
                                                        $vPurchaseUnit = getAmtPCustom((int)$variationStock / $item->conversion_rate) . ' ' . $item->purchase_unit;
                                                        $vSaleUnit = getAmtPCustom(((int)$variationStock) % $item->conversion_rate) . ' ' . $item->sale_unit;
                                                        $vQtyWithUnit =  $vPurchaseUnit . ' ' . $vSaleUnit;
                                                    }
                                        ?>
                                        <li>
                                            <div class="<?php echo $vItemStockAlertCls; ?>"><?php echo $variation_d[0] . '('. $variation_d[1] .')'; ?></div>
                                            <div class="<?php echo $vItemStockAlertCls; ?>">
                                                <?php 
                                                if($item->unit_type == '1'){
                                                    echo $vQtyWithUnit;
                                                } else if($item->unit_type == '2'){
                                                    echo $vQtyWithUnit . ' (' . getAmtPCustom($variationStock) . ' ' . $item->sale_unit . ')';
                                                }
                                                ?>
                                            </div>
                                        </li>
                                        <?php }} }?>
                                    </ul>
                                </div>
                            <?php } else if($item->type == 'IMEI_Product' || $item->type == 'Serial_Product') {
                                $expStock = ((int)$item->stock_qty - (int)$item->out_qty);
                                $expConvertedPrice = (float)$item->last_three_purchase_avg / (int)$item->conversion_rate;
                                $purchasePriceSum = ($expConvertedPrice) * $expStock;
                                $purchaseUnitSum = (int)$expStock;
                                $saleUnitSum = (int)$expStock;
                                if($item->allimei){
                                    $imaiSerial = explode("||", $item->allimei);
                                    foreach($imaiSerial as $k=>$v){
                                        echo '-' . $v . "<br>";
                                    }
                                }
                            } else if($item->type == 'Medicine_Product'){ 
                              if ((int)$item->conversion_rate != 0 && $item->last_three_purchase_avg != 0) {
                                  $purchasePriceSum = (float)$item->last_three_purchase_avg / (int)$item->conversion_rate * (int)$item->stock_qty - (int)$item->out_qty;
                              } else {
                                  $purchasePriceSum = 0; 
                              }
                                
                            ?>
                            <div class="lowStockInnerTable">
                                <ul>
                                    <li>
                                        <div><?php echo lang('expiry_date'); ?></div>
                                        <div><?php echo lang('quantity'); ?></div>
                                    </li>
                                    <?php 
                                    if(isset($item->allexpiry) && $item->allexpiry){
                                        $allexpiry = explode("||", $item->allexpiry);
                                        foreach($allexpiry as $ek=>$expiry){
                                            $expiry_d = explode("|", $expiry);
                                            $expSaleQtySum = ((int)$expiry_d[1] / $item->conversion_rate ) * $item->conversion_rate;
                                            if((int)$expiry_d[1] < $item->alert_quantity){
                                                $generalStock += $expSaleQtySum;
                                                $expQtyWithUnit = '';
                                                if($item->unit_type == '1'){
                                                    $saleUnitSum += (int)$expiry_d[1]; /* $expiry_d[1] = Expiry Quantity  */
                                                    $expQtyWithUnit = escape_output(getAmtPCustom((int)$expiry_d[1])) . ' ' . $item->sale_unit;
                                                } else if($item->unit_type == '2'){
                                                    $purchaseUnitSum += ((int)$expiry_d[1] / $item->conversion_rate);
                                                    $saleUnitSum += ((int)$expiry_d[1] % $item->conversion_rate);
                                                    $expPurchaseUnit = getAmtPCustom((int)$expiry_d[1] / $item->conversion_rate) . ' ' . $item->purchase_unit;
                                                    $expSaleUnit = getAmtPCustom(((int)$expiry_d[1] % $item->conversion_rate)) . ' ' . $item->sale_unit;
                                                    $expQtyWithUnit =  $expPurchaseUnit . ' ' . $expSaleUnit;
                                                }
                                    ?>
                                    <li>
                                        <div><?php echo dateFormat($expiry_d[0]);?></div>
                                        <div>
                                            <?php 
                                            if($item->unit_type == 1){
                                                echo $expQtyWithUnit;
                                            }else if($item->unit_type == 2){
                                                echo $expQtyWithUnit . ' (' . getAmtPCustom($expSaleQtySum) . $item->sale_unit . ')';
                                            }
                                            ?>
                                        </div>
                                    </li>
                                    <?php   } } }?>
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                        <p class="w-25 ps-2">
                          <?php
                          if($item->unit_type == '1'){
                            echo getAmtPCustom($saleUnitSum) . ' ' . $item->sale_unit;
                          } else if($item->unit_type == '2'){
                            echo getAmtPCustom($purchaseUnitSum) . ' ' . $item->purchase_unit . ' ' . getAmtPCustom($saleUnitSum) . ' ' . $item->sale_unit . ' ';
                            echo '(' . getAmtPCustom($generalStock) . $item->sale_unit . ')';
                          }
                          ?>
                        </p>
                    </li>
                    <?php } }?>
                  </ul>
              </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="box box-info">
          <div class="box-header">
            <iconify-icon icon="solar:cart-large-broken" width="22" class="me-2"></iconify-icon>
            <h3 class="box-title"><?php echo lang('top_ten_food_this_month'); ?></h3>
          </div>
          <div class="box-body op_height_280">
            <ul class="todo-list">
              <li class="todo-title">
                <div class="op_float_left op_padding_left_5 op_font_weight_b">
                    <span><?php echo lang('sn'); ?></span>
                </div>
                <span class="text op_font_weight_b"><?php echo lang('food_name'); ?></span>
                <div class="op_float_right op_padding_right_5 op_font_weight_b">
                  <span><?php echo lang('count'); ?></span>
                </div>
              </li>
            </ul>
            <ul class="todo-list op_overflow_h top_ten_food_menu">
            <?php
                if ($top_ten_food_menu && !empty($top_ten_food_menu)) {
                foreach ($top_ten_food_menu as $key => $value) {
                  $key++;
                    ?>
                    <li>
                      <div class="op_float_left op_padding_left_5">
                        <span><?= $key ?></span>
                      </div>
                      <?php if($value->type != 0){ ?>
                        <span class="text"><?php echo escape_output($value->menu_name); ?></span>
                        <?php }else{ ?>
                        <span class="text"><?php echo escape_output($value->parent_name . '-(' . $value->menu_name .')'); ?></span>
                        <?php } ?>
                      <div class="op_float_right op_padding_right_5 op_color_green">
                        <span><?= number_format($value->totalQty,2) ?></span>
                      </div>
                    </li>
              <?php } } ?>
              </ul>
          </div>
        </div>
        </div>

        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header">
              <iconify-icon icon="solar:users-group-rounded-line-duotone" width="22" class="me-2"></iconify-icon>
                <h3 class="box-title"><?php echo lang('top_ten_customers'); ?></h3>
            </div>
            <div class="box-body op_height_280">
              <ul class="todo-list">
                <li class="todo-title">
                  <div class="op_float_left op_padding_left_5 op_font_weight_b">
                      <span><?php echo lang('sn'); ?></span>
                  </div>
                  <span class="text op_font_weight_b"><?php echo lang('customer_name'); ?></span>
                  <div class="op_float_right op_padding_right_5 op_font_weight_b">
                    <span><?php echo lang('sale_amount'); ?></span>
                  </div>
                </li>
              </ul>
              <ul class="todo-list" id="top_ten_customer">
              <?php
                  if ($top_ten_customer && !empty($top_ten_customer)) {
                  foreach ($top_ten_customer as $key => $value) {
                    $key++;
                      ?>
                      <li>
                        <div class="op_float_left op_padding_left_5">
                          <span><?= $key ?></span>
                        </div>
                        <span class="text"><?php echo escape_output($value->name); ?> <?php echo escape_output($value->customer_phone != '' ? '(' . $value->customer_phone . ')' : ''); ?></span>
                        <div class="op_float_right op_padding_right_5 op_color_green">
                          <span><?php echo getAmtCustom($value->total_payable); ?></span>
                        </div>
                      </li>
                <?php } } ?>
                </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header">
              <iconify-icon icon="solar:card-recive-broken" width="22" class="me-2"></iconify-icon>
              <h3 class="box-title"><?php echo lang('customer_receiveable'); ?></h3>
            </div>
            <div class="box-body">
                <ul class="todo-list">
                <li class="todo-title">
                  <div class="op_float_left op_padding_left_5 op_font_weight_b">
                      <span><?php echo lang('sn'); ?></span>
                  </div>
                  <span class="text op_font_weight_b"><?php echo lang('customer_name'); ?></span>
                  <div class="op_float_right op_padding_right_5 op_font_weight_b">
                    <span><?php echo lang('due_amount'); ?></span>
                  </div>
                </li>
              </ul>
              <ul class="todo-list op_overflow_h" id="customer_receivable">
              <?php
                  if ($customer_receivable && !empty($customer_receivable)) {
                  foreach ($customer_receivable as $key => $value) {
                      $due_amount_ = getCustomerDue($value->id);
                    $key++;
                    if($due_amount_ != '0.00' && $due_amount_ != ''){
                      ?>
                      <li>
                        <div class="op_float_left op_padding_left_5">
                          <span><?= $key ?></span>
                        </div>
                        <span class="text"><?php echo escape_output($value->name); ?> <?php echo ($value->phone) ? " ( $value->phone ) " : "";?></span>
                        <div class="op_float_right op_padding_right_5 op_color_green">
                          <span><?php echo getAmtCustom($due_amount_) ?></span>
                        </div>
                      </li>
                <?php } }  } ?>
                </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header">
              <iconify-icon icon="solar:card-send-broken" width="22" class="me-2"></iconify-icon>
              <h3 class="box-title"><?php echo lang('supplier_payable'); ?></h3>
            </div>
            <div class="box-body">
              <ul class="todo-list">
                <li class="todo-title">
                  <div class="op_float_left op_padding_left_5 op_font_weight_b">
                      <span><?php echo lang('sn'); ?></span>
                  </div>
                  <span class="text op_font_weight_b"><?php echo lang('supplier_name'); ?></span>
                  <div class="op_float_right op_padding_right_5 op_font_weight_b">
                    <span><?php echo lang('due_amount'); ?></span>
                  </div>
                </li>
              </ul>
              <ul class="todo-list op_overflow_h" id="supplier_payable">
              <?php
                  if ($supplier_payable && !empty($supplier_payable)) {
                  foreach ($supplier_payable as $key => $value) {
                    $key++;
                    $current_due = $value->opening_balance;
                      ?>
                      <li>
                        <div class="op_float_left op_padding_left_5">
                          <span><?= $key ?></span>
                        </div>
                        <span class="text"><?php echo escape_output($value->name); ?></span>
                        <div class="op_float_right op_padding_right_5 op_color_green">
                          <span><?php echo escape_output(getAmtCustom($current_due)) ?></span>
                        </div>
                      </li>
                <?php }  } ?>
                </ul>
            </div>
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="col-lg-12">
          <div class="box box-info">
          <div class="box-header">
            <iconify-icon icon="solar:pie-chart-2-broken" width="22" class="me-2"></iconify-icon>
            <h3 class="box-title"><?php echo lang('monthly_sales_comparision'); ?></h3>
          </div>
          <div class="box-body">
              <div class="chart">
                <div id="chart_div" class="op_width_100_p op_height_280"></div>
              </div>
          </div>
        </div>
        </div>
      </div>
    </section>
    <input type="hidden" id="purchase_" value="<?php echo escape_output(($purchase_sum->purchase_sum)); ?>">
    <input type="hidden" id="sale_" value="<?php echo escape_output(($sale_sum->sale_sum)); ?>">
    <input type="hidden" id="waste_" value="<?php echo escape_output(($waste_sum->waste_sum)); ?>">
    <input type="hidden" id="expense_" value="<?php echo escape_output(($expense_sum->expense_sum)); ?>">
    <input type="hidden" id="cust_rcv_" value="<?php echo escape_output(($customer_due_receive_sum->customer_due_receive_sum)); ?>">
    <input type="hidden" id="supp_pay_" value="<?php echo escape_output($supplier_due_payment_sum->supplier_due_payment_sum); ?>">
    <?php if (escape_output($this->session->userdata('i_sale')) != 'No') { ?>
    <input type="hidden" id="down_payment_" value="<?php echo escape_output((isset($down_payment) && $down_payment?$down_payment:0)); ?>">
    <input type="hidden" id="installment_paid_amount_" value="<?php echo escape_output((isset($paid_amount) && $paid_amount?$paid_amount:0)); ?>">
    <?php }?>

    <?php if (escape_output($this->session->userdata('i_sale')) == 'No') { ?>
      <input type="hidden" id="service_sale_total_no" value="<?php echo isset($service_sale_total->sale_sum) && $service_sale_total->sale_sum?$service_sale_total->sale_sum:'0';?>">
      <input type="hidden" id="product_sale_total_no" value="<?php echo isset($product_sale_total) && $product_sale_total?$product_sale_total:'0'; ?>">
    <?php }else{?>
      <input type="hidden" id="service_sale_total_" value="<?php echo isset($service_sale_total->sale_sum) && $service_sale_total->sale_sum?$service_sale_total->sale_sum:'0'; ?>">
      <input type="hidden" id="product_sale_total_" value="<?php echo ($product_sale_total + $down_payment + $paid_amount)?($product_sale_total + $down_payment + $paid_amount):'0'; ?>">

    <?php } ?>
  </div>
  

<script src="<?php echo base_url(); ?>frequent_changing/js/dashboard_chart_custom.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/plugins/local/loader.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
<script src="<?php echo base_url(); ?>frequent_changing/js/dashboard.js"></script>
<script src="<?php echo base_url(); ?>assets/POS/js/jquery.cookie.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/chart.js/Chart.js"></script>
