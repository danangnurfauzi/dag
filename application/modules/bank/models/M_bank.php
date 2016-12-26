<?php
class M_bank extends CI_Model {
	function data(){
        $this->load->library('rest', array('server' => $this->config->item('apiAddress')));
        $result = $this->rest->post('bank/data', apiarraytab());
		
        return cekdatatab($result);
    }
    function detil($x){
        $this->load->library('rest', array('server' => $this->config->item('apiAddress')));
        $arr=array('key' =>$x);
        $result = $this->rest->post('bank/detil', apiarray($arr));
		
        return $result;
    }
    function update($x){
        if($x!='tambah' && $x!='ubah' && $x!='hapus'){
            echo "undefined";
            exit;
        }
        $this->load->library('rest', array('server' => $this->config->item('apiAddress')));
        $data['id_bank']= get_session('key_id');
        $data['nama_bank']= isset($_POST['nama_bank']) ? $_POST['nama_bank'] : '';
        $data['no_rekening']= isset($_POST['no_rekening']) ? $_POST['no_rekening'] : '';
		$data['nama_nasabah']= isset($_POST['nama_nasabah']) ? $_POST['nama_nasabah'] : '';
        $data['alamat']= isset($_POST['alamat']) ? $_POST['alamat'] : '';
        $result = $this->rest->post('bank/update/'.$x, apiarray($data));
		
		return $result;
    }
}


	



