<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Bank extends REST_Controller
{
    function data_post()
    {
        $this->load->model('bank_api','api');

        $list = $this->api->data(getstart(),getlimit());
        if($list)
        {
            $this->response($list, 200);
        }
        else
        {
            $this->response(array('data'=>null), 422);
        }
    }
    function detil_post()
    {
        $this->load->model('bank_api','api');

        $list = $this->api->detil();
        if($list)
        {
            $this->response($list, 200);
        }
        else
        {
            $this->response(array('data'=>null), 422);
        }
    }
    function update_post($mode)
    {
        $this->load->model('bank_api','api');

        $list = $this->api->update($mode);
        if($list)
        {
            $this->response($list, 200);
        }
        else
        {
            $this->response(array('data'=>undefined), 422);
        }
    }
    public function insertMemberAcount_get()
    {
        $this->db->set('MemberID','1');
        $this->db->set('Username','christina');
        $this->db->set('Password', sha1( md5("password") ) );
        $this->db->set('PlainText', "password");
        $this->db->insert('Membership_MemberAccount')
    }

}


