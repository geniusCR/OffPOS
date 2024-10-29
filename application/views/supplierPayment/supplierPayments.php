<input type="hidden" id="print_format" value="<?php echo escape_output($this->session->userdata('print_format')); ?>">

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


    <section class="content-header">
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header"><?php echo lang('list_supplier_payment'); ?> </h3>
                <input type="hidden" class="datatable_name" data-title="<?php echo lang('list_supplier_payment'); ?>" data-id_name="datatable">
                <div class="btn_list m-right d-flex">
                    <a class="new-btn me-1" href="<?php echo base_url() ?>SupplierPayment/addSupplierPayment">
                    <iconify-icon icon="solar:add-circle-broken" width="22"></iconify-icon> <?php echo lang('add_supplier_payment'); ?>
                    </a>
                </div>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('supplier_payment'), 'secondSection'=> lang('list_supplier_payment')])?>
        </div>
    </section>



    <div class="box-wrapper">
        <div class="table-box"> 
            <div class="box-body">
                <div class="table-responsive"> 
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="w-5"><?php echo lang('sn'); ?></th>
                                <th class="w-10"><?php echo lang('date'); ?></th>
                                <th class="w-10"><?php echo lang('supplier'); ?></th>
                                <th class="w-10 text-center"><?php echo lang('amount'); ?></th>
                                <th class="w-15"><?php echo lang('payment_methods'); ?></th>
                                <th class="w-20"><?php echo lang('note'); ?></th>
                                <th class="w-10"><?php echo lang('added_by'); ?></th>
                                <th class="w-10"><?php echo lang('added_date'); ?></th>
                                <th class="w-5"><?php echo lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalAmount = 0;
                            if ($supplierPayments && !empty($supplierPayments)) {
                                $i = count($supplierPayments);
                            }
                            foreach ($supplierPayments as $spns) {
                                $totalAmount += $spns->amount;
                                ?>                       
                                <tr> 
                                    <td><?php echo $i--; ?></td> 
                                    <td><?php echo date($this->session->userdata('date_format'), strtotime($spns->date)); ?></td> 
                                    <td><?php echo getSupplierNameById($spns->supplier_id); ?></td> 
                                    <td class="text-center"> <?php echo getAmtCustom($spns->amount); ?></td>
                                    <td><?php echo getPaymentName($spns->payment_method_id); ?></td>
                                    <td><?php if ($spns->note != NULL) echo escape_output($spns->note); ?></td> 
                                    <td><?php echo escape_output($spns->added_by); ?></td>  
                                    <td><?php echo dateFormat($spns->added_date); ?></td>  
                                    <td>
                                        <div class="btn_group_wrap">
                                            <a class="btn btn-unique" href="<?php echo base_url() ?>SupplierPayment/print_invoice/<?php echo $this->custom->encrypt_decrypt($spns->id, 'encrypt'); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-original-title="<?php echo lang('print_invoice'); ?>">
                                            <i class="fas fa-print"></i>
                                            </a>
                                            <a class="btn btn-cyan" href="<?php echo base_url() ?>SupplierPayment/a4InvoicePDF/<?php echo $this->custom->encrypt_decrypt($spns->id, 'encrypt'); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-original-title="<?php echo lang('download_invoice'); ?>">
                                            <i class="fas fa-download"></i>
                                            </a>
                                            <a class="delete btn btn-danger" href="<?php echo base_url() ?>SupplierPayment/deleteSupplierPayment/<?php echo $this->custom->encrypt_decrypt($spns->id, 'encrypt'); ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="<?php echo lang('delete'); ?>">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <th></th>
                                <th></th>
                                <th><?php echo lang('total');?></th>
                                <th class="text-center"><?php echo escape_output($totalAmount) == 0 ? '' : getAmtCustom($totalAmount) ;?></th>
                                <th></th>
                                <th></th>
                                <th></th>
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

<?php $this->view('updater/reuseJs'); ?>
