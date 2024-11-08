<input type="hidden" id="The_Employee_field_is_required" value="<?php echo lang('The_Employee_field_is_required');?>">
<input type="hidden" value="<?php echo lang('The_date_field_is_required');?>" id="The_date_field_is_required">
<link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/report.css">

<div class="main-content-wrapper">
    
    <section class="content-header">
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header mt-2"><?php echo lang('servicing_report'); ?></h3>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('report'), 'secondSection'=> lang('servicing_report')])?>
        </div>
    </section>

    <div class="box-wrapper">
        <!-- Report Header Start -->
        <div class="report_header">
            <h3 class="company_name"><?php echo escape_output($this->session->userdata('business_name'));?> </h3>
            <h5 class="outlet_info">
                <strong><?php echo lang('servicing_report'); ?></strong>
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
                <?php if(isset($report_generate_time) && $report_generate_time){
                    echo $report_generate_time;
                } ?>
            </h5>
        </div>
        <!-- Report Header End -->

        <div class="table-box">
            <div class="box-body">
                <div class="table-responsive">
                <input type="hidden" class="datatable_name"  data-filter="yes" data-title="<?php echo lang('income_report'); ?>" data-id_name="datatable">
                    <table id="datatable"  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="w-5"><?php echo lang('sn'); ?></th>
                                <th class="w-10"><?php echo lang('date_and_time'); ?></th>
                                <th class="w-10"><?php echo lang('customer_name'); ?></th>
                                <th class="w-10"><?php echo lang('product_name'); ?></th>
                                <th class="w-10 text-center"><?php echo lang('servicing_charge'); ?></th>
                                <th class="w-10 text-center"><?php echo lang('paid_amount'); ?></th>
                                <th class="w-10 text-center"><?php echo lang('due_amount'); ?></th>
                                <th class="w-10 text-center"><?php echo lang('receiving_date'); ?></th>
                                <th class="w-10 text-center"><?php echo lang('delivery_date'); ?></th>
                                <th class="op_width_10_p text-right"><?php echo lang('status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($servicingReport)):
                                foreach ($servicingReport as $key => $value) {
                                    $key++;
                                    ?>
                                    <tr> 
                                        <td class="op_center"><?php echo $key; ?></td>
                                        <td><?php echo dateFormat($value->added_date); ?></td>
                                        <td><?php echo escape_output($value->customer_name); ?></td>
                                        <td><?php echo escape_output($value->product_name); ?></td>
                                        <td class="text-center"><?php echo escape_output($value->servicing_charge); ?></td>
                                        <td class="text-center"><?php echo escape_output($value->paid_amount); ?></td>
                                        <td class="text-center"><?php echo escape_output($value->due_amount); ?></td>
                                        <td class="text-center"><?php echo dateFormat($value->receiving_date); ?></td>
                                        <td class="text-center"><?php echo dateFormat($value->delivery_date); ?></td>
                                        <td>
                                            <?php if($value->status == 'Received'){?>
                                                <span class="pending-status"><?php echo escape_output($value->status) ?></span>
                                            <?php } else if($value->status == 'Delivered'){ ?>
                                                <span class="success-status"><?php echo escape_output($value->status) ?></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            endif;
                            ?>
                            
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
        <?php echo form_open(base_url() . 'Report/servicingReport') ?>
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
                    <select  class="form-control select2" id="employee_id" name="employee_id">
                        <option value=""><?php echo lang('select_employee'); ?></option>
                        <?php
                        foreach ($employees as $value) {
                            ?>
                            <option value="<?php echo escape_output($value->id) ?>" <?php echo set_select('employee_id', $value->id); ?>><?php echo escape_output($value->full_name) ?></option>
                        <?php } ?>
                    </select>
                    <div class="alert alert-error error-msg employee_id_err_msg_contnr ">
                        <p id="employee_id_err_msg"></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-2">
                <div class="form-group">
                    <select  class="form-control select2" id="status" name="status">
                        <option value=""><?php echo lang('status'); ?></option>
                        <option value="Received" <?php echo set_select('status', 'Received'); ?>><?php echo lang('received');?></option>
                        <option value="Delivered" <?php echo set_select('status', 'Delivered'); ?>><?php echo lang('delivered');?></option>
                    </select>
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
                        <option value=""><?php echo lang('outlet') ?></option>
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
                <button type="submit" name="submit" value="submit" class="new-btn servicingReport">
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

