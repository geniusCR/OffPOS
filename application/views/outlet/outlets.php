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
        if($outlets){
            foreach ($outlets as $value) {
                ?>
                <div class="col-12 col-sm-6 mb-3 col-md-6 col-lg-4 col-xl-3">
                    <div class="outlet-box text-center">
                        <div class="outlet_main_icon">
                            <iconify-icon icon="solar:shop-2-broken" class="outlet_main_icon"></iconify-icon>
                        </div>
                        <h3 dir="ltr" class="title"> <?php echo escape_output($value->outlet_name) . " "; ?></h3>
                        <?php if($value->outlet_code){ ?>
                        <h4 dir="ltr" class="outlet_phone"> <?php echo lang('outlet_code'); ?>: <?php echo escape_output($value->outlet_code); ?></h4>
                        <?php } ?>
                        <?php if($value->address){ ?>
                        <h4 dir="ltr" class="outlet_phone"> <?php echo lang('address'); ?>: <?php echo escape_output($value->address); ?></h4>
                        <?php } ?>
                        <?php if($value->phone){ ?>
                        <h4 dir="ltr" class="outlet_phone"><?php echo lang('phone'); ?>: <?php echo escape_output($value->phone); ?> </h4>
                        <?php } ?>
                        <?php if($value->email){ ?>
                        <h4 dir="ltr" class="outlet_phone"> <?php echo lang('email'); ?>: <?php echo escape_output($value->email); ?> </h4>
                        <?php } ?>
                        <div class="btn_box">
                            
                            <a class="bg-blue-btn btn" href="<?php echo base_url() ?>Outlet/addEditOutlet/<?php echo escape_output($this->custom->encrypt_decrypt($value->id, 'encrypt')); ?>">
                                <iconify-icon icon="solar:pen-new-round-broken" class="me-2"></iconify-icon>
                                <?php echo lang('edit'); ?>
                            </a>
                            <a class="bg-red-btn btn delete-color outlet_delete" href="<?php echo base_url() ?>Outlet/deleteOutlet/<?php echo escape_output($this->custom->encrypt_decrypt($value->id, 'encrypt')); ?>">
                                <iconify-icon icon="solar:trash-bin-minimalistic-broken" class="me-2"></iconify-icon>   
                                <?php echo lang('delete'); ?>
                            </a>
                            <div data-status="<?php echo isset($is_collapse) && $is_collapse == "No" ? '2' : '1'?>" class="outlet_responsive outlet_large <?php echo isset($is_collapse) && $is_collapse == "No" ? 'd-none' : 'd-block'?>">
                                <a class="bg-blue-btn btn" href="<?php echo base_url(); ?>Outlet/setOutletSession/<?php echo escape_output($this->custom->encrypt_decrypt($value->id, 'encrypt')); ?>">  
                                    <div class="d-flex align-items-center justify-content-center">
                                        <iconify-icon icon="solar:forward-2-broken" class="me-2"></iconify-icon>
                                    <?php echo lang('enter'); ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div data-status="<?php echo isset($is_collapse) && $is_collapse == "No" ? '2' : '1'?>" class="outlet_responsive outlet_small op_margin_top_10 <?php echo isset($is_collapse) && $is_collapse == "No" ? 'd-block' : 'd-none'?>">
                            <a class="bg-blue-btn btn" href="<?php echo base_url(); ?>Outlet/setOutletSession/<?php echo escape_output($this->custom->encrypt_decrypt($value->id, 'encrypt')); ?>">
                                <d class="flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:forward-2-broken" class="me-2"></iconify-icon>
                                <?php echo lang('enter'); ?>
                                </d>
                            </a>
                        </div>
                    </div>
                </div> 
                <?php
            }
        }
        ?>
    </div>
</div>
