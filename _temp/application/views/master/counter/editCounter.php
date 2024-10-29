<section class="main-content-wrapper">
<h3 class="display_none">&nbsp;</h3>

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
                <h3 class="top-left-header mt-2"><?php echo lang('edit_counter'); ?></h3>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('counter'), 'secondSection'=> lang('edit_counter')])?>
        </div>
    </section>


    <div class="box-wrapper">
        
        <div class="table-box">
            
            <?php echo form_open(base_url('Counter/addEditCounter/' . $encrypted_id)); ?>
            <div class="box-body">
                <div class="row">

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="form-group">
                            <label><?php echo lang('counter_name'); ?> <span class="required_star">*</span></label>
                            <input  type="text" name="name" class="form-control"
                                placeholder="<?php echo lang('counter_name'); ?>"
                                value="<?php echo escape_output($counter->name) ?>">
                        </div>
                        <?php if (form_error('name')) { ?>
                        <div class="callout callout-danger my-2">
                            <?php echo form_error('name'); ?>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="form-group">
                            <label><?php echo lang('outlet_name'); ?> <span class="required_star">*</span></label>
                            <select name="outlet_id" class="select2 form-control">
                                <option value=""><?php echo lang('select_outlet') ?></option>
                                <?php 
                                    foreach($outlets as $outlet){
                                ?>
                                <option <?php echo $counter->outlet_id == $outlet->id ? 'selected' : '' ?> value="<?php echo escape_output($outlet->id) ?>"><?php echo escape_output($outlet->outlet_name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php if (form_error('outlet_id')) { ?>
                        <div class="callout callout-danger my-2">
                            <?php echo form_error('outlet_id'); ?>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="form-group">
                            <label><?php echo lang('printer'); ?></label>
                            <select name="printer_id" class="select2 form-control">
                                <option value=""><?php echo lang('select_printer') ?></option>
                                <?php 
                                    foreach($printers as $printer){
                                ?>
                                <option <?php echo $counter->printer_id == $printer->id ? 'selected' : '' ?> value="<?php echo escape_output($printer->id) ?>"><?php echo escape_output($printer->title) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php if (form_error('printer_id')) { ?>
                        <div class="callout callout-danger my-2">
                            <?php echo form_error('printer_id'); ?>
                        </div>
                        <?php } ?>
                    </div>


                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label><?php echo lang('description'); ?></label>
                            <input  type="text" name="description" class="form-control"
                                    placeholder="<?php echo lang('description'); ?>" value="<?php echo escape_output($counter->description) ?>" >
                        </div>
                        <?php if (form_error('description')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('description'); ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn bg-blue-btn">
                    <?php echo lang('submit'); ?>
                </button>
                <input type="hidden" id="set_save_and_add_more" name="add_more">
                <button type="submit" name="submit" value="submit" class="btn bg-blue-btn" id="save_and_add_more">
                    <?php echo lang('save_and_add_more'); ?>
                </button>
                <a href="<?php echo base_url() ?>Counter/counters"
                    class="btn bg-blue-btn"><?php echo lang('back'); ?>
                </a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
        
</section>