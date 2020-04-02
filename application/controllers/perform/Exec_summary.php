<?php 

class Exec_summary extends CI_Controller {

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
    $today = new DateTime(date('Y-m-d H:i:s'));
    $dateStart = date('Y-m-01', strtotime('-11 month', time()));
    $dateStart = date('Ym01', strtotime('-11 month', time()));
    $dateEnd = $today->format('Ymd');

    $user_id = $_SESSION['USER_ID'];
    $division_id = $_SESSION['DIVISION'];

    $data = array(
          'segment' => array(),
          'platinum' => array(),
          'gold' => array(),
          'silver' => array(),
          'bronze' => array(),
          'platinum_total' => 0,
          'gold_total' => 0,
          'silver_total' => 0,
          'bronze_total' => 0,
          'total' => 0,
          'platinum_percentage' => 0,
          'gold_percentage' => 0,
          'silver_percentage' => 0,
          'bronze_percentage' => 0
    );
    /*
    $query_string = <<<SQL
SELECT  plafon = SUM(PLAFON_EFEKTIF),
        tgl = CAST(YEAR(POSISI) AS VARCHAR(4)) + '-' + CAST(MONTH(POSISI) AS VARCHAR(2))
FROM    FACT_KREDIT_CPA 
WHERE   POSISI >= ? 
AND     POSISI <= GETDATE()
GROUP BY CAST(YEAR(POSISI) AS VARCHAR(4)) + '-' + CAST(MONTH(POSISI) AS VARCHAR(2)) 
ORDER BY tgl ASC;
SQL
        ;
    */
    $query_string = <<<SQL
DECLARE @StartDate SMALLDATETIME, @EndDate SMALLDATETIME;

SELECT @StartDate = ?, @EndDate = ?;

;WITH d(d) AS 
(
  SELECT DATEADD(MONTH, n, DATEADD(MONTH, DATEDIFF(MONTH, 0, @StartDate), 0))
  FROM ( SELECT TOP (DATEDIFF(MONTH, @StartDate, @EndDate) + 1) 
    n = ROW_NUMBER() OVER (ORDER BY [object_id]) - 1
    FROM sys.all_objects ORDER BY [object_id] ) AS n
)
SELECT 
  [Month]    = DATENAME(MONTH, d.d), 
  [Year]     = YEAR(d.d), 
  plafon = COALESCE(SUM(o.PLAFON_EFEKTIF),0) 
FROM d LEFT OUTER JOIN dbo.FACT_KREDIT_CPA AS o
  ON o.POSISI >= d.d
  AND o.POSISI < DATEADD(MONTH, 1, d.d)
GROUP BY d.d
ORDER BY d.d;
SQL
            ;
    $rows = $this->db->query($query_string, array($dateStart,$dateEnd))->result();
    /*
    print_r($rows);die;
    $data['result'] = array();
    foreach ($rows as $row) {
      $bln = $row->tgl . '-01';
      $bln = strtotime($bln);
      $monthNum  = date('m', $bln);
      $yearNum  = date('Y', $bln);
      $dateObj   = DateTime::createFromFormat('!m', $monthNum);
      $monthName = $dateObj->format('M');
      $row->bln = $monthName . ' ' . $yearNum;
      $data['result'][] = $row;
    }
    print_r($data['result']);die;
    */
    $data['user_is_restricted'] = false;
    $this->load->view('layout/header.php');
    $this->load->view('layout/side-nav.php');
    $this->load->view('layout/top-nav.php');
    $this->load->view('performance/executive_summary_view.php', $data);
    $this->load->view('layout/footer.php');
  }
}

?>
