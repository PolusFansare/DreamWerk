<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model
{
	public function get_data($tbl, $where, $order='created_at', $sort='ASC', $group_by='', $page=0)
	{
		if($group_by)
		{
			if($where)
				$qry=$this->db->where($where)->group_by($group_by)->order_by($order, $sort)->limit(500, $page*500)->get($tbl);
			else
				$qry=$this->db->group_by($group_by)->order_by($order, $sort)->limit(500, $page*500)->get($tbl);
		}
		else
		{
			if($where)
				$qry=$this->db->where($where)->order_by($order, $sort)->limit(500, $page*500)->get($tbl);
			else
				$qry=$this->db->order_by($order, $sort)->limit(500, $page*500)->get($tbl);
		}
		// print_r($this->db->last_query());
		return $qry->result_array();
	}
	public function get_row($tbl, $where, $order='created_at', $sort='ASC')
	{
		if($where)
			$qry=$this->db->where($where)->order_by($order, $sort)->get($tbl);
		else
			$qry=$this->db->order_by($order, $sort)->get($tbl);
		// print_r($this->db->last_query());
		return $qry->row_array();
	}
	public function get_count($tbl, $where, $order='created_at', $sort='ASC')
	{
		if($where)
			$qry=$this->db->where($where)->order_by($order, $sort)->get($tbl);
		else
			$qry=$this->db->order_by($order, $sort)->get($tbl);
		// print_r($this->db->last_query());
		return $qry->num_rows();
	}
	public function get_join_count($tbl1, $tbl2, $where, $joinon, $select, $group_by, $order='created_at', $sort='ASC')
	{
		if(!$select)
			$select=$tbl1.'.id';

		if($where && $group_by)
			$qry=$this->db->select($select)->from($tbl1)->join($tbl2, $joinon)->group_by($group_by)->where($where)->order_by($order, $sort)->get();
		if($where && !$group_by)
			$qry=$this->db->select($select)->from($tbl1)->join($tbl2, $joinon)->where($where)->order_by($order, $sort)->get();
		else
			$qry=$this->db->select($select)->from($tbl1)->join($tbl2, $joinon)->group_by($group_by)->where($where)->order_by($order, $sort)->get();
		// print_r($this->db->last_query());
		return $qry->num_rows();
	}
	public function update_data($tbl, $where, $data)
	{
		$qry=$this->db->set($data)->where($where)->update($tbl);
		// $qry=$this->db->where($where)->update($tbl, $data);
		// print_r($this->db->last_query());
		return $qry;
	}
	public function insert_data($tbl, $data)
	{
		$qry=$this->db->set($data)->insert($tbl);
		// $qry=$this->db->where($where)->update($tbl, $data);
		// print_r($this->db->last_query());
		return $this->db->insert_id();
	}
	public function delete_data($tbl, $where)
	{
		$result=$this->db->where($where)->delete($tbl);
		return $result;
	}
}
?>