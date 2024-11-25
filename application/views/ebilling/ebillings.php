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
            <h3 class="filter-modal-title"><span><?php echo lang('FilterOptions'); ?></span></h3>
            <button type="button" class="close-filter-modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <i data-feather="x"></i>
                </span>
            </button>
        </header>
        <?php echo form_open(base_url() . 'Sale/sales') ?>
        <div class="row">
            <div class="col-sm-12 mb-2">
                <div class="form-group">
                    <select name="delivery_status" id="delivery_status_filter" class="form-control  select2 width_100_p" >
                        <option value=""><?php echo lang('select'); ?></option>
                        <option value="Sent" <?php echo set_select('delivery_status', 'Sent'); ?>><?php echo lang('Sent'); ?></option>
                        <option value="Returned" <?php echo set_select('delivery_status', 'Returned'); ?>><?php echo lang('Returned'); ?></option>
                        <option value="Cash Received" <?php echo set_select('delivery_status', 'Cash Received'); ?>><?php echo lang('Cash_Received'); ?></option>
                    </select>
                </div>
            </div>
            <!--<div class="clear-fix"></div>-->
            <div class="col-sm-12 col-md-6">
                <button type="submit" name="submit" value="submit" class="new-btn">
                    <iconify-icon icon="solar:hourglass-broken" width="22"></iconify-icon>
                    <?php echo lang('submit'); ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade" id="view_fe_detail_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('fe_detail_title');?></h4>
                <button type="button" class="btn-close m_close_trigger" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"><i data-feather="x"></i></span></button>
            </div>
            <div class="modal-body">
                <table class="table" id="modal_view_fe_html_set">

                </table>
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
