<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>ASSUMPTION</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="form-group" style="margin-bottom: 20px;">
            <label class="control-label col-sm-2" for="pwd">Kurs USD:</label>
            <div class="col-sm-2">          
                <input 
                    class="txt td-number numberOnly" 
                    class="form-control" 
                    id="kurs-usd"
                    value=""
                    placeholder="0" 
                    >
            </div>
        </div>
        <br>
        <br>
        <table class="table">
            <tr class="input_form" style="background: #012D5A; color: #FFF;">
                <th></th>
                <th>IDR %</th>
                <th>Valas %</th>
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">FTP Simpanan</td>
                <td class="txt td-number numberPercent bigger100"  id="ftp-simpanan-idr" contenteditable="true" style="text-align: right;" >0</td>
                <td class="txt td-number numberPercent bigger100"  id="ftp-simpanan-valas" contenteditable="true" style="text-align: right;">0</td>                        
            </tr>
            <tr align="center">
                <td class="txt" contenteditable="false" style="text-align: left;">FTP Pinjaman</td>
                <td class="txt td-number numberPercent bigger100" id="ftp-pinjaman-idr" contenteditable="true" style="text-align: right;">0</td>
                <td class="txt td-number numberPercent bigger100" id="ftp-pinjaman-valas" contenteditable="true" style="text-align: right;">0</td>
            </tr>
        </table>
        <div class="btn-annual" style="text-align: right;">
            <button class="btn btn-primary" onclick="saveAssumptionsCalc()">
                <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
            </button>
            <p id="credit-simulation-assumptions-message"></p>
        </div>
    </div>
</div>
<script>
    var saveAssumptionsCalc = function () {

        let ftpIdr = parseFloat($('#ftp-simpanan-idr').text()).toFixed(2);
        let ftpValas = parseFloat($('#ftp-simpanan-valas').text()).toFixed(2);
        let ftp2Idr = parseFloat($('#ftp-pinjaman-idr').text()).toFixed(2);
        let ftp2Valas = parseFloat($('#ftp-pinjaman-valas').text()).toFixed(2);

        if (ftpIdr > 100.00) {
            $("#ftp-simpanan-idr").addClass('td-error');
            return;
        }

        if (ftpValas > 100.00) {
            $("#ftp-simpanan-valas").addClass('td-error');
            return;
        }

        if (ftp2Idr > 100.00) {
            $("#ftp-pinjaman-idr").addClass('td-error');
            return;
        }

        if (ftp2Valas > 100.00) {
            $("#ftp-pinjaman-valas").addClass('td-error');
            return;
        }

        var request = JSON.stringify({
            user_id: '<?= $_SESSION['USER_ID'] ?>',
            kurs_usd: $('#kurs-usd').val(),
            ftp_simpanan_idr: ftpIdr,
            ftp_simpanan_valas: ftpValas,
            ftp_pinjaman_idr: ftp2Idr,
            ftp_pinjaman_valas: ftp2Valas,
        });

        var url = '<?= base_url('/rest/calculate/save_calculate_assumptions') ?>';
        var success = function (response) {
            new PNotify({
                title: 'Success!',
                text: 'Data Has Been Save.',
                type: 'success',
                styling: 'bootstrap3'
            });
        };
        $.post(url, request, success, 'json');
    }

    $('.numberPercent').on('blur', function (e) {
        let a = e.currentTarget.innerText;
        a = a.toString().replace(/,/g, '');
        a = a.trim();
        let b = parseFloat(a).toFixed(2);
        if ($(this).hasClass('bigger100') && b > 100.00) {
            $(this).addClass('td-error');
            return;
        } else {
            $(this).removeClass('td-error');
        }
        e.currentTarget.innerText = b;
    });

    $('.td-number').on('click', function () {
        var tdElement = $(this);
        var tdText = tdElement.text();
        let kurung = (tdText.indexOf('(') !== -1 && tdText.indexOf(')') !== -1);
        tdText = tdText.replace(/,/g, '');
        if (tdText == 0 || tdText == "0.00") {
            tdElement.text("");
        } else if (kurung) {
            tdText = tdText.replace(/\(/g, '');
            tdText = tdText.replace(/\)/g, '').trim();
            tdText = '-' + tdText;
            tdElement.text(tdText);
        } else {
            tdElement.text(tdText);
        }
    })
</script>

