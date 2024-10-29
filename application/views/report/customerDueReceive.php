<input type="hidden" value="<?php echo lang('The_date_field_is_required');?>" id="The_date_field_is_required">
<input type="hidden" value="<?php echo lang('The_customer_field_is_required');?>" id="The_customer_field_is_required">
<link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/report.css">
<div class="main-content-wrapper">

    <section class="content-header">
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header mt-2"><?php echo lang('customer_due_receive_report'); ?></h3>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('report'), 'secondSection'=> lang('customer_due_receive_report')])?>
        </div>
    </section>


    <div class="box-wrapper">
        <!-- Report Header Start -->
        <div class="report_header">
            <h3 class="company_name"><?php echo escape_output($this->session->userdata('business_name'));?> </h3>
            <h5 class="outlet_info">
                <strong><?php echo lang('customer_due_receive_report'); ?></strong>
           </h5>
            <?php if(isset($outlet_id) && $outlet_id){
                $outlet_info = getOutletInfoById($outlet_id); 
            }?>
            <h5 class="outlet_info">
                <?php if(isset($outlet_id) && $outlet_id){ ?>
                    <strong><?php echo lang('outlet'); ?>: </strong> <?php echo escape_output($outlet_info->outlet_name); ?>
                <?php }?>
           </h5>
            <h5 class="outlet_info">
                <?php if(isset($outlet_id) && $outlet_id){ ?>
                    <strong><?php echo lang('address'); ?>: </strong> <?php echo escape_output($outlet_info->address); ?>
                <?php } ?>
           </h5>
            <h5 class="outlet_info">
                <?php if(isset($outlet_id) && $outlet_id){ ?>
                    <strong><?php echo lang('email'); ?>: </strong> <?php echo escape_output($outlet_info->email); ?>
                <?php } ?>
           </h5>
            <h5 class="outlet_info">
                <?php if(isset($outlet_id) && $outlet_id){ ?>
                    <strong><?php echo lang('phone'); ?>: </strong> <?php echo escape_output($outlet_info->phone); ?>
                <?php } ?>
           </h5>
            <?php if((isset($start_date) && $start_date && $start_date != '1970-01-01') || (isset($end_date) && $end_date && $end_date != '1970-01-01')){ ?>
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
                <?php if(isset($customer_id) && $customer_id){ ?>
                    <strong><?php echo lang('customer'); ?>: </strong> <?php echo getName('tbl_customers', $customer_id); ?>
                <?php }else if(isset($customer_id) && $customer_id == ''){ ?>
                    <strong><?php echo lang('customer'); ?>: </strong> <?php echo lang('all'); ?>
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
                    <input type="hidden" class="datatable_name"  data-filter="yes" data-title="<?php echo lang('customer_due_receive_report'); ?>" data-id_name="datatable">
                    <table id="datatable"  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="w-5"><?php echo lang('sn'); ?></th>
                                <th class="w-15"><?php echo lang('reference_no'); ?></th>
                                <th class="w-15"><?php echo lang('date_and_time'); ?></th>
                                <th class="w-15"><?php echo lang('customer'); ?></th>
                                <th class="w-15 text-center"><?php echo lang('amount'); ?></th>
                                <th class="w-25"><?php echo lang('note'); ?></th>
                                <th class="w-10"><?php echo lang('received_by'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grandTotal = 0;
                            $countTotal = 0;
                            if (isset($customerDueReceive)):
                                foreach ($customerDueReceive as $key => $value) {
                                    $grandTotal+=$value->amount;
                                    $key++;
                                    ?>
                                    <tr>
                                        <td class="op_center"><?php echo $key; ?></td>
                                        <td><?php echo escape_output($value->reference_no); ?></td>
                                        <td><?php echo dateFormat($value->added_date) ?></td>
                                        <td><?php echo escape_output($value->customer_name); ?></td>
                                        <td class="text-center"><?php echo getAmtCustom($value->amount) ?></td>
                                        <td><?php echo escape_output($value->note) ?></td>
                                        <td><?php echo escape_output($value->user_name); ?></td>
                                    </tr>
                                    <?php
                                }
                            endif;
                            ?>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="op_right"><?php echo lang('total'); ?> </th>
                                <th class="text-center"><?php echo getAmtCustom($grandTotal) ?></th>
                                <th></th>
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
        <?php echo form_open(base_url() . 'Report/customerDueReceiveReport') ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-2">
                <div class="form-group">
                    <input  autocomplete="off" type="text" name="startDate" id="startDate" readonly class="form-control customDatepicker" placeholder="<?php echo lang('start_date'); ?>" value="<?php echo set_value('startDate'); ?>">
                </div>
                <div class="alert alert-error error-msg startDate_err_msg_contnr ">
                    <p id="startDate_err_msg"></p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-2">
                <div class="form-group">
                    <input  autocomplete="off" type="text" id="endDate" name="endDate" readonly class="form-control customDatepicker" placeholder="<?php echo lang('end_date'); ?>" value="<?php echo set_value('endDate'); ?>">
                </div>
                <div class="alert alert-error error-msg endDate_err_msg_contnr ">
                    <p id="endDate_err_msg"></p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-2">
                <div class="form-group">
                    <select  class="form-control select2 op_width_100_p" id="customer_id" name="customer_id">
                        <option value=""><?php echo lang('customer'); ?></option>
                        <?php
                        foreach ($customers as $value) {
                            ?>
                            <option <?php echo isset($customer_id) && $customer_id && $customer_id==$value->id?'selected':''?> value="<?php echo escape_output($value->id) ?>"><?php echo escape_output($value->name);?> <?php echo escape_output($value->phone) != '' ? '(' . $value->phone . ')' : '';  ?></option>
                        <?php } ?>
                    </select>
                    <div class="alert alert-error error-msg customer_id_err_msg_contnr ">
                        <p id="customer_id_err_msg"></p>
                    </div>
                </div>
            </div>
            <?php
                if(isLMni()):
            ?>
            <div class="col-sm-12 col-md-6 mb-2">
                <div class="form-group">
                    <select  class="form-control select2" id="outlet_id" name="outlet_id">
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
                            <option <?php echo set_select('outlet_id',$value->id)?>  value="<?php echo escape_output($value->id) ?>"><?php echo escape_output($value->outlet_name) ?></option>
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
                <button type="submit" name="submit" value="submit" class="new-btn customerDueReceiveReport">
                    <iconify-icon icon="solar:hourglass-broken" width="22"></iconify-icon>
                    <?php echo lang('submit'); ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<?php $this->view('updater/reuseJs_w_pagination'); ?>
<script src="<?php echo base_url();?>frequent_changing/js/report-js/master_report_validation.js"></script>