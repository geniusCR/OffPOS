<link rel="stylesheet" href="<?php echo base_url()?>frequent_changing/css/checkBotton2.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>frequent_changing/css/item.css">
<div class="main-content-wrapper">
    <?php
    if ($this->session->flashdata('exception')) {
        echo '<section class="alert-wrapper"><div class="alert alert-success alert-dismissible fade show"> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"></button>
        <div class="alert-body"><i class="icon fa fa-check me-2"></i>';
        echo escape_output($this->session->flashdata('exception'));unset($_SESSION['exception']);
        echo '</div></div></section>';
    }
    ?>
    <?php
    if ($this->session->flashdata('exception_error')) {

        echo '<section class="alert-wrapper"><div class="alert alert-danger alert-dismissible fade show"> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"></button>
        <div class="alert-body"><i class="icon fa fa-times me-2"></i>';
        echo escape_output($this->session->flashdata('exception_error'));unset($_SESSION['exception_error']);
        echo '</div></div></section>';
    }
    ?>

    <section class="content-header"> 
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header"><?php echo lang('bulk_item_update'); ?></h3>
                <input type="hidden" class="datatable_name" data-title="<?php echo lang('bulk_item_update'); ?>" data-id_name="datatable">
                <div class="btn_list m-right d-flex">
                    <button type="button" class="dataFilterBy new-btn"><iconify-icon icon="solar:filter-broken"  width="22"></iconify-icon> <?php echo lang('filter_by');?></button>
                </div>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('item'), 'secondSection'=> lang('bulk_item_update')])?>
        </div>
    </section>

    <div class="box-wrapper"> 
        <form action="<?php echo base_url();?>Item/bulkItemUpdate" method="POST">
            <div class="text-right d-flex justify-content-end">
                <button type="submit" class="new-btn mb-2 ms-1" name="submit" value="submit">
                    <iconify-icon icon="solar:upload-minimalistic-broken" width="22"></iconify-icon>
                    <?php echo lang('update_item');?>
                </button>
            </div>
            <!-- End Filter Options -->
            <div class="table-box item_page_indicator">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="w-5 text-left"><?php echo lang('sn'); ?></th>
                                <th class="w-5"><?php echo lang('select'); ?></th>
                                <th class="w-20"><?php echo lang('name'); ?> (<?php echo lang('code'); ?>)</th>
                                <th class="w-12"><?php echo lang('sale_price'); ?></th>
                                <th class="w-12"><?php echo lang('whole_sale_price'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($bulk_item_update && !empty($bulk_item_update)) {
                                $i = count($bulk_item_update);
                            foreach ($bulk_item_update as $value) {
                            ?>
                            <tr>
                                <td><?php echo $i--; ?></td>
                                <td>
                                    <label class="container">
                                        <input type="checkbox" class="checkbox_item" value="<?php echo escape_output($value->id) ?>" name="bulk_item[]">
                                        <span class="checkmark"></span>
                                        <input type="hidden" value="<?php echo escape_output($value->id) ?>" name="bulk_item_all[]">
                                    </label>
                                </td>
                                <td><?php echo $value->name . " " . "(" . $value->code . ")"; ?></td>
                                <td>
                                    <div class="form-group">
                                        <input  autocomplete="off" type="text" onfocus="this.select();" name="sale_price[]" class="form-control integerchk" placeholder="<?php echo lang('sale_price'); ?>" value="<?php echo $value->sale_price ?>">  
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input <?php echo $value->type == 'Service_Product' ? 'readonly' : '' ?>  autocomplete="off" type="text" onfocus="this.select();" name="whole_sale_price[]" class="form-control integerchk" placeholder="<?php echo lang('whole_sale_price'); ?>" value="<?php echo $value->whole_sale_price ?>">  
                                    </div>
                                </td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- DataTables -->


<?php $this->view('updater/reuseJs')?>



