<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Portofolio_kredit extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->checkTokenMobile();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->model('PortofolioKredit_model');
        $this->load->model('PortofolioRm_model');
        $this->load->model("ProsesKredit_model");
        $this->load->model("api/Pipeline_model");

        $this->limit_per_page = 15;
        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $this->current_datetime = $current_datetime->format('Y-m-d H:i:s');
    }

    public function list_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $user['ROLE_ID']  = $this->post('RoleId');
        $user['DIVISION'] = $this->post('UnitKerjaId');
        $data['user']     = $user;
        $userId           = $user['USER_ID'];
        $roleId           = $user['ROLE_ID'];

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'  => FALSE,
                'message' => 'UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $current_page         = $this->post('page') ? $this->post('page') : 1;
        $rowno                = (($current_page - 1) * $this->limit_per_page);

        $rsUsulanPlafond = array();
        $data1 = array('id' => 1, 'name' => 'Kurang dari 50M');
        $rsUsulanPlafond[]  = (object) $data1;
        $data2 = array('id' => 2, 'name' => '50M atau lebih');
        $rsUsulanPlafond[]  = (object) $data2;
        $data['rsUsulanPlafond'] = $rsUsulanPlafond;

        if ($this->post('rm_id') || $this->post('usulanPlafond') || $this->post('ukerId') || $this->post('keyword')) {
            switch ($user['ROLE_ID']) {
                case 12:
                    $createdBy      = $userId;
                    $usulanPlafond  = 0;
                    $divisionId     = $user['DIVISION'];
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 14:
                    $createdBy      = $this->post('rm_id');
                    $usulanPlafond  = $this->post('usulanPlafond');
                    $divisionId     = $user['DIVISION'];
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 16:
                    $createdBy      = $this->post('rm_id');
                    $usulanPlafond  = $this->post('usulanPlafond');
                    $divisionId     = $this->post('ukerId');
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 17:
                    $createdBy      = $this->post('rm_id');
                    $usulanPlafond  = 0;
                    $divisionId     = $user['DIVISION'];
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 18:
                    $createdBy      = $this->post('rm_id');
                    $divisionId     = $user['DIVISION'];
                    $usulanPlafond  = 0;
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
            }
            $data['rsUker']  = $rsUker;
            $data['rsRM']    = $rsRM;

            $data['uker_id'] = $this->post('ukerId');
            $data['rm_id']   = $this->post('rm_id');
            $data['usulanPlafond'] = $this->post('usulanPlafond');
            $data['keyword'] = $this->post('keyword');
        } else {
            switch ($user['ROLE_ID']) {
                case 12:
                    $createdBy      = $userId;
                    $usulanPlafond  = 0;
                    $divisionId     = $user['DIVISION'];
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 14:
                    $createdBy      = 0;
                    $usulanPlafond  = 0;
                    $divisionId     = $user['DIVISION'];
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 16:
                    $createdBy      = 0;
                    $usulanPlafond  = 0;
                    $divisionId     = 0;
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rsRM           = $this->Pipeline_model->getUserByRole(12);
                    break;
                case 17:
                    $createdBy      = 0;
                    $usulanPlafond  = 0;
                    $divisionId     = $user['DIVISION'];
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 18:
                    $createdBy      = 0;
                    $usulanPlafond  = 0;
                    $divisionId     = $user['DIVISION'];
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                default:
                    $createdBy      = 0;
                    $usulanPlafond  = 0;
                    $divisionId     = 0;
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rsRM           = $this->Pipeline_model->getUserByRole(12);
                    break;
            }
            $data['rsUker'] = $rsUker;
            $data['rsRM']   = $rsRM;

            $data['uker_id'] = 0;
            $data['rm_id']   = 0;
            $data['usulanPlafond'] = 0;
            $data['keyword'] = '';
        }

        $filter = array(
            'Keyword'       => $data['keyword'],
            'UsulanPlafond' => $usulanPlafond,
            'DivisionId'    => $divisionId,
            'CreatedBy'     => $createdBy,
            'rowno'         => $rowno,
            'limit_per_page' => $this->limit_per_page,
        );

        $TotalPortofolioKredit = $this->PortofolioKredit_model->getTotalPortofolioKredit($filter);
        if ($TotalPortofolioKredit[0]->Total > 0) {
            $total_page = ceil($TotalPortofolioKredit[0]->Total / $this->limit_per_page);
            if ($current_page > $total_page) {
                $this->response([
                    'data'    => [],
                    'status'  => FALSE,
                    'message' => 'Page not found'
                ], REST_Controller::HTTP_NOT_FOUND);
                return;
            } else {
                $rsPortofolioKredit            = $this->PortofolioKredit_model->getPortofolioKredit($filter);
                $data['PortofolioKredit']      = $rsPortofolioKredit;
                $data['TotalPortofolioKredit'] = $TotalPortofolioKredit[0]->Total;
                $data['Current_page']          = $current_page;
                $data['Total_page']            = $total_page;

                $this->response([
                    'data'    => $data,
                    'status'  => "Success",
                    'message' => 'Success fecht list Proses Kredit'
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'data'    => [],
                'status'  => FALSE,
                'message' => 'No Portofolio Kredit were found'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        }
    }

    public function detail_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $user['ROLE_ID']  = $this->post('RoleId');
        $user['DIVISION'] = $this->post('UnitKerjaId');
        $data['user'] = $user;

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'  => FALSE,
                'message' => 'UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $role = $user['ROLE_ID'];
        switch ($role) {
            case 12:
                $arrTujuanDiteruskan = array(17, 18);
                $rsTujuanDiteruskan  = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                //echo json_encode($rsTujuanDiteruskan); die;

                $rsTujuanDikembalikan = array();
                //echo json_encode($rsTujuanDikembalikan); die;
                break;
            case 14:
                $arrTujuanDiteruskan = array(17);
                $rsTujuanDiteruskan  = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                //echo json_encode($rsTujuanDiteruskan); die;

                $arrTujuanDikembalikan = array(17);
                $rsTujuanDikembalikan  = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);
                break;
            case 16:
                $arrTujuanDiteruskan = array(17);
                $rsTujuanDiteruskan  = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                //echo json_encode($rsTujuanDiteruskan); die;

                $arrTujuanDikembalikan = array(17);
                $rsTujuanDikembalikan  = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);
                break;
            case 17:
                $arrTujuanDiteruskan = array(14, 18);
                $rsTujuanDiteruskan  = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                //echo json_encode($rsTujuanDiteruskan); die;

                $arrTujuanDikembalikan = array(12, 18);
                $rsTujuanDikembalikan  = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);
                break;
            case 18:
                $arrTujuanDiteruskan = array(17);
                $rsTujuanDiteruskan  = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);
                //echo json_encode($rsTujuanDiteruskan); die;

                $arrTujuanDikembalikan = array(12, 17);
                $rsTujuanDikembalikan  = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);
                break;
            default:
                $rsTujuanDiteruskan   = array();
                $rsTujuanDikembalikan = array();
                break;
        }
        $data['tujuanDiteruskanOption']   = $rsTujuanDiteruskan;
        $data['tujuanDikembalikanOption'] = $rsTujuanDikembalikan;

        $portofolioKreditId       = $this->post("portofolioKreditId");
        $rsPortofolioKredit       = $this->PortofolioKredit_model->getDetailPortofolioKredit($portofolioKreditId);
        $data['PortofolioKredit'] = $rsPortofolioKredit;

        if (empty($rsPortofolioKredit)) {
            $this->response([
                'data'    => [],
                'status'  => FALSE,
                'message' => 'Portofolio Kredit not found'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        $rsHistoryProsesPortofolioRM       = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 12);
        $data['historyPortofolioKreditRM'] = $rsHistoryProsesPortofolioRM;

        $rsHistoryPortofolioKreditADK       = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 17);
        $data['historyPortofolioKreditADK'] = $rsHistoryPortofolioKreditADK;

        $rsHistoryPortofolioKreditARK       = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 18);
        $data['historyPortofolioKreditARK'] = $rsHistoryPortofolioKreditARK;

        $rsHistoryPortofolioKreditKomite       = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 14);
        $data['historyPortofolioKreditKomite'] = $rsHistoryPortofolioKreditKomite;

        $rsHistoryPortofolioKreditKadiv       = $this->PortofolioKredit_model->getHistoryPortofolioKredit($portofolioKreditId, 16);
        $data['historyPortofolioKreditKadiv'] = $rsHistoryPortofolioKreditKadiv;

        $rsFasilitasPermohonan       = $this->PortofolioKredit_model->getFasilitasPermohonan($portofolioKreditId);
        $data["fasilitasPermohonan"] = $rsFasilitasPermohonan;

        $noRekening         = $rsPortofolioKredit->NoRekening;
        $periode            = $rsPortofolioKredit->Periode;
        $rsPortofolio       = $this->PortofolioRm_model->getDetailPortofolioKredit($noRekening, $periode);
        $data['portofolio'] = $rsPortofolio;

        //$rsPortofolioKreditDocument = $this->PortofolioKredit_model->getPortofolioKreditDocument();
        //$data["PortofolioKreditDocument"] = $rsPortofolioKreditDocument;

        $rsProsesKreditDocument = $this->ProsesKredit_model->getProsesKreditDocument();
        foreach ($rsProsesKreditDocument as $row) {
            $rsProsesKreditDocumentStatus = $this->PortofolioKredit_model->getPortofolioKreditDocumentStatus($portofolioKreditId, $row->ProsesKreditDocumentId);
            if (!empty($rsProsesKreditDocumentStatus)) {
                $row->Status      = $rsProsesKreditDocumentStatus[0]->Status;
                $row->Description = $rsProsesKreditDocumentStatus[0]->Description;
            } else {
                $row->Status      = NULL;
                $row->Description = NULL;
            }
        }
        $data["PortofolioKreditDocument"] = $rsProsesKreditDocument;

        /* Set Kadiv and Wapinwil as a Komite */
        if ($user["ROLE_ID"] == 16) {
            $roleId = 14;
        } else {
            $roleId = $user["ROLE_ID"];
        }
        $data["roleId"] = $roleId;

        $this->response([
            'data'    => $data,
            'status'  => "Success",
            'message' => 'Success fecht detail Proses Kredit'
        ], REST_Controller::HTTP_OK);
    }
}
