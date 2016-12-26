<?php
/**
 * tags demonstration
 * @author this tag is parsed, but this @version tag is ignored
 */

/**
 * bila panggilan dari ajax acuhkan layout, bila bukan ajax, pakai layout
 */
function mail_to($to,$email_id,$dataemail){
    

    $ci = & get_instance();
    $datakonten=$ci->db->select('email_id,subject_email as subject,content_email as content,active')->from('tb_config_email')->where("email_id",$email_id)->get()->row();

    if($datakonten && count($to)!=0){
        if($datakonten->active){
            $subject=$datakonten->subject;
            $content=$datakonten->content;

            if($datakonten->email_id == 1 || $datakonten->email_id == 8){
                $subject=str_replace("#no_surat#",$dataemail['no_surat'],$subject);
                $subject=str_replace("#no_agenda_ms#",$dataemail['no_agenda_ms'],$subject);
                $subject=str_replace("#to#",$dataemail['to'],$subject);
                $subject=str_replace("#date#",$dataemail['date'],$subject);
                $subject=str_replace("#perihal#",$dataemail['perihal'],$subject);

                $content=str_replace("#no_surat#",$dataemail['no_surat'],$content);
                $content=str_replace("#no_agenda_ms#",$dataemail['no_agenda_ms'],$content);
                $content=str_replace("#to#",$dataemail['to'],$content);
                $content=str_replace("#date#",$dataemail['date'],$content);
                $content=str_replace("#perihal#",$dataemail['perihal'],$content);
            }else if($datakonten->email_id == 2 || $datakonten->email_id == 3 ) {
                $subject=str_replace("#no_disposisi#",$dataemail['no_disposisi'],$subject);
                $subject=str_replace("#from#",$dataemail['from'],$subject);
                $subject=str_replace("#isi#",$dataemail['isi'],$subject);
                $subject=str_replace("#date#",$dataemail['date'],$subject);
                $subject=str_replace("#perihal#",$dataemail['perihal'],$subject);

                $content=str_replace("#no_disposisi#",$dataemail['no_disposisi'],$content);
                $content=str_replace("#from#",$dataemail['from'],$content);
                $content=str_replace("#isi#",$dataemail['isi'],$content);
                $content=str_replace("#date#",$dataemail['date'],$content);
                $content=str_replace("#perihal#",$dataemail['perihal'],$content);
            } else if($datakonten->email_id == 4 || $datakonten->email_id == 5 || $datakonten->email_id == 6 || $datakonten->email_id == 7) {
                $subject=str_replace("#no_memo#",$dataemail['no_memo'],$subject);
                $subject=str_replace("#from#",$dataemail['from'],$subject);
                $subject=str_replace("#date#",$dataemail['date'],$subject);
                $subject=str_replace("#perihal#",$dataemail['perihal'],$subject);

                $content=str_replace("#no_memo#",$dataemail['no_memo'],$content);
                $content=str_replace("#from#",$dataemail['from'],$content);
                $content=str_replace("#date#",$dataemail['date'],$content);
                $content=str_replace("#perihal#",$dataemail['perihal'],$content);
            } else if($datakonten->email_id == 9 ) {
                $subject=str_replace("#kegiatan#",$dataemail['kegiatan'],$subject);
                $subject=str_replace("#from#",$dataemail['from'],$subject);
                $subject=str_replace("#tgl_mulai#",$dataemail['tgl_mulai'],$subject);
                $subject=str_replace("#tgl_selesai#",$dataemail['tgl_selesai'],$subject);
                $subject=str_replace("#tempat#",$dataemail['tempat'],$subject);

                $content=str_replace("#kegiatan#",$dataemail['kegiatan'],$content);
                $content=str_replace("#from#",$dataemail['from'],$content);
                $content=str_replace("#tgl_mulai#",$dataemail['tgl_mulai'],$content);
                $content=str_replace("#tgl_selesai#",$dataemail['tgl_selesai'],$content);
                $content=str_replace("#tempat#",$dataemail['tempat'],$content);
            }

            if($email_id==9){
                send_mail_touser($to,$subject,$content,'');
            }else{
                send_mail_tojabat($to,$subject,$content,'');
            }

        }

    }

}
function send_mail_touser($to,$subject,$content,$view=''){
    $ci = & get_instance();
    if(count($to)!=0){
    $data=$ci->db->select('email')->from('data_peg')->where("email is not null")->where("email <> ''")->where_in('user_id', $to)->get()->result();

    foreach ($data as $row) {

        send_mail($row->email,$subject,$content,$view);
    }

    }
}
function send_mail_tojabat($to,$subject,$content,$view=''){
    $ci = & get_instance();
    if(count($to)!=0){
        $data=$ci->db->select('a.email')->from('data_peg a')->join('table_jabatan b','a.user_id=b.user_id')->where("email is not null")->where("email <> ''")->where_in('b.jabatan_id', $to)->get()->result();

        foreach ($data as $row) {

            send_mail($row->email,$subject,$content,$view);
        }

    }
}
function send_mail($to,$subject,$content,$view=''){
    $ci = & get_instance();
    $ci->load->library('email');
    $ci->email->from('no-reply@rosalia-indah.com', 'Admin Rosalia Indah');
    $ci->email->to($to);
    if($view!=''){
        $mesg = $ci->load->view($view,$content,true);
    }else{
        $mesg=$content;
    }

    $ci->email->subject($subject);
    $ci->email->message($mesg);

    $ci->email->send();
}
function xpost($x,$y=null)
{
    $xvc=isset($_POST[$x]) ? htmlspecialchars(trim($_POST[$x]), ENT_QUOTES, 'UTF-8') : $y;
    return $xvc;
}
function xget($x,$y=null)
{
    $xvc=isset($_GET[$x]) ? htmlspecialchars(trim($_GET[$x]), ENT_QUOTES, 'UTF-8') : $y;
    return $xvc;
}
function blink($x='')
{

    echo base_url($x);
}


function getlimit(){
    $ci = & get_instance();
    $mth= $_SERVER['REQUEST_METHOD'] ;
    $x=$ci->get('limit');
    if(strtolower($mth)=="post"){
        $x=$ci->input->post('limit');
    }

 
	 if($x){

	if ($x>5000){
        return 5000;
    }else{
        return $x;
    }

	}else{
		return 10;
		}
}
function getstart(){
    $ci = & get_instance();
    $mth= $_SERVER['REQUEST_METHOD'] ;

    $x=$ci->get('start');
    if(strtolower($mth)=="post"){
        $x=$ci->input->post('start');
    }
/*    $y=$x -1;
    $x=($y <= 0 ? 0 : $y * getlimit() );*/

    if($x){
	return $x;
	}else{
		return 0;
		}

}


function kestring($data,$pake)
{
		$arr_fruit=$array2=$data;
	$arr_fruit=implode($pake,$array2);
	return $arr_fruit;
}


function Pecah($data,$pake,$jadi)
{
	$isi = explode($pake,$data); 
	$hasil="";
	foreach($isi as $isidetail) {
		$isidetail = trim($isidetail);
		if($isidetail!=''){
			$hasil .=  $jadi.$isidetail ;
		}
	}
	$hasil=substr($hasil,1);
	return $hasil;
}


function getuserid(){
 $ci = & get_instance();  
 
    $mth= $_SERVER['REQUEST_METHOD'] ;
    if(strtolower($mth)=="get"){
        $id=$ci->input->get('id');
        $token=$ci->input->get('token');

    }else if(strtolower($mth)=="post"){
        $id=$ci->input->post('id');
        $token=$ci->input->post('token');

    }
    $x=$ci->db->select('user_id')->from('data_peg')->where("login",$id)->get()->row();
   if($x){
    
    return $x->user_id;
   }else{
    
    
    return 0;
    
   }
}

function validatetoken(){
	return true;
    $ci = & get_instance();
    $valid=false;
    $mth= $_SERVER['REQUEST_METHOD'] ;
    $id="";
    $token="";
    $msg="User or Token Invalid";

    if(strtolower($mth)=="get"){
        $id=$ci->input->get('id');
        $token=$ci->input->get('token');

    }else if(strtolower($mth)=="post"){
        $id=$ci->input->post('id');
        $token=$ci->input->post('token');

    }

    if($id!="" && $token!=""){
        $token=$ci->db->escape_str($token);
        $id=$ci->db->escape_str($id);

        $x=$ci->db->select('count(*) as qty')->from('user_info')->where("user_name='$id' and (token_pc='$token' or token_mobile='$token')")->get()->row();
		   //$ci->response(array('status'=>'false','messages'=>$ci->db->last_query()), 200);
        // ini baru cek user & token ,.. belum ke otorisasi
        if($x->qty > 0){
            if(!validrole()){

                $msg="API Role Invalid";

            }else{
                $valid=true;
            }

        }
    }
    if(!$valid){
        $ci->response(array('status'=>'false','messages'=>$msg), 200);
        exit;
    }


}
function validrole(){

    //untuk sementara return true semua;
    $valid=true;
    return $valid;
}


