<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require(APPPATH.'/libraries/REST_Controller.php');

class Bank extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        //authUser();
    }

    public function index()
    {
        $bc = array(
            array(
                'kata' => 'Master Data'
            ),
            array(
                'kata' => 'Bank',
                'link' => 'admin/bank'
            )
        );
        $data['bc'] = $bc;
		$data['judul'] = "Daftar Bank";
        backend("bank/list",$data);
    }
    public function tambah()
    {
        $bc = array(
            array(
                'kata' => 'Master Data'
            ),
            array(
                'kata' => 'Bank',
                'link' => 'admin/bank'
            ),
            array(
                'kata' => 'Tambah Bank',
                'link' => 'admin/bank/add'
            )
        );
        set_session("key_id",null);
        $data['bc'] = $bc;
        $data['mode']='tambah';
		$data['judul'] = "Tambah Bank";
        backend("bank/edit",$data);
    }
    public function ubah($x)
    {
        $bc = array(
            array(
                'kata' => 'Master Data'
            ),
            array(
                'kata' => 'Bank',
                'link' => 'admin/bank'
            ),
            array(
                'kata' => 'Edit Bank',
                'link' => 'admin/bank/edit'
            )
        );
        set_session("key_id",$x);
        $data['bc'] = $bc;
        $data['mode']='ubah';
		$data['judul'] = "Edit Bank";
        $this->load->model('M_bank');
        $data['data']=$this->M_bank->detil($x);
        backend("bank/edit",$data);
    }
    public function hapus($x)
    {
        set_session("key_id",$x);
        $this->load->model('M_bank');
        $data=$this->M_bank->update('hapus');
        echo json_encode($data);
    }
    public function update($x)
    {
        $this->load->model('M_bank');
        $data=$this->M_bank->update($x);
        echo json_encode($data);
    }
    public function data()
    {
        $this->load->model('M_bank');
        $data=$this->M_bank->data();
        echo json_encode($data);
    }
}


