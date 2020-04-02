<?php

class Summary_cpa extends MY_Controller {

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

        $this->load->model('summary_cpa_model');
        $this->load->model('credit_simulations_model');
    }

    public function view($customer_vcif, $month = 0, $year = 0) {
        $this->checkViewCPA();
        
        $data = array();

        $data['existing'] = array();

        $data['existing']['simpanan'] = $this->summary_cpa_model->get_existing_simpanan($customer_vcif, $month, $year);
        $data['existing']['pinjaman'] = $this->summary_cpa_model->get_existing_pinjaman($customer_vcif, $month, $year);
        $data['existing']['labarugi'] = $this->summary_cpa_model->get_existing_labarugi($customer_vcif, $month, $year);

        $data['credit_simulation_assumptions'] = $this->credit_simulations_model->get_assumptions($customer_vcif);
        $data['credit_simulation_fees'] = $this->credit_simulations_model->get_fees($customer_vcif);
        $data['projection'] = $this->summary_cpa_model->get_projection($customer_vcif, $data['credit_simulation_assumptions'], $data['credit_simulation_fees']);
        $data['delta'] = array(
            'simpanan' => array(),
            'pinjaman' => array(),
            'labarugi' => array()
        );

        foreach (array('simpanan', 'pinjaman') as $group) {
            foreach ($data['existing'][$group] as $key => $value) {
                foreach (array('IDR', 'VALAS', 'TOTAL') as $currency) {
                    $data['delta'][$group][$key][$currency] = number_format($data['projection'][$group][$key][$currency] - $data['existing'][$group][$key][$currency]);
                    $data['existing'][$group][$key][$currency] = number_format($data['existing'][$group][$key][$currency]);
                    $data['projection'][$group][$key][$currency] = number_format($data['projection'][$group][$key][$currency]);
                }
            }
        }

        foreach ($data['existing']['labarugi'] as $key => $value) {
            $data['delta']['labarugi'][$key] = number_format($data['projection']['labarugi'][$key] - $data['existing']['labarugi'][$key]);
            $data['existing']['labarugi'][$key] = number_format($data['existing']['labarugi'][$key]);
            $data['projection']['labarugi'][$key] = number_format($data['projection']['labarugi'][$key]);
        }
        $data['credit_simulation_assumptions']['kurs_usd'] = number_format($data['credit_simulation_assumptions']['kurs_usd'],2);
        $data['credit_simulation_assumptions']['ftp_simpanan_idr'] = number_format($data['credit_simulation_assumptions']['ftp_simpanan_idr'],2);
        $data['credit_simulation_assumptions']['ftp_simpanan_valas'] = number_format($data['credit_simulation_assumptions']['ftp_simpanan_valas'],2);
        $data['credit_simulation_assumptions']['ftp_pinjaman_idr'] = number_format($data['credit_simulation_assumptions']['ftp_pinjaman_idr'],2);
        $data['credit_simulation_assumptions']['ftp_pinjaman_valas'] = number_format($data['credit_simulation_assumptions']['ftp_pinjaman_valas'],2);
        $data['vcif'] = $customer_vcif;
        $data['month'] = $month;
        $data['year'] = $year;

        $this->load->view('layout/header.php');
        $this->load->view('layout/side-nav.php');
        $this->load->view('layout/top-nav.php');
        $this->load->view('performance/company/cpa/summary_cpa_view', $data);
        $this->load->view('layout/footer.php');
    }

}
