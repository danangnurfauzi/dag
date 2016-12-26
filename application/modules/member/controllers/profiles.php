<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Profiles extends MX_controller
{

	var $api = "";
	var $memberID = "";

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('rest','form_validation','session'));
		$this->api = 'http://localhost/dag/api/index.php/v1/';
		$this->memberID = 1;
	}

	function createSession()
	{
		$newdata = array( 
		   'username'  => 'johndoe', 
		   'logged_in' => TRUE
		);  

		$this->session->set_userdata($newdata);
	}

	function index()
	{
		$data['memberData'] = $this->rest->get($this->api.'membership/profileMember',array( 'memberID' => $this->memberID ),'application/json');

		//print_r($data['memberData']);exit;
		
		$data['memberID'] = $this->memberID;

		$this->load->view('member/profiles_view' , $data); 
	}

	function updateProfileMember()
	{
		//print_r($_POST);exit;

		$data['memberData'] = $this->rest->get($this->api.'membership/profileMember',array( 'memberID' => $this->memberID ),'application/json');
		
		$data['memberID'] = $this->memberID;

		$this->form_validation->set_rules('NamaDepan', 'Nama Depan', 'required',
				array('required' => 'Mohon Isi %s Anda.')
			);
        $this->form_validation->set_rules('NamaBelakang', 'Nama Belakang', 'required',
        		array('required' => 'Mohon Isi %s Anda.')
        	);
        $this->form_validation->set_rules('AlamatLengkap', 'Alamat Lengkap', 'required',
        		array('required' => 'Mohon Isi %s Anda.')
        	);
        $this->form_validation->set_rules('TipeID', 'Tipe Identitas', 'required',
        		array('required' => 'Mohon Pilih %s Anda.')
        	);
        $this->form_validation->set_rules('NoID', 'Nomor Identitas', 'required',
        		array('required' => 'Mohon Isi %s Anda.')
        	);
        $this->form_validation->set_rules('AlamatEmail', 'Alamat Email', 'required',
        		array('required' => 'Mohon Isi %s Anda.')
        	);

        if ($this->form_validation->run() == FALSE)
        {
	        $data['errors'] = TRUE;
	        $this->load->view('member/profiles_view',$data);
        }
        else
        {
        	
        	$promo = (isset($_POST['promo']) ? '1' : '0');

        	$tanggal = explode('-', $_POST['TanggalLahir']);
        	$tanggalFix = $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0];

			$set = array(
							'memberID' 		=> $_POST['memberID'],
							'JenisKelamin' 	=> $_POST['JenisKelamin'],
							'NamaDepan' 	=> $_POST['NamaDepan'],
							'NamaBelakang' 	=> $_POST['NamaBelakang'],
							'AlamatLengkap' => $_POST['AlamatLengkap'],
							'Kelurahan' 	=> $_POST['Kelurahan'],
							'Kecamatan' 	=> $_POST['Kecamatan'],
							'Kabupaten' 	=> $_POST['Kabupaten'],
							'RT' 			=> $_POST['RT'],
							'RW' 			=> $_POST['RW'],
							'KodePos' 		=> $_POST['KodePos'],
							'TipeID' 		=> $_POST['TipeID'],
							'NoID' 			=> $_POST['NoID'],
							'TempatLahir' 	=> $_POST['TempatLahir'],
							'TanggalLahir' 	=> $tanggalFix,
							'AlamatEmail' 	=> $_POST['AlamatEmail'],
							'NoTelp' 		=> $_POST['NoTelp'],
							'NoHandphone' 	=> $_POST['NoHandphone'],
							'promo'			=> $promo
						);

			
			$status = $this->rest->get($this->api.'membership/updateProfileMember',$set);
			//print_r($status);exit;

			if ($status == 'success')
			{
				$this->session->set_flashdata('success', 'Data Anda Berhasil di perbaharui.');
				redirect('member/profiles');
			}else
			{
				$this->session->set_flashdata('error', 'Data Anda Tidak Berhasil di perbaharui.');
				redirect('member/profiles');
			}
        }

	}

	function updatePassword()
	{
		$this->load->library('encrypt');

		$data['memberAccount'] = $this->rest->get($this->api.'membership/accountMember',array( 'memberID' => $this->memberID),'application/json');

		$this->load->view('member/updatePassword_view',$data);
	}

	function updateAccountMember()
	{

		$memberAccount = $this->rest->get($this->api.'membership/accountMember',array( 'memberID' => $this->memberID),'application/json');

		$data['memberAccount'] = $memberAccount;

		$this->form_validation->set_rules('username', 'Username', 'required',
				array('required' => 'Mohon Isi %s Anda.')
			);
		$this->form_validation->set_rules('passwordLama', 'Password Lama', 'required',
				array('required' => 'Mohon Isi %s Anda.')
			);
        $this->form_validation->set_rules('passwordBaru', 'Password Baru', 'required',
        		array('required' => 'Mohon Isi %s Anda.')
        	);
        $this->form_validation->set_rules('passwordBaruReType', 'Konfirmasi Password Baru', 'required',
        		array('required' => 'Mohon Isi %s Anda.')
        	);

        if ($this->form_validation->run() == FALSE)
        {
	        $data['errors'] = TRUE;
	        $this->load->view('member/updatePassword_view',$data);
        }
        else
        {
        	$enkrip = base64_encode($_POST['passwordLama']);

        	if ( $enkrip != $memberAccount->PlainText )
        	{
        		
        		$this->session->set_flashdata('error', 'Maaf Password Lama Anda Tidak Sesuai.');
				redirect('member/profiles/updatePassword');

        	}else{

        		if ($_POST['passwordBaru'] == $_POST['passwordBaruReType']) 
        		{
        			$set = array(
									'Username' => $_POST['username'],
									'Password' => $_POST['passwordBaru'],
									'MemberID' => $this->memberID
								);

					$status = $this->rest->get($this->api.'membership/updateAccountMember',$set);	

					if ($status == 'success')
					{
						$this->session->set_flashdata('success', 'Password Anda Berhasil di perbaharui.');
						redirect('member/profiles/updatePassword');
					}else
					{
						$this->session->set_flashdata('error', 'Password Anda Tidak Berhasil di perbaharui.');
						redirect('member/profiles/updatePassword');
					}

        		}else{
        			$this->session->set_flashdata('error', 'Maaf Password Baru dan Konfirmasi Password Anda Tidak Sama.');
					redirect('member/profiles/updatePassword');
        		}
        	}
        }

	}

	function enkripPasswordAccountMember()
	{
		$this->load->library('encrypt');
		$data = $this->rest->get($this->api.'membership/accountMember',array( 'memberID' => $this->memberID),'application/json');
		$password = base64_encode($_POST['password']);// $this->encrypt->encode($_POST['password']);
		//echo $password;exit;
		if ($data->PlainText == $password) {
			echo "true";
		}else{
			echo "false";
		}
	}
}

?>