<script src="<?php echo base_url(); ?>assets/plugins/barcode/JsBarcode.all.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>frequent_changing/css/print_barcode.css">
<div class="main-content-wrapper">


    <section class="content-header">
        <div class="row justify-content-between">
            <div class="col-6 p-0">
                <h3 class="top-left-header"><?php echo lang('print_barcode'); ?></h3>
            </div>
            <?php $this->view('updater/breadcrumb', ['firstSection'=> lang('item'), 'secondSection'=> lang('print_barcode')])?>
        </div>
    </section>


    <div class="box-wrapper">
        <div class="table-box">
            <!-- general form elements -->
            <div class="box-body">
                <div id="printableArea">
                    <div class="print_div_wrapper">
                        <?php
                        for ($i = 0; $i < sizeof($items); $i++):
                        for ($j = 0;
                                $j < $items[$i]['qty'];
                                $j++):
                            ?>
                            <div class="text-center border-1-default p-2">
                                <div>
                                    <?php if($items[$i]['parent_id'] != 0) { ?>
                                        <span class="font-700"><?= getItemNameById($items[$i]['parent_id']) ?></span> - 
                                    <?php } ?>
                                    <span class="font-700"><?= $items[$i]['item_name'] ?>
                                    <?php if($items[$i]['parent_id'] != 0) { ?>
                                        (<span class="font-700"><?= $items[$i]['code'] ?></span>)
                                    <?php } ?>
                                </div>
                                <div>
                                    <img class="op__min_width_139" id="barcode<?= $items[$i]['id'] ?><?= $j ?>">
                                </div>
                                <div class="text-center item_description">
                                    <p class="font-700"><?php echo lang('code');?>: <?= $items[$i]['code'] ?></p>
                                    <p><?php echo lang('price');?>: <?= getAmtCustom($items[$i]['sale_price']) ?></p>
                                    <p class="mb-0"><?php echo getBusinessName($this->session->userdata('company_id')) ?></p>
                                </div>
                            </div>
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
                <a id="print_trigger" class="btn bg-blue-btn"><?php echo lang('Print');?></a>
                <a class="btn bg-blue-btn" href="<?php echo base_url() ?>Item/itemBarcodeGenerator"><?php echo lang('back'); ?></a>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>frequent_changing/js/print_trigger.js"></script>
