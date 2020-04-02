
<!-- end bri_sp_tabContent -->


	                    </div>
					</div>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";
  $(document).ready(function(){

    $("#financial_highlights-tab").click(function(){
      var tab_panel_type = $(this).attr('tab_panel_type');
      var AccountPlanningId = $(this).attr('AccountPlanningId');

      $('.loaderImage').show();

      $('#bri_sp_tabContent').load("<?= base_url('tasklist/AccountPlanning/view_financial_highlights/')?>" + AccountPlanningId +"/" + tab_panel_type , function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success") {
          $('.loaderImage').hide();
        }

        if(statusTxt == "error") {
          $('.loaderImage').hide();
          new PNotify({
              title: xhr.status,
              text: "Error: " + xhr.status + ": " + xhr.statusText,
              type: xhr.status,
              styling: 'bootstrap3'
          });
          
          PNotify.prototype.options.delay = 1200;
        }

      });
    });

    $("#facilities_banking-tab").click(function(){
      var tab_panel_type = $(this).attr('tab_panel_type');
      var AccountPlanningId = $(this).attr('AccountPlanningId');

      $('.loaderImage').show();

      $('#bri_sp_tabContent').load("<?= base_url('tasklist/AccountPlanning/view_facilities_banking/')?>" + AccountPlanningId +"/" + tab_panel_type , function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success") {
          $('.loaderImage').hide();
        }

        if(statusTxt == "error") {
          $('.loaderImage').hide();
          new PNotify({
              title: xhr.status,
              text: "Error: " + xhr.status + ": " + xhr.statusText,
              type: xhr.status,
              styling: 'bootstrap3'
          });
          
          PNotify.prototype.options.delay = 1200;
        }

      });
    });

    $("#wallet_share-tab").click(function(){
      var tab_panel_type = $(this).attr('tab_panel_type');
      var AccountPlanningId = $(this).attr('AccountPlanningId');

      $('.loaderImage').show();

      $('#bri_sp_tabContent').load("<?= base_url('tasklist/AccountPlanning/view_wallet_share/')?>" + AccountPlanningId +"/" + tab_panel_type , function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success") {
          $('.loaderImage').hide();
        }

        if(statusTxt == "error") {
          $('.loaderImage').hide();
          new PNotify({
              title: xhr.status,
              text: "Error: " + xhr.status + ": " + xhr.statusText,
              type: xhr.status,
              styling: 'bootstrap3'
          });
          
          PNotify.prototype.options.delay = 1200;
        }

      });
    });

    $("#competition_analysis-tab").click(function(){
      var tab_panel_type = $(this).attr('tab_panel_type');
      var AccountPlanningId = $(this).attr('AccountPlanningId');

      $('.loaderImage').show();

      $('#bri_sp_tabContent').load("<?= base_url('tasklist/AccountPlanning/view_competition_analysis/')?>" + AccountPlanningId +"/" + tab_panel_type , function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success") {
          $('.loaderImage').hide();
        }

        if(statusTxt == "error") {
          $('.loaderImage').hide();
          new PNotify({
              title: xhr.status,
              text: "Error: " + xhr.status + ": " + xhr.statusText,
              type: xhr.status,
              styling: 'bootstrap3'
          });
          
          PNotify.prototype.options.delay = 1200;
        }

      });
    });
    
  });  
</script>
