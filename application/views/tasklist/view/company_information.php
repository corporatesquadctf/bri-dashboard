<style type="text/css">
    .panel_container{
        padding:0;
        border-radius: 4px;
    }
    .panel_container .title_container{
        border-bottom: 1px solid #e5e5e5;
        padding: 15px 30px;
        box-shadow: 0 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
    }
    .panel_container .title_container label{
        margin: 0 0 0 15px;
        font-weight: 600;
        font-size: 14px;
    }
    .content_container{
        padding: 0 0 20px 0;
        margin: 0;
        border: none;
    }
    .content_container .child_company_content{
        margin: 0;
        padding: 15px 10px;
        box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
    }
    .shadow_content_container{
        margin: 0;
        padding: 0;
        box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
    }
    /*
    .content_container .child_company_content button{
        font-size: 10px;
        line-height: 136.89%;
        letter-spacing: 0.15px;
        background: #F58C38;
        border-radius: 2px;
        color: #fff;
        width: 125px;
        height: 36px;
    }
    */
    .content_container .label_title{
        color: #218FD8;
        font-weight: 600;
        font-size: 14px;
    }
    .content_container .label_desc{
        color: #707070;
        font-weight: normal;
        font-size: 14px;
    }
    .child_content{
        padding: 5px 30px !important;
        display: flex;
    }
    .div-action{
        display: inline-flex;
        margin: auto;
        color: #F58C38;
        float: right;
    }
    .div-action i{
        font-size: 14px;
        font-weight: normal;
        margin: auto;
    }
    .div-action .fa-chevron-down:before {
        content: "none";
    }
    .div-action label{
        font-size: 14px;
        font-weight: normal;
        padding-left: 5px;
        margin-bottom: 0px;
    }
    .div-action:hover i, .div-action:hover label{
        cursor: pointer;
        font-weight: bold !important;
    }
    .label-action{
        margin:0 !important; 
        padding-left:5px !important; 
        font-weight: normal !important;
    }
    .div-cst{
        display: inline-flex;
        margin: 10px 0;
    }
    .div-disabled{
        display: inline-flex;
        margin: auto;
        color: #d4d4d4;
        float: right;
    }
    .div-disabled i{
        font-size: 14px;
        font-weight: normal;
        margin: auto;
    }
    .div-disabled .fa-chevron-down:before {
        content: "none";
    }
    .div-disabled label{
        font-size: 14px;
        font-weight: normal;
        padding-left: 5px;
        margin-bottom: 0px;
    }

    .div-action:hover i, .div-action:hover label{
        cursor: pointer;
        font-weight: bold !important;
    }
    .label-action{
        margin:0 !important; 
        padding-left:5px !important; 
        font-weight: normal !important;
    }
    .div-cst{
        display: inline-flex;
        margin: 10px 0;
    }

    .btn-data-option:not([disabled]):not(.disabled).load, .show>.btn-data-option.dropdown-toggle {
        background-color: #1c71ff!important;
    }

    .btn-data-option.load, .btn-data-option:focus {
        background-color: #1c71ff;
        color: white;
    }

    .btn-data-option {
        background-color: white;
        border-radius:10px;
        border:1px solid #d4d4d4;
        color: #d4d4d4;
    }

    .timeline h2.title:before {
        content: "";
        position: absolute;
        left: -33px;
        top: -3px;
        display: block;
        width: 24px;
        height: 24px;
        border: 3px solid #218FD8;
        border-top-color: rgb(33, 143, 216);
        border-top-style: solid;
        border-top-width: 3px;
        border-right-color: rgb(33, 143, 216);
        border-right-style: solid;
        border-right-width: 3px;
        border-bottom-color: rgb(33, 143, 216);
        border-bottom-style: solid;
        border-bottom-width: 3px;
        border-left-color: rgb(33, 143, 216);
        border-left-style: solid;
        border-left-width: 3px;
        border-image-source: initial;
        border-image-slice: initial;
        border-image-width: initial;
        border-image-outset: initial;
        border-image-repeat: initial;
        border-radius: 14px;
        background: #218FD8;
    }

</style>
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel panel_container">
                <div class="x_title collapse-link title_container" style="cursor: pointer;">
                    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                    <label style="cursor: pointer;">Group Overview</label>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content content_container">
                <?php 
                    $iAssignedCompany = 0;
                    foreach($account_planning['AssignedCompany'] as $rowAssignedCompany): ?>
                    <div class="x_panel row content_container shadow_content_container">
                        <div class="x_title row collapse-link" style="padding:0; margin:0;">
                            <div class="col-xs-12 " style="padding:0; cursor: pointer;">
                                <div class="col-xs-12" style="padding: 10px 30px 5px 30px;">
                                    <label class="label_title" style="font-size: 14px; cursor: pointer;"><?= $rowAssignedCompany->Name; ?></label>
                                          <?php 
                                            if ($AccountPlanningTabType == 'input') {
                                          ?>
                                    <div class="btn_edit_company_overview pull-right" data-id="<?=$rowAssignedCompany->VCIF; ?>">
                                        <div class="div-action">
                                            <i class="material-icons">edit</i>
                                            <label class="label-action">Edit Data</label>
                                        </div>
                                    </div>
                                          <?php 
                                            }
                                          ?>
                                </div>
                            </div>
                        </div>
                        <div class="x_content" style="padding:0;">
                            <div class="col-xs-12 col-md-12" style="padding:10px 20px 5px 20px;">
                                <div class="row form-group">
                                    <div class="col-xs-4">
                                        <div class="col-xs-12">
                                            <label class="label_title">ADDRESSS</label>
                                        </div>
                                        <div class="col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                            <?php
                                                if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                                echo '<label class="label_desc">'.$account_planning['GroupOverview'][$iAssignedCompany][0]['Address1'].'</label>'; 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="col-xs-12">
                                            <label class="label_title">GLOBAL RATINGS</label>
                                        </div>
                                        <div class="col-xs-12">
                                            <?php 
                                                if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                                echo '<label class="label_desc">'.$account_planning['GroupOverview'][$iAssignedCompany][0]['GlobalRatingName'].' '.$account_planning['GroupOverview'][$iAssignedCompany][0]['GlobalRatingDescription'].'</label>';
                                            ?>
                                        </div>  
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="col-xs-12">
                                            <label class="label_title">DOMESTIC RATINGS</label>
                                        </div>
                                        <div class="col-xs-12">
                                            <?php 
                                                if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                                echo '<label class="label_desc">'.$account_planning['GroupOverview'][$iAssignedCompany][0]['DomesticRating'].'</label>'; 
                                            ?>
                                        </div>                      
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-4">
                                        <div class="col-xs-12">
                                            <label class="label_title">CITY</label>
                                        </div>
                                        <div class="col-xs-12">
                                            <?php 
                                                if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                                echo '<label class="label_desc">'.$account_planning['GroupOverview'][$iAssignedCompany][0]['Province'].'</label>'; 
                                            ?>
                                        </div>                   
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="col-xs-12">
                                            <label class="label_title">INDUSTRY</label>
                                        </div>
                                        <div class="col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                            <?php 
                                                if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                                echo '<label class="label_desc">'.$account_planning['GroupOverview'][$iAssignedCompany][0]['IndustryName'].'</label>';
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="col-xs-12">
                                            <label class="label_title">INDUSTRY TREND</label>
                                        </div>
                                        <div class="col-xs-12">
                                            <?php 
                                                if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                                echo '<label class="label_desc">'.$account_planning['GroupOverview'][$iAssignedCompany][0]['IndustryTrend'].'</label>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="col-xs-12">
                                            <label class="label_title">LIFE CYCLE</label>
                                        </div>
                                        <div class="col-xs-12">
                                            <?php 
                                                if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                                echo '<label class="label_desc">'.$account_planning['GroupOverview'][$iAssignedCompany][0]['LifeCycle'].'</label>'; 
                                            ?>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $iAssignedCompany++; endforeach; ?>                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel panel_container">
                <div class="x_title collapse-link title_container" style=" cursor: pointer;">
                    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                    <label style="cursor: pointer;">Key Shareholder</label>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content content_container">
                    <div class="row" style="width: 100%; padding: 15px 20px;">
                      <?php 
                        if ($AccountPlanningTabType == 'input') {
                      ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-data-option form-check-label <?php if($keyShareholderDataSource=='lastyear') echo 'load'; ?>" id="btn-opt-lastyear" title="Last Year">
                                <i class="material-icons" style="font-size: 18px">history</i>
                              </label>
                              <label class="btn btn-data-option form-check-label <?php if($keyShareholderDataSource=='datamart') echo 'load'; ?>" id="btn-opt-datamart" title="Data Mart">
                                <i class="material-icons"  style="font-size: 18px">cloud_download</i>
                              </label>
                              <label class="btn btn-data-option form-check-label <?php if($keyShareholderDataSource=='manual') echo 'load'; ?>" id="btn-opt-manual" title="Manual Input">
                                <i class="material-icons" style="font-size: 18px">edit</i>
                              </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12  pull-right">
                            <div class="div-action btn_edit_key_shareholder" id="kseditbtn">
                                <i class="material-icons">edit</i>
                                <label class="label-action">Edit Data</label>
                            </div>
                        </div>
                      <?php 
                        }
                      ?>
                    </div>
                    <div class="row child_company_content" style="width: 100%; padding: 15px 20px;">
                        <div class="col-sm-6 col-xs-12" style="vertical-align: middle; text-align: center;">
                            <canvas id="shareholder-chart" height="150" width="150"></canvas>
                        </div>
                        <div class="col-sm-6 col-xs-12" style="vertical-align: middle; text-align: left;">
                            <table width="100%" style="table-layout: fixed; width: 100%">
                                <?php if (isset($account_planning['Shareholder'])) {?>
                                    <?php foreach ($account_planning['Shareholder'] as $row => $value) : ?>
                                        <tr>
                                            <td style="width: 5%; vertical-align: top;"><i class="fa fa-square" style="margin:0 5px 0  0; color:<?= $value['Color']; ?>"></i></td>
                                            <td style="width: 40%; vertical-align: top; word-break: break-word; word-wrap: break-word;"><label class="label_desc" style="margin:0; color:#505D6F; font-weight:normal; word-break: break-word; word-wrap: break-word;"><?=$value['Name']?></label></td>
                                            <td style="width: 20%; vertical-align: top; text-align:right;"><label class="label_desc" style="margin:0; color:#218FD8; font-weight:600;"><?= $value['PortionPercentage']?> %</label></td>
                                            <td style="width: 35%; vertical-align: top; text-align:right;"><label class="label_desc" style="margin:0; color:#505D6F; font-weight:600;"><?= number_format($value['Value'], 0)?></label></td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <tr>
                                            <td></td>
                                            <td><label class="label_desc" style="margin:15px 0 0 0; color:#505D6F; font-weight:bold;">Total</label></td>
                                            <td style="text-align:right;"><label class="label_desc" style="margin:15px 0 0 0; color:#218FD8; font-weight:600;"><?= number_format(round($account_planning['totalPortionShareholderPercentage']), 0); ?> %</label></td>
                                            <td style="text-align:right;"><label class="label_desc" style="margin:15px 0 0 0; color:#505D6F; font-weight:600;"><?= number_format($account_planning['totalPortionShareholder'], 0); ?></label></td>
                                        </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>             
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel panel_container">
                <div class="x_title collapse-link title_container" style=" cursor: pointer;">
                    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                    <label style="cursor: pointer;">Business Process and Organization</label>
                      <?php 
                        if ($AccountPlanningTabType == 'input') {
                      ?>
                    <div class="btn_edit_business_process_organitation pull-right">
                        <div class="div-action">
                            <i class="material-icons no-after no-before">edit</i>
                            <label class="label-action">Edit Data</label>
                        </div>
                    </div>
                      <?php 
                        }
                      ?>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content content_container">
                    <!-- GROUP STRUCTURE -->
                    <div class="row content_container shadow_content_container">
                        <div class="col-xs-12" style="padding: 0; cursor: pointer;">
                            <div class="col-xs-12" style="padding: 10px 30px 5px 30px;">
                                <label class="label_title" style="font-size: 14px; cursor: pointer;">Group Structure</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12" style="padding:0;">
                            <?php if (!empty($account_planning['FileStructure'][2])) {
                                $jmlGroupStructure = count($account_planning['FileStructure'][2]);
                                $i = 1;
                                foreach ($account_planning['FileStructure'][2] as $row => $value) : 
                                ?>
                                    <div class="col-xs-12 child_content" style="padding-right: 30px !important;">
                                        <div style="width:100%;">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <a href="<?php echo base_url().'uploads/account_planning/'.$account_planning['AccountPlanningId'].'/'.$value->FilePath;?>" target="_blank">
                                                    <i class="fa fa-file-pdf-o" style="color:red; cursor: pointer;"></i>
                                                    <label class="label_desc" style="margin-left: 5px; cursor: pointer;"><?= $value->FilePath; ?></label>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                <?php $i++; endforeach; ?>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- BUSINESS PROCESS -->
                    <div class="row content_container shadow_content_container">
                        <div class="col-xs-12" style="padding: 0; cursor: pointer;">
                            <div class="col-xs-12" style="padding: 10px 30px 5px 30px;">
                                <label class="label_title" style="font-size: 14px; cursor: pointer;">Business Process</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12" style="padding:0;">
                            <?php if (!empty($account_planning['FileStructure'][1])) {
                                $jmlBusinessProcess = count($account_planning['FileStructure'][1]);
                                $i = 1;
                                foreach ($account_planning['FileStructure'][1] as $row => $value) : 
                                ?>
                                    <div class="col-xs-12 child_content" style="padding-right: 30px !important;">
                                        <div style="width:2%;"><label class="label_desc" style="margin-bottom: 0px;"><?= $i; ?>.</label></div>
                                        <div style="width:98%;">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-4">
                                                        <label class="label_desc"><?= $value->Name; ?></label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <a href="<?php echo base_url().'uploads/account_planning/'.$account_planning['AccountPlanningId'].'/'.$value->VCIF.'/'.$value->FilePath;?>" target="_blank">
                                                        <i class="fa fa-file-pdf-o" style="color:red; cursor: pointer;"></i> 
                                                        <label class="label_desc" style="margin-left: 5px; cursor: pointer;"><?= $value->FilePath; ?></label>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                <?php $i++; endforeach; ?>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- COMPANY STRUCTURE -->
                    <div class="row content_container shadow_content_container">
                        <div class="col-xs-12" style="padding: 0; cursor: pointer;">
                            <div class="col-xs-12" style="padding: 10px 30px 5px 30px;">
                                <label class="label_title" style="font-size: 14px; cursor: pointer;">Company Structure</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12" style="padding:0;">
                            <?php if (!empty($account_planning['FileStructure'][3])) {
                                $jmlCompanyStructure = count($account_planning['FileStructure'][3]);
                                $i = 1;
                                foreach ($account_planning['FileStructure'][3] as $row => $value) : 
                                ?>
                                    <div class="col-xs-12 child_content" style="padding-right: 30px !important;">
                                        <div style="width:2%;"><label class="label_desc" style="margin-bottom: 0px;"><?= $i; ?>.</label></div>
                                        <div style="width:98%;">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-4">
                                                        <label class="label_desc"><?= $value->Name; ?></label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <a href="<?php echo base_url().'uploads/account_planning/'.$account_planning['AccountPlanningId'].'/'.$value->VCIF.'/'.$value->FilePath;?>" target="_blank">
                                                        <i class="fa fa-file-pdf-o" style="color:red; cursor: pointer;"></i> 
                                                        <label class="label_desc" style="margin-left: 5px; cursor: pointer;"><?= $value->FilePath; ?></label>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                <?php $i++; endforeach; ?>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel panel_container">
                <div class="x_title collapse-link title_container" style=" cursor: pointer;">
                    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                    <label style="cursor: pointer;">Strategic Plan</label>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content content_container">                        
                    <?php 
                    $iAssignedCompany = 0;
                    foreach($account_planning['AssignedCompany'] as $rowAssignedCompany): ?>
                    <div class="x_panel row content_container shadow_content_container">
                        <div class="x_title row collapse-link" style="padding:0; margin:0;">
                            <div class="col-xs-12" style="padding:0; cursor: pointer;">
                                <div class="col-xs-12" style="padding: 10px 30px 5px 30px;">
                                    <label class="label_title" style="font-size: 14px; cursor: pointer;"><?= $rowAssignedCompany->Name; ?></label>
                      <?php 
                        if ($AccountPlanningTabType == 'input') {
                      ?>
                                    <div class="btn_edit_strategic_plan pull-right" data-id="<?=$rowAssignedCompany->VCIF; ?>">
                                        <div class="div-action">
                                            <i class="material-icons">edit</i>
                                            <label class="label-action">Edit Data</label>
                                        </div>
                                    </div>
                      <?php 
                        }
                      ?>
                                </div>
                            </div>
                        </div>
                        <div class="x_content" style="padding:0;">
                            <div class="col-xs-12 col-md-12" style="padding:0;">
                                <?php if (!empty($account_planning['StrategicPlan'][$iAssignedCompany])) {
                                        $jmlStrategicPlan = count($account_planning['StrategicPlan'][$iAssignedCompany]);
                                        $index_strategic = 1;
                                        foreach ($account_planning['StrategicPlan'][$iAssignedCompany] as $row) : 
                                        ?>
                                        <div class="col-xs-12 child_content">
                                            <div style="width:2%;"><label class="label_desc"><?= $index_strategic; ?>.</label></div>
                                            <div style="width:18%;"><label class="label_desc" style="font-weight: bold;"><?= $row->StrategicPlanTypeName; ?></label></div>
                                            <div style="width:80%; word-break: break-word; word-wrap: break-word;"><label class="label_desc"><?= $row->Name; ?></label></div>
                                        </div>
                                    <?php $index_strategic++; endforeach; ?>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>   
                    <?php $iAssignedCompany++; endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel panel_container">
                <div class="x_title collapse-link title_container" style=" cursor: pointer;">
                    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                    <label style="cursor: pointer;">Coverage Mapping</label>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content content_container">
                    <?php 
                    $iAssignedCompany = 0;
                    foreach($account_planning['AssignedCompany'] as $rowAssignedCompany): ?>
                    <div class="x_panel row content_container shadow_content_container">
                        <div class="x_title row collapse-link" style="padding:0; margin:0;">
                            <div class="col-xs-12" style="padding: 0; cursor: pointer;">
                                <div class="col-xs-12" style="padding: 10px 30px 5px 30px;">
                                    <label class="label_title" style="font-size: 14px; cursor: pointer;"><?= $rowAssignedCompany->Name; ?></label>
                      <?php 
                        if ($AccountPlanningTabType == 'input') {
                      ?>
                                    <div class="btn_edit_coverage_mapping pull-right" data-id="<?=$rowAssignedCompany->VCIF; ?>">
                                        <div class="div-action">
                                            <i class="material-icons">edit</i>
                                            <label class="label-action">Edit Data</label>
                                        </div>
                                    </div>
                      <?php 
                        }
                      ?>
                                </div>
                            </div>
                        </div>
                        <div class="x_content" style="padding:0;">
                            <div class="col-xs-12 col-md-12" style="padding:0;">
                                <?php if (!empty($account_planning['CoverageMapping'][$iAssignedCompany])) {
                                        $jmlCoverageMapping = count($account_planning['CoverageMapping'][$iAssignedCompany]);
                                        $i = 1;
                                        foreach ($account_planning['CoverageMapping'][$iAssignedCompany] as $row) : 
                                ?>                                    
                                        <div class="col-xs-12 child_content">
                                            <div style="width:2%;"><label class="label_desc" style="margin-bottom: 0px;"><?= $i; ?>.</label></div>
                                            <div style="width:98%;">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <div class="col-xs-12">
                                                            <label class="label_title">Client Name</label>
                                                        </div>
                                                        <div class="col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                            <label class="label_desc"><?= $row->ClientName; ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <div class="col-xs-12">
                                                            <label class="label_title">Client Contact</label>
                                                        </div>
                                                        <div class="col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                            <label class="label_desc"><?= $row->ContactNumber; ?></label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <div class="col-xs-12">
                                                            <label class="label_title">Client Position</label>
                                                        </div>
                                                        <div class="col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                            <label class="label_desc"><?= $row->ClientPosition; ?></label>
                                                        </div>                      
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <div class="col-xs-12">
                                                            <label class="label_title">Other Information</label>
                                                        </div>
                                                        <div class="col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                            <label class="label_desc"><?= $row->OtherInformation; ?></label>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <div class="col-xs-12">
                                                            <label class="label_title">Bank Person Name</label>
                                                        </div>
                                                        <div class="col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                            <label class="label_desc"><?= $row->BankPerson; ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <div class="col-xs-12">
                                                            <label class="label_title">Bank Contact</label>
                                                        </div>
                                                        <div class="col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                            <label class="label_desc"><?= $row->BankContact; ?></label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <div class="col-xs-12">
                                                            <label class="label_title">Bank Position</label>
                                                        </div>
                                                        <div class="col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                            <label class="label_desc"><?= $row->BankPosition; ?></label>
                                                        </div>                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    <?php $i++; endforeach; ?>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>   
                    <?php $iAssignedCompany++; endforeach; ?>
                </div>            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="x_panel panel_container">
                <div class="x_title collapse-link title_container" style=" cursor: pointer;">
                    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                    <label style="cursor: pointer;">Recent Activities</label>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content content_container">                    
                    <div class="row content_container" style="padding: 7px 10px 7px 20px;">

                        <div class="dashboard-widget-content">
                            <ul class="list-unstyled timeline widget">
                            <?php if (!empty($account_planning['recentActivities'])) {?>
                            <?php 
                            foreach ($account_planning['recentActivities'] as $row => $value) : 
                              $DateTimeActivities = new DateTime(date($value['CreatedDate']));
                            ?>
                              <li>
                                <div class="block"; style="padding-right: 0">
                                  <div class="block_content" style="padding: 5px 0 30px 5px;">
                                    <h2 class="title">
                                      <a style="color: #F58C38; font-weight: bold; font-size: 12px;"><?= $value['Activity'] ?></a>
                                    </h2>
                                    
                                    <div class="col-xs-12 col-sm-12" style="font-size: 12px; font-weight: normal; color: #707070; padding-top: 5px; padding-bottom: 5px; padding-left: 0px">
                                        <?= $value['Message'] ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-6" style="padding-left: 0px;">
                                        <i class="material-icons" style="font-size: 16px; color: #218FD8; margin-right: 2px; vertical-align: middle;">person</i>
                                        <label style="font-size: 10px; font-weight: normal; color: #a4a4a4;"><?= $value['Name'] ?></label>
                                    </div> 
                                    <div class="col-xs-12 col-sm-6" style="float: right; text-align: right;">
                                        <i class="material-icons" style="font-size: 16px; color: #218FD8; margin-right: 2px; vertical-align: middle;" title="Date">event</i>
                                        <label style="font-size: 10px; font-weight: normal; color: #a4a4a4;"><?= $DateTimeActivities->format('d F Y'); ?></label>
                                        <i class="material-icons" style="font-size: 16px; color: #218FD8; margin-left: 5px; margin-right: 2px; vertical-align: middle;" title="Time">access_time</i>
                                        <label style="font-size: 10px; font-weight: normal; color: #a4a4a4;"><?= $DateTimeActivities->format('h:i a'); ?></label>
                                    </div>
                                    <div class="byline">
                                    </div>
                                    <p class="excerpt">
                                        <!-- Description -->
                                    </p>
                                  </div>
                                </div>
                              </li>
                            <?php endforeach; ?>
                            <?php } ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="x_panel panel_container">
                <div class="x_title collapse-link title_container" style=" cursor: pointer;">
                    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                    <label style=" cursor: pointer;">CST Member</label>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content content_container">
                    <?php foreach($account_planning['CSTMember'] as $rowCSTMember): ?>
                        <div class="row content_container shadow_content_container" style="padding: 10px 10px 10px 20px;">
                            <div class="col-xs-12 col-sm-3">
                                <?php if($rowCSTMember->ProfilePicture != null){ ?>
                                    <img class="img-responsive" src="<?= base_url('/uploads/'.$rowCSTMember->ProfilePicture); ?>" style="width: 64px; height: 64px;">
                                <?php }else{ ?>
                                    <img class="img-responsive" src="<?= base_url('/assets/images/user_profile/default.png'); ?>" style="width: 64px; height: 64px;">
                                <?php } ?>
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label style="font-size: 16px; font-weight: 600; color: #252525;"><?= $rowCSTMember->UserName; ?></label>
                                        <label style="font-size: 12px; font-weight: normal; color: #707070;">( Join Date: <?= date("d F Y", strtotime($rowCSTMember->CreatedDate)); ?> )</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="border-bottom: 1px solid #BFC8D5;">                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7">
                                        <div class="div-cst">
                                            <i class="material-icons" style="font-size: 18px; color: #218FD8; margin-right: 2px;">apartment</i>
                                            <label style="font-size: 12px; font-weight: normal; color: #707070;"><?= $rowCSTMember->UkerName; ?></label>
                                        </div>                               
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="div-cst">
                                            <i class="material-icons" style="font-size: 18px; color: #218FD8; margin-right: 2px;">business_center</i>
                                            <label style="font-size: 12px; font-weight: normal; color: #707070;"><?= $rowCSTMember->Title; ?></label>
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="alertModalLabel">Info
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </h5>
          </div>
          <div class="modal-body">
            <img src="<?= base_url('assets/images/error.png') ?>" style="width: 64px; height: 64px; margin-right: 20px;"><span id="infoMessage"> Data history not available. </span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Confirm
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </h5>
          </div>
          <div class="modal-body">
            <img src="<?= base_url('assets/images/question-icon.png') ?>" style="width: 64px; height: 64px; margin-right: 20px;"><span id="confirmMessage"> Load data from data mart? </span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancel-btn-opt" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="save-btn-opt" data-dismiss="modal">Load & Save</button>
          </div>
        </div>
      </div>
    </div>

    <script>
        var base_url = "<?= base_url(); ?>";
        var labelShareholder = [];
        var dataShareholder = [];
        var colorShareholder = [];        
        <?php
            foreach($account_planning['Shareholder'] as $row):
        ?>
            labelShareholder.push('<?= $row['Name']; ?>');
            dataShareholder.push(<?= $row['Value']; ?>);
            colorShareholder.push('<?= $row['Color']; ?>');
        <?php
            endforeach;
        ?>

  // Panel toolbox
  $(document).ready(function() {
      $('.collapse-link').on('click', function() {
          var $BOX_PANEL = $(this).closest('.x_panel'),
              $ICON = $(this).find('i'),
              $BOX_CONTENT = $BOX_PANEL.find('.x_content');
          
          // fix for some div with hardcoded fix class
          if ($BOX_PANEL.attr('style')) {
              $BOX_CONTENT.slideToggle(200, function(){
                  $BOX_PANEL.removeAttr('style');
              });
          } else {
              $BOX_CONTENT.slideToggle(200); 
              $BOX_PANEL.css('height', 'auto');  
          }

          $ICON.toggleClass('fa-chevron-up fa-chevron-down');
      });

      $('.close-link').click(function () {
          var $BOX_PANEL = $(this).closest('.x_panel');

          $BOX_PANEL.remove();
      });

        $('.btn_edit_company_overview').click(function(){

            var vcif = $(this).data('id');
            window.location.href= "<?= base_url('tasklist/AccountPlanning/editgroupoverview/'.$account_planning['AccountPlanningId'].'/company_information'); ?>/"+vcif;

        });
        
        init_shareholder_chart(dataShareholder, labelShareholder, colorShareholder);

        $('.btn_edit_business_process_organitation').click(function(){
            window.location.href= "<?= base_url('tasklist/AccountPlanning/editbusinessprocessorganisation/'.$account_planning['AccountPlanningId'].'/company_information'); ?>";
        });

        $('.btn_edit_strategic_plan').click(function(){
            var vcif = $(this).data('id');
            window.location.href= "<?= base_url('tasklist/AccountPlanning/editstrategicplan/'.$account_planning['AccountPlanningId'].'/company_information'); ?>/"+vcif;
        });

        $('.btn_edit_coverage_mapping').click(function(){
            var vcif = $(this).data('id');
            window.location.href= "<?= base_url('tasklist/AccountPlanning/editcoveragemapping/'.$account_planning['AccountPlanningId'].'/company_information'); ?>/"+vcif;
        });

        $('#kseditbtn').click(edit_shareholder);

        $("#btn-opt-lastyear").click(function(){
            $('#save-btn-opt').off();
            $('#save-btn-opt').on('click', function(){save_confirm_modal('lastyear');});
            $('#confirmMessage').html('Load data from <b>last year\'s</b> data?');
            $('#confirmModal').modal('show');
        });

        $("#btn-opt-datamart").click(function(){
            $('#save-btn-opt').off();
            $('#save-btn-opt').on('click', function(){save_confirm_modal('datamart');});
            $('#confirmMessage').html('Load data from <b>data mart</b>?');
            $('#confirmModal').modal('show');
        });

        $("#btn-opt-manual").click(function(){
            $('#btn-opt-datamart').removeClass('load');
            $('#btn-opt-lastyear').removeClass('load');
            $('#btn-opt-manual').addClass('load');
            $('#kseditbtn').removeClass("div-disabled");
            $('#kseditbtn').addClass("div-action");
            $( "#kseditbtn" ).on('click', edit_shareholder());
        });

    });

    var current_opt_load = '<?= $keyShareholderDataSource ?>';
    if(current_opt_load != 'manual') {
        $('#kseditbtn').removeClass("div-action");
        $('#kseditbtn').addClass("div-disabled");
        $('#kseditbtn').off();
    }

    function edit_shareholder(){
        window.location.href= "<?= base_url('tasklist/AccountPlanning/editkeyshareholders/'.$account_planning['AccountPlanningId'].'/company_information'); ?>";
    }

    function init_shareholder_chart(dataShareholder, labelShareholder, colorShareholder){               
        if( typeof (Chart) === 'undefined'){ return; }                
        if ($('#shareholder-chart').length){                    
        var chart_doughnut_settings = {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: labelShareholder,
                    datasets: [{
                        data: dataShareholder,
                        backgroundColor: colorShareholder
                    }]
                },
                options: { 
                    legend: false, 
                    responsive: false,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                var total = meta.total;
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = parseFloat((currentValue/total*100).toFixed(2));
                                return percentage+' %';
                            }
                        }
                    }
                },
                
            }
        
            $('#shareholder-chart').each(function(){                        
                var chart_element = $(this);
                var chart_doughnut = new Chart( chart_element, chart_doughnut_settings);                        
            });                
        }               
    }

    /*Acitve status
    lastyear | datamart | manual
    */
    function save_confirm_modal(newactive){
        $('.loaderImage').show();
        /*Load Data*/
        var loadFunction = '';
        if(newactive === 'lastyear')
            loadFunction = 'loadKeyShareholderLastYear';
        else if(newactive === 'datamart')
            loadFunction = 'loadKeyShareholderDataMart';

        $.getJSON(base_url+'tasklist/DataLoadOption/'+loadFunction+'/<?= $account_planning['AccountPlanningId'] ?>').done(function(result, status, xhr){
            if(result.status === 'success'){
                $('#btn-opt-'+current_opt_load).removeClass('load');
                $('#btn-opt-'+newactive).addClass('load');
                $('#kseditbtn').removeClass("div-action");
                $('#kseditbtn').addClass("div-disabled");
                $('#kseditbtn').off();
                current_opt_load = newactive;
                window.location.href= '<?=base_url('tasklist/AccountPlanning/view/'.$account_planning['AccountPlanningId'].'/input/company_information');?>';
            } else if(result.status === 'error'){
                if(newactive === 'lastyear'){
                    $('#infoMessage').text('Data history not available.');
                } else if(newactive === 'datamart'){
                    $('#infoMessage').text('Data mart not available.');
                }
                $('.loaderImage').hide();
                $('#alertModal').modal('show');
            }
        }).fail(function(xhr, status, error){
            // alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
            $('#infoMessage').text("Result: [" + status + "] " + error);
            $('.loaderImage').hide();
            $('#alertModal').modal('show');
        });
    }        

</script>