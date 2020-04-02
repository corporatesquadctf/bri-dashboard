<?php

class Notification_model extends CI_Model {
  private $user_id;
  function __construct() {
    parent::__construct();
    $this->user_id = $_SESSION['USER_ID'];
  }
  public function getNotif() {
    $sql = "SELECT A.*, D.Name USER_FROM_NAME, B.Title CORPORATE_TITLE, C.Name DIVISION_NAME
      FROM Notification A
      JOIN [User] B ON A.UserTo=B.UserId
      JOIN [User] D on A.UserFrom = D.UserId
      JOIN UnitKerja C ON B.UnitKerjaId=C.UnitKerjaId
      WHERE IsRead=0
        AND A.UserTo = '".$this->user_id."'
      ORDER BY CreatedDate DESC";

    return $this->db->query($sql)->result_array();

  }
  public function getNotifJs() {
    return json_encode($this->getNotif());
  }
  public function readNotif($nomer) {
    $newData = [
      'IsRead' => 1
    ];
    $updateData = $this->db->where('NotificationId', $nomer)->update('Notification', $newData);
  }
  public function addNotif($UserTo, $Subject, $Title, $Message, $URL) {
    $newData = [
      'CreatedDate' => date('Y-m-d H:i:s'),
      'UserFrom' => $this->user_id,
      'UserTo' => $UserTo,
      'Subject' => $Subject,
      'Title' => $Title,
      'Message' => $Message,
      'URL' => $URL
    ];
    // echo json_encode($newData);
    $updateData = $this->db->insert('Notification', $newData);
  }
}