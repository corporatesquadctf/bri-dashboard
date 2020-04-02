<?php

class Bristartingpoints extends CI_Controller {

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
    }

    public function viewStartingPoint($Vcif) {
        $this->load->database();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $yearNow = $today->format('Y');

        if ($Vcif) {
            // GET FINANCIAL HIGHLIGHT DATA
            $this->db->select('*');
            $this->db->from('FINANCIALHIGHLIGHT_GROUPS');
            $this->db->where('IS_DEFAULT', 1);
            $this->db->where('STATUS', 1);

            $financial_highlight_groups = $this->db->get()->result();
            foreach ($financial_highlight_groups as $financial_highlight_group) {

                $this->db->select('FHD.ID DETAIL_ID, FHD.DETAIL_NAME, FHG.ID GROUP_ID, FHG.GROUP_NAME');
                $this->db->from('FINANCIALHIGHLIGHT_DETAILS FHD');
                $this->db->join('FINANCIALHIGHLIGHT_GROUPS FHG', 'FHG.ID = FHD.GROUP_ID', 'left');
                $this->db->where('FHG.ID', $financial_highlight_group->ID);

                $financial_highlight_details = $this->db->get()->result();

                foreach ($financial_highlight_details as $financial_highlight_detail) {
                    $data['FH_DETAIL'][] = array(
                        'FHG_ID' => $financial_highlight_detail->GROUP_ID,
                        'FHG_NAME' => $financial_highlight_detail->GROUP_NAME,
                        'FHD_ID' => $financial_highlight_detail->DETAIL_ID,
                        'FHD_NAME' => $financial_highlight_detail->DETAIL_NAME
                    );
                }

                $data['FH_GROUP'][] = array(
                    'FHG_ID' => $financial_highlight_group->ID,
                    'FHG_NAME' => $financial_highlight_group->GROUP_NAME
                );
            }

            $this->load->view('layout/header.php');
            $this->load->view('layout/side-nav.php');
            $this->load->view('layout/top-nav.php');
            $this->load->view('performance/viewaccountplanning/view_bristartingpoint.php', $data);
            $this->load->view('layout/footer.php');
        }
    }
}
?>