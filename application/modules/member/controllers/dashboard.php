<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Dashboard extends MX_controller
{
	
	var $api = "";
	var $memberID = "";

	function __construct()
	{
		parent::__construct();
		$this->load->library('rest');
		$this->api = 'http://localhost/dag/api/index.php/v1/';
		$this->memberID = 1;
	}

	function index()
	{
		
		$data['memberData'] = $this->rest->get($this->api.'membership/profileMember',array( 'memberID' => $this->memberID ),'application/json');
		
		$data['memberStatus'] = $this->rest->get($this->api.'membership/checkStatusMember',array( 'memberID' => $this->memberID ) , 'application/json' );
		//sprint_r($data['memberStatus']);exit;
		$this->load->view('member/dashboard_view',$data);

	}
}

?>


