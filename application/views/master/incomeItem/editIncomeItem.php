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
                <h3 class="top-left-header mt-2"><?php echo lang('edit_income_item'); ?></h3>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('income_item'), 'secondSection'=> lang('edit_income_item')])?>
        </div>
    </section>

    <div class="box-wrapper">
        <div class="table-box"> 
            <?php echo form_open(base_url('IncomeItem/addEditIncomeItem/' . $encrypted_id)); ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-3">

                        <div class="form-group">
                            <label><?php echo lang('income_item_name'); ?> <span class="required_star">*</span></label>
                            <input  autocomplete="off" type="text" name="name" class="form-control" placeholder="<?php echo lang('income_item_name'); ?>" value="<?php echo escape_output($income_item_information->name); ?>">
                        </div>
                        <?php if (form_error('name')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('name'); ?></span>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="col-md-6 col-lg-8 mb-3">

                        <div class="form-group">
                            <label><?php echo lang('description'); ?></label>
                            <input  autocomplete="off" type="text" name="description" class="form-control" placeholder="<?php echo lang('description'); ?>" value="<?php echo escape_output($income_item_information->description); ?>">
                        </div>
                        <?php if (form_error('description')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('description'); ?></span>
                            </div>
                        <?php } ?> 

                    </div> 

                </div>
                <!-- /.box-body --> 
            </div>
            
            <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn bg-blue-btn">
                    <?php echo lang('submit'); ?></button>
                    
                <input type="hidden" id="set_save_and_add_more" name="add_more">
                <button type="submit" name="submit" value="submit" class="btn bg-blue-btn" id="save_and_add_more">
                    <?php echo lang('save_and_add_more'); ?>
                </button>
                <a href="<?php echo base_url() ?>IncomeItem/incomeItems"
                    class="btn bg-blue-btn"><?php echo lang('back'); ?>
                </a>
            </div>
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>