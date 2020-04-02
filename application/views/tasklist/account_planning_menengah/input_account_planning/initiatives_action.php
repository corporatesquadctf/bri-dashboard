<div class="row">
    <div class="col-xs-12">
        <div class="x_panel panel_container">
            <div class="x_title collapse-link title_container">
                <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                <label>Initiative Action</label>
                <div class="clearfix"></div>
            </div>
            <div class="x_content content_container">
                <div class="col-xs-12 pull-right <?= $DisplayAction; ?>" style="padding:10px 30px 10px 0;">
                    <div class="div-action btn_edit_initiative_action">
                        <i class="material-icons">edit</i>
                        <label class="label-action">Edit Data</label>
                    </div>
                </div>
                <div class="row content_container shadow_content_container">
                    <div class="col-xs-12" id="initiative-action-container" style="padding:10px 30px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".btn_edit_initiative_action").click(function(){
            window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_initiatives_action/".$APMenengahHeaderInformation->AccountPlanningMenengahId); ?>";
        });
    });

    function init_intitiative_action (data){
        $("#initiative-action-container").empty();
        var index = 0;
        var walletShareHTML  = "";
            walletShareHTML += "<div class='row'>";
            walletShareHTML += "    <div class='col-xs-12'>";
            walletShareHTML += "        <table width='100%' class='table' cellpadding='20' cellspacing='20' style='font-size: 12px; table-layout: fixed;'>";
            walletShareHTML += "            <thead style='background-color: #FFFFFF; color: #4BB8FF; font-weight: bold;'>";
            walletShareHTML += "                <tr>";
            walletShareHTML += "                    <th style='width: 5%;'>No</th>";
            walletShareHTML += "                    <th style='width: 35%;'>Initiatives</th>";
            walletShareHTML += "                    <th style='width: 20%;'>Action Plans</th>";
            walletShareHTML += "                    <th style='width: 20%;'>Description</th>";
            walletShareHTML += "                </tr>";
            walletShareHTML += "            </thead>";
            walletShareHTML += "            <tbody>";
        if(data.length > 0){
            $.each(data, function(index, item){
                index++;
                walletShareHTML += "                <tr>";
                walletShareHTML += "                    <td>"+index+"</td>";
                walletShareHTML += "                    <td class='hyphenate'>"+item.Name+"</td>";
                walletShareHTML += "                    <td>"+item.DateTimePeriod+"</td>";
                walletShareHTML += "                    <td class='hyphenate'>"+item.Description+"</td>";
                walletShareHTML += "                </tr>";
            });
        }
            walletShareHTML += "            </tbody>";
            walletShareHTML += "        </table>";
            walletShareHTML += "    </div>";
            walletShareHTML += "</div>";
            $("#initiative-action-container").append(walletShareHTML);
        
    }
</script>
