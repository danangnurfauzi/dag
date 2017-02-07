<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class Bomembership extends MX_controller
{
	
	var $api = "";
	var $memberID = "";

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('rest','session','form_validation'));
		$this->form_validation->CI =& $this;
		$this->load->helper('security');
		$this->api = 'http://localhost/dag/api/index.php/v1/';
		$this->memberID = 1;
	}

	function index()
	{
		$data['memberData'] = $this->rest->get($this->api.'membership/profileMember',array( 'memberID' => $this->memberID ),'application/json');
		
		$data['memberStatus'] = $this->rest->get($this->api.'membership/checkStatusMember',array( 'memberID' => $this->memberID ) , 'application/json' );

		$this->load->view('member/bomembership_view',$data);
	}

	function tukarPoint()
	{
		$profile = $this->rest->get($this->api.'membership/profileMember',array( 'memberID' => $this->memberID ),'application/json');

		$data['memberStatus'] = $this->rest->get($this->api.'membership/checkStatusMember',array( 'memberID' => $this->memberID ) , 'application/json' );

		$data['point'] = $profile->JumlahPoint;

		$data['kotaAgen'] = $this->rest->get($this->api.'membership/listKotaAgen', array() , 'application/json' );

		$data['reward'] = $this->rest->get($this->api.'membership/listPointReward', array() , 'application/json' );

		$data['JumlahReward'] = $this->rest->get($this->api.'membership/jumlahRewardActive', array() , 'application/json' );

		$this->load->view('member/tukarPoint3_view', $data );
	}

	function redeemPointMember()
	{
		$set = array();
		foreach ($_POST['barang'] as $key => $value) {
			$set[] = array(
					'barang'	=> $value,
					'jumlah'	=> $_POST['jumlahReward'][$value-1]
				);
		}

		$result = $this->rest->post($this->api.'membership/redeemPointMember',array('set'=>$set , 'memberID'=>$this->memberID));

		print_r($result);
	}

	function redeemPointMember2()
	{
		$set = array();
		foreach ($_POST['jumlahItem'] as $key => $value) {
			if ( ($value != '') || ($value != '0') ) {
				$set[] = array(
					'barang'	=> $_POST['stockId'][$key] ,
					'jumlah'	=> $value
				);
			}
			
		}

		$pengiriman = array();

		if ($_POST['kirimKe'] == 1) {
			$pengiriman[] = array(
					'kirimKe'	=> '1',
					'agenID' 	=> $_POST['agen'] 
				);
		}else{
			$pengiriman[] = array(
					'kirimKe' 	=> '2',
					'alamat' 	=> $_POST['alamat'],
					'rt' 		=> $_POST['rt'],
					'rw' 		=> $_POST['rw'],
					'kdPos' 	=> $_POST['kdpos'],
					'kecamatan' => $_POST['kecamatan'],
					'kelurahan' => $_POST['keluarhan'],
				);
		}

		$result = $this->rest->post($this->api.'membership/redeemPointMember2',array('set'=>$set , 'memberID'=>$this->memberID,'pengiriman'=>$pengiriman));

		print_r($result);
	}

	function redeemPointMember3()
	{
		$profile = $this->rest->get($this->api.'membership/profileMember',array( 'memberID' => $this->memberID ),'application/json');

		$data['point'] = $profile->JumlahPoint;

		if ($profile->JumlahPoint < $_POST['totalPointRedeem'])
		{
			$this->session->set_flashdata('error', 'Maaf Point Anda Tidak Mencukupi untuk Melakukan Redeem Barang Yang Anda Pilih.');
			redirect('member/bomembership/tukarPoint');
		}else{

			$data['kotaAgen'] = $this->rest->get($this->api.'membership/listKotaAgen', array() , 'application/json' );

			$data['memberStatus'] = $this->rest->get($this->api.'membership/checkStatusMember',array( 'memberID' => $this->memberID ) , 'application/json' );

			$set = array();

			foreach ($_POST['jumlahItem'] as $key => $value)
			{

				if ( $value == '' || $value == '0' ) continue;

					$set[] = array(
						'nama' 		=> $_POST['NamaStock'][$key],
						'point' 	=> $_POST['PointReward'][$key],
						'barang'	=> $_POST['stockId'][$key] ,
						'jumlah'	=> $value
					);
				
				
			}

			$data['post'] = $set;

			$this->load->view('member/tukarPoint3_1_view', $data );
			
		}

	}

	function redeemPointMember31()
	{
		$profile = $this->rest->get($this->api.'membership/profileMember',array( 'memberID' => $this->memberID ),'application/json');

		$data['kotaAgen'] = $this->rest->get($this->api.'membership/listKotaAgen', array() , 'application/json' );

		$data['memberStatus'] = $this->rest->get($this->api.'membership/checkStatusMember',array( 'memberID' => $this->memberID ) , 'application/json' );

		$data['point'] = $profile->JumlahPoint;

		$this->form_validation->set_rules('kirimKe', 'Pilihan Pengiriman', 'required',
                        array('required' => 'Pilih Salah Satu %s.')
                );

		if ($this->form_validation->run() == FALSE)
		{
			
			$data['errors'] = TRUE;

			$set = array();

			foreach ($_POST['stockId'] as $key => $value)
			{

				$set[] = array(
					'nama' 		=> $_POST['nama'][$key],
					'point' 	=> $_POST['PointReward'][$key],
					'barang'	=> $_POST['stockId'][$key],
					'jumlah'	=> $_POST['jumlah'][$key]
				);
				
			}

			//echo "<pre>";
			//print_r($set);exit;

			$data['post'] = $set;

			$data['result'] = $_POST['totalPointRedeem'];

			$this->load->view('member/tukarPoint31_view', $data );

		}else{

			if ($_POST['kirimKe'] == 1)
			{
				//print_r($_POST);exit;
				$this->form_validation->set_rules('kotaAgen', 'Kota Agen', 'callback_check_defaultKotaAgen');

				$this->form_validation->set_rules('agen', 'Agen', 'required|callback_check_defaultAgen',
	                       array('required' => 'Pilih Salah Satu %s')
	                );

				if ($this->form_validation->run() == FALSE)
		        {
		        	
		        	//$this->form_validation->set_message('check_default', 'Harap Pilih Agen Terdekat');

		        	$data['errors'] = TRUE;

					$set = array();

					foreach ($_POST['stockId'] as $key => $value)
					{

						$set[] = array(
							'nama' 		=> $_POST['nama'][$key],
							'point' 	=> $_POST['PointReward'][$key],
							'barang'	=> $_POST['stockId'][$key],
							'jumlah'	=> $_POST['jumlah'][$key]
						);
						
					}

					//echo "<pre>";
					//print_r($set);exit;

					$data['post'] = $set;

					$data['result'] = $_POST['totalPointRedeem'];

					$this->load->view('member/tukarPoint31_view', $data );
		        }
		        else
		        {
		        	//print_r($_POST);exit;

		        	$set = array();
					foreach ($_POST['stockId'] as $key => $value) {
						
						$set[] = array(
							'barang'	=> $_POST['stockId'][$key] ,
							'jumlah'	=> $_POST['jumlah'][$key]
						);
						 
					}

					$pengiriman = array();

					$pengiriman[] = array(
						'kirimKe'	=> '1',
						'agenID' 	=> $_POST['agen'] 
					);

					$result = $this->rest->get($this->api.'membership/redeemPointMember3',array('set'=>$set , 'memberID'=>$this->memberID,'pengiriman'=>$pengiriman));
					//print_r($result);exit;
					if ($result == 'success')
					{
						$this->session->set_flashdata('success', 'Data Redeem Point Anda Berhasil dan Akan Segera Kami Proses.');
						redirect('member/bomembership/tukarPoint');
					}else
					{
						$this->session->set_flashdata('error', 'Data Redeem Point Anda Belum Berhasil, silahkan Coba beberapa saat lagi.');
						redirect('member/bomembership/tukarPoint');
					}

		        }

			}elseif( $_POST['kirimKe'] == 2){

				$this->form_validation->set_rules('alamat', 'Alamat', 'required',
	                        array('required' => 'Harap isi %s Tujuan.')
	                );

				$this->form_validation->set_rules('kdpos', 'Kode Pos', 'required',
	                        array('required' => 'Harap isi %s.')
	                );

				$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required',
	                        array('required' => 'Harap isi %s.')
	                );

				$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required',
	                        array('required' => 'Harap isi %s.')
	                );

				$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required',
	                        array('required' => 'Harap isi %s.')
	                );

				$this->form_validation->set_rules('provinsi', 'Provinsi', 'required',
	                        array('required' => 'Harap isi %s.')
	                );

				if ($this->form_validation->run() == FALSE)
		        {
		        	$data['errors'] = TRUE;

					$set = array();

					foreach ($_POST['stockId'] as $key => $value)
					{

						$set[] = array(
							'nama' 		=> $_POST['nama'][$key],
							'point' 	=> $_POST['PointReward'][$key],
							'barang'	=> $_POST['stockId'][$key],
							'jumlah'	=> $_POST['jumlah'][$key]
						);
						
					}

					//echo "<pre>";
					//print_r($set);exit;

					$data['post'] = $set;

					$data['result'] = $_POST['totalPointRedeem'];

					$this->load->view('member/tukarPoint31_view', $data );
		        }
		        else
		        {
		        	echo "pret";
		        }

			}else{

				$this->form_validation->set_rules('pilihPengiriman', 'Pilihan Pengiriman', 'required',
                        array('required' => 'Pilih Salah Satu %s.')
                );

				if ($this->form_validation->run() == FALSE)
				{
					
					$data['errors'] = TRUE;

					$set = array();

					foreach ($_POST['stockId'] as $key => $value)
					{

						$set[] = array(
							'nama' 		=> $_POST['nama'][$key],
							'point' 	=> $_POST['PointReward'][$key],
							'barang'	=> $_POST['stockId'][$key],
							'jumlah'	=> $_POST['jumlah'][$key]
						);
						
					}

					//echo "<pre>";
					//print_r($set);exit;

					$data['post'] = $set;

					$data['result'] = $_POST['totalPointRedeem'];

					$this->load->view('member/tukarPoint31_view', $data );

				}

			}

		}

	}

	function listAgenByKota()
	{
		$html = $this->rest->post($this->api.'membership/listAgenByKota',array('kotaID'=>$_POST['kotaID']));
		//print_r($html);
		$option = "";
		$option .= "<option value='0'>Pilih Agen</option>";
		foreach($html as $row)
		{
			$option .= "<option value='".$row->AgenID."'>".$row->NamaAgen."</option>";
		}

		echo $option;
	}

	function check_defaultKotaAgen( $post )
	{
		//var_dump($post);
		//echo $post;exit;
		if ($post == '0')
		{
			$this->form_validation->set_message(__FUNCTION__, 'Harap Pilih Kota Agen Terdekat');
			return FALSE;
		}else{
			return TRUE;
		}
		//return $post == '0' ? FALSE : TRUE;
	}

	function check_defaultAgen( $post )
	{
		if ($post == '0')
		{
			$this->form_validation->set_message(__FUNCTION__, 'Harap Pilih Agen Terdekat Anda');
			return FALSE;
		}else{
			return TRUE;
		}
		//return $post == '0' ? FALSE : TRUE;
	}
}

?>