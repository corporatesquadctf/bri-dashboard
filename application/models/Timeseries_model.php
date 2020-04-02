<?php

class Timeseries_model extends CI_Model {

    private $year_current;

    function __construct() {
        parent::__construct();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
    }

    public function get_data($start, $end, $divisi, $user_is_restricted) {

        $today = new DateTime(date('Y-m-d H:i:s'));
        $end = date_create($end . '-01');
        $dateStart = date('Ym01', strtotime('-1 months', strtotime($start)));
        $dateEnd = $end->format('Ymd');
        $data = Array();
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
[month]    = LEFT(DATENAME(MONTH,d.d),3),
[year]     = YEAR(d.d), 
[dates]     = LEFT(DATENAME(MONTH,d.d),3) + ' ' + convert(varchar(4), YEAR(d.d)),
profit = COALESCE(SUM(o.LABA_RUGI_FTP_SETELAH_MODAL),0), 
outstanding = COALESCE(SUM(o.BAKI_DEBET),0), 
fee_income = COALESCE(SUM(o.FEEBASED),0),
interest = COALESCE(SUM(o.PEND_BUNGA),0)

FROM d 
LEFT OUTER JOIN dbo.VIEW_CUSTOMER_MAPPING AS v ON v.div_id = ?
LEFT OUTER JOIN dbo.FACT_SUMMARY_LABA_RUGI AS o 
  ON o.POSISI >= d.d
    AND o.POSISI < DATEADD(MONTH, 1, d.d)
    AND v.cif = o.cifno
GROUP BY d.d
ORDER BY d.d;
SQL
        ;
        $rows = $this->db->query($query_string, array($dateStart, $dateEnd, $divisi))->result();
        $data['profit'] = Array();
        foreach ($rows as $key => $row) {
            if ($key > 0) {
                //PROFIT
                $profit = new stdClass();
                $row->index = $key;
                $delta = $row->profit - $rows[$key - 1]->profit;
                if ($delta != 0) {
                    if ($delta < 0) {
                        $number = abs($delta) * -1;
                        $row->delta = number_format($number / 1000000);
                    } else {
                        $row->delta = number_format($delta / 1000000);
                    };
                } else {
                    $row->delta = 0;
                }
                if ($rows[$key - 1]->profit == 0) {
                    $row->percent = "-";
                } else {
                    $row->percent = number_format(($delta / $rows[$key - 1]->profit) * 100, 2);
                }
                $profit->index = $key;
                $profit->dates = $row->dates;
                $profit->profit = number_format($row->profit / 1000000);
                $profit->delta = $row->delta;
                $profit->percent = $row->percent;
                $data['profit'][] = $profit;
                //OUTSTANDING
                $outstanding = new stdClass();
                $delta2 = $row->outstanding - $rows[$key - 1]->outstanding;
                if ($delta2 != 0) {
                    if ($delta2 < 0) {
                        $number = abs($delta2) * -1;
                        $row->delta2 = number_format($number / 1000000);
                    } else {
                        $row->delta2 = number_format($delta2 / 1000000);
                    };
                } else {
                    $row->delta2 = 0;
                }
                if ($rows[$key - 1]->outstanding == 0) {
                    $row->percent2 = "-";
                } else {
                    $row->percent2 = number_format(($delta2 / $rows[$key - 1]->outstanding) * 100, 2);
                }
                $outstanding->index = $key;
                $outstanding->dates = $row->dates;
                $outstanding->outstanding = number_format($row->outstanding / 1000000);
                $outstanding->delta = $row->delta2;
                $outstanding->percent = $row->percent2;
                $data['outstanding'][] = $outstanding;
                //FEE INCOME
                $fee_income = new stdClass();
                $delta3 = $row->fee_income - $rows[$key - 1]->fee_income;
                if ($delta3 != 0) {
                    if ($delta3 < 0) {
                        $number = abs($delta3) * -1;
                        $row->delta3 = number_format($number / 1000000);
                    } else {
                        $row->delta3 = number_format($delta3 / 1000000);
                    };
                } else {
                    $row->delta3 = 0;
                }
                if ($rows[$key - 1]->fee_income == 0) {
                    $row->percent3 = "-";
                } else {
                    $row->percent3 = number_format(($delta3 / $rows[$key - 1]->fee_income) * 100, 2);
                }
                $fee_income->index = $key;
                $fee_income->dates = $row->dates;
                $fee_income->fee_income = number_format($row->fee_income / 1000000);
                $fee_income->delta = $row->delta3;
                $fee_income->percent = $row->percent3;
                $data['fee_income'][] = $fee_income;
                //INTEREST
                $interest = new stdClass();
                $delta4 = $row->interest - $rows[$key - 1]->interest;
                if ($delta4 != 0) {
                    if ($delta4 < 0) {
                        $number = abs($delta4) * -1;
                        $row->delta4 = number_format($number / 1000000);
                    } else {
                        $row->delta4 = number_format($delta4 / 1000000);
                    };
                } else {
                    $row->delta4 = 0;
                }
                if ($rows[$key - 1]->interest == 0) {
                    $row->percent4 = "-";
                } else {
                    $row->percent4 = number_format(($delta4 / $rows[$key - 1]->interest) * 100, 2);
                }
                $interest->index = $key;
                $interest->dates = $row->dates;
                $interest->interest = number_format($row->interest / 1000000);
                $interest->delta = $row->delta4;
                $interest->percent = $row->percent4;
                $data['interest'][] = $interest;
            };
        };

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
[month]    = LEFT(DATENAME(MONTH,d.d),3),
[year]     = YEAR(d.d), 
[dates]     = LEFT(DATENAME(MONTH,d.d),3) + ' ' + convert(varchar(4), YEAR(d.d)),
npl = COALESCE(SUM(o.BAKI_DEBET),0)

FROM d 
LEFT OUTER JOIN dbo.VIEW_CUSTOMER_MAPPING AS v ON v.div_id = ?
LEFT OUTER JOIN dbo.FACT_KREDIT_CPA AS o 
  ON o.POSISI >= d.d
    AND o.POSISI < DATEADD(MONTH, 1, d.d)
    AND v.cif = o.cifno
    AND o.KOLEKTIBILITAS > 2
GROUP BY d.d
ORDER BY d.d;
SQL
        ;
        $rows = $this->db->query($query_string, array($dateStart, $dateEnd, $divisi))->result();
        foreach ($rows as $key => $row) {
            if ($key > 0) {
                //NPL
                $npl = new stdClass();
                $row->index = $key;
                $delta = $row->npl - $rows[$key - 1]->npl;
                if ($delta != 0) {
                    if ($delta < 0) {
                        $number = abs($delta) * -1;
                        $row->delta = number_format($number / 1000000);
                    } else {
                        $row->delta = number_format($delta / 1000000);
                    };
                } else {
                    $row->delta = 0;
                }
                if ($rows[$key - 1]->npl == 0) {
                    $row->percent = "-";
                } else {
                    $row->percent = number_format(($delta / $rows[$key - 1]->npl) * 100, 2);
                }
                $npl->index = $key;
                $npl->dates = $row->dates;
                $npl->npl = number_format($row->npl / 1000000);
                $npl->delta = $row->delta;
                $npl->percent = $row->percent;
                $data['npl'][] = $npl;
            }
        }
        $data['masterDivisi'] = $this->db
                        ->select('m.id, m.division_name')
                        ->from('MASTER_DIVISIONS m')
                        ->where('STATUS', 1)
                        ->where('DIVISION_TYPE', 1)
                        ->get()->result();
        if ($divisi != $this->session->get_userdata()['DIVISION'] && $user_is_restricted == false) {
            $data['divisiNow'] = $divisi;
        } else {
            $data['divisiNow'] = $this->session->get_userdata()['DIVISION'];
        };
        $data['restricted'] = $user_is_restricted;
        return $data;
    }

}
