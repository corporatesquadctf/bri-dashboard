
<!DOCTYPE html>
<html>
<head>
	<title>BRI Dashboard | Dokumen LKN</title>
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
    <div class="center bold underline">LAPORAN KUNJUNGAN NASABAH</div>
    <div class="hyphenate mt25">
        <div class="wrapper">
            <div class="cell bold w25">Nama Debitur</div>
            <div class="cell bold w5">:</div>
            <div class="cell"><?= $ProsesKredit->CustomerName; ?></div>
        </div>
        <div class="wrapper">
            <div class="cell bold w25">Alamat</div>
            <div class="cell bold w5">:</div>
            <div class="cell"><?= $ProsesKredit->Address; ?></div>
        </div>
        <div class="wrapper">
            <div class="cell bold w25">Waktu Kunjungan</div>
            <div class="cell bold w5">:</div>
            <div class="cell"><?= $WaktuKunjungan = empty($ProsesKredit->WaktuKunjungan) ? "-": date("Y-m-d h:i:s", strtotime($ProsesKredit->WaktuKunjungan)); ?></div>
        </div>
        <div class="wrapper">
            <div class="cell bold w25">Hasil Kunjungan</div>
            <div class="cell bold w5">:</div>
            <div class="cell"><?= $ProsesKredit->HasilKunjungan; ?></div>
        </div>
    </div>
    <div class="hyphenate bold mt25">Tanggapan Para Pejabat BRI yang menerima LKN tersebut :</div>
    <div class="hyphenate">(Merupakan kewajiban pejabat BRI yang menerima LKN untuk memonitor atau melakukan tindak lanjut atas informasi yang ada pada LKN tersebut)</div>
    <div class="hyphenate text-indent" style="margin-top: 10px;"><?= $ProsesKredit->Tanggapan; ?>&nbsp;</div>
    <div class="border mt25 p5">
        <div class="center">Dibuat oleh:</div>
        <div class="hyphenate">
            <div class="wrapper">
                <div class="cell w25">Nama</div>
                <div class="cell w5">:</div>
                <div class="cell"><?= $ProsesKredit->RMName; ?></div>
            </div>
            <div class="wrapper">
                <div class="cell w25">Jabatan</div>
                <div class="cell w5">:</div>
                <div class="cell"><?= $ProsesKredit->RoleName; ?></div>
            </div>
            <div class="wrapper">
                <div class="cell w25">Unit Kerja</div>
                <div class="cell w5">:</div>
                <div class="cell"><?= $ProsesKredit->UnitKerjaName; ?></div>
            </div>
        </div>
    </div>
</body>

</html>