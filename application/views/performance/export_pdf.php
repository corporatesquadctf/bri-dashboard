<script src="<?= base_url(); ?>assets/jsPdf/jsPdf.js"></script>
<script src="<?= base_url(); ?>assets/jsPdf/jspdf.plugin.autotable.js"></script>
<script src="<?= base_url(); ?>assets/jsPdf/jspdf.plugin.addhtml.js"></script>
<script src="<?= base_url(); ?>template/vendors/moment/min/moment.min.js"></script>
<style type="text/css">
    @media all {
        .page-break { display: none; }
    }

    @media print {
        .page-break { display: block; page-break-before: always; }
    }
    body{
        background-color: #fff;
    }
    .main-print{
        margin: auto;
        width: 50%;
        padding: 10px;
        height: 5000px;
    }
    .dispnone{
        display: none;
    }
</style>

<body id="print">

    <div class="main-print" id="html-2-pdfwrapper">
        <?php $this->load->view('performance/export/company/company_information.php'); ?>
        <!--ADD_PAGE-->
        <?php $this->load->view('performance/export/bri_starting/financial_highlights.php'); ?>
        <!--ADD_PAGE-->
        <?php $this->load->view('performance/export/bri_starting/banking_facilities.php'); ?>
        <!--ADD_PAGE-->
        <?php $this->load->view('performance/export/bri_starting/wallet_shares.php'); ?>
        <!--ADD_PAGE-->
        <?php $this->load->view('performance/export/bri_starting/competition_analyses.php'); ?>
        <!--ADD_PAGE-->
        <?php $this->load->view('performance/export/client_needs/funding.php'); ?>
        <!--ADD_PAGE-->
        <?php $this->load->view('performance/export/client_needs/services.php'); ?>
        <!--ADD_PAGE-->
        <?php $this->load->view('performance/export/action_plan/estimated_financial.php'); ?>
        <!--ADD_PAGE-->
        <?php $this->load->view('performance/export/action_plan/initiative_action.php'); ?>
        <!--ADD_PAGE-->
        <?php $this->load->view('performance/export/cpa/cpa_projection.php'); ?>
    </div>

    <div class="col-md-12" style="margin-bottom: 20px;">
        <center>
            <a id="export" type="button" class="btn btn-danger form-control export"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate PDF</a>

            <!-- <a id="downloadPdf" type="button" class="btn btn-success form-control export">download PDF</a> -->
        </center>
    </div>
</body>

<script>
    var base64Img = null;
    var margins = {
        top: 100,
        bottom: 40,
        left: 50,
        width: 550
    };
    (function (API) {
        API.centerText = function (txt, options, x, y) {
            options = options || {};
            /* Use the options align property to specify desired text alignment
             * Param x will be ignored if desired text alignment is 'center'.
             * Usage of options can easily extend the function to apply different text 
             * styles and sizes 
             */
            if (options.align == "center") {
                // Get current font size
                var fontSize = this.internal.getFontSize();

                // Get page width
                var pageWidth = margins.width;

                // Get the actual text's width
                /* You multiply the unit width of your string by your font size and divide
                 * by the internal scale factor. The division is necessary
                 * for the case where you use units other than 'pt' in the constructor
                 * of jsPDF.
                 */
                txtWidth = this.getStringUnitWidth(txt) * fontSize / this.internal.scaleFactor;

                // Calculate text's x coordinate
                x = (pageWidth - txtWidth) / 2;
            }

            // Draw text at x,y
            this.text(txt, x, y);
        }
    })(jsPDF.API);

    function header(doc) {
        doc.setFontSize(15);
        doc.setFontStyle('normal');
        doc.setTextColor(255, 255, 255);
        doc.setFillColor(16, 90, 181);
        doc.rect(0, 0, 600, 30, 'F');
        doc.centerText("PT. BANK RAKYAT INDONESIA (PERSERO)", {align: "center"}, 0, 20);

        let year = "<?= $account_planning['doc_year']; ?>";
        let customer_name = "<?= $account_planning['customer_name']; ?>";
        let classification = "<?= $parameter[0]->MASTER_SUPER_CLASSIFICATIONS ? $parameter[0]->MASTER_SUPER_CLASSIFICATIONS : '- Not classified -'; ?>";
        doc.setFontSize(10);
        doc.setTextColor(0, 0, 0);
        doc.text("Date : " + year, 100, 40);
        doc.text("Classification : " + classification, 400, 40);
        doc.setTextColor(0, 0, 0);
        doc.centerText("ACCOUNT PLANNING", {align: "center"}, 0, 60);
        doc.centerText(customer_name, {align: "center"}, 0, 80);
        doc.setDrawColor(0, 0, 255);
        doc.setFillColor(16, 90, 181);
        doc.line(3, 100, margins.width + 43, 100); // horizontal line
    }
    ;

    function footer(doc, pageNumber, totalPages) {
        let str = pageNumber + " of " + totalPages
        doc.setTextColor(0, 0, 0);
        doc.setFontSize(6);
        let customer_name = "<?= $account_planning['customer_name']; ?>";
        doc.text(customer_name, 50, doc.internal.pageSize.getHeight() - 10);
        doc.centerText(moment().format('DD MMMM YYYY, HH:mm:ss'), {align: "center"}, 0, doc.internal.pageSize.getHeight() - 10);
        doc.text(str, doc.internal.pageSize.getWidth() - 50, doc.internal.pageSize.getHeight() - 10);

    }
    ;

    function headerFooterFormatting(doc)
    {
        var totalPages = doc.internal.getNumberOfPages();

        for (var i = totalPages; i >= 1; i--)
        { //make this page, the current page we are currently working on.
            doc.setPage(i);

            header(doc);

            footer(doc, i, totalPages);

        }
    }
    ;

    $("#export").on('click', function () {
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '.hide': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        generate = function ()
        {
            var pdf = new jsPDF('p', 'pt', 'a4');
            pdf.setProperties({
                title: "Account Planning <?= $account_planning['customer_name']; ?>"
            });
            pdf.setFontSize(10);
            var oriSize = [];
            var table = document.getElementsByTagName("table");
            for (let a of table) {
                oriSize.push(a.style.fontSize);
                a.style.fontSize = '6px';
            }
            ;
            pdf.fromHTML(document.getElementById('html-2-pdfwrapper'),
                    margins.left, // x coord
                    margins.top,
                    {
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': specialElementHandlers
                    }, function (dispose) {
                headerFooterFormatting(pdf)
                var string = pdf.output('datauri');
                var iframe = "<iframe width='100%' height='100%' src='" + string + "'></iframe>"
                var x = window.open();
                x.document.open();
                x.document.write(iframe);
                x.document.close();
                pdf.save('account_planning_<?= $account_planning['customer_name']; ?>.pdf')
            },
                    margins);
            for (let a in table) {
                table[a].style.fontSize = oriSize[a];
            }
        };
        generate();
    })
</script>
<script type="text/javascript">
    $('#downloadPdf').on('click', function () {
        var pdf = new jsPDF('p', 'pt', 'a4');

        pdf.addHTML($('#print')[0], function () {
            pdf.save('account_planning.pdf');
        });
    });
</script>