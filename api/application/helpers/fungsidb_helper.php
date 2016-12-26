<?php


function insert($param,$tabel)
{
		//var_dump($param);
		if ($param) {
			
			
 
				//simpan surat ke db
				
		        $ci = & get_instance();
				
				$ci->db->insert_batch($tabel, $param);
				
				
				//$this->db->insert_batch($tabel, $param);
				
				
				
				//$data=$this->db->last_query();
				//$id=$this->db->insert_id();
				//return ($this->db->affected_rows() != 1) ? false : true;
				return $ci->db->affected_rows() > 0;
				//return $id;
			
		}
}


function delete($field,$tabel,$data)
{
		//var_dump($param);
		
		 $ci = & get_instance();
				
		if ($tabel && $field && $tabel) {
        	$x=$ci->db->where($field,$data)->delete($tabel);			
		}else
		{
			$x=false;
			}
		return $x;
}

function edit($field,$tabel,$key,$data)
{
		//var_dump($param);
		
		 $ci = & get_instance();
				
		if ($tabel && $field && $tabel) {
			  $x=$ci->db->where($field,$key)->update($tabel,$data);	
              //$x=$ci->db->last_query();	
		}else
		{
			$x=false;
			}
		return $x;
}

      
?>


