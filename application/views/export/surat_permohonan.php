
<!DOCTYPE html>
<html>
<head>
	<title>BRI Dashboard | Surat Permohonan</title>
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
    .mt25{
        margin-top: 25px;
    }
    .text-indent{
        text-indent: 50px;
    }
    .right{
        text-align: right;
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
</style>
<header>
</header>

<footer>	
</footer>

<body>
    <div class="right">
        . . . . . . . . . . . . , <?= $ExportDate; ?>
    </div>
    <div class="mt25">No :</div>
    <div>Kepada Yth,</div>
    <div>Bapak/Ibu Pemimpin BRI</div>
    <div><?= $ProsesKredit->UnitKerjaName; ?></div>

    <div class="mt25">Dengan Hormat,</div>
    <div class="text-indent hyphenate justify mt25">Bersama surat ini perkenankanlah kami untuk mengajukan permohonan fasilitas pinjaman sebagai berikut.</div>
    <div class="hyphenate mt25">
        <div class="wrapper">
            <div class="cell w25" style="text-indent: 20px;">Nama Perusahaan</div>
            <div class="cell w5">:</div>
            <div class="cell"><?= $ProsesKredit->CustomerName; ?></div>
        </div>
        <div class="wrapper">
            <div class="cell w25" style="text-indent: 20px;">Alamat</div>
            <div class="cell w5">:</div>
            <div class="cell"><?= $ProsesKredit->Address; ?></div>
        </div>
        <div class="wrapper">
            <div class="cell w25" style="text-indent: 20px;">Jangka Waktu</div>
            <div class="cell w5">:</div>
            <div class="cell"><?= $ProsesKredit->JangkaWaktu; ?> Bulan</div>
        </div>
        <div class="wrapper">
            <div class="cell w25" style="text-indent: 20px;">Detail Fasilitas</div>
            <div class="cell w5">:</div>
            <div class="cell">
                <table>
                    <?php
                        $totalPlafond = 0;
                        if(!empty($FasilitasPermohonan)):
                            echo "<tr><th style='width: 10%;'>No.</th><th style='width: 40%;'>Fasilitas</th><th style='text-align: right;'>Plafond</th>";
                            $i = 1;
                            foreach($FasilitasPermohonan as $row):
                    ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row->FacilityName; ?></td>
                                    <td style="text-align: right;">Rp. <?= number_format($row->Plafond, 2, ".", ","); ?></td>
                                </tr>
                    <?php
                            $totalPlafond += $row->Plafond;
                            $i++;
                            endforeach;
                        endif;
                    ?>
                </table>
            </div>
        </div>
        <div class="wrapper">
            <div class="cell w25" style="text-indent: 20px;">Plafond Usulan</div>
            <div class="cell w5">:</div>
            <div class="cell">Rp. <?= number_format($totalPlafond, 2, ".", ","); ?></div>
        </div>
        <div class="wrapper">
            <div class="cell w25" style="text-indent: 20px;">Terbilang</div>
            <div class="cell w5">:</div>
            <div class="cell"><strong><?= $ProsesKredit->PermohonanTerbilang; ?></strong></div>
        </div>
    </div>
    <div class="text-indent hyphenate justify mt25">Sebagai pertimbangan lebih lanjut, berikut kami sertakan data-data yang diperlukan. Demikian atas perhatian dan terkabulnya permohonan ini kami ucapkan terima kasih.</div>
    <div class="signature mt25">
        <div>Hormat Saya,</div>
        <div class="contact hyphenate">a.n. Direktur<br/><?= $ProsesKredit->CustomerName; ?></div>
    </div>
</body>

</html>