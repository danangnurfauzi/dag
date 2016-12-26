<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class StockManagement extends MX_controller
{

	var $api = "";
	var $memberID = "";

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('rest','form_validation','session','pagination'));
		$this->api = 'http://localhost/dag/api/index.php/v1/';
	}

	function dashboard()
	{
		$this->load->config('pagination');

		$stock = $this->rest->get($this->api.'membership/stockPoint', array() , 'application/json' );

        $config['base_url'] = site_url('member/stockManagement/dashboard');

        $config['total_rows'] = count($stock);

		$config['per_page'] = 3;

		$config['uri_segment'] = 4;

		$choice = $config['total_rows'] / $config['per_page'];
        
        $config["num_links"] = floor($choice);

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0 ;

		$data['listStock'] = $this->rest->get($this->api.'membership/stockPointPagination', array( 'per_page' => $config['per_page'] , 'data_page' => $data['page'] ) , 'application/json' );
		//print_r($data['listStock']);exit;
		//echo $data['listStock'];exit;
		$this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'required',
                        array('required' => 'Harap Isi %s.')
                );

		$this->form_validation->set_rules('StockTersedia', 'Stock', 'required|integer',
                        array('required' => 'Harap Isi %s.' , 'integer' => 'Hanya Angka yang di Perbolehkan')
                );

		$this->form_validation->set_rules('SetPoint', 'Set Point', 'required|integer',
                        array('required' => 'Harap Isi %s.' , 'integer' => 'Hanya Angka yang di Perbolehkan' )
                );

		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = TRUE;
			$this->load->view('member/SMdashboard_view',$data);	
		}else{
			$result = $this->rest->get($this->api.'membership/insertStock',array('data'=>$_POST));
			//echo $result;exit;
			if ($result == 'success')
			{
				$this->session->set_flashdata('success', 'Data Stock Baru Berhasil Di Tambahkan.');
				redirect('member/stockManagement/dashboard');
			}else
			{
				$this->session->set_flashdata('error', 'Data Stock Baru Gagal Di Tambahkan.');
				redirect('member/stockManagement/dashboard');
			}
		}

	}

	function editStock( $StockIDEnkrip )
	{

		$id = base64_decode($StockIDEnkrip);

		$data['data'] = $this->rest->get($this->api.'membership/dataEditStock',array('id'=>$id));

		//print_r($data);exit;

		$this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'required',
                        array('required' => 'Harap Isi %s.')
                );

		$this->form_validation->set_rules('StockTersedia', 'Stock', 'required|integer',
                        array('required' => 'Harap Isi %s.' , 'integer' => 'Hanya Angka yang di Perbolehkan')
                );

		$this->form_validation->set_rules('SetPoint', 'Set Point', 'required|integer',
                        array('required' => 'Harap Isi %s.' , 'integer' => 'Hanya Angka yang di Perbolehkan' )
                );

		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = TRUE;
			$this->load->view('member/SMeditStock_view',$data);	
		}else{
			$result = $this->rest->get($this->api.'membership/updateStock',array('data'=>$_POST));
			//echo $result;exit;
			if ($result == 'success')
			{
				$this->session->set_flashdata('success', 'Edit Data Stock Berhasil.');
				redirect('member/stockManagement/dashboard');
			}else
			{
				$this->session->set_flashdata('error', 'Edit Data Stock Gagal.');
				redirect('member/stockManagement/dashboard');
			}
		}

	}

	function deleteStock( $StockIDEnkrip )
	{
		$id = base64_decode($StockIDEnkrip);

		$result = $this->rest->get($this->api.'membership/deleteStock',array('id'=>$id));
		//echo $result;exit;
		if ($result == 'success')
		{
			$this->session->set_flashdata('success', 'Hapus Data Stock Berhasil.');
			redirect('member/stockManagement/dashboard');
		}else
		{
			$this->session->set_flashdata('error', 'Hapus Data Stock Gagal.');
			redirect('member/stockManagement/dashboard');
		}
	}

}

?>