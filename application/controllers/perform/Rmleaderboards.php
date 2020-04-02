<?php 

class Rmleaderboards extends MY_Controller {

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
    	$division_id = $_SESSION['DIVISION'];

    	$data = array(
            'rmusers' => array()
        );

        $this->db->select(<<<SQL
        	users.id,
        	users.name,
        	master_divisions.division_name,
        	role.role_name
SQL
        	);
        $this->db->from('users');
        $this->db->join('master_divisions', 'master_divisions.id = users.division_id', 'left');
        $this->db->join('role', 'role.id = users.role_id', 'left');
        $this->db->where('users.role_id', 10);
        $this->db->where('users.status', 1);
        if($_SESSION['ROLE_ID']==1){

        }else{
        $this->db->where('users.division_id', $division_id);
        }
        $rmusers = $this->db->get()->result_array();

        foreach ($rmusers as $rmuser) {

        	$rm_id = $rmuser['id'];
        	if (!key_exists($rm_id, $data['rmusers'])) {
        		$data['rmusers'][$rm_id] = array(
        			'rm_name' => $rmuser['name'],
        			'division' => $rmuser['division_name'],
        			'outstanding' => 0,
        			'outstanding_ratas' => 0,
        			'simpanan' => 0,
        			'simpanan_ratas' => 0,
        			'current_cpa' => 0,
        			'tasks'	=> array()
        		);
        	}
        	
        	$this->db->distinct();
        	$this->db->select(<<<SQL

        		delegations_maker.vcif,
        		account_plannings.customer_name
SQL
			);
        	$this->db->from('delegations_maker');
        	$this->db->join('account_plannings', 'delegations_maker.vcif = account_plannings.vcif', 'left');
        	$this->db->where('delegations_maker.maker_id', $rm_id);

        	$data['rmusers'][$rm_id]['tasks'] = $this->db->get()->result_array();

        	$query_string = <<<SQL
with fact_kredit_cpa_summed as (
   select 
      sum(baki_debet) outstanding,
      sum(baki_debet_ratas) outstanding_ratas
   from fact_kredit_cpa
   where cifno in (
      select cif from par_mapping_vcif
      where vcif in (
			select vcif from delegations_maker
			where maker_id = ? )
   )
),
fact_simpanan_cpa_summed as (
   select 
      sum(saldo) simpanan,
      sum(avrgsaldo) simpanan_ratas
   from fact_simpanan_cpa
   where cifno in (
      select cif from par_mapping_vcif
      where vcif in (
			select vcif from delegations_maker
			where maker_id = ? )
   )
),
current_cpa as (
 select 
   sum(laba_rugi_ftp_setelah_modal) current_cpa
   from fact_summary_laba_rugi
   where cifno in (
        select cif from par_mapping_vcif
        where vcif in (
			select vcif from delegations_maker
			where maker_id = ? )
    )
 )
select *
from fact_kredit_cpa_summed
cross join fact_simpanan_cpa_summed
cross join current_cpa;
SQL
		;
		$financial_data = $this->db->query($query_string, array($rm_id, $rm_id, $rm_id))->result_array();
		if(!empty($financial_data)){
			$financial_data = $financial_data[0];
			$data['rmusers'][$rm_id]['outstanding'] = number_format($financial_data['outstanding']);
			$data['rmusers'][$rm_id]['outstanding_ratas'] = number_format($financial_data['outstanding_ratas']);
			$data['rmusers'][$rm_id]['simpanan'] = number_format($financial_data['simpanan']);
			$data['rmusers'][$rm_id]['simpanan_ratas'] = number_format($financial_data['simpanan_ratas']);
			$data['rmusers'][$rm_id]['current_cpa'] = number_format($financial_data['current_cpa']);

		}

	}

	$this->load->view('layout/header.php');
	$this->load->view('layout/side-nav.php');
	$this->load->view('layout/top-nav.php');
	$this->load->view('performance/leaderboard.php', $data);
	$this->load->view('layout/footer.php');
}
}

?>
