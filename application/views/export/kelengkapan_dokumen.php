
<!DOCTYPE html>
<html>
<head>
	<title>BRI Dashboard | Kelengkapan Dokumen</title>
</head>
<style type="text/css">
	@page {
		margin: 0px;
		padding: 0px;
		font-family: "Times New Roman";
		color:#000000;
        font-size: 12pt;
	}
	header {
		top: 0px;
		left: 0cm;
		right: 0cm;
		width: 100%;
	}
	footer {
		position: fixed; 
		bottom: 0cm; 
		left: 0cm; 
		right: 0cm;
		height: 10px;
		padding: 50px 75px;
	}
	body {
		padding: 100px;
	}
	table{
		width: 100%;
        border-spacing:0;
        border-collapse: collapse;
	}
    table>tbody>tr>th{
        padding: 3px;
        background: #f3f3f3;
        border: 1px solid #000;
        text-align: left;
    }
    table>tbody>tr>td{
        padding: 3px;
        border: 1px solid #000;
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
    .bold{
        font-weight: bold;
    }
    .underline{
        text-decoration: underline;
    }
    .mt25{
        margin-top: 25px;
    }
    .text-indent{
        text-indent: 50px;
    }
    .right{
        text-align: right;
    }
    .center{
        text-align: center;
    }
    .justify{
        text-align: justify;
    }
    .wrapper{
		display: table;
		table-layout: fixed;
		width: 100%;
	}
    .wrapper .cell{
        display: table-cell;
        padding: 2px;
    }
    .w5{
        width: 5%;
    }
    .w35{
        width: 35%;
    }
    .w25{
        width: 25%;
    }
    .signature{
        width: 200px;
        float: right;
        text-align: center;
    }
    .signature .contact{
        margin-top: 50px
    }
    .border{
        border: 1px solid #000;
    }
    .p5{
        padding: 5px;
    }
</style>
<header>
</header>

<footer>	
</footer>

<body>
    <div class="center bold underline">CHECKLIST KELENGKAPAN DOKUMEN</div>
    <div class="bold mt25">Data Debitur</div>
    <div class="hyphenate mt25">
        <div class="wrapper">
            <div class="cell w35 text-indent">Nama Debitur</div>
            <div class="cell w5">:</div>
            <div class="cell"><?= $ProsesKredit->CustomerName; ?></div>
        </div>
        <div class="wrapper">
            <div class="cell w35 text-indent">Alamat</div>
            <div class="cell w5">:</div>
            <div class="cell"><?= $ProsesKredit->Address; ?></div>
        </div>
        <div class="wrapper">
            <div class="cell w35 text-indent">
                <?php 
                    if($Portofolio == 0) echo "Jenis Usaha";
                    else echo "Sub Sektor Ekonomi";
                ?>
            </div>
            <div class="cell w5">:</div>
            <div class="cell"><?php 
                if($Portofolio == 0) echo $ProsesKredit->BusinessType;
                else echo $ProsesKredit->SubsectorEconomyName; ?>
            </div>
        </div>
    </div>
    <div class="bold mt25">Daftar Dokumen</div>
    <div class="mt25">
        <table style="table-layout: fixed;">
            <tbody>
            <tr>
                <th rowspan="2" style="text-align: center; width: 5%;">No</th>
                <th rowspan="2" style="text-align: center; width: 30%;">Nama Dokumen</th>
                <th colspan="2" style="text-align: center; width: 20%;">Kelengkapan</th>
                <th rowspan="2" style="text-align: center;">Keterangan</th>
            </tr>
            <tr>
                <th style="text-align: center;">Ada</th>
                <th style="text-align: center;">Tidak</th>
            </tr>
            <?php
                $i = 1;
                foreach($ProsesKreditDocument as $row):
                    $imgUploaded = "";
                    $imgNotUploaded = "";
                    if($row->Status == 1){
                        $imgUploaded = "<img src='".base_url('assets/images/icons/checked_document.svg')."'>";
                    }else{
                        $imgNotUploaded = "<img src='".base_url('assets/images/icons/checked_document.svg')."'>";
                    }
            ?>
            <tr>
                <td><?= $i; ?></td>
                <td class="hyphenate"><?= $row->Name; ?></td>
                <td style="text-align:center;"><?= $imgUploaded; ?></td>
                <td style="text-align:center;"><?= $imgNotUploaded; ?></td>
                <td class="hyphenate"><?= $row->Description; ?></td>
            </tr>
            <?php
                $i++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <div>&nbsp;</div>
    <div class="border mt25 p5">
        <div class="center">Dibuat oleh:</div>
        <div class="hyphenate">
            <div class="wrapper">
                <div class="cell w25">Nama</div>
                <div class="cell w5">:</div>
                <div class="cell"><?= $ADKInformation["Name"]; ?></div>
            </div>
            <div class="wrapper">
                <div class="cell w25">Jabatan</div>
                <div class="cell w5">:</div>
                <div class="cell"><?= $ADKInformation["RoleName"]; ?></div>
            </div>
            <div class="wrapper">
                <div class="cell w25">Unit Kerja</div>
                <div class="cell w5">:</div>
                <div class="cell"><?= $ADKInformation["UnitKerjaName"]; ?></div>
            </div>
        </div>
    </div>
</body>

</html>