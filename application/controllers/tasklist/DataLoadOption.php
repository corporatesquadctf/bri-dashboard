<?php 

class DataLoadOption extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->library(array(
            'session',
            'form_validation',
            'pagination'
        ));
      
        $this->load->model('DataLoadOption_model');
        $this->load->model('TasklistAccountPlanning_model');

        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_year = $current_datetime->format('Y');
        $this->current_date = $current_datetime->format('Y-m-d');
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
    }

    public function loadKeyShareholderLastYear($accountPlanningId){
        $data = $this->DataLoadOption_model->loadKeyShareholderLastYear($accountPlanningId);

        if($data){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
            $this->DataLoadOption_model->saveKeyShareholderLastYear($accountPlanningId);
            $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($accountPlanningId, 'Update', 'Updating key shareholders on company information', $_SESSION['PERSONAL_NUMBER']);
        } else {
            $result = array(
                'status' => 'error',
                'message'=> 'No data available'
            );
        }

        echo json_encode($result);
    }

    public function loadFinancialHighlightLastYear($accountPlanningId, $groupId){
        $data = $this->DataLoadOption_model->loadFinancialHighlightLastYear($accountPlanningId, $groupId);

        if($data){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
            $this->DataLoadOption_model->saveFinancialHighlightLastYear($accountPlanningId, $groupId);
            $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($accountPlanningId, 'Update', 'Updating financial highlight on BRI starting position', $_SESSION['PERSONAL_NUMBER']);
        } else {
            $result = array(
                'status' => 'error',
                'message'=> 'No data available'
            );
        }

        echo json_encode($result);
    }

    public function loadFinancialHighlightDataMart($accountPlanningId, $groupId){
        $data = $this->DataLoadOption_model->loadFinancialHighlightDataMart($accountPlanningId);

        if($data){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
            $this->DataLoadOption_model->saveFinancialHighlightDataMart($accountPlanningId, $groupId);
            $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($accountPlanningId, 'Update', 'Updating financial highlight on BRI starting position', $_SESSION['PERSONAL_NUMBER']);
        } else {
            $result = array(
                'status' => 'error',
                'message'=> 'No data available'
            );
        }

        echo json_encode($result);
    }

    public function loadBankFacilityLastYear($accountPlanningId, $groupId, $vcif){
        $data = $this->DataLoadOption_model->loadBankFacilityLastYear($accountPlanningId, $groupId, $vcif);

        if($data){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
            $this->DataLoadOption_model->saveBankFacilityLastYear($accountPlanningId, $groupId, $vcif);
            $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($accountPlanningId, 'Update', 'Updating bank facility on BRI starting position', $_SESSION['PERSONAL_NUMBER']);
        } else {
            $result = array(
                'status' => 'error',
                'message'=> 'No data available'
            );
        }

        echo json_encode($result);
    }

    public function loadBankFacilityDataMart($accountPlanningId, $groupId, $vcif){
        $data = $this->DataLoadOption_model->loadBankFacilityDataMart($accountPlanningId, $groupId, $vcif);

        if($data){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
            $this->DataLoadOption_model->saveBankFacilityDataMart($accountPlanningId, $groupId, $vcif);
            $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($accountPlanningId, 'Update', 'Updating bank facility on BRI starting position', $_SESSION['PERSONAL_NUMBER']);

        } else {
            $result = array(
                'status' => 'error',
                'message'=> 'No data available'
            );
        }

        echo json_encode($result);
    }

    public function loadKeyShareholderDataMart($accountPlanningId){
        $data = $this->DataLoadOption_model->loadKeyShareholderDataMart($accountPlanningId);

        if($data){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
            $this->DataLoadOption_model->saveKeyShareholderDataMart($accountPlanningId);
            $this->TasklistAccountPlanning_model->insertAccountPlanningActivity($accountPlanningId, 'Update', 'Updating key shareholder on company information', $_SESSION['PERSONAL_NUMBER']);

        } else {
            $result = array(
                'status' => 'error',
                'message'=> 'No data available'
            );
        }

        echo json_encode($result);
    }

}