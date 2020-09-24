<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logincheck extends CI_Model
{
	public function check_admin_user($username, $pass)
	{
		$qry=$this->db->where("(email = '$username' OR username = '$username')")->where("password", md5($pass))->where("role", 'Admin')->get('dw_user_details');
		// print_r($this->db->last_query());
		return $qry->row_array();
	}
}
?>