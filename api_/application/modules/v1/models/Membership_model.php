<?php

class Membership_model extends CI_Model
{

	function profileMember( $id )
	{
		$this->db->select();
		$this->db->from('dbo.Membership_Member');
		$this->db->where('MemberID',$id);
		return $this->db->get();
	}

	function accountMember( $id )
	{
		$this->db->select();
		$this->db->from('dbo.Membership_MemberAccount');
		$this->db->where('MemberID',$id);
		return $this->db->get();
	}
 
}

?>


