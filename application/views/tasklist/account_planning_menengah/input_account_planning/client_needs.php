<div class="row">
    <div class="col-xs-12">
        <div class="x_panel panel_container">
            <div class="x_title collapse-link title_container">
                <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                <label>Fundings</label>
                <div class="clearfix"></div>
            </div>
            <div class="x_content content_container">
                <div class="col-xs-12 pull-right <?= $DisplayAction; ?>" style="padding:10px 30px 10px 0;">
                    <div class="div-action btn_edit_fundings">
                        <i class="material-icons">edit</i>
                        <label class="label-action">Edit Data</label>
                    </div>
                </div>
                <div class="row content_container shadow_content_container">
                    <div class="col-xs-12" id="fundings-container" style="padding:10px 30px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel panel_container">
            <div class="x_title collapse-link title_container">
                <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                <label>Services</label>
                <div class="clearfix"></div>
            </div>
            <div class="x_content content_container">
                <div class="col-xs-12 pull-right <?= $DisplayAction; ?>" style="padding:10px 30px 10px 0;">
                    <div class="div-action btn_edit_services">
                        <i class="material-icons">edit</i>
                        <label class="label-action">Edit Data</label>
                    </div>
                </div>
                <div class="row content_container shadow_content_container">
                    <div class="col-xs-12" id="services-container" style="padding:10px 30px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".btn_edit_fundings").click(function(){
            window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_fundings/".$APMenengahHeaderInformation->AccountPlanningMenengahId); ?>";
        });

        $(".btn_edit_services").click(function(){
            window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_services/".$APMenengahHeaderInformation->AccountPlanningMenengahId); ?>";
        });
    });

    function init_fundings(data){
        $("#fundings-container").empty();
        var index = 0;
        if(data.length > 0){
            var walletShareHTML  = "";
                walletShareHTML += "<div class='row'>";
                walletShareHTML += "    <div class='col-xs-12'>";
                walletShareHTML += "        <table width='100%' class='table' cellpadding='20' cellspacing='20' style='font-size: 12px; table-layout: fixed;>";
                walletShareHTML += "            <thead style='background-color: #FFFFFF; color: #4BB8FF; font-weight: bold;'>";
                walletShareHTML += "                <tr>";
                walletShareHTML += "                    <th style='width: 10%;'>No</th>";
                walletShareHTML += "                    <th style='width: 15%;'>Kebutuhaan Pendanaan</th>";
                walletShareHTML += "                    <th style='width: 20%; text-align: right;'>Jangka Waktu (Bulan)</th>";
                walletShareHTML += "                    <th style='width: 20%; text-align: right;'>Nominal</th>";
                walletShareHTML += "                    <th style='width: 35%;'>Deskripsi</th>";
                walletShareHTML += "                </tr>";
                walletShareHTML += "            </thead>";
                walletShareHTML += "            <tbody>";
            $.each(data, function(index, item){
                index++;
                walletShareHTML += "                <tr>";
                walletShareHTML += "                    <td>"+index+"</td>";
                walletShareHTML += "                    <td class='hyphenate'>"+item.FundingNeed+"</td>";
                walletShareHTML += "                    <td style='text-align: right;'><label style='margin: 0; font-weight: normal;' class='period' data-a-sep=','>"+item.TimePeriod+"</label> Bulan</td>";
                walletShareHTML += "                    <td style='text-align: right;'>Rp. <label style='margin: 0; font-weight: normal;' class='money' data-a-sep=','>"+item.Amount+"</label></td>";
                walletShareHTML += "                    <td class='hyphenate'>"+item.Description+"</td>";
                walletShareHTML += "                </tr>";
            });
                walletShareHTML += "            </tbody>";
                walletShareHTML += "        </table>";
                walletShareHTML += "    </div>";
                walletShareHTML += "</div>";
            $("#fundings-container").append(walletShareHTML);
            $(".money").autoNumeric("init",{
                mDec: "0",
                vMax: "999999999999999"
            });

            $(".period").autoNumeric("init",{
                mDec: "0",
                vMax: "999"
            });
        }
    }

    function init_services(data){
        $("#services-container").empty();
        var index = 0;
        if(data.length > 0){
            var walletShareHTML  = "";
                walletShareHTML += "<div class='row'>";
                walletShareHTML += "    <div class='col-xs-12'>";
                walletShareHTML += "        <table width='100%' class='table' cellpadding='20' cellspacing='20' style='font-size: 12px; table-layout: fixed;'>";
                walletShareHTML += "            <thead style='background-color: #FFFFFF; color: #4BB8FF; font-weight: bold;'>";
                walletShareHTML += "                <tr>";
                walletShareHTML += "                    <th style='width: 10%;'>No</th>";
                walletShareHTML += "                    <th style='width: 15%;'>Service</th>";
                walletShareHTML += "                    <th style='width: 25%;'>Product Owner</th>";
                walletShareHTML += "                    <th style='width: 15%; text-align: right;'>Target (Bulan)</th>";
                walletShareHTML += "                    <th style='width: 35%;'>Deskripsi</th>";
                walletShareHTML += "                </tr>";
                walletShareHTML += "            </thead>";
                walletShareHTML += "            <tbody>";
            $.each(data, function(index, item){
                index++;
                walletShareHTML += "                <tr>";
                walletShareHTML += "                    <td>"+index+"</td>";
                walletShareHTML += "                    <td class='hyphenate'>"+item.Name+"</td>";
                walletShareHTML += "                    <td style='display: grid;'>";
                var unitKerjaTag = item.UnitKerjaTag;
                $.each(unitKerjaTag, function(index, items){
                    walletShareHTML += "                    <div style='border: 1px solid #E5E5E5; background: #F5F5F5; box-sizing: border-box; border-radius: 2px; margin: 2px; padding-left: 10px;'>";
                    walletShareHTML += "                        <label style='margin: 0; font-weight: normal; color: #218FD8;'>#</label><label style='margin: 0 5px; font-weight: normal;'>"+items+"</label>";
                    walletShareHTML += "                    </div>";
                });
                walletShareHTML += "                    </td>";
                walletShareHTML += "                    <td style='text-align: right;'><label style='margin: 0; font-weight: normal;' class='period' data-a-sep=','>"+item.Target+"</label> Bulan</td>";
                walletShareHTML += "                    <td class='hyphenate'>"+item.Description+"</td>";
                walletShareHTML += "                </tr>";
            });
                walletShareHTML += "            </tbody>";
                walletShareHTML += "        </table>";
                walletShareHTML += "    </div>";
                walletShareHTML += "</div>";
            $("#services-container").append(walletShareHTML);
            
            $(".period").autoNumeric("init",{
                mDec: "0",
                vMax: "999"
            });
        }
    }
</script>
