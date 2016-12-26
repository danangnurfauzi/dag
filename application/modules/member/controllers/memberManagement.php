<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class MemberManagement extends MX_controller
{

	var $api = "";
	var $memberID = "";

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('rest','form_validation','session'));
		$this->api = 'http://localhost/dag/api/index.php/v1/';
	}

	function dashboard()
	{

		$data['listMember'] = $this->rest->get($this->api.'membership/listMember', array() , 'application/json' );

		$this->load->view('member/MMdashboard_view',$data);	

	}

}

?>