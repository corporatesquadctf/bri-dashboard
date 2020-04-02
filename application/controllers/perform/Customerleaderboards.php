<?php

class Customerleaderboards extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->library(array(
            'session',
            'form_validation'
        ));
        $this->load->database();
    }

    public function index() {
        $this->checkModule();
        $user_id = $_SESSION['USER_ID'];

        $data = array(
            'groups' => array(),
            'old' => array(),
            'new' => array(),
        );

        //Get Makers
        $this->db->distinct();
        $this->db->select("view_customer_mapping.vcif, delegations_maker.maker_id, users.name");
        $this->db->from('view_customer_mapping');
        $this->db->join('delegations_maker', 'view_customer_mapping.vcif = delegations_maker.vcif', 'left');
        $this->db->join('users', 'delegations_maker.maker_id = users.id', 'left');
        $query_result = $this->db->get()->result_array();
        $makers = [];
        foreach ($query_result as $row) {
            if (!key_exists($row['vcif'], $makers)) {
                $makers[$row['vcif']] = array();
            }
            $makers[$row['vcif']][] = $row;
        }

        //HOME
        $this->db->select(<<<SQL
            group_id, 
            group_name,
            vcif, 
            company_name,
            outstanding,
            outstanding_ratas,
            simpanan,
            simpanan_ratas,
            current_cpa
SQL
        );
        $this->db->from('leaderboard', 1);
        $this->db->order_by('group_name', 'asc');

        $companies = $this->db->get()->result_array();

        foreach ($companies as $company) {
            $group_id = $company['group_id'];

            if (!key_exists($group_id, $data['groups'])) {
                $data['groups'][$group_id] = array(
                    'group_name' => $company['group_name'],
                    'outstanding' => 0,
                    'outstanding_ratas' => 0,
                    'simpanan' => 0,
                    'simpanan_ratas' => 0,
                    'current_cpa' => 0,
                    'companies' => array()
                );
            }

            $company['view'] = 'btn-success';
            $company['makers'] = $makers[$company['vcif']];

            //Company View
            $this->db->from('ACCOUNT_PLANNINGS');
            $this->db->where('DOC_STATUS', 4);
            $this->db->where('VCIF', $company['vcif']);
            $this_acc = $this->db->get()->result_array();
            if (count($this_acc) <= 0) {
                $company['view'] = 'disabled';
            };


            $data['groups'][$group_id]['outstanding'] += $company['outstanding'];
            $data['groups'][$group_id]['outstanding_ratas'] += $company['outstanding_ratas'];
            $data['groups'][$group_id]['simpanan'] += $company['simpanan'];
            $data['groups'][$group_id]['simpanan_ratas'] += $company['simpanan_ratas'];
            $data['groups'][$group_id]['current_cpa'] += $company['current_cpa'];

            $company['outstanding'] = $company['outstanding'];
            $company['outstanding_ratas'] = $company['outstanding_ratas'];
            $company['simpanan'] = $company['simpanan'];
            $company['simpanan_ratas'] = $company['simpanan_ratas'];
            $company['current_cpa'] = $company['current_cpa'];

            $data['groups'][$group_id]['companies'][$company['vcif']] = $company;
        }


        //EGZISTING
        $this->db->select(<<<SQL
            group_id, 
            group_name,
            vcif, 
            company_name,
            outstanding,
            outstanding_ratas,
            simpanan,
            simpanan_ratas,
            current_cpa
SQL
        );
        $this->db->from('leaderboard', 1);
        $this->db->where('new', 0);
        $this->db->order_by('group_name', 'asc');
        $companies = $this->db->get()->result_array();

        foreach ($companies as $company) {
            $group_id = $company['group_id'];

            if (!key_exists($group_id, $data['old'])) {
                $data['old'][$group_id] = array(
                    'group_name' => $company['group_name'],
                    'outstanding' => 0,
                    'outstanding_ratas' => 0,
                    'simpanan' => 0,
                    'simpanan_ratas' => 0,
                    'current_cpa' => 0,
                    'companies' => array()
                );
            }

            $company['view'] = 'btn-success';
            $company['makers'] = $makers[$company['vcif']];

            //Company View
            $this->db->from('ACCOUNT_PLANNINGS');
            $this->db->where('DOC_STATUS', 4);
            $this->db->where('VCIF', $company['vcif']);
            $this_acc = $this->db->get()->result_array();
            if (count($this_acc) <= 0) {
                $company['view'] = 'disabled';
            };

            $data['old'][$group_id]['outstanding'] += $company['outstanding'];
            $data['old'][$group_id]['outstanding_ratas'] += $company['outstanding_ratas'];
            $data['old'][$group_id]['simpanan'] += $company['simpanan'];
            $data['old'][$group_id]['simpanan_ratas'] += $company['simpanan_ratas'];
            $data['old'][$group_id]['current_cpa'] += $company['current_cpa'];

            $company['outstanding'] = $company['outstanding'];
            $company['outstanding_ratas'] = $company['outstanding_ratas'];
            $company['simpanan'] = $company['simpanan'];
            $company['simpanan_ratas'] = $company['simpanan_ratas'];
            $company['current_cpa'] = $company['current_cpa'];

            $data['old'][$group_id]['companies'][$company['vcif']] = $company;
        }

        //NEW
        $this->db->select(<<<SQL
            group_id, 
            group_name,
            vcif, 
            company_name,
            current_cpa
SQL
        );
        $this->db->from('leaderboard', 1);
        $this->db->where('new', 1);
        $this->db->order_by('group_name', 'asc');
        $companies = $this->db->get()->result_array();

        foreach ($companies as $company) {
            $group_id = $company['group_id'];

            if (!key_exists($group_id, $data['new'])) {
                $data['new'][$group_id] = array(
                    'group_name' => $company['group_name'],
                    'companies' => array()
                );
            }

            $company['view'] = 'btn-success';
            $company['makers'] = $makers[$company['vcif']];


            $this->db->from('ACCOUNT_PLANNINGS');
            $this->db->where('DOC_STATUS', 4);
            $this->db->where('VCIF', $company['vcif']);
            $this_acc = $this->db->get()->result_array();
            if (count($this_acc) <= 0) {
                $company['view'] = 'disabled';
            };

            $data['new'][$group_id]['companies'][$company['vcif']] = $company;
        }
        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/custleaderboards_index.php', $data);
        $this->load->view('layout/footer.php');
    }

    public function hitungOutstanding() {
        $queryData = $this->db
                // ->distinct()
                ->select('a.BAKI_DEBET, a.CIFNO, b.vcif, b.CIF,')
                ->from('FACT_KREDIT_CPA a')
                ->join('PAR_MAPPING_vcif b', 'b.CIF = a.CIFNO', 'left')
        ;
        $queryData = $this->db->get();

        if (isset($options['BAKI_DEBET'])) {
            $this->db->select_sum('BAKI_DEBET');
            $this->db->from('FACT_KREDIT_CPA');
            $query = $this->db->get();
            return $query->row()->openpos;
        }

        print_r($query);
        die();
    }

    public function openAccountPlanning() {
        $postedData = $this->input->post('id');

        if (ctype_digit($postedData)) {
            $groupId = $postedData;

            $this->db->select('*')
                    ->from('VIEW_MASTER_COMPANY')
                    ->where('GROUP_ID', $groupId);
            $result = $this->db->get();
            $detail['total'] = $result->num_rows();

            if ($detail) {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => true, 'redirect' => base_url('perform/companyinformations/main/' . $groupId))));
            } else {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false, 'error' => 'Authorize to the system failed! Try again with valid credentials.')));
            }
        } else {

            $companyName = $postedData;

            $this->db->select('*')
                    ->from('VIEW_MASTER_COMPANY')
                    ->where('COMPANY_NAME', $companyName);
            $result = $this->db->get();
            $detail['total'] = $result->num_rows();

            if ($detail) {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => true, 'redirect' => base_url('perform/companyinformations/main/' . $companyName))));
            } else {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false, 'error' => 'Authorize to the system failed! Try again with valid credentials.')));
            }
        }
    }

}

?>