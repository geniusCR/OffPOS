<input type="hidden" id="select" value="<?php echo lang('select');?>">
<input type="hidden" id="The_Variation_Attribute_field_required" value="<?php echo lang('The_Variation_Attribute_field_required');?>">
<input type="hidden" id="name_field_required" value="<?php echo lang('name_field_required');?>">
<input type="hidden" id="The_Contact_field_required" value="<?php echo lang('The_Contact_field_required');?>">
<input type="hidden" id="The_Phone_field_is_required" value="<?php echo lang('The_Phone_field_is_required');?>">
<input type="hidden" id="Expiry_Quantitty_Field_required" value="<?php echo lang('Expiry_Quantitty_Field_required');?>">
<input type="hidden" id="The_Unit_Name_field_is_required" value="<?php echo lang('The_Unit_Name_field_is_required');?>">
<input type="hidden" id="ok" value="<?php echo lang('ok');?>">
<input type="hidden" id="alert_" value="<?php echo lang('alert_');?>">
<input type="hidden" id="img_select_error_msg" value="<?php echo lang('img_select_error_msg');?>">
<input type="hidden" class="add_row_text" value="<?php echo lang('add_new'); ?>">
<input type="hidden" class="Used_for_variations" value="<?php echo lang('Used_for_variations'); ?>">
<input type="hidden" class="Visible_on_the_product_page" value="<?php echo lang('Visible_on_the_product_page'); ?>">
<input type="hidden" class="actions" value="<?php echo lang('actions'); ?>">
<input type="hidden" class="opening_stock" value="<?php echo lang('opening_stock'); ?>">
<input type="hidden" class="code_" value="<?php echo lang('code'); ?>">
<input type="hidden" class="alert_quantity" value="<?php echo lang('alert_quantity'); ?>">
<input type="hidden" class="Default_Sale_Price" value="<?php echo lang('Default_Sale_Price'); ?>">
<input type="hidden" class="Default_Purchase_Price" value="<?php echo lang('Default_Purchase_Price'); ?>">
<input type="hidden" class="Default_Whole_Sale_Price" value="<?php echo lang('Default_Whole_Sale_Price'); ?>">
<input type="hidden" id="imei_ln" value="<?php echo lang('imei'); ?>">
<input type="hidden" id="serial_ln" value="<?php echo lang('serial'); ?>">
<input type="hidden" id="guide_purchase_price" value="<?php echo lang('guide_purchase_price'); ?>">
<input type="hidden" id="guide_sale_price" value="<?php echo lang('guide_sale_price'); ?>">
<input type="hidden" id="guide_wholesale_price" value="<?php echo lang('guide_wholesale_price'); ?>">
<input type="hidden" id="delete_confirmation" value="<?php echo lang('delete_confirmation'); ?>">
<input type="hidden" id="attention_variation" value="<?php echo lang('attention_variation'); ?>">
<input type="hidden" id="guide_opening_stock" value="<?php echo lang('in_sale_unit'); ?>">
<input type="hidden" id="item_type" value="<?php echo escape_output($item_details->type); ?>">
<input type="hidden" id="add_edit_mode" value="edit_mode">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/crop/croppie.css">
<script src="<?php echo base_url(); ?>assets/bower_components/crop/croppie.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/add_item.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/edit_item_new.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/get_variation_details.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>frequent_changing/css/addeidtitem.css">


<select class="hidden_variation_data display_none">
    <option value=""><?php echo lang('select_variation'); ?></option>
    <?php
    foreach ($Variations as $key=>$value):
        ?>
        <option data-id="<?php echo escape_output($value->id)?>" value="<?php echo escape_output($value->id)?>"><?php echo escape_output($value->variation_name)?></option>
        <?php
    endforeach;
    ?>
</select>




<div class="main-content-wrapper">


    <?php
    if ($this->session->flashdata('exception')) {
        echo '<section class="alert-wrapper">
        <div class="alert alert-success alert-dismissible fade show"> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-body">
        <i class="m-right fa fa-check"></i>';
        echo escape_output($this->session->flashdata('exception'));unset($_SESSION['exception']);
        echo '</div></div></section>';
    }
    ?>

    <section class="content-header">
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header mt-2"><?php echo lang('edit_item'); ?></h3>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('item'), 'secondSection'=> lang('edit_item')])?>
        </div>
    </section>


    <div class="box-wrapper">
        <div class="table-box">
            <?php echo form_open(base_url() . 'Item/addEditItem/' . $encrypted_id, $arrayName = array('id' => 'item_form', 'enctype' => 'multipart/form-data')) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('type'); ?> <span class="required_star">*</span>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('product_type_message'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                
                                <select disabled  class="form-control  select2 check_type op_width_100_p" id="type" name="type">
                                    <option value="General_Product" <?php echo set_select('type', 'General_Product'); ?><?php echo escape_output($item_details->type) == 'General_Product' ? 'selected' : '' ?>>
                                        <?php echo lang('general_product'); ?></option>
                                    <option value="Variation_Product" <?php echo set_select('type', 'Variation_Product'); ?> <?php echo escape_output($item_details->type) == 'Variation_Product' ? 'selected' : '' ?>>
                                        <?php echo lang('variation_product'); ?></option>
                                    <option value="IMEI_Product" <?php echo set_select('type', 'IMEI_Product'); ?> <?php echo escape_output($item_details->type) == 'IMEI_Product' ? 'selected' : '' ?>>
                                        <?php echo lang('imei_product'); ?></option>
                                    <option value="Serial_Product" <?php echo set_select('type', 'Serial_Product'); ?> <?php echo escape_output($item_details->type) == 'Serial_Product' ? 'selected' : '' ?>>
                                        <?php echo lang('serial_product'); ?></option>
                                    <option value="Medicine_Product" <?php echo set_select('type', 'Medicine_Product'); ?> <?php echo escape_output($item_details->type) == 'Medicine_Product' ? 'selected' : '' ?>>
                                        <?php echo lang('Medicine_Product'); ?></option>
                                    <option value="Installment_Product" <?php echo set_select('type', 'Installment_Product'); ?> <?php echo escape_output($item_details->type) == 'Installment_Product' ? 'selected' : '' ?>>
                                        <?php echo lang('installment_product'); ?></option>
                                    <option value="Service_Product" <?php echo set_select('type', 'Service_Product'); ?> <?php echo escape_output($item_details->type) == 'Service_Product' ? 'selected' : '' ?>>
                                        <?php echo lang('service_product'); ?></option>
                                    <option value="Combo_Product" <?php echo set_select('type', 'Combo_Product'); ?> <?php echo escape_output($item_details->type) == 'Combo_Product' ? 'selected' : '' ?>>
                                        <?php echo lang('Combo_Product'); ?></option>
                                </select>
                                <input type="hidden" name="type" value="<?php echo escape_output($item_details->type); ?>">
                            </div>
                            <?php if (form_error('type')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('type'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row expiry_maintain_wrapper">
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('expiry_date_maintain'); ?> <span class="required_star">*</span>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('expiry_date_maintain_guide'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <select disabled class="form-control select2" id="expiry_date_maintain" name="expiry_date_maintain">
                                    <option value="Yes" <?php echo set_select('expiry_date_maintain', 'Yes'); ?>>
                                        <?php echo lang('yes'); ?></option>
                                    <option value="No" <?php echo set_select('expiry_date_maintain', 'No'); ?>>
                                        <?php echo lang('no'); ?></option>
                                </select>
                            </div>
                            <?php if (form_error('expiry_date_maintain')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('expiry_date_maintain'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                            <div class="form-group">
                                <label><?php echo lang('name'); ?> <span class="required_star">*</span></label>
                                <input  autocomplete="off" type="text" id="name" name="name"
                                    class="form-control" placeholder="<?php echo lang('name'); ?>"
                                    value="<?php echo escape_output($item_details->name); ?>">
                            </div>
                            <?php if (form_error('name')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('name'); ?></span>
                            </div>
                            <?php } ?>
                            <div class="alert alert-error error-msg name_err_msg_contnr ">
                                <p id="name_err_msg"></p>
                            </div>
                        </div>

                        

                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                            <div class="form-group">
                                <label><?php echo lang('alternative_name'); ?></label>
                                <input  autocomplete="off" type="text" id="alternative_name" name="alternative_name"
                                    class="form-control" placeholder="<?php echo lang('alternative_name'); ?>"
                                    value="<?php echo escape_output($item_details->alternative_name) ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 rack_no">
                            <div class="form-group">
                                <label><?php echo lang('rack'); ?></label>
                                <div class="d-flex">
                                    <select class="from-control select2" name="rack_id" id="rack_id">
                                        <option><?php echo lang('select');?></option>
                                        <?php foreach($racks as $rack){ ?>
                                        <option <?php echo escape_output($rack->id) ==  $item_details->rack_id ? 'selected' : ''  ?> value="<?php echo escape_output($rack->id) ?>"><?php echo escape_output($rack->name) ?></option>
                                        <?php } ?>
                                    </select>  
                                    <button type="button" class="new-btn ms-1 add_rack_by_ajax bg-blue-btn-p-14">
                                    <iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <?php if (form_error('rack_id')) { ?>
                                <div class="callout callout-danger my-2">
                                    <span class="error_paragraph"><?php echo form_error('rack_id'); ?></span>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 generic_name">
                            <div class="form-group">
                                <label><?php echo lang('generic_name'); ?></label>
                                <input  autocomplete="off" type="text" id="generic_name" name="generic_name"
                                    class="form-control" placeholder="<?php echo lang('generic_name'); ?>"
                                    value="<?php echo escape_output($item_details->generic_name); ?>">
                            </div>
                            <?php if (form_error('generic_name')) { ?>
                                <div class="callout callout-danger my-2">
                                    <span class="error_paragraph"><?php echo form_error('generic_name'); ?></span>
                                </div>
                            <?php } ?>
                        </div>

                        


                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 <?php echo escape_output($item_details->type) == 'Variation_Product' ? 'd-none' : '' ?>" id="sale_price_group">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('sale_price'); ?> <span class="required_star">*</span>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('guide_sale_price'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <input  autocomplete="off" type="text" onfocus="this.select();" id="sale_price"
                                            name="sale_price" class="form-control integerchk" 
                                            placeholder="<?php echo lang('sale_price'); ?>"
                                            value="<?php echo escape_output($item_details->sale_price); ?>">
                                        
                            </div>
                            <?php if (form_error('sale_price')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('sale_price'); ?></span>
                            </div>
                            <?php } ?>
                            <div class="alert alert-error error-msg sale_price_err_msg_contnr ">
                                <p id="sale_price_err_msg"></p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 disable_service_field <?php echo escape_output($item_details->type) == 'Variation_Product' ? 'd-none' : '' ?>" id="whole_sale_price_group">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('whole_sale_price'); ?>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('guide_wholesale_price'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <input  autocomplete="off" type="text" onfocus="this.select();"
                                            id="whole_sale_price" name="whole_sale_price"
                                            class="form-control disable_service integerchk"
                                            placeholder="<?php echo lang('whole_sale_price'); ?>"
                                            value="<?php echo escape_output($item_details->whole_sale_price); ?>">
                            </div>
                            <?php if (form_error('whole_sale_price')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('whole_sale_price'); ?></span>
                            </div>
                            <?php } ?>
                        </div>


                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 disable_service_field <?php echo escape_output($item_details->type) == 'Variation_Product' ? 'd-none' : '' ?>" id="purchase_price_group">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('purchase_price'); ?>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('guide_purchase_price'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                
                                <input  autocomplete="off" type="text" onfocus="this.select();"
                                            id="purchase_price" name="purchase_price"
                                            class="form-control integerchk disable_service"
                                            onkeyup="return replacePonto();"
                                            placeholder="<?php echo lang('purchase_price'); ?>"
                                            value="<?php echo escape_output($item_details->purchase_price); ?>">
                            </div>
                            <div class="alert alert-error error-msg purchase_price_err_msg_contnr ">
                                <p id="purchase_price_err_msg"></p>
                            </div>
                            <?php if (form_error('purchase_price')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('purchase_price'); ?></span>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 disable_service_field <?php echo escape_output($item_details->type) == 'Variation_Product' ? 'd-none' : '' ?>" id="opening_stock_group">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('opening_stock'); ?>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('in_sale_unit'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <?php 
                                    if((int)$item_details->opening_stock){
                                        $op_stock_val = ((int)$item_details->opening_stock)  / (int)$item_details->conversion_rate;
                                    }else{
                                        $op_stock_val = 0;
                                    }
                                ?>
                                <input readonly  autocomplete="off" type="text" id="opening_stock"
                                name="opening_stock" class="form-control disable_service integerchk"
                                placeholder="<?php echo lang('opening_stock'); ?>"
                                value="<?php echo getAmt($op_stock_val) ?>">
                            </div>
                            <?php if (form_error('opening_stock')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('opening_stock'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3" id="category_id_group">
                            <div class="form-group">
                                <label><?php echo lang('category'); ?> <span class="required_star">*</span></label>
                                <div class="d-flex">
                                    <div class="op_webkit_fill_available"> 
                                        <select  class="form-control select2 op_width_100_p"  id="category_id" name="category_id">
                                            <option value=""><?php echo lang('select'); ?></option>
                                            <?php foreach ($categories as $ctry) { ?>
                                            <option value="<?php echo escape_output($ctry->id) ?>" <?php echo set_select('category_id', $ctry->id); ?>  <?php echo isset($item_details->category_id) && $item_details->category_id==$ctry->id?'selected':'' ?>> <?php echo escape_output($ctry->name) ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="alert alert-error error-msg category_id_err_msg_contnr ">
                                            <p id="category_id_err_msg"></p>
                                        </div>
                                    </div>
                                    <button type="button" class="new-btn ms-1 btn bg-blue-btn-p-14 add_category_by_ajax">
                                    <iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <?php if (form_error('category_id')) { ?>
                                <div class="callout callout-danger my-2">
                                    <span class="error_paragraph"><?php echo form_error('category_id'); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3" id="code_group">
                            <div class="form-group">
                                <label><?php echo lang('code'); ?></label>
                                <input  autocomplete="off" readonly type="text" onfocus="select();" id="code_"
                                    name="code" class="form-control" placeholder="<?php echo lang('code'); ?>"
                                    value="<?php echo escape_output($item_details->code); ?>">
                                <?php if (form_error('code')) { ?>
                                <div class="callout callout-danger my-2">
                                    <span class="error_paragraph"><?php echo form_error('code'); ?></span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                            <div class="form-group">
                                <label><?php echo lang('loyalty_point'); ?></label>
                                <input  autocomplete="off" type="text" onfocus="select();" id="loyalty_point"
                                    name="loyalty_point" class="form-control" placeholder="<?php echo lang('loyalty_point'); ?>"
                                    value="<?php echo escape_output($item_details->loyalty_point); ?>">
                                <?php if (form_error('loyalty_point')) { ?>
                                <div class="callout callout-danger my-2">
                                    <span class="error_paragraph"><?php echo form_error('loyalty_point'); ?></span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 disable_service_field" id="supplier_id_group">
                            <div class="form-group">
                                <label><?php echo lang('supplier'); ?></label>
                                <div class="d-flex">
                                    <div class="op_webkit_fill_available"> 
                                        <select  class="form-control disable_service select2 op_width_100_p" id="supplier_id" name="supplier_id">
                                            <option value=""><?php echo lang('select'); ?></option>
                                            <?php foreach ($suppliers as $splrs) {?>
                                                <option <?=isset($item_details->supplier_id) && $item_details->supplier_id && $item_details->supplier_id==$splrs->id?'selected':''?> value="<?php echo escape_output($splrs->id) ?>" <?php echo set_select('supplier_id', $splrs->id); ?>><?php echo escape_output($splrs->name) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="button" class="new-btn ms-1 btn bg-blue-btn-p-14 add_supplier_by_ajax">
                                    <iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon>
                                    </button>
                                </div>

                            </div>
                            <?php if (form_error('supplier_id')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('supplier_id'); ?></span>
                            </div>
                            <?php } ?>
                            <div class="alert alert-error error-msg supplier_id_err_msg_contnr ">
                                <p id="supplier_id_err_msg"></p>
                            </div>
                            
                        </div>
                        <div class="cler-fix"></div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 disable_service_field" id="select_unit_type_group">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label><?php echo lang('unit_type'); ?> <span class="required_star">*</span></label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('unit_type_message'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <select name="unit_type"  class="unit_type form-control select2 op_width_100_p" id="select_unit_type">
                                    <option  <?=isset($item_details->unit_type) && $item_details->unit_type && $item_details->unit_type==1?'selected':''?> value="1"><?php echo lang('single_unit') ?></option>
                                    <option  <?=isset($item_details->unit_type) && $item_details->unit_type && $item_details->unit_type==2?'selected':''?> value="2"><?php echo lang('double_unit') ?></option>
                                </select>  
                            </div>
                        </div>

                        <div class="cler-fix"></div>

                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 single_unit_hide_show disable_service_field <?php echo escape_output($item_details->unit_type) == 1 ? '' : 'd-none' ?>">
                            <div class="form-group">
                                <label><?php echo lang('unit'); ?> <span class="required_star">*</span></label>
                                <div class="d-flex">
                                    <div class="op_webkit_fill_available"> 
                                        <select  class="form-control select2 disable_service op_width_100_p"
                                            id="unit_id" name="unit_id">
                                            <option value=""><?php echo lang('select'); ?></option>
                                            <?php foreach ($units as $value) { ?>
                                            <option value="<?php echo escape_output($value->id) ?>" <?php echo escape_output($item_details->sale_unit_id) == $value->id ? 'selected' : '' ?><?php echo set_select('unit_id', $value->id); ?>><?php echo escape_output($value->unit_name) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="button" data-unit-type="Single Unit" class="new-btn ms-1 bg-blue-btn-p-14 add_sale_unit_by_ajax">
                                    <iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <?php if (form_error('unit_id')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('unit_id'); ?></span>
                            </div>
                            <?php } ?>
                            <div class="alert alert-error error-msg unit_id_err_msg_contnr ">
                                <p id="unit_id_err_msg"></p>
                            </div>
                        </div>
                        <div class="cler-fix"></div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 double_unit_hide_show disable_service_field <?php echo escape_output($item_details->unit_type) == 2 ? '' : 'd-none' ?>">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('purchase_unit'); ?> <span class="required_star">*</span>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('guide_purchase_unit'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="op_webkit_fill_available"> 
                                        <select  class="form-control select2 disable_service op_width_100_p"
                                            id="purchase_unit_id" name="purchase_unit_id" <?php echo escape_output($item_details->type) == 3 ? 'disabled' : ''?>>
                                            <option value=""><?php echo lang('select'); ?></option>
                                            <?php foreach ($units as $value) { ?>
                                                <option value="<?php echo escape_output($value->id) ?>" <?php
                                                    if ($item_details->purchase_unit_id == $value->id) {
                                                        echo "selected";
                                                    }
                                                    ?>><?php echo escape_output($value->unit_name) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="button" class="new-btn ms-1 bg-blue-btn-p-14 add_purchase_unit_by_ajax">
                                    <iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon>
                                    </button>
                                </div>


                            </div>
                            <div class="alert alert-error error-msg purchase_unit_id_err_msg_contnr ">
                                <p id="purchase_unit_id_err_msg"></p>
                            </div>
                            <?php if (form_error('purchase_unit_id')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('purchase_unit_id'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 double_unit_hide_show disable_service_field <?php echo escape_output($item_details->unit_type) == 2 ? '' : 'd-none' ?>">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('sale_unit'); ?> <span class="required_star">*</span>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('guide_purchase_unit'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="op_webkit_fill_available"> 
                                            <select  class="form-control select2 disable_service op_width_100_p"
                                                id="sale_unit_id" name="sale_unit_id">
                                                <option value=""><?php echo lang('select'); ?></option>
                                                <?php foreach ($units as $value) { ?>
                                                    <option value="<?php echo escape_output($value->id) ?>" <?php
                                                                if ($item_details->sale_unit_id == $value->id) {
                                                                    echo "selected";
                                                                }
                                                                ?>><?php echo escape_output($value->unit_name) ?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                    <button type="button" class="new-btn ms-1 bg-blue-btn-p-14 add_sale_unit_by_ajax">
                                    <iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon>
                                    </button>
                                </div>

                            </div>
                            <div class="alert alert-error error-msg sale_unit_id_err_msg_contnr ">
                                <p id="sale_unit_id_err_msg"></p>
                            </div>
                            <?php if (form_error('sale_unit_id')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('sale_unit_id'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 double_unit_hide_show disable_service_field <?php echo escape_output($item_details->unit_type) == 2 ? '' : 'd-none' ?>">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('conversion_rate'); ?> <span class="required_star">*</span>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('guide_conversion_rate'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="op_webkit_fill_available"> 
                                        <input  type="text" id="conversion_rate" autocomplete="off"
                                                name="conversion_rate"
                                                class="form-control integerchk disable_service check_sale_purchase_unit"
                                                placeholder="<?php echo lang('conversion_rate'); ?>"
                                                value="<?php echo isset($item_details->conversion_rate) && $item_details->conversion_rate!="0.00" && $item_details->conversion_rate?$item_details->conversion_rate:''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-error error-msg conversion_rate_err_msg_contnr ">
                                <p id="conversion_rate_err_msg"></p>
                            </div>
                            <?php if (form_error('conversion_rate')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph" class="error_paragraph"><?php echo form_error('conversion_rate'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="cler-fix"></div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 common_warranty disable_service_field <?php echo escape_output($item_details->type) == 'Variation_Product' ? 'd-none' : '' ?>">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('warranty'); ?> 
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('msg_show_invoce'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="op_webkit_fill_available"> 
                                        <div class="d-flex">
                                            <input  autocomplete="off" type="text" id="warranty"
                                                    name="warranty" class="form-control mr_3 integerchk"
                                                    placeholder="<?php echo lang('eg_no_1'); ?>"
                                                    value="<?php echo escape_output($item_details->warranty); ?>">
                                            <select  name="warranty_date" id="warranty_date" class="form-control select2">
                                                <option value="day" <?php echo set_select('warranty_date', 'day'); ?> <?php echo escape_output($item_details->warranty_date) == 'day' ? 'selected' : '' ?>><?php echo lang('day');?></option>
                                                <option value="month" <?php echo set_select('warranty_date', 'month'); ?> <?php echo escape_output($item_details->warranty_date) == 'month' ? 'selected' : '' ?>><?php echo lang('month');?></option>
                                                <option value="year" <?php echo set_select('warranty_date', 'year'); ?> <?php echo escape_output($item_details->warranty_date) == 'year' ? 'selected' : '' ?>><?php echo lang('year');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php if (form_error('warranty')) { ?>
                            <div class="callout callout-danger my-2">
                                
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 common_guarantee disable_service_field <?php echo escape_output($item_details->type) == 'Variation_Product' ? 'd-none' : '' ?>">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('guarantee'); ?> 
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('msg_show_invoce'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="op_webkit_fill_available"> 
                                        <div class="d-flex">
                                            <input  autocomplete="off" type="text" id="guarantee"
                                                name="guarantee" class="form-control mr_3 integerchk"
                                                placeholder="<?php echo lang('eg_no_1'); ?>"
                                                value="<?php echo escape_output($item_details->guarantee); ?>">
                                            <select  name="guarantee_date" id="guarantee_date" class="form-control select2">
                                                <option value="day" <?php echo set_select('guarantee_date', 'day'); ?> <?php echo escape_output($item_details->guarantee_date) == 'day' ? 'selected' : '' ?>><?php echo lang('day');?></option>
                                                <option value="month" <?php echo set_select('guarantee_date', 'month'); ?> <?php echo escape_output($item_details->guarantee_date) == 'month' ? 'selected' : '' ?>><?php echo lang('month');?></option>
                                                <option value="year" <?php echo set_select('guarantee_date', 'year'); ?> <?php echo escape_output($item_details->guarantee_date) == 'year' ? 'selected' : '' ?>><?php echo lang('year');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (form_error('guarantee')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('guarantee'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="cler-fix"></div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 disable_service_field" id="brand_wrap">
                            <div class="form-group">
                                <label><?php echo lang('brand'); ?></label>
                                <div class="d-flex">
                                    <div class="op_webkit_fill_available"> 
                                        <select  class="form-control select2 op_width_100_p"  id="brand_id" name="brand_id">
                                            <option value=""><?php echo lang('select'); ?></option>
                                            <?php foreach ($brands as $ctry) { ?>
                                                <option <?=isset($item_details->brand_id) && $item_details->brand_id && $item_details->brand_id==$ctry->id?'selected':''?> value="<?php echo escape_output($ctry->id) ?>" <?php echo set_select('brand_id', $ctry->id); ?>><?php echo escape_output($ctry->name) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="button" class="new-btn ms-1 bg-blue-btn-p-14 add_brand_by_ajax">
                                    <iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <?php if (form_error('brand_id')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('brand_id'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 disable_service_field <?php echo escape_output($item_details->type) == 'Variation_Product' ? 'd-none' : '' ?>" id="alert_quantity_group">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('alert_quantity'); ?> 
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('in_sale_unit'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <input  autocomplete="off" type="text" id="alert_quantity"
                                    name="alert_quantity" class="form-control disable_service"
                                    placeholder="<?php echo lang('alert_quantity'); ?>"
                                    value="<?php echo escape_output($item_details->alert_quantity); ?>">
                            </div>
                            <?php if (form_error('qty')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('qty'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
 
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 disable_service_field">
                            <div class="form-group">
                                <label><?php echo lang('description'); ?></label>
                                <input  autocomplete="off" type="text" id="description" name="description"
                                    class="form-control" placeholder="<?php echo lang('description'); ?>" value="<?php echo escape_output($item_details->description); ?>">
                            </div>
                            <?php if (form_error('description')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('description'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="clear-fix"></div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                            <input type="hidden" value="<?=$item_details->photo?>" name="image_url" id="image_url">
                            <div class="form-group">
                                <button type="button" class="new-btn add_image_for_crop op_display_inline_flex">
                                <iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon> <?php echo lang('add_image'); ?></button>
                                <button type="button"
                                class="new-btn bg-blue-btn-p-14 show_image_trigger op_display_inline_flex">
                                <iconify-icon icon="solar:eye-bold-duotone" width="22"></iconify-icon></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row disable_service_field">
                        <div class="col-md-12 variation_div_0" id="variation_wrap">
                            <div class="variation_div_1 op-d-none">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th  class="width_38_p_i w_49_p"><?php echo lang('variation'); ?></th>
                                        <th class="w_49_p"><?php echo lang('variation_value'); ?></th>
                                        <th class="width_1_p">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody class="add_variation_div">
                                    <?php
                                    $variation_details = json_decode($item_details->variation_details ? $item_details->variation_details : '');
                                    if(isset($variation_details) && $variation_details){
                                        foreach ($variation_details as $key_va=>$variation){
                                            $variation_details_plan = json_decode($variation);
                                            $attribute_details = json_decode($variation_details_plan->child_row_attribute);


                                            $selected_value = '';
                                            if($attribute_details){
                                                foreach ($attribute_details as $k1=>$vl){
                                                    $selected_value.=$vl;
                                                    if($k1<((sizeof($attribute_details))-1)){
                                                        $selected_value.="|||";
                                                    }
                                                }
                                            }
                                        ?>
                                        <tr class="bottom_border">
                                            <td class="padding_0">
                                                <select class="form-control select2 counter_variation_id get_variation_details">
                                                    <option value=""><?php echo lang('select_variation'); ?></option>
                                                    <?php
                                                    foreach ($Variations as $key=>$value):
                                                        ?>
                                                        <option <?=isset($variation_details_plan->attribute_id) && $variation_details_plan->attribute_id==$value->id?'selected':''?> data-id="<?php echo escape_output($value->id)?>" value="<?php echo escape_output($value->id)?>"><?php echo escape_output($value->variation_name)?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select data-selected_value="<?php echo $selected_value?>" class="form-control select_multiple child_row_attribute check_required child_row_counter<?=($key_va)?>">
                                                    <option value=""><?php echo lang('select'); ?></option>
                                                </select>
                                                <a href="javascript:void(0)" class="new-btn bg-blue-btn-p-14 mt-2 add_row margin_top_2 pull-right"><iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon></a>
                                            </td>
                                            <td class="c_center">
                                                <a class="remove_row new-btn-danger" href="javascript:void(0)">
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-broken" class="color-red" width="22"></iconify-icon>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    }else{
                                    ?>
                                        <tr class="bottom_border">
                                            <td class="padding_0">
                                                <select class="form-control select2 counter_variation_id get_variation_details">
                                                    <option value=""><?php echo lang('select_variation'); ?></option>
                                                    <?php
                                                    foreach ($Variations as $key=>$value):
                                                        ?>
                                                        <option data-id="<?php echo escape_output($value->id)?>" value="<?php echo escape_output($value->id)?>"><?php echo escape_output($value->variation_name)?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                                <br>
                                                <label><input type="checkbox" name="visible_on_product" class="visible_on_product"  value="1"> <?php echo lang('Visible_on_the_product_page'); ?></label><br>
                                                <label><input type="checkbox" name="used_for_variations" class="used_on_variation"  value="1"> <?php echo lang('Used_for_variations'); ?></label>
                                            </td>
                                            <td>
                                                <select class="form-control child_row_attribute check_required child_row_counter0">
                                                    <option value=""><?php echo lang('select'); ?></option>
                                                </select>
                                                <a href="javascript:void(0)" class="btn bg-blue-btn bg-blue-btn-p-14 btn-sm mt-2 add_row margin_top_2 pull-right"><i class="fa fa-plus"></i> <?php echo lang('add_new'); ?></a>
                                            </td>
                                            <td class="c_center">
                                                <a class="remove_row" href="javascript:void(0)"><i class="color_red fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button" class="new-btn me-1 bg-blue-btn-p-14 add_variation"><iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon> <?php echo lang('add_variation'); ?></button>
                                                <button type="button" class="new-btn bg-blue-btn-p-14 generate_variation"><iconify-icon icon="solar:history-outline" width="22"></iconify-icon> <?php echo lang('generate_variation'); ?></button>
                                            </div>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="variation_div_2 <?php echo escape_output($item_details->type) == 'Variation_Product' ? '' : 'op-d-none' ?>">
                                <button type="button" class="new-btn bg-blue-btn-p-14 back_to_attribute"><iconify-icon icon="solar:map-arrow-left-bold-duotone" width="22"></iconify-icon> <?php echo lang('back_to_attribute'); ?></button>
                                <p></p>
                                <table class="table table-bordered">
                                    <tbody  id="variation_container_div">
                                        <?php
                                        if(isset($variation_products)&& $variation_products):
                                            foreach ($variation_products as $k_v_p=>$vp_value):
                                        ?>
                                        <tr class="heading_tr">
                                            <th colspan="4">
                                                <input type="hidden" value="<?php echo escape_output($vp_value->id) ?>" name="old_variation_id[]"> 
                                                <input type="hidden" value="<?php echo escape_output($vp_value->name) ?>" name="variation_name[]"> #<span class="counter_variation"></span>  <?php echo escape_output($vp_value->name) ?> <div class="pull-right"><span class="cursor_tr show_details_view">
                                                <iconify-icon data-status="1"  class="arrow_status" icon="solar:arrow-up-broken" width="22"></iconify-icon>
                                            </span><span class="cursor_pointer">
                                            <iconify-icon class="row_remove_variation color-red" icon="solar:trash-bin-minimalistic-broken" width="22"></iconify-icon>
                                            </span></div></th>
                                        </tr>
                                        <tr class="display_none show_details_view_sub_div1">
                                            <td class="op_width_20_p txt-uh-41 c_center" rowspan="2">
                                                <input type="hidden" class="variation_product_images" value="<?php echo escape_output($vp_value->photo) ?>">
                                                <?php if($vp_value->photo){ ?>
                                                    <img class="width_45_p add_image_for_crop_variation cursor_tr" src="<?=base_url()?>uploads/items/<?=escape_output($vp_value->photo)?>">
                                                <?php }else{ ?>
                                                    <img class="width_45_p add_image_for_crop_variation cursor_tr" src="<?=base_url()?>uploads/site_settings/image_thumb.png">
                                                <?php } ?>
                                                <iconify-icon class="image_div cursor_pointer color-red" icon="solar:trash-bin-minimalistic-broken" width="22"></iconify-icon>
                                            </td>
                                            <td class="op_width_20_p form-group">
                                                <label><?php echo lang('sale_price'); ?> <span class="required_star">*</span></label>
                                                <input type="text" class="form-control integerchk default_sale_price_variation check_required_variation" onfocus="select()" placeholder="<?php echo lang('sale_price'); ?>" value="<?php echo escape_output($vp_value->sale_price) ?>">
                                            </td>

                                            <td class="op_width_20_p form-group">
                                                <label><?php echo lang('whole_sale_price'); ?> <span class="required_star">*</span></label>
                                                <input type="number" onfocus="select()" class="form-control default_whole_sale_price_variation check_required_variation" placeholder="<?php echo lang('whole_sale_price'); ?>"  value="<?php echo escape_output($vp_value->whole_sale_price) ?>">
                                            </td>

                                            <td class="width_100_p form-group" colspan="2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label><?php echo lang('purchase_price'); ?> <span class="required_star">*</span></label>
                                                    <span><i data-tippy-content="<?php echo lang('guide_purchase_price');?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i></span>
                                                </div>
                                                <input type="text" class="form-control integerchk default_purchase_price_variation check_required_variation" onfocus="select()" placeholder="<?php echo lang('purchase_price'); ?>" value="<?php echo escape_output($vp_value->purchase_price) ?>">
                                            </td>
                                        </tr>
                                        <tr class="display_none show_details_view_sub_div3">
                                            <td class="op_width_20_p form-group">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label><?php echo lang('opening_stock'); ?> </label>
                                                    <span><i data-tippy-content="<?php echo lang('in_sale_unit');?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i></span>
                                                </div>
                                                <input type="number" onfocus="select()" serial_e="<?php echo $k_v_p; ?>" data-item="<?php echo escape_output($vp_value->id) ?>" class="form-control opening_stock_variation stock_view" placeholder="<?php echo lang('opening_stock'); ?>" value="<?php echo getItemOpeningStockAndConversionRate($vp_value->id); ?>">
                                                <div class="op_stock_set d-none">
                                                    <?php foreach($outlets as $outlet){ ?>
                                                        <input type="hidden" name="outlets<?php echo $k_v_p ?>[]" value="<?php echo escape_output($outlet->id);?>">
                                                        <input type="hidden" name="quantity<?php echo $k_v_p ?>[]" value="<?php echo getVariationOpeningStock($vp_value->id, $outlet->id);?>">
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td class="op_width_20_p form-group">
                                                <label><?php echo lang('code'); ?> <span class="required_star">*</span></label>
                                                <input type="text" onfocus="select()" class="form-control code_variation check_required_variation" placeholder="<?php echo lang('code'); ?>" value="<?php echo escape_output($vp_value->code) ?>"></td>
                                            <td class="op_width_20_p form-group" colspan="2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label><?php echo lang('alert_quantity'); ?></label>
                                                    <span><i data-tippy-content="<?php echo lang('in_sale_unit');?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i></span>
                                                </div>
                                                <input type="number" onfocus="select()" class="form-control alert_quantity_variation" placeholder="<?php echo lang('alert_quantity'); ?>"  value="<?php echo escape_output($vp_value->alert_quantity) ?>">
                                            </td>
                                        </tr>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="combo_item_cart">
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>
                                        <?php echo lang('items'); ?> <span class="required_star">*</span>
                                    </label>
                                    <div class="ms-3 op_right op_font_18 op_cursor_pointer mb-4-px">
                                        <i data-tippy-content="<?php echo lang('product_type_message'); ?>" class="fa-regular fa-circle-question tippyBtnCall font-16 theme-color"></i>
                                    </div>
                                </div>
                                <select  class="form-control select2  check_type op_width_100_p" id="combo_item">
                                    <option value=""><?php echo lang('select_item') ?></option>
                                    <?php foreach($items as $key=>$item){ ?>
                                    <option data-item-price="<?php echo escape_output($item->sale_price) ?>" value="<?php echo escape_output($item->id) ?>"><?php echo escape_output($item->name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if (form_error('type')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('type'); ?></span>
                            </div>
                            <?php } ?>
                        </div>


                        <div class="col-md-12">
                            <div class="table-responsive" id="combo_table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="w-5"><?php echo lang('sn'); ?></th>
                                            <th class="w-10"><?php echo lang('show_in_invoice'); ?></th>
                                            <th class="w-25"><?php echo lang('item_name'); ?></th>
                                            <th class="w-20"><?php echo lang('quantity_amount'); ?></th>
                                            <th class="w-20"><?php echo lang('amount'); ?></th>
                                            <th class="w-15"><?php echo lang('total'); ?></th>
                                            <th class="w-5"><?php echo lang('actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $grand_total_sum = 0;
                                            if(isset($combo_items) && $combo_items){
                                                foreach($combo_items as $key=>$combo){
                                                    $grand_total_sum = (int)$combo->quantity * (int)$combo->unit_price;
                                            
                                        ?>
                                        <tr data-item_id="">
                                            <td class="sn_counter"><?php echo $key + 1;?></td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input check_box_trigger" type="checkbox" id="inlineCheckbox1" <?php echo escape_output($combo->show_invoice == 'Yes' ? 'checked' : '');?>>
                                                    <label class="form-check-label" for="inlineCheckbox1"></label>
                                                    <input type="hidden" name="item_show_in_invoice[]" class="checkbox_el" value="<?php echo escape_output($combo->show_invoice == 'Yes' ? 'on' : 'off');?>">
                                                </div>
                                            </td>
                                            <td>
                                                <p><?php echo escape_output($combo->item_name);?></p>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input  autocomplete="off" type="text" onfocus="select();" name="combo_item_qty[]" class="form-control integerchk comboCalculation quantity" placeholder="Quantity" value="<?php echo escape_output($combo->quantity);?>">
                                                    <input type="hidden" name="combo_item_id[]" value="<?php echo escape_output($combo->item_id);?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input  autocomplete="off" type="text" onfocus="select();" name="combo_item_unitprice[]" class="form-control integerchk comboCalculation unit_price" placeholder="Unit Price" value="<?php echo escape_output($combo->unit_price);?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input  autocomplete="off" type="text" onfocus="select();" name="" class="form-control integerchk combo_total" placeholder="Total" readonly value="<?php echo escape_output((int)$combo->quantity * (int)$combo->unit_price);?>">
                                                </div>
                                            </td>
                                            <td>
                                                <span class="combo_trash_trigger cursor-pointer new-btn-danger justify-content-center d-inline-flex">
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-broken" width="18"></iconify-icon>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="w-5"></td>
                                        <td class="w-10"></td>
                                        <td class="w-25"></td>
                                        <td class="w-20"></td>
                                        <td class="w-20"></td>
                                        <td class="w-15">
                                            <div class="form-group">
                                                <label>
                                                    <?php echo lang('sale_price'); ?>
                                                </label>
                                                <input  autocomplete="off" type="text" name="combo_sale_subtotal" class="form-control integerchk combo_sale_subtotal" placeholder="<?php echo lang('sale_price'); ?>" readonly disabled value="<?php echo getAmt($grand_total_sum);?>">
                                            </div>
                                        </td>
                                        <td class="w-5"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>



                    <div class="row" id="tax_table">
                        <?php
                        $collect_tax = $this->session->userdata('collect_tax');
                        if(isset($collect_tax) && $collect_tax=="Yes"){
                            if($item_details->tax_information != ''){
                                $tax_information = json_decode($item_details->tax_information);
                                $tax_string_p = ($item_details->tax_string);
                                //get company data
                                $company = getCompanyInfo();
                                $tax_setting = json_decode($company->tax_setting);
                                $tax_string_s = ($company->tax_string);
                                if($tax_string_p==$tax_string_s){
                                    foreach($tax_information as $tax_field){ ?>
                                    <div class="col-md-4 col-lg-4 col-xl-3 mb-3">
                                        <div class="form-group">
                                            <label><?php echo escape_output($tax_field->tax_field_name) ?></label>
                                            <table class="ir_w_100 mt_0">
                                                <tr>
                                                    <td>
                                                        <input  type="hidden" name="tax_field_id[]"
                                                            value="<?php echo escape_output((isset($tax_field->tax_field_id) && $tax_field->tax_field_id?$tax_field->tax_field_id:'')) ?>">
                                                        <input  type="hidden" name="tax_field_company_id[]"
                                                            value="<?php echo escape_output($tax_field->tax_field_company_id) ?>">
                                                        <input  type="hidden" name="tax_field_name[]"
                                                            value="<?php echo escape_output($tax_field->tax_field_name) ?>">
                                                        <input  type="text" name="tax_field_percentage[]"
                                                            class="form-control integerchk for_items <?php echo escape_output($item_details->type) == 'Installment_Product' ? 'off-d-none' : '' ?>" placeholder=""
                                                            value="<?php  echo escape_output($tax_field->tax_field_percentage) ?>">
                                                    
                                                        <input readonly  type="text" 
                                                        class="form-control for_installment <?php echo escape_output($item_details->type) == 'Installment_Product' ? '' : 'off-d-none' ?>"
                                                        placeholder="" value="">
                                                    
                                                    </td>
                                                    <td class="txt_27 text_center_bg_whtie">%</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <?php  } ?>
                                <?php }else{ 
                                    $arr = array();
                                    if($tax_information){
                                        foreach($tax_information as $value_){
                                            $arr[$value_->tax_field_name] = $value_->tax_field_percentage;
                                        }
                                    }
                                    foreach($tax_setting as $single_tax){
                                        $tax_percentage = '';
                                        if(isset($arr[$single_tax->tax]) && $arr[$single_tax->tax]){
                                            $tax_percentage = $arr[$single_tax->tax];
                                        }else{
                                            $tax_percentage = $single_tax->tax_rate;
                                        }
                                    ?>

                                    <div class="col-md-4 col-lg-4 col-xl-3 mb-3">
                                        <div class="form-group">
                                            <label><?php echo escape_output($single_tax->tax) ?></label>
                                            <table class="ir_w_100 mt_0">
                                                <tr>
                                                    <td>
                                                        <input  type="hidden" name="tax_field_id[]"
                                                            value="<?php echo escape_output((isset($single_tax->id) && $single_tax->id?$single_tax->id:'')) ?>">
                                                        <input  type="hidden" name="tax_field_company_id[]"
                                                            value="<?php echo escape_output($this->session->userdata('company_id')); ?>">
                                                        <input  type="hidden" name="tax_field_name[]"
                                                            value="<?php echo escape_output($single_tax->tax) ?>">
                                                        <input  type="text" name="tax_field_percentage[]"
                                                            class="form-control integerchk for_items <?php echo escape_output($item_details->type) == 'Installment_Product' ? 'off-d-none' : '' ?>" placeholder=""
                                                            value="<?php  echo escape_output($tax_percentage) ?>">
                                                        
                                                        <input readonly  type="text" 
                                                        class="form-control for_installment <?php echo escape_output($item_details->type) == 'Installment_Product' ? '' : 'off-d-none' ?>"
                                                        placeholder="" value="<?php echo getAmtPCustom(0);?>">
                                                        
                                                    </td>
                                                    <td class="txt_27 text_center_bg_whtie">%</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                <?php } }?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="item_append">
                        <?php 
                        if(isset($_POST['outlets'])){
                        foreach($_POST['outlets'] as $row=>$outlet){ ?>
                            <input type="hidden" name="outlets[]" value="<?php echo htmlspecialchars($outlet); ?>">
                            <input type="hidden" name="quantity[]" value="<?php echo htmlspecialchars($_POST['quantity'][$row]); ?>">
                            <input type="hidden" name="item_description[]" value="<?php echo htmlspecialchars($_POST['item_description'][$row]); ?>">
                        <?php } }else{
                            foreach($stockDetails as $stok_d){ ?>
                                <input type="hidden" name="outlets[]" value="<?php echo escape_output($stok_d->outlet_id); ?>">
                                <input type="hidden" name="quantity[]" value="<?php echo escape_output($stok_d->stock_quantity) / $item_details->conversion_rate; ?>">
                                <input type="hidden" name="item_description[]" value="<?php echo escape_output($stok_d->item_description); ?>">
                        <?php } }?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn bg-blue-btn">
                        <iconify-icon icon="solar:upload-minimalistic-broken"></iconify-icon>
                        <?php echo lang('submit'); ?>
                    </button>
                    <input type="hidden" id="set_save_and_add_more" name="add_more">
                    <button type="submit" name="submit" value="submit" class="btn bg-blue-btn" id="save_and_add_more">
                        <iconify-icon icon="solar:undo-right-round-broken"></iconify-icon>
                        <?php echo lang('save_and_add_more'); ?>
                    </button>
                    <a class="btn bg-blue-btn text-decoration-none" href="<?php echo base_url() ?>Item/items">
                        <iconify-icon icon="solar:undo-left-round-broken"></iconify-icon>
                        <?php echo lang('back'); ?>
                    </a>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>



<!-- Category Modal -->
<div class="modal fade " id="addCategoryModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                <?php echo lang('add_item_category'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                data-feather="x"></i></span></button>
            </div>
            <div class="modal-body">
                <form id="add_category_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-sm-4 control-label"><?php echo lang('name'); ?><span class="op_color_red">
                                        *</span></label>
                                <input type="text" autocomplete="off" class="form-control" name="name" id="name_cat"
                                    placeholder="<?php echo lang('name'); ?>" value="">
                                <div class="alert alert-error error-msg cat_name_err_msg_contnr ">
                                    <p class="cat_name_err_msg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('description'); ?></label>
                                <input autocomplete="off" type="text" id="description_cat" name="description"
                                    class="form-control" placeholder="<?php echo lang('description'); ?>" value="<?php echo set_value('description'); ?>">  
                                <div class="alert alert-error error-msg sdescription_err_msg_contnr ">
                                    <p class="description_err_msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn" id="addCategory"><?php echo lang('submit'); ?></button>
                <button type="button" class="btn bg-blue-btn" data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Rack Modal -->
<div class="modal fade " id="addRackModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                <?php echo lang('add_rack'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                data-feather="x"></i></span></button>
            </div>
            <div class="modal-body">
                <form id="add_category_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-sm-4 control-label"><?php echo lang('name'); ?><span class="op_color_red">
                                        *</span></label>
                                <input type="text" autocomplete="off" class="form-control" name="name" id="name_rack"
                                    placeholder="<?php echo lang('name'); ?>" value="">
                                <div class="alert alert-error error-msg rack_name_err_msg_contnr ">
                                    <p class="rack_name_err_msg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('description'); ?></label>
                                <input autocomplete="off" type="text" id="description_rack" name="description"
                                    class="form-control" placeholder="<?php echo lang('description'); ?>" value="<?php echo set_value('description'); ?>">  
                                <div class="alert alert-error error-msg rack_des_err_msg_contnr ">
                                    <p class="rack_des_err_msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn" id="addRack"><?php echo lang('submit'); ?></button>
                <button type="button" class="btn bg-blue-btn" data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Brand Modal -->
<div class="modal fade" id="addBrandModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                <?php echo lang('add_brand'); ?></h4> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                            data-feather="x"></i></span></button>
            </div>
            <div class="modal-body">
                <form id="add_brand_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class=" control-label"><?php echo lang('name'); ?><span class="op_color_red">
                                    *</span></label>
                                <input type="text" autocomplete="off" class="form-control" name="name" id="name_brand"
                                    placeholder="<?php echo lang('name'); ?>" value="">
                                <div class="alert alert-error error-msg brand_name_err_msg_contnr ">
                                    <p class="brand_name_err_msg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('description'); ?></label>
                                <input autocomplete="off" type="text" name="description" id="description_brand"
                                    class="form-control" placeholder="<?php echo lang('description'); ?>" value="<?php echo set_value('description'); ?>">
                                <div class="alert alert-error error-msg sdescription_err_msg_contnr ">
                                    <p class="description_err_msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn" id="addBrand"> <?php echo lang('submit'); ?></button>
                <button type="button" class="btn bg-blue-btn"  data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Suppliers Modal -->
<div class="modal fade" id="addSupplierModal" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                    <?php echo lang('add_supplier'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                            data-feather="x">×</i></span></button>
                
            </div>
            <div class="modal-body scroll_body">
                <form id="add_supplier_form">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('supplier_name'); ?><span class="op_color_red"> *</span></label>
                                <input type="text" autocomplete="off" class="form-control" name="name" id="name_supplier"
                                    placeholder="<?php echo lang('supplier_name'); ?>" value="">
                                <div class="alert alert-error error-msg sup_name_err_msg_contnr ">
                                    <p class="sup_name_err_msg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('contact_person'); ?><span class="op_color_red"> *</span></label>
                                <input autocomplete="off" type="text" id="contact_person" name="contact_person"
                                    class="form-control" placeholder="<?php echo lang('contact_person'); ?>"
                                    value="<?php echo set_value('contact_person'); ?>">
                                <div class="alert alert-error error-msg contact_person_err_msg_contnr ">
                                    <p class="contact_person_err_msg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('phone'); ?><span class="op_color_red">
                                        *</span></label>
                                <input autocomplete="off" type="text" id="phone" name="phone" class="form-control"
                                    placeholder="<?php echo lang('phone'); ?>" value="<?php echo set_value('phone'); ?>">
                                <div class="alert alert-error error-msg phone_err_msg_contnr ">
                                    <p class="phone_err_msg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('email'); ?></label>
                                <input autocomplete="off" type="text" id="email" name="email" class="form-control"
                                    placeholder="<?php echo lang('email'); ?>" value="<?php echo set_value('email'); ?>">
                                <div class="alert alert-error error-msg email_err_msg_contnr ">
                                    <p class="email_err_msg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>
                                    <?php echo lang('opening_balance'); ?>
                                </label>
                                <div class="d-flex align-items-center">
                                    <div class="op_webkit_fill_available"> 
                                        <div class="d-flex">
                                            <input autocomplete="off" type="text"
                                                    name="opening_balance" class="form-control mr_3 integerchk"
                                                    placeholder="<?php echo lang('opening_balance'); ?>"
                                                    value="<?php echo set_value('opening_balance'); ?>">
                                                <select name="opening_balance_type" id="opening_balance_type" class="form-control select2">
                                                <option value="Debit" <?php echo set_select('opening_balance_type', 'Debit'); ?>><?php echo lang('debit');?></option>
                                                <option value="Credit" <?php echo set_select('opening_balance_type', 'Credit'); ?>><?php echo lang('credit');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (form_error('opening_balance')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('opening_balance'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-3">
                                <label><?php echo lang('description'); ?></label>
                                <input class="form-control" name="description"
                                    placeholder="<?php echo lang('description'); ?> ..." value="<?php echo $this->input->post('description'); ?>">
                            </div>
                            <?php if (form_error('description')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('description'); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group mb-3">
                                <label><?php echo lang('address'); ?></label>
                                <textarea class="form-control" name="address"
                                    placeholder="<?php echo lang('address'); ?>"><?php echo $this->input->post('address'); ?></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn" id="addSupplier">  <?php echo lang('submit'); ?></button>
                <button type="button" class="btn bg-blue-btn"  data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Purchase Unit Modal -->
<div class="modal fade" id="addPurchaseUnitModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                    <?php echo lang('add_purchase_unit'); ?></h4> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                            data-feather="x">×</i></span></button>
               
            </div>
            <div class="modal-body">
                <form id="add_purchase_unit_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('unit_name'); ?><span class="op_color_red">
                                        *</span></label>
                                <input type="text" autocomplete="off" class="form-control" name="unit_name" id="unit_name_p"
                                    placeholder="<?php echo lang('name'); ?>" value="">
                                <div class="alert alert-error error-msg unit_name_err_msg_contnr ">
                                    <p class="unit_name_err_msg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('description'); ?></label>
                                <input autocomplete="off" type="text" name="description" id="description_p"
                                    class="form-control" placeholder="<?php echo lang('description'); ?>"
                                    value="<?php echo set_value('description'); ?>">
                                <div class="alert alert-error error-msg sdescription_err_msg_contnr ">
                                    <p class="description_err_msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn" id="addPurchaseUnit"> <?php echo lang('submit'); ?></button>
                <button type="button" class="btn bg-blue-btn" data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Sale Unit Modal -->
<div class="modal fade" id="addSaleUnitModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                <?php echo lang('add_sale_unit'); ?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                            data-feather="x">×</i></span></button>
               
            </div>
            <div class="modal-body">
                <form id="add_sale_unit_form">
                    <input type="hidden" id="set_unit_type">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('unit_name'); ?><span class="op_color_red">
                                        *</span></label>
                                <input type="text" autocomplete="off" class="form-control" name="unit_name"
                                    id="unit_name_sale" placeholder="<?php echo lang('name'); ?>" value="">
                                <div class="alert alert-error error-msg sale_unit_name_err_msg_contnr ">
                                    <p class="sale_unit_name_err_msg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="control-label"><?php echo lang('description'); ?></label>
                                <input autocomplete="off" type="text" name="description" id="description_s"
                                    class="form-control" placeholder="<?php echo lang('description'); ?>"
                                    value="<?php echo set_value('description'); ?>">
                                <div class="alert alert-error error-msg sdescription_err_msg_contnr ">
                                    <p class="description_err_msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn" id="addSaleUnit">  <?php echo lang('submit'); ?></button>
                <button type="button" class="btn bg-blue-btn" data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>


<!-- Image Modal -->
<div class="modal fade" id="AddItemImageModal" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?php echo lang('image_cropper'); ?>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i data-feather="x">×</i>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo" class="upload_demo_single"></div>
                    </div>
                    <div class="col-md-12 text-center">
                        <strong><?php echo lang('select_image'); ?></strong>
                        <br>
                        <input type="file" class="form-control" id="upload">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn bg-blue-btn-p-14 upload-result"><?php echo lang('crop'); ?></button>
                <button type="button" class="btn bg-blue-btn bg-blue-btn-p-14" data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>


<!-- Variation Attribute Modal -->
<div class="modal fade" id="add_variation_attribute_modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                <?php echo lang('add_variation'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i data-feather="x">×</i></span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label ><?php echo lang('Variation_Attribute');?></label>
                            <input type="hidden" class="form-control" id="attribute_name_id">
                            <input type="text" class="form-control"  id="attribute_name" placeholder="<?php echo lang('Variation_Attribute');?>">
                            <div class="attr_error_msg mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn bg-blue-btn-p-14 add_new_attribute">  <?php echo lang('submit'); ?></button>
                <button type="button" class="btn bg-blue-btn bg-blue-btn-p-14"  data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Variation Image Modal -->
<div class="modal fade" id="add_variation_image_modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7 text-center">
                        <div id="upload-demo_variation"></div>
                    </div>
                    <div class="col-md-5 txt-uh-50 m-auto">
                        <div class="mb-3">
                            <p><strong><?php echo lang('Preview_Image');?></strong></p>
                            <img class="set_preview_img width_45_p border-r-px" src="-" alt="">
                        </div>
                        <strong><?php echo lang('select_image'); ?></strong>
                        <br>
                        <input type="hidden" value="" id="hidden_row_image_variation">
                        <input type="file" class="form-control variation_image">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn bg-blue-btn-p-14 upload-result_variaton">
                    <?php echo lang('crop'); ?></button>
                <button type="button" class="btn bg-blue-btn bg-blue-btn-p-14" data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
                
            </div>
        </div>
    </div>
</div>

<!-- Show Image Modal -->
<div class="modal fade" id="show_image" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                <?php echo lang('view_image'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                data-feather="x"></i></span></button>
            </div>
            <div class="modal-body">
                <div id="upload-demo-i" class="text-center">
                    <?php if(!empty($item_details->photo)){?>
                    <img class="img-responsive op_margin_bottom_5"
                        src="<?= base_url() . "uploads/items/" . $item_details->photo ?>" alt="Photo">
                    <?php } else{?>
                        <img class="img-responsive op_margin_bottom_5"
                        src="<?= base_url() . 'uploads/site_settings/image_thumb.png' ?>" alt="Photo" height="100" width="100">
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn bg-blue-btn-p-14" data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Opening Stock Modal -->
<div class="modal fade" id="opening_stock_modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                <?php echo lang('opening_stock_set_for_outlet'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                data-feather="x"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="scroll_body">
                    <?php if($item_details->type == 'General_Product' || $item_details->type == 'Installment_Product'){ ?>
                        <?php foreach($outlets as $outlet){ ?>
                        <div class="card p-3 mb-3">
                            <h5><b><?php echo lang('outlet');?>:</b><?php echo escape_output($outlet->outlet_name); ?></h5>
                            <div class="form-group mb-3">
                                <label for="outlet_<?php echo escape_output($outlet->id); ?>" class="form-label"><?php echo lang('quantity');?></label>
                                <input type="text" class="form-control integerchk quantity_trigger general_product_stock_check" data-outlet="<?php echo escape_output($outlet->id); ?>" data-item="<?php echo escape_output($item_details->id); ?>" placeholder="<?php echo lang('quantity');?>" id="outlet_<?php echo escape_output($outlet->id); ?>">
                            </div>
                        </div>
                        <?php } ?>
                    <?php }else if($item_details->type == 'IMEI_Product' || $item_details->type == 'Serial_Product'){ ?>
                        <?php foreach($outlets as $outlet){ ?>
                        <div class="card p-3 mb-3">
                            <h5><b><?php echo lang('outlet');?>:</b> <?php echo escape_output($outlet->outlet_name) ?></h5>
                            <div class="form-group mb-3">
                                <label for="outlet_<?php echo escape_output($outlet->id); ?>" class="form-label"><?php echo lang('quantity');?></label>
                                <input readonly type="text" class="form-control integerchk quantity_trigger imeiserial_product_stock_check mb-2" data-outlet="<?php echo escape_output($outlet->id); ?>" data-item="<?php echo escape_output($item_details->id); ?>" placeholder="<?php echo lang('quantity');?>" id="outlet_<?php echo escape_output($outlet->id); ?>" value="">
                                <div class="form_clear_trigger item_description_body_<?php echo escape_output($outlet->id); ?>">
                                </div>
                                <div class="imeiSerial_add_more" data-id="<?php echo escape_output($outlet->id); ?>">
                                    <button type="button" class="ms-1 btn bg-blue-btn bg-blue-btn-p-14 add_imei_serial">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php }else if($item_details->type == 'Medicine_Product'){ ?>
                        <?php foreach($outlets as $outlet){ ?>
                        <div class="card p-3 mb-3">
                            <h5><b><?php echo lang('outlet');?>:</b> <?php echo escape_output($outlet->outlet_name) ?></h5>
                            <div class="form-group mb-3">
                                <label for="outlet_<?php echo escape_output($outlet->id); ?>" class="form-label"><?php echo lang('total');?> <?php echo lang('quantity');?></label>
                                <input readonly type="text" class="form-control integerchk quantity_trigger Medicine_Product_stock_check mb-2" data-outlet="<?php echo escape_output($outlet->id); ?>" data-item="<?php echo escape_output($item_details->id); ?>" placeholder="<?php echo lang('quantity');?>" id="outlet_<?php echo escape_output($outlet->id); ?>" value="">
                                <div class="expiry_set form_clear_trigger item_description_body_<?php echo escape_output($outlet->id); ?>" data-id="<?php echo escape_output($outlet->id); ?>">
                                </div>
                                <div class="expiry_add_more" data-id="<?php echo escape_output($outlet->id); ?>">
                                    <button type="button" class="ms-1 btn bg-blue-btn bg-blue-btn-p-14 add_new_expiry">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php }else if($item_details->type == 'Variation_Product'){ ?>
                        <input type="hidden" class="variation_opening_main">
                        <?php foreach($outlets as $outlet){ ?>
                        <div class="card p-3 mb-3">
                            <h5><b><?php echo lang('outlet');?>:</b><?php echo escape_output($outlet->outlet_name); ?></h5>
                            <div class="form-group mb-3">
                                <label for="outlet_<?php echo escape_output($outlet->id); ?>" class="form-label"><?php echo lang('quantity');?></label>
                                <input type="text" class="form-control integerchk quantity_trigger variation_product_stock_check" data-outlet="<?php echo escape_output($outlet->id); ?>" data-item="" placeholder="<?php echo lang('quantity');?>" id="outlet_<?php echo escape_output($outlet->id); ?>">
                            </div>
                        </div>
                        <?php } ?>
                    <?php }else{ ?>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn" id="oppening_stock_submit"><?php echo lang('submit'); ?></button>
                <button type="button" class="btn bg-blue-btn" data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>



