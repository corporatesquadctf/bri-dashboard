<?php
    class EconomyResearch extends MY_Controller {
        function __construct() {
            parent::__construct();
            $this->load->helper(array(
                "form",
                "url",
                "security"
            ));
            $this->load->library(array(
                "session",
                "form_validation",
                "pagination",
                "zip"
            ));

            $this->load->model("macro_economy/EconomyResearch_model","EconomyResearch_model");
            
            $current_datetime = new DateTime(date("Y-m-d H:i:s"));
            $this->current_datetime = $current_datetime->format("Y-m-d H:i:s");
        }

        public function index($rowNo = 0) {
            $this->checkModule();
            $data = array();

            $treeData = array(
                ["id" => "1", "parent" => "#", "text" => "All Files"],
                ["id" => "2", "parent" => "#", "text" => "My Files"],
                ["id" => "3", "parent" => "#", "text" => "Recent"],
                ["id" => "4", "parent" => "#", "text" => "Save"],
            );

            //echo json_encode($treeData); die;

            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('macro_economy/economy_research', $data);
            $this->load->view('layout/footer.php');
        }

        public function processCreateAnalysis(){
            $userId = $this->session->PERSONAL_NUMBER;
            $title = $this->input->post("title");
            $startPeriode = $this->input->post("start_periode");
            $endPeriode = $this->input->post("end_periode");
            $description = $this->input->post("description");
            $nodePath = $this->input->post("nodePath");

            /* Config Destination Path */
            $nodePath = $this->input->post("nodePath");
            $arrNodePath = explode("_", $nodePath);
            $basePath = "./uploads/macro_economy/";
            for($i = count($arrNodePath)-1; $i >= 0; $i--){
                $basePath .= $arrNodePath[$i]."/";
            }

            $data = array(
                "MacroEconomyId" => $arrNodePath[0],
                "Title" => $title,
                "StartPeriode" => $startPeriode,
                "EndPeriode" => $endPeriode,
                "Description" => $description,
                "IsActive" => 1,
                "CreatedDate" => $this->current_datetime,
                "CreatedBy" => $userId
            );

            $result = $this->EconomyResearch_model->createAnalysis($data);
            if($result["status"] == "success"){
                $basePath .= $result["id"];
                if(is_dir($basePath) === false){
                    mkdir($basePath, 0755, true);
                }
            }
            echo json_encode($result);            
        }

        public function serviceGetAnalysis($macroEconomyId){
            $this->serviceUpdateMacroEconomyLog($macroEconomyId);
            $rsMacroEconomy = $this->EconomyResearch_model->serviceGetAnalysis($macroEconomyId);
            $rsPinned = $this->EconomyResearch_model->serviceGetPinnedAnalysis($macroEconomyId);
            $arrPinned = array();
            foreach($rsPinned as $row){
                array_push($arrPinned, $row->MacroEconomyAnalysisId);
            }
            $node = $this->getParentNode($macroEconomyId, "text");
            foreach($rsMacroEconomy as $row){
                $row->NodePath = $node." > ".$row->Title;
                $row->Pinned = 0;
                if(in_array($row->MacroEconomyAnalysisId, $arrPinned)){
                    $row->Pinned = 1;
                }
            }
            echo json_encode($rsMacroEconomy);
        }

        public function serviceGetRecentAnalysis($macroEconomyId){
            $lastId = $this->serviceGetLatestMacroEconomyId($macroEconomyId);
            if($lastId != NULL){
                $rsMacroEconomy = $this->EconomyResearch_model->serviceGetAnalysis($lastId);
                $rsPinned = $this->EconomyResearch_model->serviceGetPinnedAnalysis($lastId);
                $arrPinned = array();
                foreach($rsPinned as $row){
                    array_push($arrPinned, $row->MacroEconomyAnalysisId);
                }
                $node = $this->getParentNode($lastId, "text");
                foreach($rsMacroEconomy as $row){
                    $row->NodePath = $node." > ".$row->Title;
                    $row->Pinned = 0;
                    if(in_array($row->MacroEconomyAnalysisId, $arrPinned)){
                        $row->Pinned = 1;
                    }
                }
            }else{
                $rsMacroEconomy = [];
            }
            echo json_encode($rsMacroEconomy);
        }

        public function serviceGetMyFiles($macroEconomyId){
            $this->serviceUpdateMacroEconomyLog($macroEconomyId);
            $userId = $this->session->PERSONAL_NUMBER;
            $rsMacroEconomyAnalysis = $this->EconomyResearch_model->serviceGetMyFiles($userId);
            $rsPinned = $this->EconomyResearch_model->serviceGetPinnedAnalysis();
            $arrPinned = array();
            foreach($rsPinned as $row){
                array_push($arrPinned, $row->MacroEconomyAnalysisId);
            }
            $node = $this->getParentNode($macroEconomyId, "text");
            foreach($rsMacroEconomyAnalysis as $row){
                $row->NodePath = $node." > ".$row->Title;
                $row->Pinned = 0;
                if(in_array($row->MacroEconomyAnalysisId, $arrPinned)){
                    $row->Pinned = 1;
                }
            }
            echo json_encode($rsMacroEconomyAnalysis);
        }

        public function serviceGetPinAnalysis($macroEconomyId){
            $this->serviceUpdateMacroEconomyLog($macroEconomyId);
            $rsPinned = $this->EconomyResearch_model->serviceGetPinnedAnalysis();
            $node = $this->getParentNode($macroEconomyId, "text");
            foreach($rsPinned as $row){
                $row->NodePath = $node." > ".$row->Title;
                $row->Pinned = 1;
            }
            echo json_encode($rsPinned);
        }

        public function serviceUpdateMacroEconomyLog($macroEconomyId){
            $data = array(
                "MacroEconomyId" => $macroEconomyId,
                "CreatedDate" => $this->current_datetime,
                "CreatedBy" => $this->session->PERSONAL_NUMBER
            );
            $result = $this->EconomyResearch_model->serviceUpdateMacroEconomyLog($data);
        }

        public function serviceGetLatestMacroEconomyId(){
            $result = $this->EconomyResearch_model->serviceGetLatestMacroEconomyId();
            if(!empty($result)){
                return $result[0]->MacroEconomyId;
            }else return null;
        }

        public function serviceGetDetailAnalysis($macroEconomyAnalysisId){
            $rsMacroEconomyAnalysis = $this->EconomyResearch_model->serviceGetDetailAnalysis($macroEconomyAnalysisId);
            $createdDate = date_create($rsMacroEconomyAnalysis->CreatedDate);
            $rsMacroEconomyAnalysis->CreatedDate = date_format($createdDate, "d/m/Y - H:i");

            $arrStartPeriode = explode("-", $rsMacroEconomyAnalysis->StartPeriode);
            $startPeriode = $arrStartPeriode[1]."-".$arrStartPeriode[0]."-01";
            $startPeriode = new DateTime(date($startPeriode));
            $startPeriode = $startPeriode->format('F Y');

            if($rsMacroEconomyAnalysis->EndPeriode != ""){
                $arrEndPeriode = explode("-", $rsMacroEconomyAnalysis->EndPeriode);
                $endPeriode = $arrEndPeriode[1]."-".$arrEndPeriode[0]."-01";
                $endPeriode = new DateTime(date($endPeriode));
                $endPeriode = $endPeriode->format('F Y');
            }else{
                $endPeriode = "";
            }
            $rsMacroEconomyAnalysis->Periode = $startPeriode." - ".$endPeriode;

            $node = $this->getParentNode($rsMacroEconomyAnalysis->MacroEconomyId, "text");
            $rsMacroEconomyAnalysis->NodePath = $node;
            echo json_encode($rsMacroEconomyAnalysis);
        }

        public function processUploadFile(){
            $userId = $this->session->PERSONAL_NUMBER;
            $macroEconomyAnalysisId = $this->input->post("macroEconomyAnalysisId");

            /* Config Destination Path */
            $rsMacroEconomyAnalysis = $this->EconomyResearch_model->serviceGetDetailAnalysis($macroEconomyAnalysisId);
            $node = $this->getParentNode($rsMacroEconomyAnalysis->MacroEconomyId, "id");
            $arrNodePath = explode(" > ", $node);
            $basePath = "./uploads/macro_economy/";
            for($i = 1; $i < count($arrNodePath) ; $i++){
                $basePath .= $arrNodePath[$i]."/";
            }
            $fullPath = $basePath.$rsMacroEconomyAnalysis->MacroEconomyId."/".$macroEconomyAnalysisId;
            if(is_dir($fullPath) === false){
                mkdir($fullPath, 0755, true);
            }

            /* Config File Upload */
            $config["upload_path"] = $fullPath;
            $config["allowed_types"] = "*";
            $config["max_filename"] = "255";
            $config["encrypt_name"] = false;
            $config["max_size"] = "";
            $config["overwrite"] = true;

            /* Move File Upload */
            $status = "success";
            $message = "";
            if (isset($_FILES["fileUpload"]["name"])){
                $data = array(
                    "MacroEconomyAnalysisId" => $macroEconomyAnalysisId,
                    "Name" => str_replace(" ","_", $_FILES["fileUpload"]["name"]),
                    "IsActive" => 1,
                    "CreatedBy" => $userId,
                    "CreatedDate" => $this->current_datetime
                );
                $rs = $this->EconomyResearch_model->createMacroEconomyFile($data);
                if($rs["status"] == "success"){
                    $config["file_name"] = $_FILES["fileUpload"]["name"];
                    $this->load->library("upload", $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("fileUpload")){
                        $status = "error";
                        $message = $this->upload->display_errors("","");
                    }
                }else{
                    $status = $rs["status"];
                    $message = $rs["message"];
                }
            }else{
                $status = "error";
                $message = "No file selected";
            }            

            $data = array(
                "status" => $status,
                "message" => $message
            );
            echo json_encode($data);
        }
        
        public function serviceGetFileUpload($macroEconomyAnalysisId){
            $rsFileUpload = $this->EconomyResearch_model->serviceGetFileUpload($macroEconomyAnalysisId);
            echo json_encode($rsFileUpload);
        }

        public function serviceRemoveFileUpload(){
            $userId = $this->session->PERSONAL_NUMBER;
            $macroEconomyFileId = $this->input->post("macroEconomyFileId");

            $data = array(
                "IsActive" => 0,
                "ModifiedDate" => $this->current_datetime,
                "ModifiedBy" => $userId
            );
            $result = $this->EconomyResearch_model->serviceRemoveFileUpload($data, $macroEconomyFileId);
            echo json_encode($result);
        }

        public function serviceDeleteAnalysis(){
            $userId = $this->session->PERSONAL_NUMBER;
            $macroEconomyAnalysisId = $this->input->post("macroEconomyAnalysisId");

            $data = array(
                "IsActive" => 0,
                "ModifiedDate" => $this->current_datetime,
                "ModifiedBy" => $userId
            );
            $result = $this->EconomyResearch_model->serviceDeleteAnalysis($data, $macroEconomyAnalysisId);
            echo json_encode($result);
        }

        public function servicePinAnalysis(){
            $userId = $this->session->PERSONAL_NUMBER;
            $macroEconomyAnalysisId = $this->input->post("macroEconomyAnalysisId");
            $pin = $this->input->post("pin");

            $data = array(
                "MacroEconomyAnalysisId" => $macroEconomyAnalysisId,
                "IsActive" => $pin,
                "CreatedDate" => $this->current_datetime,
                "CreatedBy" => $userId
            );
            $result = $this->EconomyResearch_model->servicePinnAnalysis($data, $macroEconomyAnalysisId);
            echo json_encode($result);
        }

        public function serviceGetTreeData(){
            $rsMacroEconomy = $this->EconomyResearch_model->getMacroEconomyStructure();
            foreach($rsMacroEconomy as $row){
                if($row->parent == "#"){
                    $row->icon = base_url("assets/images/icons/parent_node.svg");
                }else{
                    $row->icon = base_url("assets/images/icons/child_node.svg");
                }
                $row->text = TRIM($row->text);
            }
            echo json_encode($rsMacroEconomy);
        }

        public function serviceGetPrimaryTreeData(){
            $rsMacroEconomy = $this->EconomyResearch_model->getPrimaryMacroEconomyStructure("2,3,4");
            foreach($rsMacroEconomy as $row){
                if($row->parent == "#"){
                    $row->icon = base_url("assets/images/icons/parent_node.svg");
                }else{
                    $row->icon = base_url("assets/images/icons/child_node.svg");
                }
                $row->text = TRIM($row->text);
            }
            echo json_encode($rsMacroEconomy);
        }

        public function serviceCreateSector(){
            $parents = explode("_", substr($this->input->post("Parents"), 0, -1));
            $parentNode = $this->input->post("ParentNode");
            $name = $this->input->post("Name");
            
            $arrParents = array();
            for ($i = count($parents)-1; $i >= 0; $i--) {
                array_push($arrParents, $parents[$i]);
            }
            array_push($arrParents, $parentNode);

            $data = array(
                //"arrParents" => $arrParents,
                "ParentNode" => $parentNode,
                "Name" => $name,
                "IsActive" => 1,
                "CreatedDate" => $this->current_datetime,
                "CreatedBy" => $this->session->PERSONAL_NUMBER
            );
            
            $result = $this->EconomyResearch_model->serviceCreateSector($data);
            if($result["status"] == "success"){
                $basePath = "./uploads/macro_economy/";
                foreach($arrParents as $macroEconomyId){
                    if($macroEconomyId != "#" && $macroEconomyId != "1"){
                        $basePath .= $macroEconomyId."/";
                    }
                }
                $basePath .= $result["id"];
                if(is_dir($basePath) === false){
                    mkdir($basePath, 0755, true);
                }
            }
            
            echo json_encode($result);
        }

        public function serviceUpdateSector(){
            $macroEconomyId = $this->input->post("MacroEconomyId");
            $name = $this->input->post("Name");

            $data = array(
                "MacroEconomyId" => $macroEconomyId,
                "Name" => $name,
                "IsActive" => 1,
                "ModifiedDate" => $this->current_datetime,
                "ModifiedBy" => $this->session->PERSONAL_NUMBER
            );
            $result = $this->EconomyResearch_model->serviceUpdateSector($data);
            echo json_encode($result);
        }

        public function serviceDeleteSector(){
            $macroEconomyId = $this->input->post("MacroEconomyId");

            $arrMacroEconomy = [$macroEconomyId];
            $rsChild = $this->EconomyResearch_model->serviceGetChildSector($macroEconomyId);
            if(!empty($rsChild)){
                foreach($rsChild as $row){
                    array_push($arrMacroEconomy, $row->id);
                    $rsChild2 = $this->EconomyResearch_model->serviceGetChildSector($row->id);
                    if(!empty($rsChild2)){
                        foreach($rsChild2 as $row2){
                            array_push($arrMacroEconomy, $row2->id);
                            $rsChild3 = $this->EconomyResearch_model->serviceGetChildSector($row2->id);
                            if(!empty($rsChild3)){
                                foreach($rsChild3 as $row3){
                                    array_push($arrMacroEconomy, $row3->id);
                                    $rsChild4 = $this->EconomyResearch_model->serviceGetChildSector($row3->id);
                                    foreach($rsChild4 as $row4){
                                        array_push($arrMacroEconomy, $row4->id);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $data = array();
            foreach($arrMacroEconomy as $row){
                $macroEconomy = array(
                    "MacroEconomyId" => $row,
                    "IsActive" => 0,
                    "ModifiedDate" => $this->current_datetime,
                    "ModifiedBy" => $this->session->PERSONAL_NUMBER
                );
                array_push($data, $macroEconomy);
            }

            $result = $this->EconomyResearch_model->serviceDeleteSector($data);
            echo json_encode($result);
        }

        public function getParentNode($macroEconomyId, $type){
            $arrSuperNode = array("#", "1", "2", "3", "4");
            $node = "";
            while(!in_array($macroEconomyId, $arrSuperNode)){
                $rsMacroEconomy = $this->EconomyResearch_model->getMacroEconomyStructure($macroEconomyId);
                if(!empty($rsMacroEconomy)){
                    if($type == "text")
                        $node = trim($rsMacroEconomy[0]->text)." > ".$node;
                    else if($type == "id")
                        $node = $rsMacroEconomy[0]->parent." > ".$node;
                    $macroEconomyId = $rsMacroEconomy[0]->parent;
                }else{
                    break;
                }
            }
            $node = substr($node, 0, strlen($node) - 3);
            return $node;
        }

        public function downloadAnalysis($macroEconomyAnalysisId){
            $this->load->library('zip');
            $this->zip->compression_level = 0;
            
            $rsMacroEconomyAnalysis = $this->EconomyResearch_model->serviceGetDetailAnalysis($macroEconomyAnalysisId);
            $node = $this->getParentNode($rsMacroEconomyAnalysis->MacroEconomyId, "id");
            $arrNodePath = explode(" > ", $node);
            $basePath = "./uploads/macro_economy/";
            for($i = 1; $i < count($arrNodePath) ; $i++){
                $basePath .= $arrNodePath[$i]."/";
            }
            $fullPath = $basePath.$rsMacroEconomyAnalysis->MacroEconomyId."/".$macroEconomyAnalysisId;
            
            $rsFileUpload = $this->EconomyResearch_model->serviceGetFileUpload($macroEconomyAnalysisId);
            if(!empty($rsFileUpload)){
                foreach($rsFileUpload as $row){
                    $path = $fullPath."/".$row->Name;
                    $this->zip->read_file($path);
                }
            }else{
                $name = "information.txt";
                $data = "No File Uploaded";
                $this->zip->add_data($name, $data);
            }
            $this->zip->download($rsMacroEconomyAnalysis->Title.".zip");
        }

        public function serviceMoveAnalysis(){
            $macroEconomyAnalysisId = $this->input->post("MacroEconomyAnalysisId");
            $currentNode = $this->input->post("CurrentNode");
            $destinationNode = $this->input->post("DestinationNode");

            $data = array(
                "MacroEconomyId" => $destinationNode,
                "ModifiedDate" => $this->current_datetime,
                "ModifiedBy" => $this->session->PERSONAL_NUMBER
            );

            $result = $this->EconomyResearch_model->serviceMoveAnalysis($data, $macroEconomyAnalysisId);
            if($result["status"] == "success"){
                $currentPath = "./uploads/macro_economy/";
                $currentNodeParent = $this->getParentNode($currentNode, "id");
                $arrCurrentNode = explode(" > ", $currentNodeParent);
                for($i = 1; $i < count($arrCurrentNode); $i++){
                    $currentPath .= $arrCurrentNode[$i]."/";
                }
                $currentPath = $currentPath.$currentNode."/".$macroEconomyAnalysisId;

                $destinationPath = "./uploads/macro_economy/";
                $destinationNodeParent = $this->getParentNode($destinationNode, "id");
                $arrDestinationNode = explode(" > ", $destinationNodeParent);
                for($i = 1; $i < count($arrDestinationNode); $i++){
                    $destinationPath .= $arrDestinationNode[$i]."/";
                }
                $destinationPath = $destinationPath.$destinationNode."/";
                if(is_dir($destinationPath) === false){
                    mkdir($destinationPath, 0755, true);
                }
                
                rename($currentPath, $destinationPath."/".$macroEconomyAnalysisId);
            }
            
            echo json_encode($result);
        }
    }
?>