<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class EmailAction extends MX_controller
{

	var $api = "";

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('rest','form_validation','session'));
		$this->api = 'http://localhost/dag/api/index.php/v1/';
	}

	function dashboard()
	{

		$data['listMember'] = $this->rest->get($this->api.'membership/listMember', array() , 'application/json' );

		$this->load->view('member/EAdashboard_view',$data);	

	}

	function sendActivation( $memberID )
	{
		
		$message = "";

		$message .= "<p>Untuk Aktivasi Member Anda Silahkah klik Link Berikut</p><br/>";

		$message .= "<a href='http://202.153.229.89/dag/index.php/member/emailAction/activatedMember/".$memberID."'>Aktivasi</a>";

		$set = array(
					'subject' => 'Aktivasi Member',
					'message' => $message
					);
		//echo $message;exit;
		$status = $this->rest->get($this->api.'membership/sendEmail', array( 'memberID' => $memberID , 'set' => $set ) , 'application/json' );
		
		//print_r($status);

		if ($status == 'success')
		{
			$this->session->set_flashdata('success', 'Email Aktivasi Berhasil Di Kirim.');
			redirect('member/emailAction/dashboard');
		}else
		{
			$this->session->set_flashdata('error', 'Email Aktivasi Gagal Di Kirim.');
			redirect('member/emailAction/dashboard');
		}
	}

	function activatedMember( $id )
	{
		$status = $this->rest->get($this->api.'membership/activatedMember', array( 'memberID' => $id ) , 'application/json' );

		if ($status == 'success')
		{
			$this->session->set_flashdata('success', 'Member Anda Berhasil Di Aktivasi.');
			redirect('member/profiles');
		}else
		{
			$this->session->set_flashdata('error', 'Member Anda Gagal Di Aktivasi.');
			redirect('member/profiles');
		}
	}

}

?>