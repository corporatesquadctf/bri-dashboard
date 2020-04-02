<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends CI_Model {

    public function checkOwner($AccountPlanningId) {
        $sql = '
            SELECT COUNT(AccountPlanningOwnerId) AS "numrows" 
            FROM "AccountPlanningOwner" 
            WHERE "CreatedBy" = \''.$this->session->PERSONAL_NUMBER.'\' AND AccountPlanningId = '.$AccountPlanningId.' AND IsActive = 1
        ';

        $result = $this->db->query($sql)->result_array();  

        if ($result[0]['numrows'] === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkCST($AccountPlanningId) {
        $sql = '
            SELECT COUNT(UserId) AS "numrows" 
            FROM "AccountPlanningMember" 
            WHERE "UserId" = \''.$this->session->PERSONAL_NUMBER.'\' AND AccountPlanningId = '.$AccountPlanningId.'
        ';

        $result = $this->db->query($sql)->result_array();  

        if ($result[0]['numrows'] === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkModule($url) {
        if (!isset($_SESSION['PERSONAL_NUMBER'])) {
            redirect(base_url());
        } 
        $roleId = $_SESSION['ROLE_ID'];

        $sql = "SELECT B.[Path] MODULE_PATH
            FROM MapModuleRole A, Module B 
            WHERE A.ModuleId=B.ModuleId AND B.IsActive=1
                AND A.RoleId=".$roleId;

        $results = $this->db->query($sql)->result_array();

        foreach ($results as $res) {
            $modules[] = $res['MODULE_PATH'];
        }
        //customer management
        if ((strpos($url, 'admin/customer_menengah') !== false) && (in_array('admin/customer_menengah', $modules))) {
            return true;
        }
        //topbottom validasi
        if ((strpos($url, 'performance/topbottom') !== false) && (in_array('performance/topbottom', $modules))) {
            return true;
        }
        //segment client
        if ((strpos($url, 'perform/segment') !== false) && (in_array('perform/segment', $modules))) {
            return true;
        }
        //Monitoring
        if ((strpos($url, 'monitoring/RelationshipManager') !== false) && (in_array('monitoring/RelationshipManager', $modules))) {
            return true;
        }
        if ((strpos($url, 'monitoring/AccountPlanning') !== false) && (in_array('monitoring/AccountPlanning', $modules))) {
            return true;
        }
        if ((strpos($url, 'monitoring/proseskredit') !== false) && (in_array('monitoring/proseskredit', $modules))) {
            return true;
        }
        if ((strpos($url, 'monitoring/portofolio_kredit') !== false) && (in_array('monitoring/portofolio_kredit', $modules))) {
            return true;
        }
        //Performance
        if ((strpos($url, 'performance/AccountPlanning') !== false) && (in_array('performance/AccountPlanning', $modules))) {
            return true;
        }
        if ((strpos($url, 'performance/RmLeaderboard') !== false) && (in_array('performance/RmLeaderboard', $modules))) {
            return true;
        }
        if ((strpos($url, 'performance/CustomerLeaderboard') !== false) && (in_array('performance/CustomerLeaderboard', $modules))) {
            return true;
        }
        if ((strpos($url, 'performance/CustomerTopBottom/view') !== false) && (in_array('performance/CustomerTopBottom/view', $modules))) {
            return true;
        }
        if ((strpos($url, 'performance/ClassifiedCustomer/view') !== false) && (in_array('performance/ClassifiedCustomer/view', $modules))) {
            return true;
        }
        if ((strpos($url, 'performance/ClassifiedCustomer/details') !== false)) {
            return true;
        }
        //Confirmation
        if ((strpos($url, 'confirmation/Checker') !== false)) {
            return true;
        }
        if ((strpos($url, 'confirmation/Signer') !== false)) {
            return true;
        }
        if ((strpos($url, 'confirmation/approver') !== false) && (in_array('confirmation/approver', $modules))) {
            return true;
        }
        //Utility
        if ((strpos($url, 'utility/Group') !== false) && (in_array('utility/Group', $modules))) {
            return true;
        }
        if ((strpos($url, 'utility/Vcif') !== false) && (in_array('utility/Vcif', $modules))) {
            return true;
        }
        if ((strpos($url, 'utility/Cif') !== false) && (in_array('utility/Cif', $modules))) {
            return true;
        }
        //My Task List
        if (in_array('tasklist/disposisi', $modules)) {
            return true;
        }
        if ((strpos($url, 'tasklist/disposisi') !== false) && (in_array('tasklist/disposisi', $modules))) {
            return true;
        }
        if ((strpos($url, 'tasklist/Approve') !== false) && (in_array('tasklist/Approve', $modules))) {
            return true;
        }
        if ((strpos($url, 'tasklist/AccountPlanning') !== false) && (in_array('tasklist/AccountPlanning', $modules))) {
            return true;
        }
        if ((strpos($url, 'tasklist/AccountPlanningCst') !== false) && (in_array('tasklist/AccountPlanningCst', $modules))) {
            return true;
        }

        if (strpos($url, 'tasklist/AccountPlanning/view') !== false) {
            return true;
        }

        if (strpos($url, 'tasklist/AccountPlanning/view_cpa') !== false) {
            return true;
        }

        if ((strpos($url, 'tasklist/MyTask') !== false) && (in_array('tasklist/MyTask', $modules))) {
            return true;
        }
        if (strpos($url, 'tasklist/AccountPlanning') !== false || (strpos($url, 'tasklist/AccountPlanning') !== false)) {
            $p_module = 'tasklist/AccountPlanning';
            if(in_array($p_module, $modules)) return true;
        }

        if (strpos($url, 'disposisi/account_planning_menengah/disposisi_customer') !== false || (strpos($url, 'disposisi/account_planning_menengah/disposisi_customer') !== false)) {
            $p_module = 'disposisi/account_planning_menengah/disposisi_customer';
            if(in_array($p_module, $modules)) return true;
        }

        if (strpos($url, 'tasklist/account_planning_menengah/create_account_planning') !== false || (strpos($url, 'tasklist/account_planning_menengah/create_account_planning') !== false)) {
            $p_module = 'tasklist/account_planning_menengah/create_account_planning';
            if(in_array($p_module, $modules)) return true;
        }

        if (strpos($url, 'tasklist/account_planning_menengah/manage_account_planning') !== false || (strpos($url, 'tasklist/account_planning_menengah/manage_account_planning') !== false)) {
            $p_module = 'tasklist/account_planning_menengah/manage_account_planning';
            if(in_array($p_module, $modules)) return true;
        }
        //Portofolio
        if ((strpos($url, 'portofolio/portofolioRm') !== false) && (in_array('portofolio/portofolioRm', $modules))) {
            return true;
        }
        //Pipeline
        if ((strpos($url, 'pipeline/create') !== false) || (strpos($url, 'pipeline/process_create') !== false) ||
        (strpos($url, 'pipeline/edit') !== false) || (strpos($url, 'pipeline/process_edit') !== false) ||
        (strpos($url, 'pipeline/copy') !== false) || (strpos($url, 'pipeline/process_copy') !== false)) {
            $p_module = 'pipeline/draft';
            if(in_array($p_module, $modules)) return true;
        }
        if ((strpos($url, 'pipeline/submitted') !== false) || (strpos($url, 'pipeline/detail') !== false)) {
            $p_module = 'pipeline/submitted';
            if(in_array($p_module, $modules)) return true;
        } 
        if ((strpos($url, 'pipeline/history_detail') !== false)) {
            $p_module = 'pipeline/history';
            if(in_array($p_module, $modules)) return true;
        }        
        //all
        return in_array($url, $modules);
    }

    public function checkModuleAcc() {
        if (!isset($_SESSION['PERSONAL_NUMBER'])) {
            redirect(base_url());
        } 
        $roleId = $_SESSION['ROLE_ID'];

        $sql = "SELECT DISTINCT B.[Path] MODULE_PATH
            FROM MapModuleRole A 
            JOIN Module B ON A.ModuleId=B.ModuleId
            WHERE B.IsActive=1 AND A.RoleId=".$roleId;

        $results = $this->db->query($sql)->result_array();

        foreach ($results as $res) {
            $modules[] = $res['MODULE_PATH'];
        }

        if (in_array('admin/user_management/access', $modules)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkSub($sub_role) {
        $roleId = $_SESSION['ROLE_ID'];


        $this->db->select('*');
        $this->db->from('role');
        $this->db->where('ID', $roleId);
        $this->db->where('SUBROLE_ID', $sub_role);

        $results = $this->db->get_where()->result();
        //var_dump($results); die();
        if ($results[0]->SUBROLE_ID === 1) {
            return true;
        } else {

            return false;
        }
    }

    function check_tasks($vcif, $year) {

        $user_id = $_SESSION['USER_ID'];

        $this->db->distinct();
        $this->db->select(<<<SQL
            delegations_maker.*, 
            view_customer_mapping.company_name company_name,
            account_plannings.vcif,
            account_plannings.year, 
            account_plannings.doc_status, 
            USERS.id, USERS.name
SQL
        );

        $this->db->from('delegations_maker');
        $this->db->join('account_plannings', 'account_plannings.vcif = delegations_maker.vcif', 'left');
        $this->db->join('view_customer_mapping', 'delegations_maker.vcif = view_customer_mapping.vcif', 'left');
        $this->db->join('USERS', 'USERS.id = delegations_maker.maker_id', 'left');
        $this->db->where('maker_id', $user_id);
        $this->db->order_by('account_plannings.year', 'desc');

        $results = $this->db->get()->result_array();

        foreach ($results as $res) {
            $vcifUser[] = $res['vcif'] . '/' . $res['year'];
        }

        if (in_array($vcif . '/' . $year, $vcifUser)) {
            return true;
        } else {

            return false;
        }
    }

    function check_viewtasks($vcif, $year) {

        $user_id = $_SESSION['USER_ID'];
        $role_id = $_SESSION['ROLE_ID'];

        $this->db->distinct();
        $this->db->select(<<<SQL
           account_plannings.*
SQL
        );

        $this->db->from('account_plannings');
        $this->db->where('account_plannings.vcif', $vcif);
        $this->db->where('account_plannings.year', $year);

        $acp = $this->db->get()->result_array();
        if ($role_id == USER_ROLE_RM) {

            $this->db->distinct();
            $this->db->select(<<<SQL
           account_plannings.*
SQL
            );

            $this->db->from('account_plannings');
            $results = $this->db->get()->result_array();

            foreach ($results as $res) {

                $vcifPublished[] = $res['VCIF'] . '/' . $res['YEAR'];
            }

            if (in_array($vcif . '/' . $year, $vcifPublished)) {
                return true;
            } else {

                return false;
            }
        } elseif (($role_id == USER_ROLE_AVP || $role_id == USER_ROLE_VP || $role_id == USER_ROLE_EVP) && $acp[0]['DOC_STATUS'] !== 4) {

            $this->db->distinct();
            $this->db->select(<<<SQL
            delegations_checker.*, 
            view_customer_mapping.company_name company_name,
            account_plannings.vcif,
            account_plannings.year, 
            account_plannings.doc_status, 
            USERS.id, USERS.name
SQL
            );

            $this->db->from('delegations_checker');
            $this->db->join('account_plannings', 'account_plannings.vcif = delegations_checker.vcif', 'left');
            $this->db->join('view_customer_mapping', 'delegations_checker.vcif = view_customer_mapping.vcif', 'left');
            $this->db->join('USERS', 'USERS.id = delegations_checker.checker_id', 'left');
            $this->db->where('checker_id', $user_id);
            $this->db->where('account_plannings.vcif', $vcif);
            $this->db->where('account_plannings.year', $year);
            $this->db->order_by('account_plannings.year', 'desc');

            $results = $this->db->get()->result_array();

            foreach ($results as $res1) {
                $vcifChecker[] = $res1['vcif'] . '/' . $res1['year'];
            }

            $this->db->distinct();
            $this->db->select(<<<SQL
            delegations_signer.*, 
            view_customer_mapping.company_name company_name,
            account_plannings.vcif,
            account_plannings.year, 
            account_plannings.doc_status, 
            USERS.id, USERS.name
SQL
            );

            $this->db->from('delegations_signer');
            $this->db->join('account_plannings', 'account_plannings.vcif = delegations_signer.vcif', 'left');
            $this->db->join('view_customer_mapping', 'delegations_signer.vcif = view_customer_mapping.vcif', 'left');
            $this->db->join('USERS', 'USERS.id = delegations_signer.signer_id', 'left');
            $this->db->where('signer_id', $user_id);
            $this->db->where('account_plannings.vcif', $vcif);
            $this->db->where('account_plannings.year', $year);
            $this->db->order_by('account_plannings.year', 'desc');

            $results2 = $this->db->get()->result_array();

            foreach ($results2 as $res2) {
                $vcifSigner[] = $res2['vcif'] . '/' . $res2['year'];
            }

            if (!empty($results)) {
                return true;
            } elseif (!empty($results2)) {
                return true;
            } else {
                return false;
            }
        } else {

            $this->db->distinct();
            $this->db->select(<<<SQL
           account_plannings.*
SQL
            );

            $this->db->from('account_plannings');
            $this->db->where('doc_status', 4);
            $results = $this->db->get()->result_array();

            foreach ($results as $res) {

                $vcifPublished[] = $res['VCIF'] . '/' . $res['YEAR'];
            }

            if (in_array($vcif . '/' . $year, $vcifPublished)) {
                return true;
            } else {
                return false;
            }
        }
    }

    function check_viewCPA($urls) {
        $urlsCount = count($urls);

        $this->db->distinct();
        $this->db->select(<<<SQL
            view_customer_mapping.vcif
SQL
        );
        $this->db->from('view_customer_mapping');
        $this->db->where('status_vcif', 1);

        $results = $this->db->get()->result_array();

        foreach ($results as $res) {

            $vcifView[] = $res['vcif'];
        }

        $vcif = $urls[3];
        if (in_array($vcif, $vcifView)) {
            return true;
        } else {

            return false;
        }
    }

}
