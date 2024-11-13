<script src="<?php echo base_url(); ?>assets/plugins/barcode/JsBarcode.all.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>frequent_changing/css/print_barcode.css">
<div class="main-content-wrapper">

    
    <section class="content-header">
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header"><?php echo lang('print_label'); ?></h3>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('item'), 'secondSection'=> lang('print_label')])?>
        </div>
    </section>



    <div class="box-wrapper">
        <div class="table-box">
            <div class="box-body">
            <h5><?php echo lang('Each_image_will_be_printed_on_separate_page'); ?></h5>
            <div id="printableArea">
                    <div class="">
                        <?php
                        $total_item_count = sizeof($items);
                        for ($i = 0; $i < $total_item_count; $i++):   
                        for ($j = 0;
                                $j < $items[$i]['qty'];
                                $j++):
                            ?>
                            <div class="text-center border-1-default p-2">
                                <div>
                                    <?php if($items[$i]['parent_id'] != 0) { ?>
                                        <span class="font-700"><?= getItemNameById($items[$i]['parent_id']) ?></span> -
                                    <?php } ?>
                                    <span class="font-700"><?= $items[$i]['item_name'] ?></span>
                                    <?php if($items[$i]['parent_id'] != 0) { ?>
                                        (<span class="font-700"><?= $items[$i]['code'] ?></span>)
                                    <?php } ?>
                                </div>
                                <div>
                                    <img class="op__min_width_139" id="barcode<?= $items[$i]['id'] ?><?= $j ?>">
                                </div>
                                <div class="text-center item_description">
                                    <p class="font-700"><?php echo lang('code');?>: <?= $items[$i]['code'] ?></p>
                                    <p><?= getAmtCustom($items[$i]['sale_price']) ?></p>
                                    <p class="mb-0"><?php echo getBusinessName($this->session->userdata('company_id')) ?></p>
                                </div>
                            </div>
                            <div style="page-break-after: always;"></div>
                        <?php
                        endfor;
                        ?>
                        <?php for ($j = 0;
                        $j < $items[$i]['qty'];
                        $j++):
                        ?>
                            <script>
                            // inline js used for dynamic barcode generate
                            JsBarcode("#barcode<?=$items[$i]['id']?><?=$j?>", "<?=$items[$i]['code']?>", {
                                    width: 1,
                                    height: 30,
                                    fontSize: 12,
                                    textMargin: -18,
                                    margin: 0,
                                    marginTop: 0,
                                    marginLeft: 10,
                                    marginRight: 10,
                                    marginBottom: 0,
                                    displayValue: false
                                });
                            </script>
                        <?php
                        endfor;
                        endfor;
                        ?>
                    </div>
                </div>                      
            </div>
            

            <div class="box-footer">
                <a id="print_trigger" class="btn bg-blue-btn op_margin_right_5">
                    <iconify-icon icon="solar:printer-2-broken"></iconify-icon>
                    <?php echo lang('Print');?>
                </a>
                <a class="btn bg-blue-btn" href="<?php echo base_url() ?>Item/itemBarcodeGeneratorLabel">
                    <iconify-icon icon="solar:undo-left-round-broken"></iconify-icon>
                    <?php echo lang('back'); ?>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>frequent_changing/js/print_trigger.js"></script>
