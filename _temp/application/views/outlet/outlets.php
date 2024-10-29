<div class="main-content-wrapper">

<?php  $is_collapse = $this->session->userdata('is_collapse'); ?>

    <?php
    if ($this->session->flashdata('exception')) {
        echo '<section class="alert-wrapper"><div class="alert alert-success alert-dismissible fade show"> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"></button>
        <div class="alert-body"><i class="icon fa fa-check me-2"></i>';
        echo escape_output($this->session->flashdata('exception'));unset($_SESSION['exception']);
        echo '</div></div></section>';
    }

    if ($this->session->flashdata('exception_2')) {
        echo '<section class="alert-wrapper"><div class="alert alert-danger alert-dismissible fade show"> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"></button>
        <div class="alert-body"><i class="icon fa fa-times me-2"></i>';
        echo ($this->session->flashdata('exception_2'));unset($_SESSION['exception_2']);
        echo '</div></div></section>';
    }

    ?>

    



    <section class="content-header">
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header mt-2"><?php echo lang('list_outlet'); ?></h3>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('outlet'), 'secondSection'=> lang('list_outlet')])?>
        </div>
    </section>



    <div class="row">
        <?php
        foreach ($outlets as $value) {
            ?>
            <div class="col-12 col-sm-6 mb-3 col-md-6 col-lg-4 col-xl-3">
                <div class="outlet-box text-center">
                    <iconify-icon icon="material-symbols:storefront-outline" width="40"></iconify-icon>
                    <h3 dir="ltr" class="title"> <?php echo escape_output($value->outlet_name) . " "; ?></h3>
                    <h4 dir="ltr" class="outlet_phone"> <?php echo lang('outlet_code'); ?>: <?php echo escape_output($value->outlet_code); ?></h4>
                    <h4 dir="ltr" class="outlet_phone"> <?php echo lang('address'); ?>: <?php echo escape_output($value->address); ?></h4>
                    <h4 dir="ltr" class="outlet_phone"> <?php echo lang('phone'); ?>: <?php echo escape_output($value->phone); ?> </h4>
                    <h4 dir="ltr" class="outlet_phone"> <?php echo lang('email'); ?>: <?php echo escape_output($value->email); ?> </h4>
                    <div class="btn_box">
                        <a class="bg-blue-btn btn" href="<?php echo base_url(); ?>Outlet/setOutletSession/<?php echo escape_output($this->custom->encrypt_decrypt($value->id, 'encrypt')); ?>"> <strong><?php echo lang('enter'); ?></strong></a>
                        <a class="bg-blue-btn btn" href="<?php echo base_url() ?>Outlet/addEditOutlet/<?php echo escape_output($this->custom->encrypt_decrypt($value->id, 'encrypt')); ?>">  <strong><?php echo lang('edit'); ?></strong></a>
                        <a data-status="<?php echo isset($is_collapse) && $is_collapse == "No" ? '2' : '1'?>" class="delete-color outlet_delete outlet_responsive outlet_large bg-red-btn btn <?php echo isset($is_collapse) && $is_collapse == "No" ? 'd-none' : 'd-block'?>" href="<?php echo base_url() ?>Outlet/deleteOutlet/<?php echo escape_output($this->custom->encrypt_decrypt($value->id, 'encrypt')); ?>">  <strong><?php echo lang('delete'); ?></strong></a>
                    </div>
                    <div data-status="<?php echo isset($is_collapse) && $is_collapse == "No" ? '2' : '1'?>" class="outlet_responsive outlet_small op_margin_top_10 <?php echo isset($is_collapse) && $is_collapse == "No" ? 'd-block' : 'd-none'?>">
                        <a class="delete-color outlet_delete bg-red-btn btn <?php echo isset($is_collapse) && $is_collapse == "No" ? 'd-block' : ''?>" href="<?php echo base_url() ?>Outlet/deleteOutlet/<?php echo escape_output($this->custom->encrypt_decrypt($value->id, 'encrypt')); ?>">  <strong><?php echo lang('delete'); ?></strong></a>
                    </div>
                </div>
            </div> 
            <?php
        }
        ?>
    </div>
</div>
