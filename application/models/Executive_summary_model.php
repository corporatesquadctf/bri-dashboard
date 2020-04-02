<?php

class Executive_summary_model extends CI_Model {

    private $month_names = array('', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

    function __construct() {
        parent::__construct();
    }

    public function get_classified_loan($division) {
        $year = date('Y');
        $month = date('m');
        $month--;
        if ($month == 0) {
            $month = 12;
            $year--;
        }
        $query_string = <<<SQL
            SELECT kolektibilitas, baki_debet, total_rekening
            FROM exec_sum_classified_loan
            WHERE DIVISION = ? 
            AND YEAR = ?
            AND MONTH = ?
SQL
        ;
        $rows = $this->db->query($query_string, array($division, $year, $month))->result();
        return $rows;
    }

    public function get_plafon($start, $end, $division) {
        $start_year = explode("-", $start)[0];
        $end_year = explode("-", $end)[0];
        //
        $query_string = <<<SQL
            SELECT plafon, year, month 
            FROM exec_sum_plafon 
            WHERE DIVISION = ? 
            AND YEAR >= ?
            AND YEAR <= ?
SQL;
        $rows = $this->db->query($query_string, array($division, $start_year, $end_year))->result();
        $mapped_result = [];
        foreach ($rows as $row) {
            $year_month = "{$row->year}-{$row->month}";
            $mapped_result[$year_month] = $row->plafon;
        }
        $result = $this->sort_and_pad($start, $end, $mapped_result, 'plafon');
        return $result;
    }

    public function get_loan_outstanding($start, $end, $division) {
        $start_year = explode("-", $start)[0];
        $end_year = explode("-", $end)[0];
        //
        $query_string = <<<SQL
            SELECT outstanding, ratas, year, month 
            FROM exec_sum_loan_outstanding 
            WHERE DIVISION = ? 
            AND YEAR >= ?
            AND YEAR <= ?
SQL;
        $rows = $this->db->query($query_string, array($division, $start_year, $end_year))->result();
        $mapped_result = [];
        foreach ($rows as $row) {
            $year_month = "{$row->year}-{$row->month}";
            $mapped_result[$year_month] = array(
                'outstanding' => $row->outstanding,
                'ratas' => $row->ratas
            );
        }
        $result = $this->sort_and_pad($start, $end, $mapped_result, ['outstanding', 'ratas']);
        return $result;
    }

    public function get_customer_profit($start, $end, $division) {
        $start_year = explode("-", $start)[0];
        $end_year = explode("-", $end)[0];
        //
        $query_string = <<<SQL
            SELECT setelah_modal, year, month 
            FROM exec_sum_customer_profit 
            WHERE DIVISION = ? 
            AND YEAR >= ?
            AND YEAR <= ?
SQL;
        $rows = $this->db->query($query_string, array($division, $start_year, $end_year))->result();
        $mapped_result = [];

        foreach ($rows as $row) {
            $year_month = "{$row->year}-{$row->month}";
            $mapped_result[$year_month] = $row->setelah_modal;
        }
        $result = $this->sort_and_pad($start, $end, $mapped_result, 'setelah_modal');
        return $result;
    }

    public function get_loan_sector($division) {
        $year = date('Y');
        $month = date('m');
        $month--;
        if ($month == 0) {
            $month = 12;
            $year--;
        }
        $query_string = <<<SQL
            SELECT jenis, baki_debet, rek
            FROM exec_sum_loan_sector
            WHERE DIVISION = ? 
            AND YEAR = ?
            AND MONTH = ?
SQL
        ;
        $rows = $this->db->query($query_string, array($division, $year, $month))->result();
        return $rows;
    }

    public function get_interest_income($start, $end, $division) {
        $start_year = explode("-", $start)[0];
        $end_year = explode("-", $end)[0];
        //
        $query_string = <<<SQL
            SELECT bunga, bunga_total, year, month 
            FROM exec_sum_interest_income
            WHERE DIVISION = ? 
            AND YEAR >= ?
            AND YEAR <= ?
SQL;
        $rows = $this->db->query($query_string, array($division, $start_year, $end_year))->result();
        $mapped_result = [];
        foreach ($rows as $row) {
            $year_month = "{$row->year}-{$row->month}";
            $mapped_result[$year_month] = array(
                'bunga' => $row->bunga,
                'bunga_total' => $row->bunga_total
            );
        }

        $result = $this->sort_and_pad($start, $end, $mapped_result, ['bunga', 'bunga_total']);
        return $result;
    }

    public function get_fee_income($start, $end, $division) {
        $start_year = explode("-", $start)[0];
        $end_year = explode("-", $end)[0];
        //
        $query_string = <<<SQL
            SELECT fee, year, month 
            FROM exec_sum_fee_income
            WHERE DIVISION = ? 
            AND YEAR >= ?
            AND YEAR <= ?
SQL;
        $rows = $this->db->query($query_string, array($division, $start_year, $end_year))->result();
        $mapped_result = [];

        foreach ($rows as $row) {
            $year_month = "{$row->year}-{$row->month}";
            $mapped_result[$year_month] = $row->fee;
        }
        $result = $this->sort_and_pad($start, $end, $mapped_result, 'fee');
        return $result;
    }

    public function get_dpk($start, $end, $division) {
        $start_year = explode("-", $start)[0];
        $end_year = explode("-", $end)[0];
        //
        $query_string = <<<SQL
            SELECT saldo, avrgsaldo, year, month 
            FROM exec_sum_dpk
            WHERE DIVISION = ? 
            AND YEAR >= ?
            AND YEAR <= ?
SQL;
        $rows = $this->db->query($query_string, array($division, $start_year, $end_year))->result();
        $mapped_result = [];

        foreach ($rows as $row) {
            $year_month = "{$row->year}-{$row->month}";
            $mapped_result[$year_month] = array(
                'saldo' => $row->saldo,
                'avrgsaldo' => $row->avrgsaldo
            );
        }
        $result = $this->sort_and_pad($start, $end, $mapped_result, ['saldo', 'avrgsaldo']);
        return $result;
    }

    public function get_giro($start, $end, $division) {
        $start_year = explode("-", $start)[0];
        $end_year = explode("-", $end)[0];
        //
        $query_string = <<<SQL
            SELECT saldo, avrgsaldo, year, month 
            FROM exec_sum_giro
            WHERE DIVISION = ? 
            AND YEAR >= ?
            AND YEAR <= ?
SQL;
        $rows = $this->db->query($query_string, array($division, $start_year, $end_year))->result();
        $mapped_result = [];
        foreach ($rows as $row) {
            $year_month = "{$row->year}-{$row->month}";
            $mapped_result[$year_month] = array(
                'saldo' => $row->saldo,
                'avrgsaldo' => $row->avrgsaldo
            );
        }
        $result = $this->sort_and_pad($start, $end, $mapped_result, ['saldo', 'avrgsaldo']);
        return $result;
    }

    public function get_deposito($start, $end, $division) {
        $start_year = explode("-", $start)[0];
        $end_year = explode("-", $end)[0];
        //
        $query_string = <<<SQL
            SELECT saldo, avrgsaldo, year, month 
            FROM exec_sum_deposito
            WHERE DIVISION = ? 
            AND YEAR >= ?
            AND YEAR <= ?
SQL;
        $rows = $this->db->query($query_string, array($division, $start_year, $end_year))->result();
        $mapped_result = [];

        foreach ($rows as $row) {
            $year_month = "{$row->year}-{$row->month}";
            $mapped_result[$year_month] = array(
                'saldo' => $row->saldo,
                'avrgsaldo' => $row->avrgsaldo
            );
        }
        $result = $this->sort_and_pad($start, $end, $mapped_result, ['saldo', 'avrgsaldo']);
        return $result;
    }

    public function get_loany($start, $end, $division) {
        $start_year = explode("-", $start)[0];
        $end_year = explode("-", $end)[0];
        //
        $query_string = <<<SQL
            SELECT pend_bunga, baki_debet_ratas, year, month 
            FROM exec_sum_loany_raw
            WHERE DIVISION = ? 
            AND YEAR >= ?
            AND YEAR <= ?
SQL;
        $rows = $this->db->query($query_string, array($division, $start_year, $end_year))->result();
        $mapped_result = [];
        foreach ($rows as $row) {
            $year_month = "{$row->year}-{$row->month}";
            $saldo = 0;
            if (!empty($row->baki_debet_ratas) && $row->baki_debet_ratas > 0) {
                $saldo = $row->pend_bunga * 100 / $row->baki_debet_ratas;
            }
            $mapped_result[$year_month] = $saldo;
        }
        $result = $this->sort_and_pad($start, $end, $mapped_result, 'saldo');
        return $result;
    }

    private function sort_and_pad($start, $end, $array, $indices) {
        /* $direct refers to whether or not the content of the array is 
         * another array, or a singleton
         */

        $direct = FALSE;
        if (!is_array($indices)) {
            $direct = TRUE;
            $indices = array($indices);
        }
        //Infinite Loop Protection
        $counter = 24;
        // Determining Year and Month
        $end_year = explode("-", $end)[0];
        $end_month = explode("-", $end)[1];
        $year = explode("-", $start)[0];
        $month = explode("-", $start)[1];

        $end_month ++;
        if ($end_month > 12):
            $end_month = 1;
            $end_year ++;
        endif;

        //
        $result = [];
        while ($counter > 0 && !($year == $end_year && $month == $end_month)) {
            $year_month = "{$year}-{$month}";

            //Initial Data
            $month_data = [];
            $month_data['Year'] = $year;
            $month_data['Month'] = $this->month_names[$month];
            //
            foreach ($indices as $index) {
                $month_data[$index] = 0;
            }
            //
            if (array_key_exists($year_month, $array)) {
                if ($direct) {
                    $array[$year_month] = array($indices[0] => $array[$year_month]);
                }
                foreach ($indices as $index) {
                    $month_data[$index] = $array[$year_month][$index];
                }
            }
            $result[] = $month_data;
            $month++;
            if ($month > 12) {
                $year++;
                $month = 1;
            }
            $counter--;
        }
        return $result;
    }

}
