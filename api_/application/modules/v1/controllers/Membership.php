<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Membership extends REST_Controller
{
    
    function __construct()
    {
    	parent::__construct();
    	$this->load->model('membership_model','mm'); 
    }
	
	function profileMember_get()
	{

		$ID = $this->get('memberID');

		$member = $this->mm->profileMember($ID);

        if($member->num_rows() > 0)
        {
            $this->response($member->row(), 200);
        }else
        {
            $this->response(array('data'=>null), 422);
        }
	}

	function updateProfileMember_post()
	{

		$this->db->trans_begin();

		$this->db->set('JenisKelamin',$_POST['JenisKelamin']);
		$this->db->set('NamaDepan',$_POST['NamaDepan']);
		$this->db->set('NamaBelakang',$_POST['NamaBelakang']);
		$this->db->set('AlamatLengkap',$_POST['AlamatLengkap']);
		$this->db->set('Kelurahan',$_POST['Kelurahan']);
		$this->db->set('Kecamatan',$_POST['Kecamatan']);
		$this->db->set('Kabupaten',$_POST['Kabupaten']);
		$this->db->set('RT',$_POST['RT']);
		$this->db->set('RW',$_POST['RW']);
		$this->db->set('KodePos',$_POST['KodePos']);
		$this->db->set('TipeID',$_POST['TipeID']);
		$this->db->set('NoID',$_POST['NoID']);
		$this->db->set('TempatLahir',$_POST['TempatLahir']);
		$this->db->set('TanggalLahir',$_POST['TanggalLahir']);
		$this->db->set('AlamatEmail',$_POST['AlamatEmail']);
		$this->db->set('NoTelp',$_POST['NoTelp']);
		$this->db->set('NoHandphone',$_POST['NoHandphone']);
		$this->db->where('MemberID',$_POST['memberID']);
		$this->db->update('Membership_Member');

		if ($this->db->trans_status() === FALSE)
		{					
			$this->db->trans_rollback();
			$status = "failed";
		}
		else
		{					
			$this->db->trans_commit();
			$status = "success";
		}

		if ($status == 'success') {
			$this->response( "success" , 200);
		}else{
			$this->response(array('messages' => 'failed'), 422);
		}

	}

	function updateAccountMember_post()
    {
    	$this->load->library('encrypt');

    	$password = $this->encrypt->encode($_POST['Password']);

    	$password2 = base64_encode($_POST['Password']);

        $this->db->trans_begin();

        $this->db->set('Username',$_POST['Username']);
        $this->db->set('Password', sha1( md5( $_POST['Password'] ) ) );
        $this->db->set('PlainText', $password2 );
        $this->db->set('UpdateDate', date("Y-m-d H:i:j"));
        $this->db->where('MemberID',$_POST['MemberID']);
        $this->db->update('Membership_MemberAccount');

       	if ($this->db->trans_status() === FALSE)
		{					
			$this->db->trans_rollback();
			$status = "failed";
		}
		else
		{					
			$this->db->trans_commit();
			$status = "success";
		}

		if ($status == 'success') {
			$this->response( "success" , 200);
		}else{
			$this->response(array('messages' => 'failed'), 422);
		}

		//echo $this->db->last_query();
    }

    function accountMember_get()
    {
    	$ID = $this->get('memberID');

		$account = $this->mm->accountMember($ID);

        if($account->num_rows() > 0)
        {
            $this->response($account->row(), 200);
        }else
        {
            $this->response(array('data'=>null), 422);
        }
    }
}


