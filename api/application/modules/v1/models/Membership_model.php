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

	function statusMember( $id )
	{
		$this->db->select();
		$this->db->from('dbo.Membership_Member m');
		$this->db->join('dbo.Membership_MemberStatus s','m.MemberStatusID = s.MemberStatusID');
		$this->db->where('m.MemberID',$id);
		return $this->db->get();
	}

	function listPointReward()
	{
		$this->db->select('s.NamaStock , s.Jumlah , r.RewardID , r.PointReward , s.StockID');
		$this->db->from('dbo.Membership_PointReward r');
		$this->db->join('dbo.Membership_Stock s','r.StockID = s.StockID');
		$this->db->where('s.Aktif','True');
		return $this->db->get();
	}

	function getPointReward( $id )
	{
		$this->db->select('s.NamaStock , s.Jumlah , r.RewardID , s.StockID , r.PointReward');
		$this->db->from('dbo.Membership_PointReward r');
		$this->db->join('dbo.Membership_Stock s','r.StockID = s.StockID');
		$this->db->where('s.StockID',$id);
		return $this->db->get();
	}

	function kotaAgen()
	{
		$this->db->select();
		$this->db->from('dbo.Membership_KotaAgen');
		return $this->db->get();
	}

	function getAgenByKota( $id )
	{
		$this->db->select();
		$this->db->from('dbo.Membership_Agen');
		$this->db->where('kotaID',$id);
		return $this->db->get();
	}

	function getStockPoint( $id = null )
	{
		$this->db->select('s.StockID, s.NamaStock, s.Jumlah, s.Aktif, p.RewardID, p.PointReward');
		$this->db->from('dbo.Membership_Stock s');
		$this->db->join('dbo.Membership_PointReward p','s.StockID = p.StockID');
		if( $id != null )
		{
			$this->db->where('s.StockID',$id);
		}
		$this->db->where('s.IsDelete','0');
		return $this->db->get();
	}

	function getStockPointPagination( $limit , $start )
	{
		/*$this->db->select('s.StockID, s.NamaStock, s.Jumlah, s.Aktif, p.RewardID, p.PointReward');
		$this->db->from('dbo.Membership_Stock s');
		$this->db->join('dbo.Membership_PointReward p','s.StockID = p.StockID');
		$this->db->where('s.IsDelete','0');
		$this->db->where('')
		$this->db->order_by( 's.StockID' , 'ASC' );*/

		$sql = 'SELECT TOP '.$limit.' s.StockID, s.NamaStock, s.Jumlah, s.Aktif, p.RewardID, p.PointReward';
		$sql .= ' FROM dbo.Membership_Stock s';
		$sql .= ' JOIN dbo.Membership_PointReward p ON s.StockID = p.StockID';
		$sql .= ' WHERE s.IsDelete = 0';
		$sql .= ' AND s.StockID NOT IN ( SELECT TOP '.$start.' StockID FROM dbo.Membership_Stock ORDER BY StockID ASC )';
		$sql .= ' ORDER BY s.StockID ASC';

		$result = $this->db->query($sql);

		return $result;
	}

	function listMember()
	{
		$this->db->select();
		$this->db->from('Membership_Member');
		return $this->db->get();
	}
 
}

?>