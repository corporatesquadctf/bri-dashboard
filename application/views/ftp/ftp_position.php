<style>
    .img-collapsable, .img-edit{
        cursor: pointer;
        float: right;
    }
</style>
<div class="right_col" role="main">    
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">FTP</li>
                            <li class="breadcrumb-item active">FTP Position</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">FTP Position</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($FTP as $row): ?>
                <div class="col-xs-12">
                    <div class="x_panel panel_container">
                        <div class="x_title collapse-link title_container">
                            <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                            <label><?= $row->Name; ?></label>
                        </div>
                        <div class="x_content content_container" style="padding:0;">
                            <?php foreach($row->FTPItems as $rowItem): ?>
                                <div class="col-xs-12" style="box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                    <div class="row" style="box-shadow: 0px 4px 4px rgba(229, 229, 229, 0.25); border-radius: 0px;">
                                        <div class="col-xs-12" style="padding:0 60px; height: 48px; display: table;">
                                            <div style="vertical-align: middle; display: table-cell; padding:0 2px;">
                                                <span style="font-weight: 600; font-size: 16px; color: #65B6F0;"><?= $rowItem->Name; ?></span>
                                                <?php if($rowItem->FTPItemId == 1) : ?><span style="font-size: 14px; color: #FF4646; margin-left: 5px;">#all values in million</span><?php endif; ?>
                                                <?php if($rowItem->FTPItemId == 2) : ?><span style="font-size: 14px; color: #FF4646; margin-left: 5px;">#USD Currency</span><?php endif; ?>
                                                <?php if($rowItem->FTPItemId == 13) : ?><span style="font-size: 14px; color: #FF4646; margin-left: 5px;">#Berdasarkan Segmen Bisnis (P.A)</span><?php endif; ?>
                                            </div>
                                            <div style="vertical-align: middle; display: table-cell; text-align: right; padding-right: 20px;">
                                                <img id="imgFTPItem_<?= $rowItem->FTPItemId; ?>" src="<?= base_url("assets/images/icons/minus.svg");?>" class="img-collapsable" data-id="<?= $rowItem->FTPItemId; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="FTPItem_<?= $rowItem->FTPItemId; ?>">
                                        <input type="hidden" id="collapsableFTPItem_<?= $rowItem->FTPItemId; ?>" name="collapsableFTPItem_<?= $rowItem->FTPItemId; ?>" value="1" />
                                        <?php if($row->FTPGroupId == 1): ?>
                                            <div class="col-xs-12" style="box-shadow: 0px 4px 4px rgba(229, 229, 229, 0.25); border-radius: 0px; padding: 0;">
                                                <div class="row" style="padding: 15px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                    <div class="col-xs-12"><img src="<?= base_url("assets/images/icons/edit.svg");?>" class="img-edit" data-id="<?= $rowItem->FTPItemId; ?>" /></div>
                                                    <div class="col-xs-1" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">No</span></div>
                                                    <div class="col-xs-3" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Saldo</span></div>
                                                    <div class="col-xs-4" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Suku Bunga Counter (% P.A)</span></div>
                                                </div>
                                                <?php
                                                    if(!empty($rowItem->FTPDetail)):
                                                        $i=1;
                                                        foreach($rowItem->FTPDetail as $rowItemDetail):
                                                            $descSaldo = "";
                                                            if($rowItemDetail->BottomMargin != null){
                                                                $btmMargin = $rowItemDetail->BottomMargin == 0 ? $rowItemDetail->BottomMargin : $rowItemDetail->BottomMargin -1;
                                                                $btmMargin = $btmMargin / 1000000;
                                                                $descSaldo .= "≥ ".number_format($btmMargin, 0, ".", ",");
                                                            }
                                                            if($rowItemDetail->TopMargin != null){
                                                                $topMargin = $rowItemDetail->TopMargin / 1000000;
                                                                $descSaldo .= " s/d ".number_format($topMargin, 0, ".", ",");
                                                            }
                                                ?>
                                                    <div class="row" style="padding: 10px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                        <div class="col-xs-1" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $i; ?></span></div>
                                                        <div class="col-xs-3" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $descSaldo; ?></span></div>
                                                        <div class="col-xs-4" style="text-align: center;"><span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->InterestRate; ?></span></div>
                                                    </div>
                                                <?php
                                                        $i++;
                                                        endforeach;
                                                    endif;
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($row->FTPGroupId == 2): ?>
                                            <div class="col-xs-12" style="box-shadow: 0px 4px 4px rgba(229, 229, 229, 0.25); border-radius: 0px; padding: 0;">
                                                <div class="row" style="padding: 15px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                    <div class="col-xs-12"><img src="<?= base_url("assets/images/icons/edit.svg");?>" class="img-edit" data-id="<?= $rowItem->FTPItemId; ?>" /></div>
                                                    <div class="col-xs-1" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">No</span></div>
                                                    <div class="col-xs-3" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Jangka Waktu</span></div>
                                                    <div class="col-xs-4" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Suku Bunga Counter (% P.A)</span></div>
                                                </div>
                                                <?php
                                                    if(!empty($rowItem->FTPDetail)):
                                                        $i=1;
                                                        foreach($rowItem->FTPDetail as $rowItemDetail):
                                                            $descTerm = $rowItemDetail->Term." Bulan";
                                                ?>
                                                    <div class="row" style="padding: 10px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                        <div class="col-xs-1" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $i; ?></span></div>
                                                        <div class="col-xs-3" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $descTerm; ?></span></div>
                                                        <div class="col-xs-4" style="text-align: center;"><span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->InterestRate; ?></span></div>
                                                    </div>
                                                <?php
                                                        $i++;
                                                        endforeach;
                                                    endif;
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($row->FTPGroupId == 3): ?>
                                            <div class="col-xs-12" style="box-shadow: 0px 4px 4px rgba(229, 229, 229, 0.25); border-radius: 0px; padding: 0;">
                                                <div class="row" style="padding: 15px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                    <div class="col-xs-12"><img src="<?= base_url("assets/images/icons/edit.svg");?>" class="img-edit" data-id="<?= $rowItem->FTPItemId; ?>" /></div>
                                                    <div class="col-xs-1" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">No</span></div>
                                                    <div class="col-xs-3" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Jangka Waktu</span></div>
                                                    <div class="col-xs-4" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Suku Bunga Counter (% P.A) < 100.000 USD</span></div>
                                                    <div class="col-xs-4" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Suku Bunga Counter (% P.A) ≥ 100.000 USD</span></div>
                                                </div>
                                                <?php
                                                    if(!empty($rowItem->FTPDetail)):
                                                        $i=1;
                                                        foreach($rowItem->FTPDetail as $rowItemDetail):
                                                            $descTerm = $rowItemDetail->Term." Bulan";
                                                ?>
                                                    <div class="row" style="padding: 10px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                        <div class="col-xs-1" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $i; ?></span></div>
                                                        <div class="col-xs-3" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $descTerm; ?></span></div>
                                                        <div class="col-xs-4" style="text-align: center;"><span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->InterestRateLess; ?></span></div>
                                                        <div class="col-xs-4" style="text-align: center;"><span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->InterestRateMore; ?></span></div>
                                                    </div>
                                                <?php
                                                        $i++;
                                                        endforeach;
                                                    endif;
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($row->FTPGroupId == 4 || $row->FTPGroupId == 6): ?>
                                            <div class="col-xs-12" style="box-shadow: 0px 4px 4px rgba(229, 229, 229, 0.25); border-radius: 0px; padding: 0;">
                                                <div class="row" style="padding: 15px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                    <div class="col-xs-12"><img src="<?= base_url("assets/images/icons/edit.svg");?>" class="img-edit" data-id="<?= $rowItem->FTPItemId; ?>" /></div>
                                                    <div class="col-xs-1" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">No</span></div>
                                                    <div class="col-xs-3" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Pinjaman</span></div>
                                                    <div class="col-xs-4" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Suku Bunga Counter (% P.A)</span></div>
                                                </div>
                                                <?php
                                                    if(!empty($rowItem->FTPDetail)):
                                                        $i=1;
                                                        foreach($rowItem->FTPDetail as $rowItemDetail):
                                                ?>
                                                    <div class="row" style="padding: 10px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                        <div class="col-xs-1" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $i; ?></span></div>
                                                        <div class="col-xs-3" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $rowItemDetail->Description; ?></span></div>
                                                        <div class="col-xs-4" style="text-align: center;"><span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->BottomMarginInterestRate; ?></span> - <span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->TopMarginInterestRate; ?></span></div>
                                                    </div>
                                                <?php
                                                        $i++;
                                                        endforeach;
                                                    endif;
                                                ?>    
                                            </div>
                                        <?php endif; ?>
                                        <?php if($row->FTPGroupId == 5): ?>
                                            <div class="col-xs-12" style="box-shadow: 0px 4px 4px rgba(229, 229, 229, 0.25); border-radius: 0px; padding: 0;">
                                                <div class="row" style="padding: 15px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                    <div class="col-xs-12"><img src="<?= base_url("assets/images/icons/edit.svg");?>" class="img-edit" data-id="<?= $rowItem->FTPItemId; ?>" /></div>
                                                    <div class="col-xs-1" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">No</span></div>
                                                    <div class="col-xs-3" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Keterangan</span></div>
                                                    <div class="col-xs-4" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Suku Bunga Counter (% P.A)</span></div>
                                                </div>
                                                <?php
                                                    if(!empty($rowItem->FTPDetail)):
                                                        $i=1;
                                                        foreach($rowItem->FTPDetail as $rowItemDetail):
                                                            if($rowItem->FTPItemId == 8 || $rowItem->FTPItemId == 9):
                                                ?>
                                                    <div class="row" style="padding: 10px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                        <div class="col-xs-1" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $i; ?></span></div>
                                                        <div class="col-xs-3" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $rowItemDetail->Description; ?></span></div>
                                                        <div class="col-xs-4" style="text-align: center;"><span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->BottomMarginInterestRate; ?></span> - <span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->TopMarginInterestRate; ?></span></div>
                                                    </div>
                                                <?php
                                                            endif;
                                                            if($rowItem->FTPItemId == 10 || $rowItem->FTPItemId == 11):
                                                                $descTenor = "";
                                                                if($rowItemDetail->BottomMarginTerm != null){
                                                                    $btmMargin = $rowItemDetail->BottomMarginTerm == 0 ? $rowItemDetail->BottomMarginTerm : $rowItemDetail->BottomMarginTerm -1;
                                                                    $descTenor .= "≥ ".number_format($btmMargin, 0, ".", ",");
                                                                }
                                                                if($rowItemDetail->TopMarginTerm != null){
                                                                    $topMargin = $rowItemDetail->TopMarginTerm;
                                                                    $descTenor .= " s/d ".number_format($topMargin, 0, ".", ",");
                                                                }                                                            
                                                ?>
                                                    <div class="row" style="padding: 10px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                        <div class="col-xs-1" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $i; ?></span></div>
                                                        <div class="col-xs-3" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $descTenor; ?></span></div>
                                                        <div class="col-xs-4" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $rowItemDetail->InterestRate; ?></div>
                                                    </div>
                                                <?php
                                                            endif;
                                                        $i++;
                                                        endforeach;
                                                    endif;
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($row->FTPGroupId == 7): ?>
                                            <div class="col-xs-12" style="box-shadow: 0px 4px 4px rgba(229, 229, 229, 0.25); border-radius: 0px; padding: 0;">
                                                <div class="row" style="padding: 15px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                    <div class="col-xs-12"><img src="<?= base_url("assets/images/icons/edit.svg");?>" class="img-edit" data-id="<?= $rowItem->FTPItemId; ?>" /></div>
                                                    <div class="col-xs-1" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">No</span></div>
                                                    <div class="col-xs-3" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Suku Bunga Dasar Kredit</span></div>
                                                    <div class="col-xs-4" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Kredit Korporasi (%)</span></div>
                                                </div>
                                                <?php
                                                    if(!empty($rowItem->FTPDetail)):
                                                        $i=1;
                                                        foreach($rowItem->FTPDetail as $rowItemDetail):
                                                ?>
                                                    <div class="row" style="padding: 10px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                        <div class="col-xs-1" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $i; ?></span></div>
                                                        <div class="col-xs-3" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $rowItemDetail->SBDK; ?></span></div>
                                                        <div class="col-xs-4" style="text-align: center;"><span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->KreditKorporasi; ?></span></div>
                                                    </div>
                                                <?php
                                                        $i++;
                                                        endforeach;
                                                    endif;
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($row->FTPGroupId == 8): ?>
                                            <div class="col-xs-12" style="box-shadow: 0px 4px 4px rgba(229, 229, 229, 0.25); border-radius: 0px; padding: 0;">
                                                <div class="row" style="padding: 15px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                    <div class="col-xs-12"><img src="<?= base_url("assets/images/icons/edit.svg");?>" class="img-edit" data-id="<?= $rowItem->FTPItemId; ?>" /></div>
                                                    <div class="col-xs-1" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">No</span></div>
                                                    <div class="col-xs-3" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">FTP</span></div>
                                                    <div class="col-xs-4" style="text-align: center;"><span style="font-weight: 600; font-size: 12px; color: #218FD8;">Suku Bunga Counter (% P.A)</span></div>
                                                </div>
                                                <?php
                                                    if(!empty($rowItem->FTPDetail)):
                                                        $i=1;
                                                        foreach($rowItem->FTPDetail as $rowItemDetail):
                                                ?>
                                                    <div class="row" style="padding: 10px 52px; margin: 0; box-shadow: 0px 2px 2px rgba(81, 118, 213, 0.05);">
                                                        <div class="col-xs-1" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $i; ?></span></div>
                                                        <div class="col-xs-3" style="text-align: center;"><span style="font-size: 12px; color: #707070;"><?= $rowItemDetail->Description; ?></span></div>
                                                        <div class="col-xs-4" style="text-align: center;"><span style="font-size: 12px; color: #707070;" class="percentage"><?= $rowItemDetail->InterestRate; ?></span></div>
                                                    </div>
                                                <?php
                                                        $i++;
                                                        endforeach;
                                                    endif;
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script>
$(document).ready(function() {
    $(".img-collapsable").click(function(){
        var id = $(this).data("id");
        var collapseStatus = $("#collapsableFTPItem_"+id).val();
        if(collapseStatus == 0){
            $("#collapsableFTPItem_"+id).val(1);
            $("#imgFTPItem_"+id).attr("src", "<?= base_url("assets/images/icons/minus.svg"); ?>");
            $("#FTPItem_"+id).fadeIn();                
        }else{
            $("#collapsableFTPItem_"+id).val(0);
            $("#imgFTPItem_"+id).attr("src", "<?= base_url("assets/images/icons/plus.svg"); ?>");
            $("#FTPItem_"+id).fadeOut();                
        }
    });

    $(".img-edit").click(function(){
        var id = $(this).data("id");
        window.location.href= "<?= base_url("ftp/ftp_position/edit_ftp_position/"); ?>"+id;
    });

    $(".money").autoNumeric("init",{
        vMax: "999999999999999",
        mDec: "0"
    });

    $(".percentage").autoNumeric("init",{
        vMax: "999"
    });
  });
</script>