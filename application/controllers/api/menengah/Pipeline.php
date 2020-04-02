<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pipeline extends REST_Controller
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

        $this->load->model('api/Pipeline_model');
        $this->limit_per_page = 15;
    }

    function draft_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $user['ROLE_ID']  = $this->post('RoleId');
        $user['DIVISION'] = $this->post('UnitKerjaId');
        $uker_id          = $this->post('uker_id');
        $rm_id            = $this->post('rm_id');
        $keyword          = $this->post('keyword');
        $year             = date('Y');
        $rsEWS            = $this->Pipeline_model->getEWSOption();
        // $user             = $this->post('personalnumber');
        $data['EWSOption'] = $rsEWS;

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $current_page         = $this->post('page') ? $this->post('page') : 1;
        $rowno                = (($current_page - 1) * $this->limit_per_page);

        if ($uker_id || $rm_id || $keyword) {

            switch ($user['ROLE_ID']) {
                case USER_ROLE_RM_MENENGAH:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION'], $user['USER_ID']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH:
                case USER_ROLE_WP:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO:
                case USER_ROLE_KADIV:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option']   = $rs_rm;
            $data['uker_id']     = $uker_id;
            $data['rm_id']       = $rm_id;
            $data['keyword']     = $keyword;

            $arr_layer_id    = NULL;
            $arr_status_id   = array('1', '5');
            $data_post       = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID'       => $arr_status_id,
                'CREATED_BY'      => $user['USER_ID'],
                'DIVISION_ID'     => $user['DIVISION'],
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD'         => $keyword,
                'YEAR'            => NULL,
                'rowno'           => $rowno,
                'limit_per_page'  => $this->limit_per_page,
            );

            $arr_layer_id    = NULL;
            $arr_status_id   = array('2', '3', '4', '5', '6', '7', '8');
            $data_post2      = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID'       => $arr_status_id,
                'CREATED_BY'      => $user['USER_ID'],
                'DIVISION_ID'     => $user['DIVISION'],
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD'         => $keyword,
                'YEAR'            => $year,
                'rowno'           => NULL,
                'limit_per_page'  => NULL,
            );
        } else {
            switch ($user['ROLE_ID']) {
                case USER_ROLE_RM_MENENGAH:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION'], $user['USER_ID']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH:
                case USER_ROLE_WP:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO:
                case USER_ROLE_KADIV:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option']   = $rs_rm;
            $data['uker_id']     = 0;
            $data['rm_id']       = 0;
            $data['keyword']     = NULL;

            $arr_layer_id         = NULL;
            $arr_status_id        = array('1', '5');
            $data_post            = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID'       => $arr_status_id,
                'CREATED_BY'      => $user['USER_ID'],
                'DIVISION_ID'     => $user['DIVISION'],
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD'         => NULL,
                'YEAR'            => NULL,
                'rowno'           => $rowno,
                'limit_per_page'  => $this->limit_per_page,
            );

            $arr_layer_id         = NULL;
            $arr_status_id        = array('2', '3', '4', '5', '6', '7', '8');
            $data_post2           = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID'       => $arr_status_id,
                'CREATED_BY'      => $user['USER_ID'],
                'DIVISION_ID'     => $user['DIVISION'],
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD'         => NULL,
                'YEAR'            => $year,
                'rowno'           => NULL,
                'limit_per_page'  => NULL,
            );
        }

        $totalpipeline        = $this->Pipeline_model->getTotalPipeline($data_post);
        $total_page           = ceil($totalpipeline[0]->Total / $this->limit_per_page);

        if ($totalpipeline[0]->Total == 0) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'No Pipeline were found'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        } elseif ($current_page > $total_page) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'Page not found'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        } else {
            $rs_pipeline        = $this->Pipeline_model->getPipeline($data_post);
            foreach ($rs_pipeline as $row) {
                $isActive       = $this->Pipeline_model->checkStatusPipeline($row->NPWP);
                $row->isActive  = $isActive;
            }
            $rs_pipeline2       = $this->Pipeline_model->getPipeline($data_post2);
            $data['pipeline']   = $rs_pipeline;
            // $data['pipeline2']  = $rs_pipeline2;
            $data['user']       = $user;
            $data['totalpipeline'] = $totalpipeline[0]->Total;
            $data['current_page']      = $current_page;
            $data['total_page']        = $total_page;

            $this->response([
                'data'      => $data,
                'status'    => "Success",
                'message'   => 'Success fecht draft pipeline'
            ], REST_Controller::HTTP_OK);
        }
    }

    function submitPipeline_post()
    {

        $user['USER_ID']  = $this->post('UserId');
        $user['ROLE_ID']  = $this->post('RoleId');
        $user['DIVISION'] = $this->post('UnitKerjaId');

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION']) || empty($this->post('id'))) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'id(id Pipeline), UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $arr_pipeline_id = $this->post('id');
        // return var_dump($arr_pipeline_id);
        $arrPipeline = array();
        foreach ($arr_pipeline_id as $row) {
            $rsPipeline = $this->Pipeline_model->getDetailPipeline($row);
            $LayerStatusId = $rsPipeline->LayerStatusId;
            if ($LayerStatusId == 1) {
                array_push($arrPipeline, $row);
            }
        }

        if (!empty($arrPipeline)) {
            $data_post = array(
                'layer_status_id' => 1,
                'status_id'       => 2,
                'arr_pipeline_id' => $arrPipeline,
                'user_id'         => $user['USER_ID'],
                'division_id'     => $user['DIVISION'],
                'role_id'         => $user['ROLE_ID'],
                'comment'         => ''
            );
            //echo json_encode($data_post); die;

            if ($this->Pipeline_model->updatePipelineStatus($data_post)) {
                $this->response([
                    "status"  => "Success",
                    "message" => "Pipeline has been successfully submitted!"
                ], REST_Controller::HTTP_OK);
                return;
            }
        } else {
            $this->response([
                "status"  => FALSE,
                "message" => "Pipeline submitted already"
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
    }

    function approvalPipeline_post()
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

        switch ($user['ROLE_ID']) {
            case USER_ROLE_RM_MENENGAH:
                $layer_status_id = 1;
                break;
            case USER_ROLE_GH_MENENGAH:
                $layer_status_id = 2;
                break;
            case USER_ROLE_WP:
                $layer_status_id = 3;
                break;
            case USER_ROLE_ERO:
                $layer_status_id = 4;
                break;
            case USER_ROLE_KADIV:
                $layer_status_id = 5;
                break;
        }

        $arr_pipeline_id = $this->post('id');
        $arrPipeline     = array();
        foreach ($arr_pipeline_id as $row) {
            $rsPipeline     = $this->Pipeline_model->getDetailPipeline($row);
            $LayerStatusId  = $rsPipeline->LayerStatusId;
            $StatusId       = $rsPipeline->StatusId;
            if ($LayerStatusId == $layer_status_id) {
                if ($LayerStatusId == 2 || $LayerStatusId == 3 || $LayerStatusId == 4 || $LayerStatusId == 5) {
                    if ($StatusId == 3) array_push($arrPipeline, $row);
                } else {
                    array_push($arrPipeline, $row);
                }
            }
        }

        $status_id = $this->post('status');
        if (!empty($arrPipeline)) {
            if ($this->post('comment') != NULL) {
                $comment = $this->post('comment');
            } else $comment = "";
            $data_post = array(
                'layer_status_id' => $layer_status_id,
                'status_id'       => $status_id,
                'arr_pipeline_id' => $arr_pipeline_id,
                'comment'         => strip_tags($comment),
                'user_id'         => $user['USER_ID'],
                'division_id'     => $user['DIVISION'],
                'role_id'         => $user['ROLE_ID']
            );
            if ($status_id == 2) {
                $flashmsg = 'Pipeline has been successfully submitted!';
                if ($this->Pipeline_model->updatePipelineStatus($data_post)) {
                    $this->response([
                        "status"  => "success",
                        "message" => $flashmsg,
                    ], REST_Controller::HTTP_OK);
                    return;
                } else {
                    $this->response([
                        "status"  => FALSE,
                        "message" => "Failed to submit Pipeline",
                    ], REST_Controller::HTTP_CONFLICT);
                    return;
                }
            } else if ($status_id == 4) {
                $flashmsg = 'Pipeline has been successfully approved!';
                if ($this->Pipeline_model->updatePipelineStatus($data_post)) {
                    $this->response([
                        "status"  => "success",
                        "message" => $flashmsg,
                    ], REST_Controller::HTTP_OK);
                    return;
                } else {
                    $this->response([
                        "status"  => FALSE,
                        "message" => "Failed to approve Pipeline",
                    ], REST_Controller::HTTP_CONFLICT);
                    return;
                }
            } else if ($status_id == 5) {
                $flashmsg = 'Pipeline has been successfully rejected!';
                if ($this->Pipeline_model->updatePipelineStatus($data_post)) {
                    $this->response([
                        "status"  => "success",
                        "message" => $flashmsg,
                    ], REST_Controller::HTTP_OK);
                    return;
                } else {
                    $this->response([
                        "status" => FALSE,
                        "message" => "Failed to reject Pipeline",
                    ], REST_Controller::HTTP_CONFLICT);
                    return;
                }
            }
        } else {
            $flashmsg = 'Failed to Update Pipeline';
            $this->response([
                "status"  => FALSE,
                "message" => $flashmsg,
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
    }

    function submitted_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $user['ROLE_ID']  = $this->post('RoleId');
        $user['DIVISION'] = $this->post('UnitKerjaId');

        $uker_id          = $this->post('uker_id');
        $rm_id            = $this->post('rm_id');
        $keyword          = $this->post('keyword');
        $sektorUsahaId    = $this->post('sektorUsahaId');

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $current_page         = $this->post('page') ? $this->post('page') : 1;
        $rowno                = (($current_page - 1) * $this->limit_per_page);

        $year = date('Y');

        $rs_sektor_usaha = $this->Pipeline_model->getSektorUsahaOption();
        $data['sektor_usaha_option'] = $rs_sektor_usaha;

        switch ($user['ROLE_ID']) {
            case USER_ROLE_GH_MENENGAH:
                $arr_layer_id = array('2');
                $arr_status_id = array('2', '3');

                $arr_layer_id2 = array('3', '4', '5');
                $arr_status_id2 = array('2', '4');
                break;
            case USER_ROLE_WP:
                $arr_layer_id = array('3');
                $arr_status_id = array('2', '3');

                $arr_layer_id2 = array('4', '5');
                $arr_status_id2 = array('2', '3', '4');
                break;
            case USER_ROLE_ERO:
                $arr_layer_id = array('4');
                $arr_status_id = array('2', '3');

                $arr_layer_id2 = array('5');
                $arr_status_id2 = array('2', '3', '4');
                break;
            case USER_ROLE_KADIV:
                $arr_layer_id = array('5');
                $arr_status_id = array('2', '3');

                $arr_layer_id2 = array('5');
                $arr_status_id2 = array('3');
                break;
            default:
                $arr_layer_id = array('5');
                $arr_status_id = array('2', '3');

                $arr_layer_id2 = array('5');
                $arr_status_id2 = array('3');
                break;
        }

        if ($uker_id || $rm_id || $keyword) {
            switch ($user['ROLE_ID']) {
                case USER_ROLE_GH_MENENGAH:
                case USER_ROLE_WP:
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO:
                case USER_ROLE_KADIV:
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $uker_id);
                    $division_id = $uker_id;
                    break;
                default:
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $uker_id);
                    $division_id = $uker_id;
                    break;
            }

            $data['uker_option']    = $rs_uker;
            $data['rm_option']      = $rs_rm;
            $data['uker_id']        = $uker_id;
            $data['rm_id']          = $rm_id;
            $data['sektorUsahaId']  = $sektorUsahaId;
            $data['keyword']        = $keyword;

            $data_post = array(
                'LAYER_STATUS_ID'   => $arr_layer_id,
                'STATUS_ID'         => $arr_status_id,
                'DIVISION_ID'       => $division_id,
                'CREATED_BY'        => $rm_id,
                'SEKTOR_USAHA_ID'   => $sektorUsahaId,
                'KEYWORD'           => $keyword,
                'YEAR'              => $year,
                'rowno'             => $rowno,
                'limit_per_page'    => $this->limit_per_page,
            );
            $data_post2 = array(
                'LAYER_STATUS_ID'   => $arr_layer_id2,
                'STATUS_ID'         => $arr_status_id2,
                'DIVISION_ID'       => $division_id,
                'CREATED_BY'        => $rm_id,
                'SEKTOR_USAHA_ID'   => $sektorUsahaId,
                'KEYWORD'           => $keyword,
                'YEAR'              => $year,
                'rowno'             => NULL,
                'limit_per_page'    => NULL,
            );
        } else {
            switch ($user['ROLE_ID']) {
                case USER_ROLE_GH_MENENGAH:
                case USER_ROLE_WP:
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO:
                case USER_ROLE_KADIV:
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default:
                    $rs_uker = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }

            $data['uker_option']    = $rs_uker;
            $data['rm_option']      = $rs_rm;
            $data['uker_id']        = 0;
            $data['rm_id']          = 0;
            $data['sektorUsahaId']  = 0;
            $data['keyword']        = NULL;

            $data_post = array(
                'LAYER_STATUS_ID'   => $arr_layer_id,
                'STATUS_ID'         => $arr_status_id,
                'DIVISION_ID'       => $division_id,
                'SEKTOR_USAHA_ID'   => 0,
                'KEYWORD'           => NULL,
                'CREATED_BY'        => 0,
                'YEAR'              => $year,
                'rowno'             => $rowno,
                'limit_per_page'    => $this->limit_per_page,
            );

            $data_post2 = array(
                'LAYER_STATUS_ID'   => $arr_layer_id2,
                'STATUS_ID'         => $arr_status_id2,
                'DIVISION_ID'       => $division_id,
                'SEKTOR_USAHA_ID'   => 0,
                'KEYWORD'           => NULL,
                'CREATED_BY'        => 0,
                'YEAR'              => $year,
                'rowno'             => NULL,
                'limit_per_page'    => NULL,
            );
        }

        $totalpipeline        = $this->Pipeline_model->getTotalPipeline($data_post);
        $total_page           = ceil($totalpipeline[0]->Total / $this->limit_per_page);

        if ($totalpipeline[0]->Total == 0) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'No Pipeline'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        } elseif ($current_page > $total_page) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'Page not found'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        } else {
            $rs_pipeline = $this->Pipeline_model->getPipeline($data_post);
            $rs_pipeline2 = $this->Pipeline_model->getPipeline($data_post2);
            $data['pipeline']      = $rs_pipeline;
            // $data['pipeline2']  = $rs_pipeline2;
            $data['user']          = $user;
            $data['totalpipeline'] = $totalpipeline[0]->Total;
            $data['current_page']  = $current_page;
            $data['total_page']    = $total_page;

            $this->response([
                'data'      => $data,
                'status'    => "Success",
                'message'   => 'Success fecht Pipeline List'
            ], REST_Controller::HTTP_OK);
        }
    }

    function history_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $user['ROLE_ID']  = $this->post('RoleId');
        $user['DIVISION'] = $this->post('UnitKerjaId');

        $uker_id          = $this->post('uker_id');
        $rm_id            = $this->post('rm_id');
        $keyword          = $this->post('keyword');
        $year             = $this->post('year');

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $current_page         = $this->post('page') ? $this->post('page') : 1;
        $rowno                = (($current_page - 1) * $this->limit_per_page);

        $dataYear = array(
            ["id" => 0,             "name"  => "3 Tahun Terakhir"],
            ["id" => date("Y"),     "name"  => date("Y")],
            ["id" => date("Y") - 1, "name"  => date("Y") - 1],
            ["id" => date("Y") - 2, "name"  => date("Y") - 2]
        );
        $data['dataYear'] = $dataYear;
        switch ($user['ROLE_ID']) {
            case USER_ROLE_RM_MENENGAH:
                $arr_layer_id  = array('1');
                $arr_status_id = array('2', '3', '4', '5', '6', '7', '8');
                break;
            case USER_ROLE_GH_MENENGAH:
                $arr_layer_id  = array('2');
                $arr_status_id = array('2', '3', '4', '5', '6', '7', '8');
                break;
            case USER_ROLE_WP:
                $arr_layer_id  = array('3');
                $arr_status_id = array('2', '3', '4', '5', '6', '7', '8');
                break;
            case USER_ROLE_ERO:
                $arr_layer_id  = array('4');
                $arr_status_id = array('2', '3', '4', '5', '6', '7', '8');
                break;
            case USER_ROLE_KADIV:
                $arr_layer_id  = array('5');
                $arr_status_id = array('2', '3', '4', '5', '6', '7', '8');
                break;
            default:
                $arr_layer_id  = array('1', '2', '3', '4', '5');
                $arr_status_id = array('2', '3', '4', '5', '6', '7', '8');
                break;
        }

        if ($uker_id || $rm_id || $keyword) {
            $year = $year ? array($year) : array(date("Y"), date("Y") - 1, date("Y") - 2);
            switch ($user['ROLE_ID']) {
                case USER_ROLE_RM_MENENGAH:
                    $created_by  = $user['USER_ID'];
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH:
                case USER_ROLE_WP:
                    $created_by  = $rm_id;
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO:
                case USER_ROLE_KADIV:
                    $created_by  = $rm_id;
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $uker_id);
                    $division_id = $uker_id;
                    break;
                default:
                    $created_by  = $rm_id;
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $uker_id);
                    $division_id = $uker_id;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option']   = $rs_rm;
            $data['uker_id']     = $uker_id;
            $data['rm_id']       = $rm_id;
            $data['year']        = $year;
            $data['keyword']     = $keyword;

            if ($year == 0) {
                $arrYear = array(date("Y"), date("Y") - 1, date("Y") - 2);
            } else {
                $arrYear = array($year);
            }

            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID'       => $arr_status_id,
                'DIVISION_ID'     => $division_id,
                'CREATED_BY'      => $created_by,
                'KEYWORD'         => $keyword,
                'YEAR'            => $arrYear,
                'rowno'           => $rowno,
                'limit_per_page'  => $this->limit_per_page,
            );
        } else {
            $year = array(date("Y"), date("Y") - 1, date("Y") - 2);
            switch ($user['ROLE_ID']) {
                case USER_ROLE_RM_MENENGAH:
                    $created_by  = $user['USER_ID'];
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH:
                case USER_ROLE_WP:
                    $created_by  = 0;
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO:
                case USER_ROLE_KADIV:
                    $created_by  = 0;
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default:
                    $created_by  = 0;
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option']   = $rs_rm;
            $data['uker_id']     = 0;
            $data['rm_id']       = 0;
            $data['year']        = 0;
            $data['keyword']     = NULL;

            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID'       => $arr_status_id,
                'CREATED_BY'      => $created_by,
                'DIVISION_ID'     => $division_id,
                'KEYWORD'         => NULL,
                'YEAR'            => $year,
                'rowno'           => $rowno,
                'limit_per_page'  => $this->limit_per_page,
            );
        }

        $totalpipeline        = $this->Pipeline_model->getTotalHistoryPipeline($data_post);
        $total_page           = ceil($totalpipeline[0]->Total / $this->limit_per_page);

        if ($totalpipeline[0]->Total == 0) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'No Pipeline'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        } elseif ($current_page > $total_page) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'Page not found'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        } else {
            $rs_pipeline = $this->Pipeline_model->getHistoryPipeline($data_post);
            $i = 0;
            foreach ($rs_pipeline as $row) {
                $rs_pipeline[$i]->IsActive = $this->Pipeline_model->checkActivePipeline($row->CIFId);
                $i++;
            }
            $data['pipeline']      = $rs_pipeline;
            $data['user']          = $user;
            $data['totalpipeline'] = $totalpipeline[0]->Total;
            $data['current_page']  = $current_page;
            $data['total_page']    = $total_page;

            $this->response([
                'data'      => $data,
                'status'    => "Success",
                'message'   => 'Success fecht history pipeline'
            ], REST_Controller::HTTP_OK);
        }
    }

    function approved_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $user['ROLE_ID']  = $this->post('RoleId');
        $user['DIVISION'] = $this->post('UnitKerjaId');

        $uker_id          = $this->post('uker_id');
        $rm_id            = $this->post('rm_id');
        $keyword          = $this->post('keyword');

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $current_page         = $this->post('page') ? $this->post('page') : 1;
        $rowno                = (($current_page - 1) * $this->limit_per_page);

        $rs_facility = $this->Pipeline_model->getFacilityOption();
        $data['fasilitasOption'] = $rs_facility;
        $fasilitas_option = "";
        foreach ($rs_facility as $row) {
            $fasilitas_option .= "<option value='" . $row->FacilityId . "'>" . $row->FacilityName . "</option>";
        }
        $data['facility_option'] = $fasilitas_option;

        $month = array(
            ["value" => 1, "name"  => "Januari"],
            ["value" => 2, "name"  => "Februari"],
            ["value" => 3, "name"  => "Maret"],
            ["value" => 4, "name"  => "April"],
            ["value" => 5, "name"  => "Mei"],
            ["value" => 6, "name"  => "Juni"],
            ["value" => 7, "name"  => "Juli"],
            ["value" => 8, "name"  => "Agustus"],
            ["value" => 9, "name"  => "September"],
            ["value" => 10, "name" => "Oktober"],
            ["value" => 11, "name" => "November"],
            ["value" => 12, "name" => "Desember"]
        );
        $data['month'] =  $month;

        $arr_layer_id  = array('1', '5');
        //Tambahkan 7 di arr_status_id jika batal masih ditampilkan di approved list
        $arr_status_id = array('4', '6', '7', '8');
        $year          = date('Y');
        switch ($user['ROLE_ID']) {
            case USER_ROLE_RM_MENENGAH:
                $created_by = $user['USER_ID'];
                break;
            case USER_ROLE_GH_MENENGAH:
            case USER_ROLE_WP:
            case USER_ROLE_ERO:
            case USER_ROLE_KADIV:
                $created_by = 0;
                break;
            default:
                $created_by = 0;
                break;
        }

        if ($uker_id || $rm_id || $keyword) {
            switch ($user['ROLE_ID']) {
                case USER_ROLE_RM_MENENGAH:
                    $created_by  = $user['USER_ID'];
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_GH_MENENGAH:
                case USER_ROLE_WP:
                    $created_by  = $rm_id;
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO:
                case USER_ROLE_KADIV:
                    $created_by  = $rm_id;
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $uker_id);
                    $division_id = $uker_id;
                    break;
                default:
                    $created_by  = $rm_id;
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $uker_id);
                    $division_id = $uker_id;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option']   = $rs_rm;
            $data['uker_id']     = $uker_id;
            $data['rm_id']       = $rm_id;
            $data['keyword']     = $keyword;

            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID'       => $arr_status_id,
                'DIVISION_ID'     => $division_id,
                'CREATED_BY'      => $created_by,
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD'         => $keyword,
                'YEAR'            => $year,
                'rowno'           => $rowno,
                'limit_per_page'  => $this->limit_per_page,
            );
        } else {
            switch ($user['ROLE_ID']) {
                case USER_ROLE_RM_MENENGAH:
                case USER_ROLE_GH_MENENGAH:
                case USER_ROLE_WP:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                    $division_id = $user['DIVISION'];
                    break;
                case USER_ROLE_ERO:
                case USER_ROLE_KADIV:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
                default:
                    $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                    $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                    $division_id = 0;
                    break;
            }

            $data['uker_option'] = $rs_uker;
            $data['rm_option']   = $rs_rm;
            $data['uker_id']     = 0;
            $data['rm_id']       = 0;
            $data['keyword']     = NULL;

            $data_post = array(
                'LAYER_STATUS_ID' => $arr_layer_id,
                'STATUS_ID'       => $arr_status_id,
                'CREATED_BY'      => $created_by,
                'DIVISION_ID'     => $division_id,
                'SEKTOR_USAHA_ID' => 0,
                'KEYWORD'         => NULL,
                'YEAR'            => $year,
                'rowno'           => $rowno,
                'limit_per_page'  => $this->limit_per_page,
            );
        }

        $totalpipeline        = $this->Pipeline_model->getTotalPipeline($data_post);
        $total_page           = ceil($totalpipeline[0]->Total / $this->limit_per_page);

        if ($totalpipeline[0]->Total == 0) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'No Pipeline'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        } elseif ($current_page > $total_page) {
            $this->response([
                'data'      => [],
                'status'    => FALSE,
                'message'   => 'Page not found'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        } else {
            $rs_pipeline = $this->Pipeline_model->getPipeline($data_post);

            $data['pipeline'] = $rs_pipeline;
            $data['user']     = $user;
            $data['totalpipeline'] = $totalpipeline[0]->Total;
            $data['current_page']  = $current_page;
            $data['total_page']    = $total_page;
            //echo json_encode($rs_pipeline); die;

            $this->response([
                'data'      => $data,
                'status'    => "Success",
                'message'   => 'Success fecht approved pipeline'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function detail_post()
    {
        $id = $this->post('PipelineId');
        $UserId = $this->post('UserId');

        if (empty($id) || empty($UserId)) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'PipelineId or UserId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        $rs_pipeline = $this->Pipeline_model->getDetailPipeline($id);

        $rs_data_source = $this->Pipeline_model->getPipelineDataSourceOption();
        $data['data_source_option'] = $rs_data_source;
        $rsEWS = $this->Pipeline_model->getEWSOption();
        $data['EWSOption'] = $rsEWS;
        $rs_customer = $this->Pipeline_model->getCustomerOption($rs_pipeline->CIFId, $UserId);
        $data['customer_option'] = $rs_customer;
        $rs_customer_type = $this->Pipeline_model->getCustomerTypeOption();
        $data['customer_type_option'] = $rs_customer_type;
        $rs_sektor_usaha = $this->Pipeline_model->getSektorUsahaOption();
        $data['sektor_usaha_option'] = $rs_sektor_usaha;
        $rs_sumber_tdb = $this->Pipeline_model->getSumberTDBOption();
        $data['sumber_tdb_option'] = $rs_sumber_tdb;
        $rs_facility = $this->Pipeline_model->getFacilityOption();
        $data['facility_option'] = $rs_facility;
        $rs_comment = $this->Pipeline_model->getLogPipeline($id);

        $rs_log = $this->Pipeline_model->getLogPipeline($id);
        $data['log_pipeline'] = $rs_log;


        $rs_sumber_ekonomi = $this->Pipeline_model->getSubSektorEkonomiOption($rs_pipeline->BusinessSector);
        $data['sub_sektor_ekonomi_option'] = $rs_sumber_ekonomi;
        $rs_detail_facility = $this->Pipeline_model->getDetailFacilityValue($id);
        $rsDetailFacilitySuplecy = $this->Pipeline_model->getDetailFacilitySuplecy($id);
        $arr_index = array();
        for ($i = 0; $i < count($rs_detail_facility); $i++) {
            array_push($arr_index, $i);
        }
        $data_post = array(
            'id'                 => $id,
            'created_by'         => $rs_pipeline->CreatedBy,
            'sumber_pipeline'    => $rs_pipeline->DataSourceId,
            'cif'                => $rs_pipeline->CIFId,
            'jenis_debitur'      => $rs_pipeline->CustomerMenengahTypeId,
            'nama_debitur'       => $rs_pipeline->CustomerName,
            'npwp_perusahaan'    => $rs_pipeline->NPWP,
            'alamat'             => $rs_pipeline->Address,
            'contact_person'     => $rs_pipeline->ContactPerson,
            'no_telp'            => $rs_pipeline->PhoneNumber,
            'jenis_usaha'        => $rs_pipeline->BusinessType,
            'sektor_usaha'       => $rs_pipeline->BusinessSector,
            'sub_sektor_ekonomi' => $rs_pipeline->EconomySubSector,
            'warna_lpg'          => $rs_pipeline->LPGStatus,
            'lpgDescription'     => $rs_pipeline->LPGDescription,
            'status_debitur'     => $rs_pipeline->CustomerStatusId,
            'plafond'            => $rs_pipeline->Plafond,
            'tdb'                => $rs_pipeline->CustomerResouceId,
            'sumber_tdb'         => $rs_pipeline->TDBResourceId,
            'jmlFasilitasSuplesi' => count($rsDetailFacilitySuplecy),
            'arrFasilitasSuplesi' => $rsDetailFacilitySuplecy,
            'jml_fasilitas'      => count($rs_detail_facility),
            'arr_fasilitas'      => $rs_detail_facility,
            'arr_index'          => $arr_index,
            'log_comment'        => $rs_comment
        );
        //echo json_encode($data_post); die;

        $data['pipeline'] = (object) $data_post;

        $this->response([
            'data'      => $data,
            'status'    => "Success",
            'message'   => 'Success fecht detail pipeline'
        ], REST_Controller::HTTP_OK);
    }

    function prosesPipeline_post()
    {
        $user['USER_ID']  = $this->post('UserId');
        $user['DIVISION'] = $this->post('UnitKerjaId');
        $user['ROLE_ID']  = $this->post('RoleId');

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $pipeline_id             = $this->post('pipeline_id');
        $isProcess               = $this->post('isProcess');
        $realisasi               = $this->post('realisasi');
        $jangkaWaktu             = $this->post("jangka_waktu");
        $dataFasilitasPermohonan = $this->post("data_fasilitas_permohonan");


        $rsPipeline       = $this->Pipeline_model->getDetailPipeline($pipeline_id);
        $LayerStatusId    = $rsPipeline->LayerStatusId;
        $StatusId         = $rsPipeline->StatusId;

        if ($LayerStatusId == 5 && $StatusId == 4) {
            $layer_status_id = 1;
            switch ($isProcess) {
                case 1:
                    $statusId = 6;
                    break;
                case 0:
                    $statusId = 4;
                    break;
            }
            $arrFasilitasPermohonan  = explode(",", $dataFasilitasPermohonan);
            $arrFasilitas = array();
            foreach ($arrFasilitasPermohonan as $row) {
                $fasilitasPermohonan = array(
                    "FacilityId" => $this->post("fasilitas_permohonan_" . $row),
                    "Plafond"    => str_replace(",", "", $this->post("plafond_" . $row))
                );
                array_push($arrFasilitas, $fasilitasPermohonan);
            }
            $data_post = array(
                'layer_status_id' => $layer_status_id,
                'status_id'       => $statusId,
                'bulanRealisasi'  => $realisasi,
                'jangka_waktu'    => $jangkaWaktu,
                'arrFasilitasPermohonan' => $arrFasilitas,
                'pipeline_id'     => $pipeline_id,
                'comment'         => NULL,
                'user_id'         => $user['USER_ID'],
                'division_id'     => $user['DIVISION'],
                'role_id'         => $user['ROLE_ID']
            );
            //echo json_encode($data_post); die;
            $flashmsg = 'Pipeline has been successfully processed!';
            if ($this->Pipeline_model->changeStatusApprovedPipeline($data_post)) {
                $this->response([
                    'status'    => "Success",
                    'message'   => $flashmsg
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status'    => FALSE,
                    'message'   => "Failed to process pipeline"
                ], REST_Controller::HTTP_CONFLICT);
            }
        } else {
            $this->response([
                'status'    => FALSE,
                'message'   => "Failed to process pipeline"
            ], REST_Controller::HTTP_CONFLICT);
        }
    }

    function batalPipeline_post()
    {
        $user['USER_ID']     = $this->post('UserId');
        $user['DIVISION']    = $this->post('UnitKerjaId');
        $user['ROLE_ID']     = $this->post('RoleId');

        if (empty($user['USER_ID']) || empty($user['ROLE_ID']) || empty($user['DIVISION'])) {
            $this->response([
                'status'    => FALSE,
                'message'   => 'UserId, RoleId and UnitKerjaId cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $pipeline_id         = $this->post('pipeline_id');
        $comment             = $this->post('comment');
        $layer_status_id     = 1;
        $data_post = array(
            'layer_status_id' => $layer_status_id,
            'status_id' => 7,
            'pipeline_id' => $pipeline_id,
            'comment' => $comment,
            'user_id' => $user['USER_ID'],
            'division_id' => $user['DIVISION'],
            'role_id' => $user['ROLE_ID']
        );
        //$this->Pipeline_model->changeStatusApprovedPipeline($data_post);
        $flashmsg = 'Pipeline has been successfully canceled!';
        if ($this->Pipeline_model->changeStatusApprovedPipeline($data_post)) {
            $this->response([
                'status'    => "Success",
                'message'   => $flashmsg
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status'    => FALSE,
                'message'   => "Failed to cancel pipeline"
            ], REST_Controller::HTTP_CONFLICT);
        }

        // echo json_encode($result);
    }
    
    function filter_post(){
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

        switch ($user['ROLE_ID']) {
            case USER_ROLE_RM_MENENGAH:
                $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION'], $user['USER_ID']);
                $division_id = $user['DIVISION'];
                break;
            case USER_ROLE_GH_MENENGAH:
            case USER_ROLE_WP:
                $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah($user['DIVISION']);
                $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH, $user['DIVISION']);
                $division_id = $user['DIVISION'];
                break;
            case USER_ROLE_ERO:
            case USER_ROLE_KADIV:
                $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                $division_id = 0;
                break;
            default:
                $rs_uker     = $this->Pipeline_model->getUnitKerjaMenengah();
                $rs_rm       = $this->Pipeline_model->getUserByRole(USER_ROLE_RM_MENENGAH);
                $division_id = 0;
                break;

            }
            $data['uker_option'] = $rs_uker;
            $data['rm_option']   = $rs_rm;
            $data['division_id'] = $division_id;
        $this->response([
            'data'      => $data,
            'status'    => 'Success',
            'message'   => 'Success Get Filter'
        ], REST_Controller::HTTP_OK);
        return;
    }
}
