<?php

class Financial_highlights_model extends CI_Model {

    private $year_previous;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $today = new DateTime(date('Y-m-d H:i:s'));
        $year_current = $today->format('Y');
        $this->year_previous = $year_current - 1;
    }

    public function get($vcif, $year) {
        $result = array();

        $today = new DateTime(date('Y-m-d H:i:s'));
        $year_current = $year;

        if (empty($vcif)) {
            return result;
        }

        //Get Skeleton
        $this->db->select(<<<SQL
groups.id group_id, 
groups.group_name, 
details.id detail_id, 
details.detail_name
SQL
        );
        $this->db->from('financialhighlight_groups groups');
        $this->db->join('financialhighlight_details details', 'groups.id = details.group_id');
        $rows = $this->db->get()->result();
        foreach ($rows as $row) {
            $group_id = $row->group_id;
            if (!array_key_exists($group_id, $result)) {
                $result[$group_id] = array(
                    'name' => $row->group_name,
                    'details' => array()
                );
            }

            $detail_id = $row->detail_id;
            $result[$group_id]['details'][$detail_id] = array(
                'name' => $row->detail_name,
                $year_current - 1 => 0,
                $year_current - 2 => 0,
                $year_current - 3 => 0
            );
        }
        $year_negative_one = $year_current - 1;
        $year_negative_three = $year_current - 3;
        $thn = array(
            $year_current - 3,
            $year_current - 2,
            $year_current - 1
        );
        $thn2 = array(
            $year_current - 1,
            $year_current - 2
        );
        $disable_year = array();
        $rows = $this->db->where('VCIF', $vcif)
                        ->where('YEAR', $thn2[0])
                        ->where('DOC_STATUS', 4)
                        ->get('ACCOUNT_PLANNINGS')->result();
        if (empty($rows)) {
            $rows2 = $this->db->where('VCIF', $vcif)
                            ->where('YEAR', $thn2[1])
                            ->where('DOC_STATUS', 4)
                            ->get('ACCOUNT_PLANNINGS')->result();
            if (empty($rows2)) {
                $disable_year = [0, 0];
            } else {
                $disable_year = [1, 0];
            }
        } else {
            $disable_year = [1, 1];
        }

        $this->db->select('currency.currency_id');
        $this->db->from('financialhighlight_currency currency');
        $this->db->where('currency.vcif', $vcif);
        $this->db->where('currency.data_year', $year_current);
        $currency = $this->db->get()->result();

        if ($currency == !null) {
            foreach ($currency as $currenc) {
                $currencys = $currenc->currency_id;
            }
        } else {

            $currencys = 0;
        }


        $this->db->select('groups.id group_id, groups.group_name, details.id detail_id, details.detail_name, values.data_year, values.data_value');
        $this->db->from('financialhighlight_groups groups');
        $this->db->join('financialhighlight_details details', 'groups.id = details.group_id', 'left');
        $this->db->join('financialhighlight_values values', 'details.id = values.detail_id', 'right');

        $this->db->where('values.vcif', $vcif);
        $this->db->where('values.data_year >=', $year_negative_three);
        $this->db->where('values.data_year <=', $year_negative_one);

        $rows = $this->db->get()->result();
        foreach ($rows as $row) {
            $group_id = $row->group_id;
            $detail_id = $row->detail_id;
            $data_year = $row->data_year;
            $result[$group_id]['details'][$detail_id][$data_year] = number_format($row->data_value, 2);
        }

        $result = array(
            'years' => $thn,
            'disable_year' => $disable_year,
            'data' => $result,
            'currency' => $currencys
        );

        return $result;
    }

    public function save_financial_highlight_value($vcif, $rows, $year_now, $currency) {
        $this->db->trans_start();
        $this->db->where('VCIF', $vcif);
        $this->db->where('DATA_YEAR', $year_now);
        $this->db->delete('FINANCIALHIGHLIGHT_CURRENCY');
        $this->insert_financial_highlight_currency($vcif, $currency, $year_now);
        $this->delete_financial_highlight_value($vcif, $rows);
        $this->insert_financial_highlight_value($vcif, $rows);
        $this->db->trans_complete();
        $hasil = array(
            'success' => TRUE,
            'message' => "Data Has been saved"
        );
        return $hasil;
    }

    public function checkDocStatus($vcif, $year_now, $password) {
        $rows = $this->db->where('VCIF', $vcif)
                        ->where('YEAR', $year_now)
                        ->where('DOC_STATUS', 4)
                        ->get('ACCOUNT_PLANNINGS')->result();
        $hasil = array(
            'success' => TRUE,
            'vcif' => $vcif,
            'year' => $year_now,
            'message' => "Data Has been saved"
        );
        if (empty($rows)) {
            $hasil['success'] = false;
            return $hasil;
        } else {
            $chgData = array(
                'DOC_STATUS' => 0
            );
            $rows = $this->db->where('VCIF', $vcif)
                    ->where('YEAR', $year_now)
                    ->where('DOC_STATUS', 4)
                    ->update('ACCOUNT_PLANNINGS', $chgData);
            $hasil['success'] = true;
            return $hasil;
        }
    }

    private function delete_financial_highlight_value($vcif, $rows) {
        $detail_ids = array();
        $data_year = array();
        foreach ($rows as $row) {
            $detail_ids[] = $row->detail_id;
            $detail_year[] = $row->data_year;
        }

        $this->db->from('financialhighlight_values');

        $this->db->where('vcif', $vcif);
        $this->db->where_in('data_year', $detail_year);
        $this->db->where_in('detail_id', $detail_ids);

        $this->db->delete();
    }

    private function insert_financial_highlight_value($vcif, $rows) {
        foreach ($rows as $row) {
            $row->vcif = $vcif;
        }
        $this->db->insert_batch('financialhighlight_values', $rows);
    }

    private function insert_financial_highlight_currency($vcif, $currency, $year_now) {
        $newData = [
            'VCIF' => $vcif,
            'CURRENCY_ID' => $currency,
            'DATA_YEAR' => $year_now,
            'ADDON' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('FINANCIALHIGHLIGHT_CURRENCY', $newData);
    }

}
