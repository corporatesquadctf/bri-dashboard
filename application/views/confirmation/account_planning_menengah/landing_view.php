<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Approval</li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('confirmation/approver');?>">Account Planning Menengah Approver</a></li>
                      <li class="breadcrumb-item active" aria-current="page">View Account Planning Menengah</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 10px 0;">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <label class="header_detail_title"><?= html_escape($APMenengahHeaderInformation->CustomerName); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="detail_property_title" style="font-size: 12px; letter-spacing: 0.25px; color: #218FD8; margin: 0;">Tahun :</span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <?= html_escape($APMenengahHeaderInformation->Year); ?>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="detail_property_title" style="font-size: 12px; letter-spacing: 0.25px; color: #218FD8; margin: 0;">Unit Kerja :</span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?= html_escape($APMenengahHeaderInformation->UnitKerjaName); ?>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <?php
                                if($APMenengahHeaderInformation->DocumentStatusId == 2){
                                ?>
                                <button class="btn btn-sm btn-warning pull-right btnActionAccountPlanning" type="button" style="width: 200px;" data-id="4">REJECT</button>
                                <button class="btn btn-sm btn-success pull-right btnActionAccountPlanning" type="button" style="width: 200px;" data-id="3">APPROVE</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background: none; border: none; padding: 0px;">
              <div role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="ap_tab" class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="<?= $account_planning['ap_tab']['company_information'] ?>" style="width: 25%">
                        <a href="#company_information" id="company_information-tab" role="tab" data-toggle="main-tab" aria-expanded="true">Company Information</a>
                      </li>
                      <li role="presentation" class="<?= $account_planning['ap_tab']['bri_starting_position'] ?>" style="width: 25%">
                        <a href="#bri_starting_position" role="tab" id="bri_starting_position-tab" data-toggle="main-tab" aria-expanded="false">BRI Starting Position</a>
                      </li>
                      <li role="presentation" class="<?= $account_planning['ap_tab']['client_needs'] ?>" style="width: 25%">
                        <a href="#client_needs" role="tab" id="client_needs-tab" data-toggle="main-tab" aria-expanded="false">Client Needs</a>
                      </li>
                      <li role="presentation" class="<?= $account_planning['ap_tab']['action_plans'] ?>" style="width: 25%">
                        <a href="#action_plans" role="tab" id="action_plans-tab" data-toggle="main-tab" aria-expanded="false">Action Plans</a>
                      </li>
                  </ul>
              </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="tab-content col-xs-12" id="ap_tabContent">
            <div role="tabpanel" class="tab-pane fade<?= $account_planning['ap_tab_content']['company_information'] ?>" id="company_information" aria-labelledby="company_information-tab">
                <?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/company_information.php'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade<?= $account_planning['ap_tab_content']['bri_starting_position'] ?>" id="bri_starting_position" aria-labelledby="bri_starting_position-tab">
                <?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/bri_starting_position.php'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade<?= $account_planning['ap_tab_content']['client_needs'] ?>" id="client_needs" aria-labelledby="client_needs-tab">
                <?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/client_needs.php'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade<?= $account_planning['ap_tab_content']['action_plans'] ?>" id="action_plans" aria-labelledby="action_plans-tab">
                <?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/action_plans.php'); ?>
            </div>
        </div>
    </div>
  </div>
  
  <div class="modal fade modal-action-account-planning" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form-horizontal" id="formActionAccountPlanning" method="POST" action="<?= base_url("confirmation/approver/add_response_approver") ?>">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
            <input type="hidden" id="accountPlanningId" name="accountPlanningId" value="" />
            <input type="hidden" id="documentStatusId" name="documentStatusId" value="" />
            <div class="row form-group">
              <div class="col-xs-12">
                <p>Comment:</p>
                <textarea id="comment" name="comment" class="form-control" rows="5" required></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
            <button id="btnSubmitActionAccountPlanning" type="submit" class="btn w150 btn-primary modal-button-ok">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
      $(".js-example-basic-single").select2();
      
      $('.nav-tabs a[href="#<?= $firstTab; ?>"]').tab('show')
      if("<?= $firstTab; ?>" == "bri_starting_position"){
        $('#bri_sp_tab a[href="#<?= $secondTab; ?>"]').tab('show')
      }else if("<?= $firstTab; ?>" == "action_plans"){

      }
      getTabInformationServices("<?= $firstTab; ?>");
      $('[data-toggle="main-tab"]').click(function(e) {
          var $this = $(this);
          var selectedTab = ($this.attr("href")).replace("#","");
          
          getTabInformationServices(selectedTab);
          $this.tab('show');
          if(selectedTab == "bri_starting_position"){
            $('#bri_sp_tab a[href="#financial_highlights"]').tab('show');
          }else if(selectedTab == "action_plans"){
            $('#action_plans_tab a[href="#estimated_financial"]').tab('show');
          }
          return false;
      });

      $(".btnActionAccountPlanning").click(function(){
        $(".modal-action-account-planning #comment").val("");
        
        var accountPlanningId = <?= $APMenengahId; ?>;
        var confirmationId = $(this).data("id");
        var confirmationlabel = "";
        
        switch(confirmationId){
            case 3: confirmationlabel = "Approve Account Planning";break;
            case 4: confirmationlabel = "Reject Account Planning"; break;
            default:  confirmationlabel = ""; break;
        }
        $(".modal-action-account-planning #myModalLabel").html(confirmationlabel);
        $(".modal-action-account-planning #accountPlanningId").val(accountPlanningId);
        $(".modal-action-account-planning #documentStatusId").val(confirmationId);

        $(".modal-action-account-planning").modal("show");
      });

      $("#formActionAccountPlanning").on("submit", function (e) {
        e.preventDefault();
        var documentStatusId = $(".modal-action-account-planning #documentStatusId").val();
        switch(documentStatusId){
            case 3: var msg = "Approved"; break;
            case 4: var msg = "Rejected"; break;
            default: var msg = ""; break;
        }
        $.ajax({
          type: "post",
          url : $("#formActionAccountPlanning").attr("action"),
          data: $("#formActionAccountPlanning").serialize(),
          dataType : "json",
          beforeSend:function(){
            $(".modal-action-account-planning").modal("hide");
            $(".loaderImage").show();
          },
          success: function(response){
            $(".loaderImage").hide();
            if(response.status === "success"){
              new PNotify({
                  title: "Success!",
                  text: "Account Planning successfully "+response.message+".",
                  type: 'success',
                  styling: "bootstrap3"
              });
              PNotify.prototype.options.delay = 1200;
              setTimeout(function(){ 
                window.location.href= "<?= base_url("confirmation/approver"); ?>";
              }, 2000);                
            }else if(response.status === "error"){
              new PNotify({
                  title: "Error!",
                  text: response.message,
                  type: "error",
                  styling: "bootstrap3"
              });
              PNotify.prototype.options.delay = 1200;
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            $(".loaderImage").hide();
            alert("<?=$this->config->item("ajax_error_message")?>");
          }
        });
      });

    });

    function getTabInformationServices(selectedTab){
        jQuery(".loaderImage").show();
        $.getJSON("<?= base_url(); ?>confirmation/approver/services_get_"+selectedTab+"/<?= $APMenengahHeaderInformation->AccountPlanningMenengahId."/".$APMenengahHeaderInformation->CIF; ?>", function (data){
            //console.log(data);
            $("#"+selectedTab+"-tab").focus();                    
            switch(selectedTab){
                case "company_information":
                    /* Build Debitur Overview Section */
                    if(data.debiturOverview.length > 0){
                      var debiturOverview = data.debiturOverview;
                      init_debitur_overview(debiturOverview);
                    }

                    /* Build Shareholder Section */
                    if(data.shareholder.length > 0){
                      var shareholder = data.shareholder;
                      init_key_shareholder(shareholder);
                    }

                    /* Build Business Process and Organization */
                    if(data.businessProcess.length > 0){
                      var businessProcess = data.businessProcess;
                      init_business_process(businessProcess);
                    }
                    if(data.companyStructure.length > 0){
                      var companyStructure = data.companyStructure;
                      init_company_structure(companyStructure);                      
                    }
                    

                    /* Build Strategic Plan Section */
                    if(data.strategicPlan.length > 0){
                        var strategicPlan = data.strategicPlan;
                        init_strategic_plan(strategicPlan);                        
                    }
                    
                    /* Build Coverage Mapping Section */
                    if(data.coverageMapping.length > 0){
                        var coverageMapping = data.coverageMapping;
                        init_coverage_mapping(coverageMapping);                        
                    }
                    break;
                case "bri_starting_position":
                    init_financial_highlight(data);
                    init_facilities_banking(data.FacilitiesBanking);
                    init_wallet_share(data.FacilitiesBanking);
                    init_competition_analysis(data.FacilitiesBanking);
                    break;
                case "client_needs":
                    init_fundings(data.Fundings);
                    init_services(data.Services);
                    break;
                case "action_plans":
                    init_estmated_financial(data.FacilitiesBanking);
                    init_intitiative_action(data.InitiativeAction);
                    break;
                default:
                    break;
            }
            jQuery(".loaderImage").hide();
        });
    }
</script>