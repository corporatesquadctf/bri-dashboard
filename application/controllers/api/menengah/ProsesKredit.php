<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ProsesKredit extends REST_Controller
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
        $this->limit_per_page = 15;

        $this->load->model('api/ProsesKredit_model');
        $this->load->model('api/Pipeline_model');
    }

    public function list_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $user['ROLE_ID']  = $this->post('RoleId');
        $user['DIVISION'] = $this->post('UnitKerjaId');
        $uker_id          = $this->post('uker_id');
        $rm_id            = $this->post('rm_id');
        $keyword          = $this->post('keyword');
        $data['user'] = $user;
        $userId = $user['USER_ID'];
        $roleId = $user['ROLE_ID'];

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'UserId, RoleId and UnitKerjaId cannot be empty'
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
        // $data['rsUsulanPlafond'] = $rsUsulanPlafond;

        if ($uker_id || $rm_id || $keyword || $this->post('usulanPlafond')) {
            switch ($user['ROLE_ID']) {
                case 12:
                    $createdBy      = $userId;
                    $usulanPlafond  = 0;
                    $divisionId     = $user['DIVISION'];
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 14:
                    $createdBy       = $rm_id;
                    $usulanPlafond   = $this->post('usulanPlafond');
                    $divisionId      = $user['DIVISION'];
                    $rsUker          = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM            = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 16:
                    $createdBy      = $rm_id;
                    $usulanPlafond  = $this->post('usulanPlafond');
                    $divisionId     = $uker_id;
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 17:
                    $createdBy      = $rm_id;
                    $usulanPlafond  = 0;
                    $divisionId     = $user['DIVISION'];
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
                case 18:
                    $createdBy      = $rm_id;
                    $divisionId     = $user['DIVISION'];
                    $usulanPlafond  = 0;
                    $rsUker         = $this->Pipeline_model->getUnitKerjaMenengah($divisionId);
                    $rsRM           = $this->Pipeline_model->getUserByRole(12, $divisionId);
                    break;
            }
            $data['rsUker'] = $rsUker;
            $data['rsRM']   = $rsRM;

            $data['uker_id']        = $uker_id;
            $data['rm_id']          = $rm_id;
            $data['usulanPlafond']  = $this->post('usulanPlafond');
            $data['keyword']        = $keyword;
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
            }
            $data['rsUker'] = $rsUker;
            $data['rsRM']   = $rsRM;

            $data['uker_id']        = 0;
            $data['rm_id']          = 0;
            $data['usulanPlafond']  = 0;
            $data['keyword']        = '';
        }

        $filter = array(
            'Keyword'       => $data['keyword'],
            'UsulanPlafond' => $usulanPlafond,
            'DivisionId'    => $divisionId,
            'CreatedBy'     => $createdBy,
            'rowno'         => $rowno,
            'limit_per_page' => $this->limit_per_page,
        );

        $TotalProsesKredit = $this->ProsesKredit_model->getTotalProsesKredit($filter);
        if($TotalProsesKredit[0]->Total){
            $total_page = ceil($TotalProsesKredit[0]->Total / $this->limit_per_page);
            if ($current_page > $total_page) {
                $this->response([
                    'data'    => [],
                    'status'  => FALSE,
                    'message' => 'Page not found'
                ], REST_Controller::HTTP_NOT_FOUND);
                return;
            } else {
                $rsProsesKredit            = $this->ProsesKredit_model->getProsesKredit($filter);
                $data['prosesKredit']      = $rsProsesKredit;
                $data['TotalProsesKredit'] = $TotalProsesKredit[0]->Total;
                $data['current_page']      = $current_page;
                $data['total_page']        = $total_page;
    
                if ($rsProsesKredit) {
                    $this->response([
                        'data'      => $data,
                        'status'    => "Success",
                        'message'   => 'Success fecht list Proses Kredit'
                    ], REST_Controller::HTTP_OK);
                } else {                
                    $this->response([
                        'data'      => [],
                        'status'    => FALSE,
                        'message'   => 'No Proses Kredit were found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
        } else {                
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'No Proses Kredit were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function detail_post()
    {

        $user['USER_ID']  = $this->post('UserId');
        $user['ROLE_ID']  = $this->post('RoleId');
        $user['DIVISION'] = $this->post('UnitKerjaId');

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $data['user']   = $user;
        $prosesKreditId = $this->post('ProsesKreditId');

        if (empty($prosesKreditId)) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'ProsesKreditId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $role = $user['ROLE_ID'];
        switch ($role) {
            case 12:
                $arrTujuanDiteruskan    = array(17, 18);
                $rsTujuanDiteruskan     = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);

                $rsTujuanDikembalikan   = array();
                break;
            case 14:
                $arrTujuanDiteruskan    = array(17);
                $rsTujuanDiteruskan     = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);

                $arrTujuanDikembalikan  = array(17);
                $rsTujuanDikembalikan   = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);
                break;
            case 16:
                $arrTujuanDiteruskan    = array(17);
                $rsTujuanDiteruskan     = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);

                $arrTujuanDikembalikan  = array(17);
                $rsTujuanDikembalikan   = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);
                break;
            case 17:
                $arrTujuanDiteruskan    = array(14, 18);
                $rsTujuanDiteruskan     = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);

                $arrTujuanDikembalikan  = array(12, 18);
                $rsTujuanDikembalikan   = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);
                break;
            case 18:
                $arrTujuanDiteruskan    = array(17);
                $rsTujuanDiteruskan     = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDiteruskan);

                $arrTujuanDikembalikan  = array(12, 17);
                $rsTujuanDikembalikan   = $this->ProsesKredit_model->getTujuanProsesKreditOption($arrTujuanDikembalikan);
                break;
            default:
                $rsTujuanDiteruskan     = array();
                $rsTujuanDikembalikan   = array();
                break;
        }
        $data['tujuanDiteruskanOption']   = $rsTujuanDiteruskan;
        $data['tujuanDikembalikanOption'] = $rsTujuanDikembalikan;

        $rsProsesKredit       = $this->ProsesKredit_model->getDetailProsesKredit($prosesKreditId);
        $data['prosesKredit'] = $rsProsesKredit;

        $rsHistoryProsesKreditRM       = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 12);
        $data['historyProsesKreditRM'] = $rsHistoryProsesKreditRM;

        //$rsADK = $this->ProsesKredit_model->getUserInformation(17, $rsProsesKredit->DivisionId);
        $rsHistoryProsesKreditADK       = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 17);
        $data['historyProsesKreditADK'] = $rsHistoryProsesKreditADK;
        //$data['adk'] = $rsADK;

        //$rsARK = $this->ProsesKredit_model->getUserInformation(18, $rsProsesKredit->DivisionId);
        $rsHistoryProsesKreditARK       = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 18);
        $data['historyProsesKreditARK'] = $rsHistoryProsesKreditARK;
        //$data['ark'] = $rsARK;

        //$rsKomite = $this->ProsesKredit_model->getUserInformation(14, $rsProsesKredit->DivisionId);
        $rsHistoryProsesKreditKomite       = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 14);
        $data['historyProsesKreditKomite'] = $rsHistoryProsesKreditKomite;
        //$data['komite'] = $rsKomite;

        $rsHistoryProsesKreditKadiv       = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId, 16);
        $data['historyProsesKreditKadiv'] = $rsHistoryProsesKreditKadiv;

        //$historyProsesKredit = $this->ProsesKredit_model->getHistoryProsesKredit($prosesKreditId);

        $rsFasilitasPermohonan       = $this->ProsesKredit_model->getFasilitasPermohonan($prosesKreditId);
        $data["fasilitasPermohonan"] = $rsFasilitasPermohonan;

        $pipelineId         = $rsProsesKredit->PipelineId;
        $rsPipeline         = $this->Pipeline_model->getDetailPipeline($pipelineId);
        $data['pipeline']   = $rsPipeline;

        $rsProsesKreditDocument = $this->ProsesKredit_model->getProsesKreditDocument();
        foreach ($rsProsesKreditDocument as $row) {
            $rsProsesKreditDocumentStatus = $this->ProsesKredit_model->getProsesKreditDocumentStatus($prosesKreditId, $row->ProsesKreditDocumentId);
            if (!empty($rsProsesKreditDocumentStatus)) {
                $row->Status      = $rsProsesKreditDocumentStatus[0]->Status;
                $row->Description = $rsProsesKreditDocumentStatus[0]->Description;
            } else {
                $row->Status      = NULL;
                $row->Description = NULL;
            }
        }
        $data["ProsesKreditDocument"] = $rsProsesKreditDocument;

        /* Set Kadiv and Wapinwil as a Komite */
        if ($user["ROLE_ID"] == 16) {
            $roleId = 14;
        } else {
            $roleId = $user["ROLE_ID"];
        }
        $data["roleId"] = $roleId;

        $this->response([
            'data'      => $data,
            'status'    => "Success",
            'message'   => 'Success fecht Detail Proses Kredit'
        ], REST_Controller::HTTP_OK);
    }
}
