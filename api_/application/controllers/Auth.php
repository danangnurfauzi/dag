<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }
	public function index()
	{

		$this->load->view('layout/front/login');
	}

	public function getlogin()
	{
		$u = $this->input->post('username');
		$p = $this->input->post('password');
		$this->load->model('UserModel');
		$data=$this->UserModel->getUser($u,$p);
        if($data){
           echo "login";
            var_dump($data);
        }else{
            echo "not login";
        }
	}
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */


