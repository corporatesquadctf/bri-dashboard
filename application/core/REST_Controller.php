<?php

class REST_Controller extends CI_Controller {

    protected $request;

    public function __construct() {

        parent::__construct();

        $raw_json = file_get_contents('php://input');
        $this->request = json_decode($raw_json);
    }

    //Response Encoding
    public function set_output($output, $headers = NULL) {
        $this->output->set_content_type('application/json');
        if (isset($headers)) {
            foreach ($headers as $key => $value) {
                $this->output->set_header($key . ': ' . $value);
            }
        }
        $this->output->set_output(json_encode($output));
    }

    //Simple Outputs
    public function set_output_error($message, $status_code = STATUS_CODE_SERVER_ERROR) {
        $output = array(
            'statusCode' => $status_code,
            'success' => FALSE,
            'message' => $message
        );
        $this->output->set_output(json_encode($output));
    }

    public function set_output_success($message) {
        $output = array(
            'statusCode' => STATUS_CODE_OK,
            'success' => TRUE,
            'message' => $message
        );
        $this->output->set_output(json_encode($output));
    }

     public function insertLog($pers, $name, $action, $ori, $change, $msg){
        $this->load->database();
        $newData = [
            'personal_number'   => $pers,
            'action' => $action,
            'addon' => date('Y-m-d H:i:s'),
            'name' => $name,
            'ori' => $ori,
            'change' => $change,
            'msg' => $msg
        ];
        $updateData = $this->db->insert('LOG', $newData);
    }

}

?>