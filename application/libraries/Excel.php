<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 *  ======================================= 
 *  Author     : Nur Arif Prihutomo
 *  License    : Protected 
 *  Email      : ayip.eiger@gmail.com
 *  
 *  PHP Excel class for export to xls, xlsx document *  
 *  ======================================= 
 */ 

require_once APPPATH."/third_party/PHPExcel-1.8/PHPExcel.php";

class Excel extends PHPExcel
{

	public function __construct()
	{
		parent::__construct();
	}
}