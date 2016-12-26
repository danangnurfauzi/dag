<?php defined('BASEPATH') OR exit('No direct script access allowed');

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

	function updateProfileMember_get()
	{

        //$JenisKelamin = $this->post('JenisKelamin');

		$this->db->trans_begin();

		$this->db->set('JenisKelamin',$this->get('JenisKelamin'));
		$this->db->set('NamaDepan',$this->get('NamaDepan'));
		$this->db->set('NamaBelakang',$this->get('NamaBelakang'));
		$this->db->set('AlamatLengkap',$this->get('AlamatLengkap'));
		$this->db->set('Kelurahan',$this->get('Kelurahan'));
		$this->db->set('Kecamatan',$this->get('Kecamatan'));
		$this->db->set('Kabupaten',$this->get('Kabupaten'));
		$this->db->set('RT',$this->get('RT'));
		$this->db->set('RW',$this->get('RW'));
		$this->db->set('KodePos',$this->get('KodePos'));
		$this->db->set('TipeID',$this->get('TipeID'));
		$this->db->set('NoID',$this->get('NoID'));
		$this->db->set('TempatLahir',$this->get('TempatLahir'));
		$this->db->set('TanggalLahir',$this->get('TanggalLahir'));
		$this->db->set('AlamatEmail',$this->get('AlamatEmail'));
		$this->db->set('NoTelp',$this->get('NoTelp'));
		$this->db->set('NoHandphone',$this->get('NoHandphone'));
		$this->db->set('IsPromo',$this->get('promo'));
		$this->db->where('MemberID',$this->get('memberID'));
		$this->db->update('Membership_Member');

		$this->db->set('AuditTypeID','3');
		$this->db->set('InsertedDateTime',date('Y-m-d H:i:j'));
		$this->db->set('MemberID',$this->get('memberID'));
		$this->db->insert('Membership_AuditTrail');

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
			//echo $JenisKelamin;
            $this->response( "success" , 200);
		}else{
			$this->response(array('messages' => 'failed'), 422);
		}

	}

	function updateAccountMember_get()
    {
    	$this->load->library('encrypt');

    	$password = $this->encrypt->encode($this->get('Password'));

    	$password2 = base64_encode($this->get('Password'));

        $this->db->trans_begin();

        $this->db->set('Username',$this->get('Username'));
        $this->db->set('Password', sha1( md5( $this->get('Password') ) ) );
        $this->db->set('PlainText', $password2 );
        $this->db->set('UpdateDate', date("Y-m-d H:i:j"));
        $this->db->where('MemberID',$this->get('MemberID'));
        $this->db->update('Membership_MemberAccount');

        $this->db->set('AuditTypeID','4');
		$this->db->set('InsertedDateTime',date('Y-m-d H:i:j'));
		$this->db->set('MemberID',$this->get('MemberID'));
		$this->db->insert('Membership_AuditTrail');

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

    function checkStatusMember_get()
    {
    	$ID = $this->get('memberID');

    	$statusMember = $this->mm->statusMember($ID);

    	$this->response($statusMember->row() , 200);

    }

    function listPointReward_get()
    {
    	$reward = $this->mm->listPointReward();

    	if($reward->num_rows() > 0)
        {
            $this->response($reward->result(), 200);
        }else
        {
            $this->response(array('data'=>null), 422);
        }
    }

    function jumlahRewardActive_get()
    {
    	$reward = $this->mm->listPointReward();

    	if($reward->num_rows() > 0)
        {
            $this->response($reward->num_rows(), 200);
        }else
        {
            $this->response(array('data'=>null), 422);
        }
    }

    function redeemPointMember_post()
    {
    	//print_r($this->post('set'));
    	$post = $this->post('set');

    	$this->db->trans_begin();

    	$this->db->set('JenisRedeem','1');
    	$this->db->set('Tanggal',date('Y-m-d H:i:j'));
    	$this->db->set('MemberID',$this->post('memberID'));
    	$this->db->insert('Membership_LogRedeemPoint');

    	$id = $this->db->insert_id();

    	$set = array();

    	$jumlahPoint = 0;

    	foreach ($post as $key => $value) {

    		$point = $this->mm->getPointReward($value['barang'])->row();

    		$pointBarang = $point->PointReward * $value['jumlah'];

    		$jumlahPoint = $jumlahPoint + $pointBarang;

    		$set[] = array(
    				'LogRedeemPointID'=>$id,
    				'MemberID'=>$this->post('memberID'),
    				'StockID'=>$value['barang'],
    				'Jumlah'=>$value['jumlah']
    			);

    		$trxStock = $point->Jumlah - $value['jumlah'];

    		$this->db->set('Jumlah',$trxStock);
    		$this->db->where('StockID',$value['barang']);
    		$this->db->update('Membership_Stock');

    	}

    	$this->db->insert_batch('Membership_TrxRedeemPoint',$set);

    	$updatePoint = $this->mm->profileMember($this->post('memberID'))->row()->JumlahPoint;

    	$trx = $updatePoint - $jumlahPoint;

    	$this->db->set('JumlahPoint',$trx);
    	$this->db->where('MemberID',$this->post('memberID'));
    	$this->db->update('Membership_Member');

    	$this->db->set('AuditTypeID','2');
		$this->db->set('InsertedDateTime',date('Y-m-d H:i:j'));
		$this->db->set('MemberID',$this->post('memberID'));
		$this->db->insert('Membership_AuditTrail');

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

    function redeemPointMember2_post()
    {
    	//print_r($this->post('set'));
    	$post = $this->post('set');

    	$pengiriman = $this->post('pengiriman');

    	$this->db->trans_begin();

    	$this->db->set('JenisRedeem','1');
    	$this->db->set('Tanggal',date('Y-m-d H:i:j'));
    	$this->db->set('MemberID',$this->post('memberID'));
    	$this->db->insert('Membership_LogRedeemPoint');

    	$id = $this->db->insert_id();

    	$set = array();

    	$jumlahPoint = 0;

    	foreach ($post as $key => $value) {

    		$point = $this->mm->getPointReward($value['barang'])->row();

    		$pointBarang = $point->PointReward * $value['jumlah'];

    		$jumlahPoint = $jumlahPoint + $pointBarang;

    		$set[] = array(
    				'LogRedeemPointID'=>$id,
    				'MemberID'=>$this->post('memberID'),
    				'StockID'=>$value['barang'],
    				'Jumlah'=>$value['jumlah']
    			);

    		$trxStock = $point->Jumlah - $value['jumlah'];

    		$this->db->set('Jumlah',$trxStock);
    		$this->db->where('StockID',$value['barang']);
    		$this->db->update('Membership_Stock');

    	}

    	$this->db->insert_batch('Membership_TrxRedeemPoint',$set);

    	$updatePoint = $this->mm->profileMember($this->post('memberID'))->row()->JumlahPoint;

    	$trx = $updatePoint - $jumlahPoint;

    	$this->db->set('JumlahPoint',$trx);
    	$this->db->where('MemberID',$this->post('memberID'));
    	$this->db->update('Membership_Member');

    	$this->db->set('AuditTypeID','2');
		$this->db->set('InsertedDateTime',date('Y-m-d H:i:j'));
		$this->db->set('MemberID',$this->post('memberID'));
		$this->db->insert('Membership_AuditTrail');

		if($pengiriman[0]['kirimKe'] == 1)
		{
			$this->db->set('LogRedeemPointID',$id);
			$this->db->set('KirimKe',$pengiriman[0]['kirimKe']);
			$this->db->set('AgenID',$pengiriman[0]['agenID']);
			$this->db->set('MemberID',$this->post('memberID'));
			$this->db->insert('Membership_PengirimanReward');
		}else{
			$this->db->set('LogRedeemPointID',$id);
			$this->db->set('KirimKe',$pengiriman['kirimKe']);
			$this->db->set('MemberID',$this->post('memberID'));
			$this->db->set('AlamatPengiriman',$pengiriman[0]['alamat']);
			$this->db->set('RT',$pengiriman[0]['rt']);
			$this->db->set('RW',$pengiriman[0]['rw']);
			$this->db->set('Kecamatan',$pengiriman[0]['kecamatan']);
			$this->db->set('Kabupaten',$pengiriman[0]['kabupaten']);
			$this->db->set('KodePos',$pengiriman[0]['kdPos']);
			$this->db->insert('Membership_PengirimanReward');
		}
	
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

    function redeemPointMember3_get()
    {
        //print_r($this->post('set'));
        $post       = $this->get('set');
        $pengiriman = $this->get('pengiriman');
        //echo "hai";
        //print_r($this->get('pengiriman'));exit;

        $this->db->trans_begin();

        $this->db->set('JenisRedeem','1');
        $this->db->set('Tanggal',date('Y-m-d H:i:j'));
        $this->db->set('MemberID',$this->get('memberID'));
        $this->db->insert('Membership_LogRedeemPoint');

        $id = $this->db->insert_id();

        $set = array();

        $jumlahPoint = 0;

        foreach ($post as $key => $value) {

            $point = $this->mm->getPointReward($value['barang'])->row();

            $pointBarang = $point->PointReward * $value['jumlah'];

            $jumlahPoint = $jumlahPoint + $pointBarang;

            $set[] = array(
                    'LogRedeemPointID'=>$id,
                    'MemberID'=>$this->get('memberID'),
                    'StockID'=>$value['barang'],
                    'Jumlah'=>$value['jumlah']
                );

            $trxStock = $point->Jumlah - $value['jumlah'];

            $this->db->set('Jumlah',$trxStock);
            $this->db->where('StockID',$value['barang']);
            $this->db->update('Membership_Stock');

        }

        $this->db->insert_batch('Membership_TrxRedeemPoint',$set);

        $updatePoint = $this->mm->profileMember($this->get('memberID'))->row()->JumlahPoint;

        $trx = $updatePoint - $jumlahPoint;

        $this->db->set('JumlahPoint',$trx);
        $this->db->where('MemberID',$this->get('memberID'));
        $this->db->update('Membership_Member');

        $this->db->set('AuditTypeID','2');
        $this->db->set('InsertedDateTime',date('Y-m-d H:i:j'));
        $this->db->set('MemberID',$this->get('memberID'));
        $this->db->insert('Membership_AuditTrail');

        if($pengiriman[0]['kirimKe'] == 1)
        {
            $this->db->set('LogRedeemPointID',$id);
            $this->db->set('KirimKe',$pengiriman[0]['kirimKe']);
            $this->db->set('AgenID',$pengiriman[0]['agenID']);
            $this->db->set('MemberID',$this->get('memberID'));
            $this->db->insert('Membership_PengirimanReward');
        }else{
            $this->db->set('LogRedeemPointID',$id);
            $this->db->set('KirimKe',$pengiriman['kirimKe']);
            $this->db->set('MemberID',$this->get('memberID'));
            $this->db->set('AlamatPengiriman',$pengiriman[0]['alamat']);
            $this->db->set('RT',$pengiriman[0]['rt']);
            $this->db->set('RW',$pengiriman[0]['rw']);
            $this->db->set('Kecamatan',$pengiriman[0]['kecamatan']);
            $this->db->set('Kabupaten',$pengiriman[0]['kabupaten']);
            $this->db->set('KodePos',$pengiriman[0]['kdPos']);
            $this->db->insert('Membership_PengirimanReward');
        }
    
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

    function passwordPlainMember_get()
    {
    	
    	$ID = $this->get('memberID');

    	$member = $this->mm->accountMember($ID);

    	$plain = $member->row()->PlainText;

    	$decode = base64_decode($plain);

    	$this->response($decode , 200);
    }

    function listKotaAgen_get()
    {
    	$kota = $this->mm->kotaAgen();

    	if($kota->num_rows() > 0)
        {
            $this->response($kota->result(), 200);
        }else
        {
            $this->response(array('data'=>null), 422);
        }

    }

    function listAgenByKota_post()
    {
    	$kotaID = $this->post('kotaID');

    	$agen = $this->mm->getAgenByKota($kotaID);

    	if($agen->num_rows() > 0)
    	{
    		$this->response($agen->result(),200);
    	}else{
    		$this->response(array('data'=>null), 422);
    	}
    }

    function stockPoint_get()
    {
        $listStock = $this->mm->getStockPoint();

        if($listStock->num_rows() > 0)
        {
            $this->response($listStock->result(),200);
        }else{
            $this->response(array('data'=>null), 422);
        }
    }

    function stockPointPagination_get()
    {
        
    	$limit = $this->get('per_page');

    	$start = $this->get('data_page');

        //echo $limit ." - ". $start;exit;

        $listStock = $this->mm->getStockPointPagination( $limit , $start );
        //echo $this->db->last_query();exit;
        if($listStock->num_rows() > 0)
        {
            $this->response($listStock->result(),200);
        }else{
            $this->response(array('data'=>null), 422);
        }
    }

    function insertStock_get()
    {
        $data = $this->get('data');

        //print_r($data);

        $this->db->trans_begin();

        $this->db->set('NamaStock',$data['NamaBarang']);
        $this->db->set('Jumlah',$data['StockTersedia']);
        $this->db->set('Aktif',TRUE);
        $this->db->insert('Membership_Stock');

        $id = $this->db->insert_id();

        $this->db->set('StockID',$id);
        $this->db->set('PointReward',$data['SetPoint']);
        $this->db->insert('Membership_PointReward');

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

    function dataEditStock_get()
    {
        $id = $this->get('id');

        $listStock = $this->mm->getStockPoint( $id );

        if($listStock->num_rows() > 0)
        {
            $this->response($listStock->row(),200);
        }else{
            $this->response(array('data'=>null), 422);
        }
    }

    function updateStock_get()
    {
        $data = $this->get('data');

        //print_r($data);

        $this->db->trans_begin();

        $this->db->set('NamaStock',$data['NamaBarang']);
        $this->db->set('Jumlah',$data['StockTersedia']);
        $this->db->set('Aktif',TRUE);
        $this->db->where('StockID',$data['StockID']);
        $this->db->update('Membership_Stock');
        
        $this->db->set('PointReward',$data['SetPoint']);
        $this->db->where('StockID',$data['StockID']);
        $this->db->update('Membership_PointReward');

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

    function deleteStock_get()
    {
        $id = $this->get('id');

        $this->db->trans_begin();

        $this->db->set('IsDelete','1');
        $this->db->where('StockID',$id);
        $this->db->update('Membership_Stock');

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

    function listMember_get()
    {
        $listMember = $this->mm->listMember();

        if($listMember->num_rows() > 0)
        {
            $this->response($listMember->result(),200);
        }else{
            $this->response(array('data'=>null), 422);
        }
    }

    function sendEmail_get()
    {
        
        $member = $this->mm->profileMember( $this->get( 'memberID' ) )->row();

        $set = $this->get('set');

        $emailTo = $member->AlamatEmail;

        $config = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'fauzinurdanang@gmail.com', 
                    'smtp_pass' => 't3l0g0d0g', 
                    'mailtype'  => 'html',
                    'charset'   => 'iso-8859-1',
                    'wordwrap'  => TRUE,
                    'priority' => '1'
                  );

        //print_r($set);exit;
        
        $this->load->library('email', $config);
        
        $this->email->set_newline("\r\n");  
        $this->email->from('fauzinurdanang@gmail.com'); 
        $this->email->to($emailTo);
        $this->email->subject($set['subject']);
        $this->email->message($set['message']);

        if($this->email->send())
        {
            $status = "success";
        }
        else
        {
            $status = $this->email->print_debugger();
            //show_error($this->email->print_debugger());
        }

        if ($status == 'success') {
            $this->response( $status , 200);
        }else{
            $this->response(array('messages' => 'failed'), 422);
        }

    }

    function activatedMember()
    {
        $id = $this->get('memberID');

        $this->db->trans_begin();

        $this->db->set('IsActivation','1');
        $this->db->where('MemberID',$id);
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
}
