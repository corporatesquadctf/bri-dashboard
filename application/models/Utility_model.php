<?php

class Utility_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('notification_model');

        $today = new DateTime(date('Y-m-d H:i:s'));
        $this->year_current = $today->format('Y');
        $this->todays = $today->format('Y-m-d H:i:s');
    }

    public function getCustomerType() {
        $sql = '
            SELECT CustomerTypeId, Name AS CustomerTypeName FROM CustomerType Where IsActive=1  
        ';
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function insertLogoToGroup($CustomerGroupId, $data) {

        $this->db->where('CustomerGroupId', $CustomerGroupId);
        $str = $this->db->update('CustomerGroup', $data);
        // echo "<br>".$this->db->last_query(); 
        // die();

        $error = $this->db->error();

        if($error['code']<>0) {
            $result = array(
                'status' => 'error',
                'message'=> $error['message']
            );
        } else {
            $result = array(
                'status' => 'success'
            );
        }

        return $result;
    }

    public function getViewCifDetails($CIF) {

        $sql = '
            SELECT a.CIF, a.VCIF, a.Name CompanyName, a.IsActive, b.Name CustomerName
            , c.Name CustomerGroupName 
            FROM DetailCustomerKorporasi a 
            LEFT JOIN CustomerKorporasi b on a.VCIF=b.VCIF 
            LEFT JOIN CustomerGroup c on b.CustomerGroupId=c.CustomerGroupId 
            WHERE a.CIF=\''.$CIF.'\'
        ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }
    public function transGroupSetMainCustomer($CustomerGroupId, $VCIF, $UserId) {
        $data = array(
            'CustomerGroupId'           => $CustomerGroupId, 
            'VCIF'                      => $VCIF, 
            'UserId'                    => $UserId, 
            );

        $str = $this->db->query('transGroupSetMainCustomer ?,?,?',$data);

        $error = $this->db->error();

        if($error['code']<>0) {
            $result = array(
                'status' => 'error',
                'message'=> $error['message']
            );
        } else {
            $result = array(
                'status' => 'success'
            );
        }

        return $result;
    }

    public function transAccountPlanningRemoveCustomer($AccountPlanningId, $VCIF, $UserId, $RMId) {
        $data = array(
            'AccountPlanningId'         => $AccountPlanningId, 
            'VCIF'                      => $VCIF, 
            'UserId'                    => $UserId, 
            );

        $str = $this->db->query('transAccountPlanningRemoveCustomer ?,?,?',$data);

        $error = $this->db->error();

        if($error['code']<>0) {
            $result = array(
                'status_remapping' => 'error',
                'message'=> $error['message']
            );
        } else {
            $this->notification_model->addNotif($RMId, "Account Planning", "Account Planning Status", "Your account planning status are set to Draft", "tasklist/AccountPlanning/view/".$AccountPlanningId."/input");
            
            $result = array(
                'status_remapping' => 'success'
            );
        }

        return $result;
    }

    public function generateVcif() {

        $sql = "
            SELECT TOP 1 SUBSTRING(VCIF,5,LEN(VCIF)) + 1 AS VCIF
                FROM CustomerKorporasi
                WHERE VCIF LIKE 'VCIF%'
                ORDER BY SUBSTRING(VCIF,5,LEN(VCIF)) DESC
        ";
        // echo $sql; //die();

        $result = $this->db->query($sql)->row_array();

        return "VCIF".$result['VCIF'];
    }


    public function getViewVcifList($searchTxt='') {

        $sql = '
            SELECT 
            a.VCIF, a.CustomerGroupId, a.Name CustomerName, a.IsActive, a.IsExisting, a.IsMain
            , b.Name CustomerGroupName
            FROM CustomerKorporasi a
            LEFT JOIN CustomerGroup b on a.CustomerGroupId=b.CustomerGroupId
            WHERE 1=1 
        ';
        if (!empty($searchTxt)) {
            $sql .= " AND (a.VCIF LIKE '%".$searchTxt."%' 
                OR a.Name LIKE '%".$searchTxt."%' OR b.Name LIKE '%".$searchTxt."%')
            ";
        }
        $sql .= ' ORDER BY a.Name ASC';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getViewVcifDetails($VCIF) {

        $sql = '
            SELECT 
            a.VCIF, a.CustomerGroupId, a.Name CustomerName, a.IsActive, a.IsExisting, a.IsMain IsMainGroup
            , b.Name CustomerGroupName
            , c.IsMain, c.AccountPlanningId
            FROM CustomerKorporasi a
            LEFT JOIN CustomerGroup b on a.CustomerGroupId=b.CustomerGroupId
            LEFT JOIN AccountPlanningCustomer c on a.VCIF=c.VCIF
            WHERE a.VCIF=\''.$VCIF.'\'
        ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getGroupCustomerList($CustomerGroupId) {
        $sql = "SELECT a.VCIF, a.Name CustomerName, b.AccountPlanningId
            FROM CustomerKorporasi a 
            LEFT JOIN AccountPlanningCustomer b on a.VCIF=b.VCIF
            where a.CustomerGroupId=".$CustomerGroupId;
            
        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getViewGroupList($searchTxt='') {

        $sql = '
            SELECT 
            "a"."CustomerGroupId", "a"."Name" AS "CustomerGroupName", "a"."Logo", "a"."ClassificationId", "a"."CustomerTypeId", "a"."CreatedDate", "a"."ModifiedDate"
            , "b"."Name" AS CustomerClassificationName
            , "c"."Name" AS CustomerTypeName
            , "c"."Name" AS CustomerTypeName
            , "d"."Name" AS CreatedBy
            , "e"."Name" AS ModifiedBy
            FROM CustomerGroup a
            LEFT JOIN Classification b ON "a"."ClassificationId"="b"."ClassificationId"
            LEFT JOIN CustomerType c ON "a"."CustomerTypeId"="c"."CustomerTypeId"
            LEFT JOIN [User] d ON "a"."CreatedBy"="d"."UserId"
            LEFT JOIN [User] e ON "a"."ModifiedBy"="e"."UserId"
            WHERE 1=1 
        ';
        if (!empty($searchTxt)) {
            $sql .= " AND (a.Name LIKE '%".$searchTxt."%' 
                OR CustomerGroupId IN (
                    SELECT CustomerGroupId
                    FROM CustomerKorporasi
                    WHERE Name LIKE '%".$searchTxt."%' OR VCIF LIKE '%".$searchTxt."%'
                )
                OR CustomerGroupId IN(
                    SELECT CustomerGroupId
                    FROM DisposisiCustomerGroup A, [User] B
                    WHERE A.IsActive=1 AND A.UserId=B.UserId
                        AND B.Name LIKE '%".$searchTxt."%'
                )
            ) ";
        }
        $sql .= ' ORDER BY a.Name ASC';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

    public function getViewGroupDetails($CustomerGroupId) {

        $sql = '
            SELECT 
            "a"."CustomerGroupId", "a"."Name" AS "CustomerGroupName", "a"."Description" AS "CustomerGroupDescription", "a"."Logo", "a"."ClassificationId", "a"."CustomerTypeId"
            , "b"."Name" AS CustomerClassificationName
            , "c"."Name" AS CustomerTypeName
            FROM CustomerGroup a
            LEFT JOIN Classification b ON "a"."ClassificationId"="b"."ClassificationId"
            LEFT JOIN CustomerType c ON "a"."CustomerTypeId"="c"."CustomerTypeId"
            WHERE CustomerGroupId='.$CustomerGroupId.' 
        ';

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function isCIFExist($CIF) {

        $sql = '
            SELECT 
            CIF
            FROM DetailCustomerKorporasi a
            WHERE CIF=\''.$CIF.'\' 
        ';
        // echo $sql; //die();

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function isGroupExist($Name) {

        $sql = '
            SELECT 
            CustomerGroupId
            FROM CustomerGroup a
            WHERE Name=\''.$Name.'\' 
        ';
        // echo $sql; //die();

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function isCustomerExist($Name) {

        $sql = '
            SELECT 
            VCIF
            FROM CustomerKorporasi
            WHERE Name=\''.$Name.'\' 
        ';
        // echo $sql; //die();

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getCustomerMainGroup($CustomerGroupId) {

        $sql = '
            SELECT VCIF
            FROM CustomerKorporasi
            WHERE CustomerGroupId='.$CustomerGroupId.' 
            AND IsMain=1
        ';
        // echo $sql; //die();

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function isVCIFMainAP($VCIF) {

        $sql = '
            SELECT 
            IsMain, AccountPlanningId
            FROM AccountPlanningCustomer a
            WHERE VCIF=\''.$VCIF.'\' 
        ';
        // echo $sql; //die();

        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getTotalViewCifLists($searchTxt = '') {
        $sql = '
            SELECT a.CIF
            FROM DetailCustomerKorporasi a 
            LEFT JOIN CustomerKorporasi b on a.VCIF=b.VCIF 
            LEFT JOIN CustomerGroup c on b.CustomerGroupId=c.CustomerGroupId 
            WHERE 1=1 
        ';
        if (!empty($searchTxt)) {
            $sql .= " AND (
                a.CIF LIKE '%".$searchTxt."%' 
                OR a.VCIF LIKE '%".$searchTxt."%' 
                OR a.Name LIKE '%".$searchTxt."%' 
                OR b.Name LIKE '%".$searchTxt."%'
                OR c.Name LIKE '%".$searchTxt."%'
                )
            ";
        }

        $result = $this->db->query($sql)->result_array();  

        return count($result);
        // return $this->db->count_all_results();
    }

    public function getViewCifLists($rowperpage='10', $rowno='0', $searchTxt='') {

        $sql = '
            SELECT a.CIF, a.VCIF, a.Name CompanyName, a.IsActive, b.Name CustomerName
            , c.Name CustomerGroupName 
            FROM DetailCustomerKorporasi a 
            LEFT JOIN CustomerKorporasi b on a.VCIF=b.VCIF 
            LEFT JOIN CustomerGroup c on b.CustomerGroupId=c.CustomerGroupId 
            WHERE 1=1 
        ';
        if (!empty($searchTxt)) {
            $sql .= " AND (
                a.CIF LIKE '%".$searchTxt."%' 
                OR a.VCIF LIKE '%".$searchTxt."%' 
                OR a.Name LIKE '%".$searchTxt."%' 
                OR b.Name LIKE '%".$searchTxt."%'
                OR c.Name LIKE '%".$searchTxt."%'
                )
            ";
        }
        $sql .= ' ORDER BY a.Name ASC OFFSET '.$rowno.' ROWS FETCH NEXT '.$rowperpage.' ROWS ONLY';

        $result = $this->db->query($sql)->result_array();  

        return $result;
    }

}
