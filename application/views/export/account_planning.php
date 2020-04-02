<!DOCTYPE html>
<html>
<head>
<!--
<link href="http://localhost/bri-dashboard/template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="http://localhost/bri-dashboard/template/build/css/custom.css" rel="stylesheet">
-->
</head>
<style type="text/css">
	body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font-family: Rockwell, "Courier Bold", Courier, Georgia, Times, "Times New Roman", serif;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    table {
        width: 100%;
        border-spacing:0;
        border-collapse: collapse;
    }
    .table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th {
        padding: 5px;
    }
    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .hyphenate {
        overflow-wrap: break-word;
        word-wrap: break-word;
        -webkit-hyphens: auto;
        -ms-hyphens: auto;
        -moz-hyphens: auto;
        hyphens: auto;
        vertical-align: top;
    }
    .circular {
        width: 100px;
        height: 100px;
        border-radius: 50px;
        border: 3px solid #204d74;
    }
    .account-planning-overview{
        table-layout: fixed;
        width: 100%;
        font-weight: bold;
    }
    .account-planning-overview .title{
        font-size: 20pt;
        color: #000;
    }
    .account-planning-overview .year{
        font-size: 18pt;
        color: #204d74;
    }
    .account-planning-overview .division{
        font-size: 11pt;
        color: #204d74;
    }
    .account-planning-overview .classification{
        font-size: 20pt;
        color: #204d74;
    }
    .account-planning-overview .status{
        font-size: 12pt;
        color: #204d74;
    }
    .container{
		padding: 10px;
		margin-bottom: 10px;
	}
    .grey{
		background-color: #F3F3F3;
	}
	.title{
		color: #218FD8;
		font-weight: bold;
	}
	.title img{
		vertical-align: middle;
		width: 30px;
	}
	.title span{
		vertical-align: middle;
		margin-left: 1px;
		font-size: 14pt;
	}
	.group-overview-container{
		padding: 0 0 0 40px;
	}
	.wrapper{
		display: table;
		table-layout: fixed;
		width: 100%;
	}
	.group-overview-container .wrapper div{
		display: table-cell;
		width: 50%;
		padding: 2px;
	}
	.group-overview-container .wrapper .title{
		color: #707070;
		font-size: 8pt;
		font-family: Verdana, Geneva, sans-serif;
	}
	.group-overview-container .wrapper .content{
		color: #000;
		font-size: 11pt;
	}
    .key-shareholder-container{
		padding: 0 0 0 40px;
	}
	.key-shareholder-content{
		padding: 2px;
	}
	.strategic-plan-container{
		padding: 0 0 0 40px;
	}
	.strategic-plan-content{
		padding: 2px;
	}
    .li-card {
        margin: 0 0 0 20px;
        border-left: 1.5px solid #808080;
        overflow: visible;
        padding: 0;
        background: transparent;
    }
    .li-block {
        margin: 0 0 0 50px;
        overflow: visible;
        padding: 5px 25px;
        margin: 0px;
        box-shadow: none;
        border-radius: 4px;
        background: #fff;
    }
    .ellipse {
		background-image: url("<?= base_url('assets/images/icons/graduation_cap.svg'); ?>");
		background-repeat: no-repeat;
		position: absolute;
        margin-top: 10px;
        width: 12pt;
        height: 12pt;
		margin-left: -9px;
    }
    .coverage-mapping-container{
		padding: 0 0 0 40px;
	}
	.coverage-mapping-content{
		padding: 2px;
	}
	.coverage-mapping-name{
		font-size: 10pt;
		font-weight: normal;
		color: #000;
	}
	.coverage-mapping-position{
		font-size: 8pt;
		font-weight: normal;
		color: #000;
	}
    .financial-group-container{
		padding: 0 0 0 40px;
	}
	.financial-group-name{
		font-weight: bold;
		font-size: 12pt;
		margin-bottom: 10px;
		padding: 2px;
	}
	.financial-group-image{
		padding: 2px;
	}
	.financial-group-table{
		font-size:10pt;
		margin-bottom: 10px;
	}
	.financial-group-table table>thead{
		background-color: #FFFFFF;
		color: #4BB8FF;
		font-weight: bold;
	}
    .facilities-banking-container{
		padding: 0 0 0 40px;
	}
	.facilities-banking-name{
		font-size: 10pt;
		background: #218FD8; 
		font-weight: 600; 
		color: white; 
		text-align: center;
		width: 150px;
		padding: 5px;
	}
	.facilities-banking-notes{
		font-size: 9pt;
		padding: 5px 2px;
	}
	.facilities-banking-table{
		font-size:9pt;
		margin-bottom: 10px;
	}
    .progress-container{
		width: 100%;
	}			
	.progress-bar {
		width: 100%;
		background-color: #e0e0e0;
		padding: 3px;
		border-radius: 3px;
		box-shadow: inset 0 1px 3px rgba(0, 0, 0, .2);
	}	
	.progress-bar-fill {
		height: 7pt;
		display: block;
		background-color: #218FD8;
		border-radius: 3px;
		text-align: center;
		transition: width 500ms ease-in-out;
	}
	.fundings-container{
		padding: 0 0 0 40px;
	}
	.fundings-table{
		font-size:8pt;
		margin-bottom: 10px;
	}
    .services-container{
		padding: 0 0 0 40px;
	}
	.services-table{
		font-size:8pt;
		margin-bottom: 10px;
	}
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 10mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    footer {
		position: fixed; 
		bottom: 0cm; 
		left: 0cm; 
		right: 0cm;
		height: 10px;
		padding: 50px;
	}
	footer table{
        width:100%;
        border-top:1px solid #000;
    }
    footer table tr td{
        text-align: left;
        padding-top: 5px;
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    .form_actions  {
        position: absolute;
        right: 0;
        margin-right: 25px;
    }
    .form_actions .btn_cancels {
        color: #FFF;
        background-color: #218FD8;
    }
    .form_actions button {
        /* border: 1px solid #F58C38; */
        box-sizing: border-box;
        border-radius: 2px;
        font-size: 12px;
        /* color: #FFFFFF; */
    }
    .form_actions .btn-default.focus, .btn-default, .btn_cancels:focus {
        border-color: #ccc;
    }
    .btn {
        border-radius: 2px;
    }
    .btn {
        border-radius: 3px;
    }
    button, .buttons, .btn, .modal-footer .btn+.btn {
        margin-bottom: 5px;
        margin-right: 5px;
    }
    .btn-group-sm>.btn, .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }
    .btn-default {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }
    .btn {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    button, input, select, textarea {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }
</style>
<body>
    <div class="form_actions">
        <a class="btn btn-sm btn-default btn_cancels" type="button" style="width: 200px;" id="btnPrint" href="<?= base_url('export/print_account_planning/'.$AccountPlanningId); ?>" target="_blank">Download as PDF</a>
    </div>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <table class="account-planning-overview border" style="table-layout: fixed; page-break-inside: auto; border-bottom: 1px solid #000;">
                    <tr>
                        <td class="border hyphenate" style="width: 30%; padding: 10px; text-align: center; vertical-align: middle;">
                            <?php
                                if (!file_exists ('uploads/CustomerGroupLogo/'.$account_planning['Logo'])) 
                                    $img_src = base_url('uploads/CustomerGroupLogo/default.png');
                                else if (isset($account_planning['Logo']))
                                    $img_src = base_url('uploads/CustomerGroupLogo/'.$account_planning['Logo']);
                                else
                                    $img_src = base_url('uploads/CustomerGroupLogo/default.png'); 
                            ?>
                            <img src="<?= $img_src; ?>" class="circular">
                        </td>
                        <td class="border hyphenate" style="width: 70%; padding: 10px; vertical-align: middle;">
                            <label class="title"><?= html_escape($account_planning['CustomerName']); ?></label><br/>
                            <label class="year">Account Planning <?= html_escape($account_planning['Year']); ?></label><br>
                            <label class="division"><?= $account_planning["UKER"]; ?></label><br/>
                            <label class="classification"><?= $account_planning["Clasifications"]; ?></label>
                        </td>
                    </tr>
                </table>
                <?php 
                    $iAssignedCompany = 0;
                    $i = 1;
                    $totalCustomer = count($account_planning['AssignedCompany']);
                    foreach($account_planning['AssignedCompany'] as $rowAssignedCompany):
                ?>
                    <!-- Customer Name -->
                    <div class="container" style="padding:10px 0 0 0; font-weight: bold; font-size: 16pt; color: #204d74;">
                        <?php
                            if($totalCustomer > 1)
                                echo $i.". ".$rowAssignedCompany->Name; 
                            else
                                echo $rowAssignedCompany->Name; 
                        ?>
                    </div>

                    <!-- Group Overview Content -->
                    <div class="container grey" id="group-overview">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/book.svg"); ?>" />
                            <span>GROUP OVERVIEW</span>				
                        </div>
                        <div class="group-overview-container">
                            <div class="wrapper">
                                <div class="title">Global Rating</div>
                                <div class="title">Industry</div>
                            </div>
                            <div class="wrapper">
                                <div class="content">
                                    <?php 
                                        if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                            echo $account_planning['GroupOverview'][$iAssignedCompany][0]['GlobalRatingName'].' '.$account_planning['GroupOverview'][$iAssignedCompany][0]['GlobalRatingDescription'];
                                        else echo "-";
                                    ?>
                                </div>
                                <div class="content">
                                    <?php 
                                        if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                            echo $account_planning['GroupOverview'][$iAssignedCompany][0]['IndustryName'];
                                        else echo "-";
                                    ?>
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="title">Domestic Rating</div>
                                <div class="title">Industry Trend</div>
                            </div>
                            <div class="wrapper">
                                <div class="content">
                                    <?php 
                                        if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                            echo $account_planning['GroupOverview'][$iAssignedCompany][0]['DomesticRating']; 
                                        else echo "-";
                                    ?>
                                </div>
                                <div class="content">
                                    <?php 
                                        if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                            echo $account_planning['GroupOverview'][$iAssignedCompany][0]['IndustryTrend'];
                                        else echo "-";
                                    ?>
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="title">Address</div>
                            </div>
                            <div class="wrapper">
                                <div class="content">
                                    <?php
                                        if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                            echo $account_planning['GroupOverview'][$iAssignedCompany][0]['Address1'];
                                        else echo "-";
                                    ?>
                                </div>
                                <div class="content"></div>
                            </div>
                            <div class="wrapper">
                                <div class="title">City</div>
                            </div>
                            <div class="wrapper">
                                <div class="content">
                                    <?php 
                                        if(!empty($account_planning['GroupOverview'][$iAssignedCompany]))
                                        echo $account_planning['GroupOverview'][$iAssignedCompany][0]['Province']; 
                                    ?>
                                </div>
                                <div class="content"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Key Shareholder Content -->
                    <?php
                        if($rowAssignedCompany->IsMain == 1):
                    ?>
                    <div class="container grey" id="group-overview" style="margin-top: -10px;">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/flag.svg"); ?>" />
                            <span>KEY SHAREHOLDER</span>				
                        </div>
                        <div class="key-shareholder-container">
                            <div class="key-shareholder-content">
                                <div class="wrapper">
                                    <div style="display: table-cell; width: 25%; padding: 2px;">
                                        <canvas id="shareholder-chart" height="150" width="150" style="display: inline;"></canvas>
                                    </div>
                                    <div style="display: table-cell; width: 75%; padding: 2px 2px 2px 10px; vertical-align: middle;">
                                        <table style="table-layout: fixed; page-break-inside: auto;">
                                            <?php if (isset($account_planning['Shareholder'])) {?>
                                                <?php foreach ($account_planning['Shareholder'] as $row => $value) : ?>
                                                    <tr>
                                                        <td style="width: 5%; vertical-align: top;"><div style="background-color:<?= $value['Color']; ?>; color:<?= $value['Color']; ?>; font-size: 8pt; height: 8pt;"></div></td>
                                                        <td style="width: 95%; vertical-align: top; word-break: break-word; word-wrap: break-word; padding-left: 5px;"><label class="label_desc" style="margin:0; color:#505D6F; font-weight:normal; word-break: break-word; word-wrap: break-word; font-size: 8pt; vertical-align: top; "><?=$value['Name']?></label></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endif;
                    ?>

                    <!-- Strategic Plan Content -->
                    <div class="container" id="straegic-plan">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/graduation_cap.svg"); ?>" />
                            <span>STRATEGIC PLAN</span>				
                        </div>
                        <div class="strategic-plan-container">
                            <div class="strategic-plan-content">
                                <?php if (!empty($account_planning['StrategicPlan'][$iAssignedCompany])) { ?>
                                    <div>
                                        <label style="font-weight: bold; font-size: 12pt;">1 - 3 Year Strategic Plan</label>
                                    </div>
                                    <ul class='list-unstyled widget' style='max-width: 100%; list-style: none; padding-left: 0;'>
                                    <?php
                                        foreach ($account_planning['StrategicPlan'][$iAssignedCompany] as $row) : 
                                            if($row->StrategicPlanTypeId == 1){
                                    ?>
                                        <li class="li-card">
                                            <div style="position: absolute; margin-left: -13px; margin-top: 7px;">
                                                <img height="24pt" width="24pt" src="<?= base_url('assets/images/icons/ellipse.svg'); ?>" style="bacgkround:#218FD8;" />
                                            </div>
                                            <div class="li-block" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                                                <div class="block_content">
                                                    <div class="row">
                                                        <div class="col-xs-12" style="font-size: 10pt; font-weight: normal; color: #000; padding-top: 5px; padding-bottom: 5px;">
                                                            <?= $row->Name; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } endforeach; ?>
                                    </ul>
                                    <div><label style="font-weight: bold; font-size: 12pt;">> 3 Year Strategic Plan</label></div>
                                    <ul class='list-unstyled widget' style='max-width: 100%; list-style: none; padding-left: 0;'>
                                    <?php
                                        foreach ($account_planning['StrategicPlan'][$iAssignedCompany] as $row) : 
                                            if($row->StrategicPlanTypeId == 2){
                                    ?>
                                        <li class="li-card">
                                            <div style="position: absolute; margin-left: -13px; margin-top: 7px;">
                                                <img height="24pt" width="24pt" src="<?= base_url('assets/images/icons/ellipse.svg'); ?>" style="bacgkround:#218FD8;" />
                                            </div>
                                            <div class="li-block" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                                                <div class="block_content">
                                                    <div class="row">
                                                        <div class="col-xs-12" style="font-size: 10pt; font-weight: normal; color: #000; padding-top: 5px; padding-bottom: 5px;">
                                                            <?= $row->Name; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } endforeach; ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- Coverage Mapping Content -->
                    <div class="container grey" id="coverage-mapping">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/wrench.svg"); ?>" />
                            <span>COVERAGE MAPPING</span>				
                        </div>
                        <div class="coverage-mapping-container">
                            <div class="wrapper">
                                <div style="display: table-cell; width: 50%;">
                                    <span style="font-weight: bold;">Client Contact</span>
                                </div>
                                <div style="display: table-cell; width: 50%;">
                                    <span style="font-weight: bold;">Bank Contact</span>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($account_planning['CoverageMapping'][$iAssignedCompany])) {
                            $jmlCoverageMapping = count($account_planning['CoverageMapping'][$iAssignedCompany]);
                            $i = 1;
                            foreach ($account_planning['CoverageMapping'][$iAssignedCompany] as $row) : 
                        ?>
                        <div class="coverage-mapping-container">
                            <div class="wrapper">
                                <div style="display: table-cell; width: 50%;">
                                    <div class="wrapper">
                                        <div style="display: table-cell; width: 10%; padding: 5px 2px; vertical-align: middle;">
                                            <!--<img src="<?= base_url("assets/images/icons/boss.svg"); ?>" style="width:100%;" />-->
                                            <img height="24pt" width="24pt" src="<?= base_url('assets/images/icons/ellipse.svg'); ?>" style="bacgkround:#218FD8;" />
                                        </div>
                                        <div style="display: table-cell; width: 90%; padding: 5px 2px; vertical-align: middle;">
                                            <div>
                                                <span class="coverage-mapping-name"><?= $row->ClientName." -"; ?></span>
                                                <span class="coverage-mapping-position"><?= $row->ClientPosition; ?></span>
                                            </div>
                                            <div>
                                                <span class="coverage-mapping-position"><?= $row->ContactNumber ? $row->ContactNumber : "-"; ?>&nbsp;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: table-cell; width: 50%;">
                                    <div class="wrapper">
                                        <div style="display: table-cell; width: 10%; padding: 5px 2px; vertical-align: middle;">
                                            <!--<img src="<?= base_url("assets/images/icons/boss.svg"); ?>" style="width:100%;" />-->
                                            <img height="24pt" width="24pt" src="<?= base_url('assets/images/icons/ellipse.svg'); ?>" style="bacgkround:#218FD8;" />
                                        </div>
                                        <div style="display: table-cell; width: 90%; padding: 5px 2px; vertical-align: middle;">
                                            <div>
                                                <span class="coverage-mapping-name"><?= $row->ClientName." -"; ?></span>
                                                <span class="coverage-mapping-position"><?= $row->BankPosition; ?></span>
                                            </div>
                                            <div>
                                                <span class="coverage-mapping-position"><?= $row->BankContact ? $row->BankContact : "-"; ?>&nbsp;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; } ?>
                    </div>

                    <!-- Financial Highlight Content -->
                    <?php
                        if($rowAssignedCompany->IsMain == 1):
                    ?>
                    <div class="container" id="financial-highlight">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/flag.svg"); ?>" />
                            <span>FINANCIAL HIGHLIGHT</span>				
                        </div>
                        <?php foreach ($account_planning['FinancialHighlight'] as $row => $value) : ?>
                        <div class="financial-group-container">
                            <div class="financial-group-name">
                                <span><?=$value[0]['FinancialHighlightGroupName']?></span>
                            </div>
                            <?php if ($value[0]['FinancialHighlightGroupId'] == 1 || $value[0]['FinancialHighlightGroupId'] == 2) { ?>
                                <div class="facilities-banking-notes" style="margin-bottom: 10px;">
                                    Notes : <span style="color: #F58C38 !important;"><?=View_Notes1?></span>
                                </div>
                            <?php } ?>
                            <?php
                                if ($value[0]['FinancialHighlightGroupId'] == 1 || $value[0]['FinancialHighlightGroupId'] == 2 || $value[0]['FinancialHighlightGroupId'] == 3 || $value[0]['FinancialHighlightGroupId'] == 5 || $value[0]['FinancialHighlightGroupId'] == 6) { 
                            ?>
                                    <?php if ($value[0]['FinancialHighlightGroupId'] == 3 || $value[0]['FinancialHighlightGroupId'] == 5 || $value[0]['FinancialHighlightGroupId'] == 6) { ?>
                                        <div class="financial-group-image"><canvas id="FinancialHighlight_barChart_<?=$value[0]['FinancialHighlightGroupId']?>"></canvas></div>
                                    <?php } else {?>
                                        <div class="financial-group-image"><canvas id="FinancialHighlight_lineChart_<?=$value[0]['FinancialHighlightGroupId']?>" height="100px"></canvas></div>
                                    <?php } ?>
                                    <div class="financial-group-table">
                                        <table class="table table-condensed table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <td colspan="2">Table Sheet</td>
                                                    <td style="text-align: right; width: 20%;"><?= $account_planning['Years'][0] ?></td>
                                                    <td style="text-align: right; width: 20%;"><?= $account_planning['Years'][1] ?></td>
                                                    <td style="text-align: right; width: 20%;"><?= $account_planning['Years'][2] ?></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if (isset($value['FinancialHighlight_details'])) { 
                                                        $iColor = 0;
                                                        foreach ($value['FinancialHighlight_details'] as $rows) : ?>
                                                            <tr>
                                                                <td style="width:5%; vertical-align: middle; ">
                                                                    <div style="background-color:<?= $account_planning['backgroundColors'][$iColor]; ?>; color:<?= $account_planning['backgroundColors'][$iColor]; ?>; font-size: 10pt; height: 10pt;"></div>
                                                                </td>
                                                                <td><?=$rows[0]['FinancialHighlightItemName']?></td>
                                                                <td style="text-align: right;"><?= $rows[$account_planning['Years'][0]]['Amount'] ?></td>
                                                                <td style="text-align: right;"><?= $rows[$account_planning['Years'][1]]['Amount'] ?></td>
                                                                <td style="text-align: right;"><?= $rows[$account_planning['Years'][2]]['Amount'] ?></td>
                                                            </tr>
                                                <?php
                                                        $iColor++;
                                                        endforeach;
                                                    }
                                                    if (isset($value['FinancialHighlight_details2'])) {
                                                        foreach ($value['FinancialHighlight_details2'] as $rows) : 
                                                ?>
                                                            <tr>
                                                                <td></td>
                                                                <td><?=$rows[0]['FinancialHighlightItemName']?></td>
                                                                <td style="text-align: right;"><?= $rows[$account_planning['Years'][0]]['Amount'] ?></td>
                                                                <td style="text-align: right;"><?= $rows[$account_planning['Years'][1]]['Amount'] ?></td>
                                                                <td style="text-align: right;"><?= $rows[$account_planning['Years'][2]]['Amount'] ?></td>
                                                            </tr>
                                                <?php
                                                        endforeach;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                            <?php } else if ($value[0]['FinancialHighlightGroupId'] == 4) { ?>
                                    <div class="financial-group-table">
                                        <table class="table table-condensed table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <td style="width: 40%;">Table Sheet</td>
                                                    <td style="text-align: right; width: 20%;"><?= $account_planning['Years'][0] ?></td>
                                                    <td style="text-align: right; width: 20%;"><?= $account_planning['Years'][1] ?></td>
                                                    <td style="text-align: right; width: 20%;"><?= $account_planning['Years'][2] ?></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($value['FinancialHighlight_details'] as $rows) : ?>
                                                <tr>
                                                    <td><?=$rows[0]['FinancialHighlightItemName']?></td>
                                                    <td style="text-align: right;"><?= $rows[$account_planning['Years'][0]]['Amount'] ?></td>
                                                    <td style="text-align: right;"><?= $rows[$account_planning['Years'][1]]['Amount'] ?></td>
                                                    <td style="text-align: right;"><?= $rows[$account_planning['Years'][2]]['Amount'] ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                            <?php } ?>
                        </div>
                        <?php endforeach; ?>
                    </div>			
                    <?php
                        endif;
                    ?>

                    <!-- Facilities With Banking -->
                    <div class="container grey" id="facilities-banking">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/graduation_cap.svg"); ?>" />
                            <span>FACILITIES BANKING</span>				
                        </div>
                        <?php foreach ($account_planning['FacilitiesBanking'] as $row => $value) : ?>
                            <div class="facilities-banking-container">
                                <div class="facilities-banking-name">
                                    <span><?=$value[0]['BankFacilityGroupName']?></span>
                                </div>
                                <div class="facilities-banking-notes">
                                    Notes : <span style="color: #F58C38 !important;"><?=View_Notes1?></span>
                                </div>
                                <div class="facilities-banking-table">
                                    <table class="table">
                                        <tbody>
                                            <?php if (isset($value['FacilitiesBanking_details'][$rowAssignedCompany->VCIF])) { ?>
                                                <?php foreach ($value['FacilitiesBanking_details'][$rowAssignedCompany->VCIF] as $rows => $values) : ?>
                                                <tr>
                                                    <td rowspan="2" style="vertical-align: top; width: 30%; border-top: 1px solid #ddd; padding:5px 0;"><?=$values['BankFacilityItemName']?></td>
                                                    <td style="text-align: left; vertical-align: top; width: 15%; border-top: 1px solid #ddd; padding: 5px;">IDR</td>
                                                    <td style="text-align: right; vertical-align: top; width: 30%; border-top: 1px solid #ddd; padding: 5px;">
                                                        <label class="money"><?=$values['IDRAmount']?></label>
                                                    </td>
                                                    <td style="text-align: center; vertical-align: top; border-top: 1px solid #ddd; padding: 5px;">
                                                            <label class="money"><?=$values['IDRRate']?></label> %
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; vertical-align: top; border-top: 1px solid #ddd; padding: 5px;">Valas</td>
                                                    <td style="text-align: right; vertical-align: top; border-top: 1px solid #ddd; padding: 5px;">
                                                        <label class="money"><?=$values['ValasAmount']?></label></td>
                                                    <td style="text-align: center; vertical-align: top; border-top: 1px solid #ddd; padding: 5px;">
                                                        <label class="money"><?=$values['ValasRate']?></label> %
                                                    </td>
                                                </tr>                                            
                                                <?php endforeach; ?>
                                                <?php } ?>
                                                <?php if (isset($value['BankFacilityAddition_detail'][$rowAssignedCompany->VCIF])) { ?>
                                                    <?php foreach ($value['BankFacilityAddition_detail'][$rowAssignedCompany->VCIF] as $rows => $values) : ?>
                                                <tr>
                                                    <td rowspan="2" style="vertical-align: top; width: 30%; border-top: 1px solid #ddd; padding:5px 0;"><?=$values['BankFacilityItemAdditionName']?></td>
                                                    <td style="text-align: left; vertical-align: top; width: 15%; border-top: 1px solid #ddd; padding: 5px;">IDR</td>
                                                    <td style="text-align: right; vertical-align: top; width: 30%; border-top: 1px solid #ddd; padding: 5px;">
                                                        <label class="money"><?=$values['IDRAmountAddition']?></label>
                                                    </td>
                                                    <td style="text-align: center; vertical-align: top; border-top: 1px solid #ddd; padding: 5px;">
                                                            <label class="money"><?=$values['IDRRateAddition']?></label> %
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; vertical-align: top; border-top: 1px solid #ddd; padding: 5px;">Valas</td>
                                                    <td style="text-align: right; vertical-align: top; border-top: 1px solid #ddd; padding: 5px;">
                                                        <label class="money"><?=$values['ValasAmountAddition']?></label></td>
                                                    <td style="text-align: center; vertical-align: top; border-top: 1px solid #ddd; padding: 5px;">
                                                        <label class="money"><?=$values['ValasRateAddition']?></label> %
                                                    </td>
                                                </tr>                                            
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Wallet Share -->
                    <div class="container" id="wallet-share">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/graduation_cap.svg"); ?>" />
                            <span>WALLET SHARE ANALYSIS</span>				
                        </div>
                        <?php foreach ($account_planning['WalletShare'] as $row => $value) : ?>
                            <div class="facilities-banking-container">
                                <div class="facilities-banking-name">
                                    <span><?=$value[0]['BankFacilityGroupName']?></span>
                                </div>
                                <div class="facilities-banking-notes">
                                    Notes : <span style="color: #F58C38 !important;"><?=View_Notes1?></span>
                                </div>
                                <div class="facilities-banking-table">
                                    <table style="font-size: 7pt;">
                                        <thead>
                                            <tr>
                                                <th style="color: #4BB8FF; padding: 5px 5px 5px 0; width: 15%; text-align: left;">Facility</th>
                                                <th style="color: #4BB8FF; padding: 5px; width: 25%; text-align: left;">Total</th>
                                                <th style="color: #4BB8FF; padding: 5px; width: 25%; text-align: left;">BRI Nominal</th>
                                                <th style="color: #4BB8FF; padding: 5px; width: 25%; text-align: left;">BRI Portion</th>
                                                <th style="color: #4BB8FF; padding: 5px; width: 10%; text-align: left;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(!empty($value['WalletShare_details'][$rowAssignedCompany->VCIF])):
                                                foreach ($value['WalletShare_details'][$rowAssignedCompany->VCIF] as $rows => $WalletShare) :
                                            ?>
                                            <tr>
                                                <td style="padding: 5px 5px 5px 0; border-top: 1px solid #ddd;"><?= $WalletShare['BankFacilityItemName']; ?></td>
                                                <td style="padding: 5px; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShare['TotalAmount']; ?></td>
                                                <td style="padding: 5px; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShare['BRINominal']; ?></td>
                                                <td style="padding: 5px; border-top: 1px solid #ddd;">
                                                    <?php if($WalletShare['BRIPortion'] > 0): ?>
                                                    <div class="progress-container">
                                                        <div class="progress-bar">
                                                            <span class="progress-bar-fill" style="width: <?= $WalletShare['BRIPortion']; ?>%;"></span>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="padding: 5px; border-top: 1px solid #ddd;"><?= $WalletShare['BRIPortion']; ?>%</td>                                              
                                            </tr>
                                            <?php 
                                                endforeach; 
                                                endif;
                                            ?>
                                            <?php 
                                                if(!empty($value['WalletShareAddition_detail'][$rowAssignedCompany->VCIF])):
                                                foreach ($value['WalletShareAddition_detail'][$rowAssignedCompany->VCIF] as $rows => $WalletShareAddition) : 
                                            ?>
                                            <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                <td style="padding: 5px 5px 5px 0; border-top: 1px solid #ddd;"><?= $WalletShareAddition['BankFacilityItemAdditionName']; ?></td>
                                                <td style="padding: 5px; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShareAddition['TotalAmountAddition']; ?></td>
                                                <td style="padding: 5px; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShareAddition['BRINominalAddition']; ?></td>
                                                <td style="padding: 5px; border-top: 1px solid #ddd;">
                                                    <?php if($WalletShareAddition['BRIPortionAddition'] > 0): ?>
                                                    <div class="progress-container">
                                                        <div class="progress-bar">
                                                            <span class="progress-bar-fill" style="width: <?= $WalletShareAddition['BRIPortionAddition']; ?>%;"></span>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="padding: 5px; border-top: 1px solid #ddd;"><?= $WalletShareAddition['BRIPortionAddition']; ?>%</td>                                                  
                                            </tr>
                                            <?php 
                                                endforeach;
                                                endif;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Competition Analysis -->
                    <div class="container grey" id="competition-anlysis">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/graduation_cap.svg"); ?>" />
                            <span>COMPETITION ANALYSIS</span>				
                        </div>
                        <?php foreach ($account_planning['CompetitionAnalysis'] as $row => $value) : ?>
                            <div class="facilities-banking-container">
                                <div class="facilities-banking-name" style="margin-bottom: 10px;">
                                    <span><?=$value[0]['BankFacilityGroupName']?></span>
                                </div>
                                <div class="facilities-banking-table">
                                    <table>
                                        <tbody>
                                            <?php if (isset($value['CompetitionAnalysis_detail'])) { ?>
                                                <?php foreach ($value['CompetitionAnalysis_detail'] as $rows => $values) : ?>
                                                    <tr style="color: #218FD8; font-weight: bold;">
                                                        <td colspan="3" style="border-bottom: 1px solid #ddd; border-top: none;"><?=$values['BankFacilityItemName']?></td>
                                                    </tr>
                                                    <tr style="color: #73879C; font-size: 8pt;">
                                                        <td>Bank Name #1</td>
                                                        <td>Bank Name #2</td>
                                                        <td>Bank Name #3</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;"><?=$values['BankName1']?></td>
                                                        <td style="border-top: none;"><?=$values['BankName2']?></td>
                                                        <td style="border-top: none;"><?=$values['BankName3']?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Fundings -->
                    <div class="container" id="fundings">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/wrench.svg"); ?>" />
                            <span>FUNDINGS</span>				
                        </div>
                        <div class="fundings-container">
                            <div class="fundings-table">
                                <table>
                                    <thead style="color: #4BB8FF; font-weight: bold;">
                                    <tr>
                                        <td style="width: 5%; padding: 2px">No.</td>
                                        <td style="width: 25%; padding: 2px;">Kebutuhan Pendanaan</td>
                                        <td style="width: 15%; padding: 2px;">Jangka Waktu</td>
                                        <td style="width: 25%; padding: 2px;">Nominal</td>
                                        <td style="padding: 2px; width: 30%;">Description</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($account_planning['Funding'][$rowAssignedCompany->VCIF])) {?>
                                        <?php $index_funding = 1; ?>
                                        <?php foreach ($account_planning['Funding'][$rowAssignedCompany->VCIF] as $row => $value) : ?>
                                        <tr>
                                            <td class="hyphenate" style="width: 5%; padding: 2px;"><?= $index_funding ?></td>
                                            <td class="hyphenate" style="width: 25%; padding: 2px;"><?=$value['FundingNeed']?></td>
                                            <td class="hyphenate" style="width: 15%; padding: 2px;"><?=$value['TimePeriod']?> Bulan</td>
                                            <td class="hyphenate" style="width: 25%; padding: 2px;">Rp. <?=number_format($value['Amount'], 2)?></td>
                                            <td class="hyphenate" style="width: 30%; padding: 2px;"><?=$value['Description']?></td>
                                        </tr>
                                        <?php $index_funding++?>
                                        <?php endforeach; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="container grey" id="services">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/wrench.svg"); ?>" />
                            <span>SERVICES</span>				
                        </div>
                        <div class="services-container">
                            <div class="services-table">
                                <table style="table-layout: fixed;">
                                    <thead style="color: #4BB8FF; font-weight: bold;">
                                        <tr>
                                            <td style="width: 5%; padding: 2px 2px 2px 0">No.</td>
                                            <td style="width: 35%; padding: 2px;">Service Name</td>
                                            <td style="width: 15%; padding: 2px;">Service Target</td>
                                            <td style="padding: 2px;">Service Description</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($account_planning['Service'][$rowAssignedCompany->VCIF])) {?>
                                        <?php $idxServices = 1; ?>
                                        <?php foreach ($account_planning['Service'][$rowAssignedCompany->VCIF] as $row => $value) : ?>
                                        <tr>
                                            <td class="hyphenate" style="padding: 2px 2px 2px 0;"><?= $idxServices ?></td>
                                            <td class="hyphenate" style="padding: 2px;"><?=$value['ServiceName']?></td>
                                            <td class="hyphenate" style="padding: 2px;"><?=$value['ServiceTarget']?> Bulan</td>
                                            <td class="hyphenate" style="padding: 2px;"><?=$value['ServiceDescription']?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3" style="padding: 2px;">
                                                <?php if (isset($value['TagServiceUnitKerja'])) {?>
                                                <?php foreach ($value['TagServiceUnitKerja'] as $rows => $values) : ?>
                                                <label class="label label-info" style="background-color: #5bc0de; color: #FFF; padding: 2px; border-radius: 2px;"># <?=$values['TagServiceUnitKerja']?></label>
                                                <?php endforeach; ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $idxServices++?>
                                        <?php endforeach; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Estimated Financial -->
                    <div class="container" id="estimated-financial">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/graduation_cap.svg"); ?>" />
                            <span>ESTIMATED FINANCIAL</span>				
                        </div>
                        <?php foreach ($account_planning['EstimatedFinancial'] as $row => $value) : ?>
                            <div class="facilities-banking-container">
                                <div class="facilities-banking-name">
                                    <span><?=$value[0]['BankFacilityGroupName']?></span>
                                </div>
                                <div class="facilities-banking-notes">
                                    Notes : <span style="color: #F58C38 !important;"><?=View_Notes1?></span>
                                </div>
                                <div class="facilities-banking-table">
                                    <table style="font-size: 7pt;">
                                        <thead>
                                            <tr>
                                                <th style="color: #4BB8FF; padding: 5px 5px 5px 0; width: 15%; text-align: left;">Facility</th>
                                                <th style="color: #4BB8FF; padding: 5px; width: 12%; text-align: left;">Currency</th>
                                                <th style="color: #4BB8FF; padding: 5px; width: 20%; text-align: right;">Projection Customer</th>
                                                <th style="color: #4BB8FF; padding: 5px; width: 25%; text-align: right;">Target BRI</th>
                                                <th style="color: #4BB8FF; padding: 5px; width: 20%; text-align: left;">Portion</th>
                                                <th style="color: #4BB8FF; padding: 5px; width: 8%; text-align: left;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(!empty($value['EstimatedFinancial_detail'][$rowAssignedCompany->VCIF])):
                                                foreach ($value['EstimatedFinancial_detail'][$rowAssignedCompany->VCIF] as $rows => $EstimatedFinancial) :
                                            ?>
                                            <tr>
                                                <td rowspan="2" style="padding: 5px 5px 5px 0; border-top: 1px solid #ddd;"><?=$EstimatedFinancial['BankFacilityItemName']?></td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">IDR</td>
                                                <td style="text-align: right; padding: 5px; border-top: 1px solid #ddd;"><?=$EstimatedFinancial['IDRProjection']?></td>
                                                <td style="text-align: right; padding: 5px; border-top: 1px solid #ddd;"><?=$EstimatedFinancial['IDRTarget']?></td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">
                                                    <?php if($EstimatedFinancial['IDRProgressValue'] > 0): ?>
                                                    <div class="progress-container">
                                                        <div class="progress-bar">
                                                            <span class="progress-bar-fill" style="width: <?= $EstimatedFinancial['IDRProgressValue']; ?>%;"></span>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">
                                                    <?=$EstimatedFinancial['IDRProgressValue']?> %
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">Valas</td>
                                                <td style="text-align: right; padding: 5px; border-top: 1px solid #ddd;"><?=$EstimatedFinancial['ValasProjection']?></td>
                                                <td style="text-align: right; padding: 5px; border-top: 1px solid #ddd;"><?=$EstimatedFinancial['ValasTarget']?></td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">
                                                    <?php if($EstimatedFinancial['ValasProgressValue'] > 0): ?>
                                                    <div class="progress-container">
                                                        <div class="progress-bar">
                                                            <span class="progress-bar-fill" style="width: <?= $EstimatedFinancial['ValasProgressValue']; ?>%;"></span>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">
                                                    <?=$EstimatedFinancial['ValasProgressValue']?> %
                                                </td>
                                            </tr>
                                            <?php 
                                                endforeach; 
                                                endif;
                                            ?>
                                            <?php 
                                                if(!empty($value['EstimatedFinancialAddition_detail'][$rowAssignedCompany->VCIF])):
                                                foreach ($value['EstimatedFinancialAddition_detail'][$rowAssignedCompany->VCIF] as $rows => $EstimatedFinancialAddition) :
                                            ?>
                                            <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                <td rowspan="2" style="padding: 5px 5px 5px 0; border-top: 1px solid #ddd;"><?=$EstimatedFinancialAddition['BankFacilityItemAdditionName']?></td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">IDR</td>
                                                <td style="text-align: right; padding: 5px; border-top: 1px solid #ddd;"><?=$EstimatedFinancialAddition['IDRProjectionAddition']?></td>
                                                <td style="text-align: right; padding: 5px; border-top: 1px solid #ddd;"><?=$EstimatedFinancialAddition['IDRTargetAddition']?></td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">
                                                    <?php if($EstimatedFinancialAddition['IDRProgressAdditionValue'] > 0): ?>
                                                    <div class="progress-container">
                                                        <div class="progress-bar">
                                                            <span class="progress-bar-fill" style="width: <?= $EstimatedFinancialAddition['IDRProgressAdditionValue']; ?>%;"></span>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">
                                                    <?=$EstimatedFinancialAddition['IDRProgressAdditionValue']?> %
                                                </td>
                                            </tr>
                                            <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">Valas</td>
                                                <td style="text-align: right; padding: 5px; border-top: 1px solid #ddd;"><?=$EstimatedFinancialAddition['ValasProjectionAddition']?></td>
                                                <td style="text-align: right; padding: 5px; border-top: 1px solid #ddd;"><?=$EstimatedFinancialAddition['ValasTargetAddition']?></td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">
                                                    <?php if($EstimatedFinancialAddition['ValasProgressAdditionValue'] > 0): ?>
                                                    <div class="progress-container">
                                                        <div class="progress-bar">
                                                            <span class="progress-bar-fill" style="width: <?= $EstimatedFinancialAddition['ValasProgressAdditionValue']; ?>%;"></span>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: left; padding: 5px; border-top: 1px solid #ddd;">
                                                    <?=$EstimatedFinancialAddition['ValasProgressAdditionValue']?> %
                                                </td>
                                            </tr>
                                            <?php 
                                                endforeach; 
                                                endif;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Initiative Action -->
                    <div class="container grey" id="initiative-action">
                        <div class="title">
                            <img src="<?= base_url("assets/images/icons/graduation_cap.svg"); ?>" />
                            <span>INITIATIVE & ACTION PLAN</span>				
                        </div>
                        <div class="services-container">
                            <div class="services-table">
                                <table style="table-layout: fixed;">
                                    <thead style="color: #4BB8FF; font-weight: bold;">
                                        <tr>
                                            <td style="width: 5%; padding: 2px 2px 2px 0">No.</td>
                                            <td style="width: 35%; padding: 2px;">Initiatives</td>
                                            <td style="width: 15%; padding: 2px;">Action Plans</td>
                                            <td style="padding: 2px;">Description</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($account_planning['InitiativeAction'][$rowAssignedCompany->VCIF])) {?>
                                        <?php $index = 1; ?>
                                        <?php foreach ($account_planning['InitiativeAction'][$rowAssignedCompany->VCIF] as $row => $value) : ?>
                                        <tr>
                                            <td class="hyphenate" style="padding: 2px 2px 2px 0;"><?= $index ?></td>
                                            <td class="hyphenate" style="padding: 2px;"><?=$value['Name']?></td>
                                            <td class="hyphenate" style="padding: 2px;"><?=$value['DateTimePeriod']?></td>
                                            <td class="hyphenate" style="padding: 2px;"><?=$value['Description']?></td>
                                        </tr>
                                        <?php $index++?>
                                        <?php endforeach; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
                    $i++;
                    endforeach;
                ?>
                <div class="container" id="cpa">
                    <div style="padding:10px 0 0 0; font-weight: bold; font-size: 16pt; color: #204d74; margin-bottom: 10px;">
                        <span>CUSTOMER PROFITABILITY ANALYSIS</span>				
                    </div>
                    <div>
                        <div class="services-table">
                            <span style="font-size: 12pt; color: #204d74; margin-bottom: 5px; font-weight: bold;">CPA Existing</span>
                            <h4 style="margin: 5px 0; color: #4BB8FF; font-weight: bold;">SIMPANAN</h4>
                            <table width="100%" class="table" cellpadding="20" cellspacing="20">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;">Keterangan</th>
                                        <th style="text-align: right; padding-right: 20px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td align="left">1</td> -->
                                        <td >Saldo </td>
                                        <td align="right"><?= number_format($Existing['SaldoSimpanan']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <!-- <td align="left">2</td> -->
                                        <td >Ratas Harian Saldo </td>
                                        <td align="right"><?= number_format($Existing['AverageSaldoSimpanan']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <!-- <td align="left">3</td> -->
                                        <td >Fee Based Income </td>
                                        <td align="right"><?= number_format($Existing['AkumulasiNominalFeeSimpanan']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <!-- <td align="left">4</td> -->
                                        <td >Beban Bunga </td>
                                        <td align="right"><?= number_format($Existing['BebanBunga']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <!-- <td align="left">5</td> -->
                                        <td >Beban Bunga Akumulasi </td>
                                        <td align="right"><?= number_format($Existing['BebanBungaAkumulasi']/VALUE_PER) ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <td align="left">6</td>
                                        <td >Jumlah Rekening </td>
                                        <td align="right"><?= number_format($Existing['JumlahRekSimpanan']) ?></td>
                                    </tr> -->
                                </tbody>
                            </table>
                            <h4 style="margin: 5px 0; color: #4BB8FF; font-weight: bold;">PINJAMAN</h4>
                            <table width="100%" class="table" cellpadding="20" cellspacing="20">
                                <thead>
                                    <tr>
                                        <th style="width: 3%"><!-- No --></th>
                                        <th style="text-align: left;">Keterangan</th>
                                        <th style="text-align: right; padding-right: 20px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>
                                        <td align="left">1</td>
                                        <td >Nilai Tercatat </td>
                                        <td align="right"><?= number_format($Existing['NilaiTercatat']/VALUE_PER) ?></td>
                                    </tr> -->
                                    <!-- <tr>
                                        <td align="left">2</td>
                                        <td >Ratas Harian Nilai Tercatat </td>
                                        <td align="right"><?= number_format($Existing['NilaiTercatatRatas']/VALUE_PER) ?></td>
                                    </tr> -->
                                    <tr>
                                        <td align="left"><!-- 3 --></td>
                                        <td >Baki Debet </td>
                                        <td align="right"><?= number_format($Existing['BakiDebet']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 4 --></td>
                                        <td >Ratas Harian Baki Debet </td>
                                        <td align="right"><?= number_format($Existing['BakiDebetRatas']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 5 --></td>
                                        <td >Plafond </td>
                                        <td align="right"><?= number_format($Existing['PlafonEfektif']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 6 --></td>
                                        <td >Kelonggaran tarik </td>
                                        <td align="right"><?= number_format($Existing['KelonggaranTarik']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 7 --></td>
                                        <td >Fee Based Income </td>
                                        <td align="right"><?= number_format($Existing['AkumulasiNominalFee']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 8 --></td>
                                        <td >Pendapatan bunga </td>
                                        <td align="right"><?= number_format($Existing['PendapatanBunga']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 9 --></td>
                                        <td >Pendapatan bunga akumulasi </td>
                                        <td align="right"><?= number_format($Existing['PendapatanBungaAkumulasi']/VALUE_PER) ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <td align="left">10</td>
                                        <td >Jumlah rekening </td>
                                        <td align="right"><?= number_format($Existing['JumlahRekKredit']) ?></td>
                                    </tr> -->

                                    <!-- ================Trade Finance============= -->
                                    <tr>
                                        <th colspan="3" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Trade Finance</b></th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 11 --></td>
                                        <td >Outstanding </td>
                                        <td align="right"><?= number_format($Existing['AkumulasiNominalTrxTf']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 12 --></td>
                                        <td >Fee Based Income Trade Finance</td>
                                        <td align="right"><?= number_format($Existing['AkumulasiNominalFeeTf']/VALUE_PER) ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <td align="left">13</td>
                                        <td >Jumlah Tf Ref </td>
                                        <td align="right"><?= number_format($Existing['AkumulasiJumlahTrxTf']) ?></td>
                                    </tr> -->

                                    <!-- ================Lain nya============= -->
                                    <tr>
                                        <th colspan="3" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Lainnya</b></th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 14 --></td>
                                        <td >Fee Based Income </td>
                                        <td align="right"><?= number_format($Existing['FeeBased']/VALUE_PER) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4 style="margin: 5px 0; color: #4BB8FF; font-weight: bold;">LABA RUGI</h4>
                            <table width="100%" class="table" cellpadding="20" cellspacing="20">
                                <thead>
                                    <tr>
                                        <th style="width: 3%"><!-- No --></th>
                                        <th style="width: 40%; text-align: left;">Keterangan</th>
                                        <th style="text-align: right; padding-right: 20px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;" ><b>Total Pendapatan Bunga</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;" ><?= number_format(($Existing['PendapatanBunga'] + $Existing['PendapatanFtp'])/VALUE_PER) ?></th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 1 --></td>
                                        <td >Pendapatan Bunga </td>
                                        <td align="right"><?= number_format($Existing['PendapatanBunga']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 2 --></td>
                                        <td >Pendapatan FTP </td>
                                        <td align="right"><?= number_format($Existing['PendapatanFtp']/VALUE_PER) ?></td>
                                    </tr>

                                    <!-- ================Total Beban Bunga============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;" ><b>Total Beban Bunga</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;" ><?= number_format(($Existing['BebanBunga'] + $Existing['BebanFtpAkumulasi'])/VALUE_PER) ?></th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 4 --></td>
                                        <td >Beban Bunga </td>
                                        <td align="right"><?= number_format($Existing['BebanBunga']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 5 --></td>
                                        <td >Beban Bunga FTP </td>
                                        <td align="right"><?= number_format($Existing['BebanFtpAkumulasi']/VALUE_PER) ?></td>
                                    </tr>
                                    <!-- ================NII============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;">NII </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?= number_format(($Existing['PendapatanBunga'] + $Existing['Provisi'] - $Existing['BebanBunga'])/VALUE_PER) ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;">NII Dengan FTP </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?=number_format((($Existing['PendapatanBunga'] + $Existing['PendapatanFtp']) - ($Existing['BebanBunga']+ $Existing['BebanFtpAkumulasi']))/VALUE_PER) ?></th>
                                    </tr>

                                    <!-- ================Fee Based============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Fee Based</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?= number_format($Existing['FeeBased']/VALUE_PER) ?></th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 6 --></td>
                                        <td >Jasa Perkreditan*</td>
                                        <td align="right">0</td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 7 --></td>
                                        <td >Jasa Simpanan* </td>
                                        <td align="right">0</td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 8 --></td>
                                        <td >Jasa Transaksi Bisnis Internasional* </td>
                                        <td align="right">0</td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 9 --></td>
                                        <td >Jasa Transfer*</td>
                                        <td align="right">0</td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 3 --></td>
                                        <td >Provisi</td>
                                        <td align="right"><?= number_format($Existing['Provisi']/VALUE_PER) ?></td>
                                    </tr>

                                    <!-- ================Total Biaya Operasional============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Total Biaya Operasional</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?= number_format($Existing['TotalBiayaOperasional']/VALUE_PER) ?></th>

                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 10 --></td>
                                        <td >Beban Administrasi & Umum* </td>
                                        <td align="right">0</td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 11 --></td>
                                        <td >Beban Operasional Lain* </td>
                                        <td align="right">0</td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 12 --></td>
                                        <td >Beban Personalia* </td>
                                        <td align="right">0</td>
                                    </tr>
                                    <!-- ================PPAP============= -->
                                    <tr>
                                        <th colspan="2" align="left" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>PPAP</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?= number_format($Existing['BiayaPpap']/VALUE_PER) ?></th>
                                    </tr>
                                    <!-- ================Laba Sebelum Modal============= -->

                                    <tr>
                                        <td align="left"><!-- 13 --></td>
                                        <td >Laba Rugi Sebelum Modal Tanpa FTP </td>
                                        <td align="right"><?= number_format($Existing['LabaRugiSebelumModal']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 14 --></td>
                                        <td >Laba Rugi Sebelum Modal Dengan FTP</td>
                                        <td align="right"><?= number_format($Existing['LabaRugiFtpSeblumModal']/VALUE_PER) ?></td>
                                    </tr>
                                    <!-- ================Total Biaya Modal============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Total Biaya Modal</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;" ><?= number_format($Existing['BiayaModal']/VALUE_PER) ?></th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 15 --></td>
                                        <td >Laba rugi tanpa FTP </td>
                                        <td align="right"><?= number_format($Existing['LabaRugiSetelahModal']/VALUE_PER) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 16 --></td>
                                        <td >Laba rugi dengan FTP</td>
                                        <td align="right"><?= number_format($Existing['LabaRugiFtpSetelahModal']/VALUE_PER) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="services-table">
                            <span style="font-size: 12pt; color: #204d74; margin-bottom: 5px; font-weight: bold;">CPA Projection</span>
                            <h4 style="margin: 5px 0; color: #4BB8FF; font-weight: bold;">ASSUMPTION</h4>
                            <span style="color: #4BB8FF; margin-bottom: 5px;">Kurs USD : <label class="money"><?= $Projection['Assumption']['USDExchange'] ?></label></span>
                            <table width="100%" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px;">
                                <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                                    <tr class="modal_table_title">
                                        <th style="text-align: left; width: 5%;">No</th>
                                        <th style="text-align: left; width: 60%;">FTP</th>
                                        <th style="text-align: center;">IDR (%)</th>
                                        <th style="text-align: center;">Valas (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: left;">1</td>
                                        <td style="text-align: left;">FTP Simpanan</td>
                                        <td style="text-align: center;">
                                            <label class="money"><?= $Projection['Assumption']['IDRFTPSimpanan'] ?></label> %
                                        </td>
                                        <td style="text-align: center;">
                                            <label class="money"><?= $Projection['Assumption']['ValasFTPSimpanan'] ?></label> %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">2</td>
                                        <td style="text-align: left;">FTP Pinjaman</td>
                                        <td style="text-align: center;">
                                            <label class="money"><?= $Projection['Assumption']['IDRFTPPinjaman'] ?></label> %
                                        </td>
                                        <td style="text-align: center;">
                                            <label class="money"><?= $Projection['Assumption']['ValasFTPPinjaman'] ?></label> %
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            <h4 style="margin: 5px 0; color: #4BB8FF; font-weight: bold;">SIMPANAN</h4>
                            <table width="100%" class="table" cellpadding="20" cellspacing="20">
                                <thead>
                                    <tr>
                                        <!-- <th style="width: 3%">No</th> -->
                                        <th style="width: 40%; text-align: left;">Keterangan</th>
                                        <th style="text-align: right; padding-right: 20px;">IDR</th>
                                        <th style="text-align: right; padding-right: 20px;">Valas</th>
                                        <th style="text-align: right; padding-right: 20px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td align="left">1</td> -->
                                        <td >Saldo </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['IDRSaldo']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['ValasSaldo']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['TotalSaldo']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- <td align="left">2</td> -->
                                        <td >Ratas Harian Saldo </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['IDRRatas']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['ValasRatas']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['TotalRatas']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- <td align="left">3</td> -->
                                        <td >Fee Based Income </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['IDRFeeBased']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['ValasFeeBased']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['TotalFeeBased']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- <td align="left">4</td> -->
                                        <td >Beban Bunga </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['IDRBebanBunga']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['ValasBebanBunga']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['TotalBebanBunga']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- <td align="left">5</td> -->
                                        <td >Beban Bunga Akumulasi </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['IDRBebanBunga']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['ValasBebanBunga']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Simpanan']['TotalBebanBunga']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4 style="margin: 5px 0; color: #4BB8FF; font-weight: bold;">PINJAMAN</h4>
                            <table width="100%" class="table" cellpadding="20" cellspacing="20">
                                <thead>
                                    <tr>
                                        <th style="width: 3%"><!-- No --></th>
                                        <th style="width: 40%; text-align: left;">Keterangan</th>
                                        <th style="text-align: right; padding-right: 20px;">IDR</th>
                                        <th style="text-align: right; padding-right: 20px;">Valas</th>
                                        <th style="text-align: right; padding-right: 20px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="left"><!-- 3 --></td>
                                        <td >Baki Debet </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDROutstanding']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasOutstanding']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalOutstanding']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 4 --></td>
                                        <td >Ratas Harian Baki Debet </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDRDailyRatas']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasDailyRatas']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalDailyRatas']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 5 --></td>
                                        <td >Plafond </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDRPlafond']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasPlafond']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalPlafond']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 6 --></td>
                                        <td >Kelonggaran tarik </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDRTarik']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasTarik']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalTarik']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 7 --></td>
                                        <td >Fee Based Income </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDRFeeBasedPinjaman']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasFeeBasedPinjaman']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalFeeBasedPinjaman']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 8 --></td>
                                        <td >Pendapatan bunga </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDRIncomeExpense']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasIncomeExpense']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalIncomeExpense']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 9 --></td>
                                        <td >Pendapatan bunga akumulasi </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDRIncomeExpense']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasIncomeExpense']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalIncomeExpense']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>

                                    <!-- ================Trade Finance============= -->
                                    <tr>
                                        <th colspan="5" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Trade Finance</b></th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 11 --></td>
                                        <td >Outstanding </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDROutstandingTradeFinance']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasOutstandingTradeFinance']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalOutstandingTradeFinance']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 12 --></td>
                                        <td >Fee Based Income Trade Finance</td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDRFeeBasedTradeFinance']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasFeeBasedTradeFinance']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalFeeBasedTradeFinance']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>

                                    <!-- ================Lain nya============= -->
                                    <tr>
                                        <th colspan="5" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Lainnya</b></th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 14 --></td>
                                        <td >Fee Based Income </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['IDRFeeBasedLain']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['ValasFeeBasedLain']/VALUE_PER) ?></label>
                                        </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['Pinjaman']['TotalFeeBasedLain']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4 style="margin: 5px 0; color: #4BB8FF; font-weight: bold;">LABA RUGI</h4>
                            <table width="100%" class="table" cellpadding="20" cellspacing="20">
                                <tr>
                                    <th style="width: 3%"><!-- No --></th>
                                    <th style="width: 40%; text-align: left;">Keterangan</th>
                                    <th style="text-align: right; padding-right: 20px;">Total</th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;" ><b>Total Pendapatan Bunga</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;" ><?= number_format($Projection['LabaRugi']['TotalPendapatanBunga']/VALUE_PER) ?></th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 1 --></td>
                                        <td >Pendapatan Bunga </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['PendapatanBunga']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 2 --></td>
                                        <td >Pendapatan FTP </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['PendapatanFTP']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>

                                    <!-- ================Total Beban Bunga============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;" ><b>Total Beban Bunga</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;" >
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalBebanBunga']/VALUE_PER) ?></label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 4 --></td>
                                        <td >Beban Bunga </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['BebanBunga']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 5 --></td>
                                        <td >Beban Bunga FTP </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['BebanBungaFTP']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <!-- ================NII============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;">NII </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['NII']/VALUE_PER) ?></label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;">NII Dengan FTP </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['NIIFTP']/VALUE_PER) ?></label>
                                        </th>
                                    </tr>

                                    <!-- ================Fee Based============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Fee Based</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['FeeBased']/VALUE_PER) ?></label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 6 --></td>
                                        <td >Jasa Perkreditan* </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalJasaPerkreditan']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 7 --></td>
                                        <td >Jasa Simpanan* </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalJasaSimpanan']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 8 --></td>
                                        <td >Jasa Transaksi Bisnis Internasional* </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalJasaTransaksi']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 9 --></td>
                                        <td >Jasa Transfer*</td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalJasaTransfer']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 3 --></td>
                                        <td >Provisi</td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalProvision']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>

                                    <!-- ================Total Biaya Operasional============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Total Biaya Operasional</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalBiayaOperasional']/VALUE_PER) ?></label>
                                        </th>

                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 10 --></td>
                                        <td >Beban Administrasi & Umum* </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalAdministrasi']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 11 --></td>
                                        <td >Beban Operasional Lain* </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalOperasional']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 12 --></td>
                                        <td >Beban Personalia* </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalPersonalia']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <!-- ================PPAP============= -->
                                    <tr>
                                        <th colspan="2" align="left" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>PPAP</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['BiayaPpap']/VALUE_PER) ?></label>
                                        </th>
                                    </tr>
                                    <!-- ================Laba Sebelum Modal============= -->

                                    <tr>
                                        <td align="left"><!-- 13 --></td>
                                        <td >Laba Rugi Sebelum Modal Tanpa FTP </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['LabaRugiSebelumModal']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 14 --></td>
                                        <td >Laba Rugi Sebelum Modal Dengan FTP</td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['LabaRugiFtpSeblumModal']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <!-- ================Total Biaya Modal============= -->
                                    <tr>
                                        <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Total Biaya Modal</b> </th>
                                        <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['TotalBiayaModal']/VALUE_PER) ?></label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 15 --></td>
                                        <td >Laba rugi tanpa FTP </td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['LabaRugiSetelahModal']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><!-- 16 --></td>
                                        <td >Laba rugi dengan FTP</td>
                                        <td align="right">
                                        <label class="money"><?= number_format($Projection['LabaRugi']['LabaRugiFtpSetelahModal']/VALUE_PER) ?></label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="<?=base_url("assets/jquery/dist/jquery.min.js");?>"></script>
<script src="<?=base_url("template/vendors/Chart.js-2.7.3/dist/Chart.js");?>"></script>
<script src="<?=base_url("template/vendors/chartjs-plugin-labels/chartjs-plugin-labels.js");?>"></script>
<script src="<?=base_url("template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js");?>"></script>
<script type="text/javascript">
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
                    plugins:{
                        labels:{
                            fontColor: '#fff'
                        }
                    },
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
                    },
                    animation: {
                        onComplete: function(){
                            var b64 = this.toBase64Image();
                            var form_data = new FormData();
                            form_data.append("accountPlanningId", <?= $account_planning["AccountPlanningId"]; ?>);
                            form_data.append("img", b64);
                            form_data.append("type", "KeyShareholders");
                            $.ajax({
                                url: "<?php echo base_url()."export/savebase64"; ?>",
                                dataType: "json",
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: "post"
                            });
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

    function format1(n, currency) {
        return currency + n.toFixed(0).replace(/./g, function(c, i, a) {
        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
    }

    function format2(n, currency) {
        return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
    }

    <?php foreach ($account_planning['FinancialHighlight'] as $row => $value) : ?>
        <?php if ($value[0]['FinancialHighlightGroupId'] == 3 || $value[0]['FinancialHighlightGroupId'] == 5 || $value[0]['FinancialHighlightGroupId'] == 6) { ?>
        var g = document.getElementById("FinancialHighlight_barChart_<?=$value[0]['FinancialHighlightGroupId']?>");
        new Chart(g,
            {
                type: "bar",
                data: {
                    labels: [<?= '"'.implode('", "', $account_planning['Years']).'"'; ?>],
                    datasets: [
                        <?php if (isset($value['FinancialHighlight_details'])) {?>
                            <?php $indexs = 0; ?>
                            <?php 
                                foreach ($value['FinancialHighlight_details'] as $rows) : ?>
                                    {
                                        label: "<?=$rows[0]['FinancialHighlightItemName']?>", 
                                        backgroundColor: "<?= $account_planning['backgroundColors'][$indexs] ?>", 
                                        data: ["<?= $rows[$account_planning['Years'][0]]['ChartAmount'] ?>", "<?= $rows[$account_planning['Years'][1]]['ChartAmount'] ?>", "<?= $rows[$account_planning['Years'][2]]['ChartAmount'] ?>"]
                                    },
                            <?php $indexs++?>
                            <?php endforeach; ?>
                        <?php } ?>
                    ]
                },
                options: {
                    legend: false,
                    scales: {
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            },
                            ticks: {
                                callback: function(label, index, labels) {
                                    return format1(label, '');
                                }
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    hover: {
                        mode: 'label'
                    },
                    plugins:{
                        labels: false                    
                    },
                    animation: {
                        onComplete: function(){
                            var b64 = this.toBase64Image();
                            var form_data = new FormData();
                            form_data.append("accountPlanningId", <?= $account_planning["AccountPlanningId"]; ?>);
                            form_data.append("img", b64);
                            form_data.append("type", "<?= $value[0]['FinancialHighlightGroupName']; ?>");
                            $.ajax({
                                url: "<?php echo base_url()."export/savebase64"; ?>",
                                dataType: "json",
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: "post"
                            });
                        }
                    }
                    
                }
            }
        )
        <?php } else if ($value[0]['FinancialHighlightGroupId'] == 1 || $value[0]['FinancialHighlightGroupId'] == 2) { ?>

        var f = document.getElementById("FinancialHighlight_lineChart_<?=$value[0]['FinancialHighlightGroupId']?>");
        new Chart(f,
            {
                type: "line",
                data: {
                    labels: [<?= '"'.implode('", "', $account_planning['Years']).'"'; ?>],
                    datasets: [
                        <?php if (isset($value['FinancialHighlight_details'])) {?>
                            <?php $indexs = 0; ?>
                            <?php foreach ($value['FinancialHighlight_details'] as $rows) : ?>
                                    {
                                        label: "<?=$rows[0]['FinancialHighlightItemName']?>", 
                                        backgroundColor: "rgba(0, 0, 0, 0)",
                                        borderColor: "<?= $account_planning['backgroundColors'][$indexs] ?>", 
                                        pointBorderColor: "rgba(38, 185, 154, 0.7)", 
                                        pointBackgroundColor: "rgba(38, 185, 154, 0.7)", 
                                        pointHoverBackgroundColor: "#fff", 
                                        pointHoverBorderColor: "rgba(220,220,220,1)", 
                                        pointBorderWidth: 1,
                                        data: ["<?= $rows[$account_planning['Years'][0]]['ChartAmount'] ?>", "<?= $rows[$account_planning['Years'][1]]['ChartAmount'] ?>", "<?= $rows[$account_planning['Years'][2]]['ChartAmount'] ?>"]

                                    },
                            <?php $indexs++?>
                            <?php endforeach; ?>
                        <?php } ?>
                    ]
            },
            options: {
                legend: false, 
                responsive: true,
                scales: {
                yAxes: [{
                    display: true,
                        scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    },
                    ticks: {
                        callback: function(label, index, labels) {
                            return format1(label, '');
                        }
                    },
                    gridLines: {
                        display: false
                    }
                }]
                },
                hover: {
                    mode: 'label'
                },
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return "Year : " + data['labels'][tooltipItem[0]['index']];
                        },
                        label: function(tooltipItem, data) {
                            return data['datasets'][tooltipItem['datasetIndex']]['label'] + " : " + format1(Number(data['datasets'][tooltipItem['datasetIndex']]['data'][tooltipItem['index']]), '');
                        }
                    },
                },                
                plugins:{
                    labels: false                  
                },
                animation: {
                    onComplete: function(){
                        var b64 = this.toBase64Image();
                        var form_data = new FormData();
                        form_data.append("accountPlanningId", <?= $account_planning["AccountPlanningId"]; ?>);
                        form_data.append("img", b64);
                        form_data.append("type", "<?= $value[0]['FinancialHighlightGroupName']; ?>");
                        $.ajax({
                            url: "<?php echo base_url()."export/savebase64"; ?>",
                            dataType: "json",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: "post"
                        });
                    }
                }    
            }
            }
        )
        <?php } ?>
    <?php endforeach; ?>

    $(document).ready(function() {
        init_shareholder_chart(dataShareholder, labelShareholder, colorShareholder);

        // Progressbar
        if ($(".progress .progress-bar")[0]) {
            $('.progress .progress-bar').progressbar();
        }
        // /Progressbar
    });
</script>