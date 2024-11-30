<input type="hidden" id="delivery_status_change" value="<?php echo lang('delivery_status_change'); ?>">
<input type="hidden" id="account_field_required" value="<?php echo lang('account_field_required'); ?>">

<input type="hidden" id="base_url_hidden" value="<?php echo base_url(); ?>">
<div class="main-content-wrapper">
    <div class="ajax-message"></div>
    <?php
    if ($this->session->flashdata('exception')) {
        echo '<section class="alert-wrapper"><div class="alert alert-success alert-dismissible fade show"> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"></button>
        <div class="alert-body"><i class="icon fa fa-check me-2"></i>';
        echo escape_output($this->session->flashdata('exception'));unset($_SESSION['exception']);
        echo '</div></div></section>';
    }
    ?> 


    <section class="content-header">
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header"><?php echo lang('list_ebilling'); ?> </h3>
                <input type="hidden" class="datatable_name" data-title="<?php echo lang('list_ebilling'); ?>" data-id_name="datatable">
                <div class="btn_list m-right d-flex">
                    <button type="button" class="dataFilterBy new-btn">
                        <iconify-icon icon="solar:filter-broken"  width="22"></iconify-icon> 
                        <?php echo lang('filter_by');?>
                    </button>
                </div>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('ebilling_menu'), 'secondSection'=> lang('list_ebilling')])?>
        </div>
    </section>




    <div class="box-wrapper">
        <div class="table-box"> 
            <!-- /.box-header -->
            <div class="table-responsive"> 
                <table id="datatable" class="table table-bordered table-striped sales_ajax_page">
                    <thead>
                        <tr>
                            <th class="w-5"><?php echo lang('actions'); ?></th>
                            <th class="w-5" data-orderable="false"><?php echo lang('fe_detail'); ?></th>  
                            <th class="w-15"><?php echo lang('ref_no'); ?></th>                          
                            <th class="w-25"><?php echo lang('fe_customer'); ?></th>
                            <th class="w-10"><?php echo lang('fe_total'); ?></th>
                            <th class="w-5"><?php echo lang('fe_fecha_emision'); ?></th>
                            <th class="w-10"><?php echo lang('fe_document_type'); ?></th>
                            <th class="w-5"><?php echo lang('fe_status'); ?></th>                       
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="filter-overlay"></div>
<div id="product-filter" class="filter-modal">
    <div class="filter-modal-body">
        <header>
            <h3 class="filter-modal-title"><span><?php echo lang('fe_FilterOptions'); ?></span></h3>
            <button type="button" class="close-filter-modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <i data-feather="x"></i>
                </span>
            </button>
        </header>
        <?php echo form_open(base_url() . 'EBilling/ebillings') ?>
        <div class="row">
            <div class="col-sm-12 mb-2">
                <div class="form-group">
                    <select name="delivery_status" id="delivery_status_filter" class="form-control  select2 width_100_p" >
                        <option value=""><?php echo lang('select'); ?></option>
                        <option value="Pending" <?php echo set_select('delivery_status', 'Pending'); ?>><?php echo lang('fe_pending'); ?></option>
                        <option value="Sent" <?php echo set_select('delivery_status', 'Sent'); ?>><?php echo lang('fe_sent'); ?></option>
                        <option value="Accepted" <?php echo set_select('delivery_status', 'Accepted'); ?>><?php echo lang('fe_accepted'); ?></option>
                        <option value="Rejected" <?php echo set_select('delivery_status', 'Rejected'); ?>><?php echo lang('fe_rejected'); ?></option>
                    </select>
                </div>
            </div>
            <!--<div class="clear-fix"></div>-->
            <div class="col-sm-12 col-md-6">
                <button type="submit" name="submit" value="submit" class="new-btn">
                    <iconify-icon icon="solar:hourglass-broken" width="22"></iconify-icon>
                    <?php echo lang('submit_filter'); ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade" id="view_fe_detail_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('fe_detail_title');?></h4>
                <button type="button" class="btn-close m_close_trigger" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"><i data-feather="x"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="hold_sale_right fix">
                    <div class="top">
                        <div class="top_middle">
                            <h1><?php echo lang('order_details'); ?></h1>
                            <div class="waiter_customer_table fix">
                                <div class="fix op_sale_details_info">
                                    <span class="op_font_weight_b"><?php echo lang('invoice_no'); ?>: </span>
                                    <span id="last_10_order_invoice_no"></span>
                                </div>
                                <div class="fix op_sale_details_info">
                                    <span class="op_font_weight_b"><?php echo lang('date_time'); ?>: </span>
                                    <span id="last_10_order_date_time"></span>
                                </div>
                            </div>
                            <div class="waiter_customer_table fix">
                                <div class="fix op_sale_details_info">
                                    <span class="op_font_weight_b"><?php echo lang('customer'); ?>: </span>
                                    <span id="last_10_order_invoice_no"></span>
                                </div>
                                <div class="fix op_sale_details_info">
                                    <span class="op_font_weight_b"><?php echo lang('fe_customer_email'); ?>: </span>
                                    <span id="last_10_order_date_time"></span>
                                </div>
                            </div>
                            <div class="item_modifier_details item_modifier_body">
                                <div class="modifier_item_header">
                                    <div class="first_column_header column_hold"><?php echo lang('item'); ?></div>
                                    <div class="second_column_header column_hold text-center"><?php echo lang('price'); ?></div>
                                    <div class="third_column_header column_hold text-center"><?php echo lang('qty'); ?></div>
                                    <div class="forth_column_header column_hold text-center"><?php echo lang('discount'); ?></div>
                                    <div class="fifth_column_header column_hold text-right"><?php echo lang('total'); ?></div>
                                </div>
                                <div class="modifier_item_details_holder hold_sale_height">
                                </div>
                            </div>
                            <div class="item_modifier_details">
                                <div class="bottom_total_calculation_hold footer-content-hold">
                                    <div class="item">
                                        <span><?php echo lang('sub_total')?>: </span>
                                        <span id="sub_total_show_hold"><?php echo getAmtPre(0)?></span>
                                    </div>
                                    <div class="item">
                                        <span><?php echo lang('total_item')?>: </span>
                                        <span id="total_items_in_cart_hold">0</span> (<span id="total_items_qty_in_cart_hold">0</span>)
                                        <span id="sub_total_hold" class="ir_display_none"><?php echo getAmtPre(0)?></span>
                                        <span id="total_item_discount_hold" class="ir_display_none"><?php echo getAmtPre(0)?></span>
                                        <span id="discounted_sub_total_amount_hold" class="ir_display_none"><?php echo getAmtPre(0)?></span>
                                    </div>
                                    <div class="item">
                                        <span><?php echo lang('tax')?>: </span>
                                        <span id="hold_all_tax_amount"></span>
                                    </div>
                                    <div class="item">
                                        <span><?php echo lang('charge')?>: </span>
                                        <span id="delivery_charge_hold"> <?php echo getAmtPre(0)?></span>
                                    </div>
                                    <div class="item">
                                        <span><?php echo lang('discount')?>: </span>
                                        <span>
                                            <span id="sub_total_discount_hold"><?php echo getAmtPre(0) ?? 0?></span> (<span id="all_items_discount_hold"><?php echo getAmtPre(0)?></span>)
                                        </span>
                                    </div>
                                </div>
                                <div class="bottom_total_calculation_hold_fe footer-content-hold">
                                    <div class="item">
                                        <span><?php echo lang('fe_clave')?>: </span>
                                        <span id="fe_clave">50622222222222222222222222222222222222222224547855</span>
                                    </div>
                                </div>
                                <div class="bottom_total_calculation_hold_fe footer-content-hold">
                                    <div class="item">
                                        <span><?php echo lang('fe_consecutive')?>: </span>
                                        <span id="fe_consecutive">22222222222222222223</span>
                                    </div>
                                </div>
                                <h1 class="modal_payable">
                                    <span><?php echo lang('total_payable')?>: </span>
                                    <span id="total_payable_hold"><?php echo getAmtPre(0)?></span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="new-btn" data-bs-dismiss="modal">
                    <iconify-icon icon="solar:close-circle-bold-duotone" width="22"></iconify-icon>
                    <?php echo lang('close'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- DataTables -->
<?php $this->load->view('updater/reuseJs2')?>
<script src="<?php echo base_url(); ?>frequent_changing/js/ebilling.js"></script>
