<style>
    #move-tree::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }
    #move-tree::-webkit-scrollbar{
        width: 7px;
        background-color: #F5F5F5;
    }
    #move-tree::-webkit-scrollbar-thumb{
        background-color: #218FD8;
    }
</style>
<div class="modal fade modal-move-analysis" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Move File</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="macroEconomyAnalysisId" name="macroEconomyAnalysisId" value="" />
                <input type="hidden" id="currentNode" name="currentNode" value="" />
                <input type="hidden" id="destinationNode" name="destinationNode" value="" />
                <div id="move-tree" class="scrollbar" style="height: 350px;"></div>
            </div>
            <div class="modal-footer form_action" style="padding: 15px;">
                <button type="button" class="btn w150 btn-default btn_cancel" data-dismiss="modal">Back</button>
                <button id="btnMoveAnalysis" type="button" class="btn w150 btn_save btn-primary modal-button-ok" disabled>Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
    });
</script>