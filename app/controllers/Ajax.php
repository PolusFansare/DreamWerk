<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Admin_model', 'mysql');
		header('content-type:application/json;charset=utf-8');
		if(!$this->session->dw_a_email && !$this->session->dw_a_username && !$this->session->dw_a_role)
			redirect('login');
	}
	public function checkUserExists()
	{
		if($this->input->post('user'))
		{
			$user=$this->mysql->get_row('if_user_login', "if_username = '".$this->input->post('user')."' OR if_email = '".$this->input->post('user')."'");
			if($user)
				echo 1;
			else
				echo 0;
		}
		else
			echo 404;
	}
	public function getStates()
	{
		if($this->input->post('country'))
		{
			$states=$this->mysql->get_data('if_all_states', "country_id = '".$this->input->post('country')."'", 'id');
			if($states)
				echo json_encode($states);
			else
				echo 0;
		}
		else
			echo 404;
	}
	public function getCities()
	{
		if($this->input->post('state'))
		{
			$states=$this->mysql->get_data('if_all_cities', "state_id = '".$this->input->post('state')."'", 'id');
			if($states)
				echo json_encode($states);
			else
				echo 0;
		}
		else
			echo 404;
	}
	public function deleteOrder()
	{
		if($this->input->post('orderid') && $this->input->post('datatype'))
		{
			if($this->input->post('datatype')=='Order Delete')
			{
				if($this->mysql->delete_data('if_order', array('if_id' => $this->input->post('orderid'))) )
				{
					$this->mysql->delete_data('if_cart', array('if_order_id' => $this->input->post('orderid')));
					$this->mysql->delete_data('if_order_delivered_by', array('if_order_id' => $this->input->post('orderid')));
					$this->mysql->delete_data('if_order_history', array('if_order_id' => $this->input->post('orderid')));
					$this->mysql->delete_data('if_order_picked_by', array('if_order_id' => $this->input->post('orderid')));
					$this->mysql->delete_data('if_order_status', array('if_order_id' => $this->input->post('orderid')));
					echo 1;
				}
				else
					echo 500;
			}
			else
				echo 404;
		}
		else
			echo 404;
	}
	public function changeOrderStatus()
	{
		if($this->input->post('orderid') && $this->input->post('orderstatus') && $this->input->post('datatype'))
		{
			if($this->input->post('datatype')=='Order Delete')
			{
				$order	= $this->mysql->get_row('if_order, if_order_history, if_order_status', "`if_order`.`if_id`=`if_order_history`.`if_order_id` AND `if_order`.`if_id`=`if_order_status`.`if_order_id` AND `if_order`.`if_id`='".$this->input->post('orderid')."'", 'if_order.if_id', 'DESC');

				if($order)
				{
					if($this->mysql->update_data('if_order_status', array('if_order_id' => $this->input->post('orderid')), array("if_order_status"=>$this->input->post('orderstatus'))))
					{
						$insert = array(
							'if_order_id'		=> $order['if_order_id'],
							'if_buyer_user_id'	=> $order['if_buyer_user_id'],
							'if_price'			=> $order['if_price'],
							'if_payment_status'	=> $order['if_payment_status'],
							'if_order_status'	=> $this->input->post('orderstatus')
						);
						$this->mysql->insert_data('if_order_history', $insert);
						echo 1;
					}
					else
						echo 0;
				}
				else
					echo 500;
			}
			else
				echo 404;
		}
		else
			echo 404;
	}
	public function updateShippingAddress()
	{
		if($this->input->post('orderid') && $this->input->post('orderShipAddress') && $this->input->post('datatype'))
		{
			if($this->input->post('datatype')=='Shipping Update')
			{
				$order	= $this->mysql->get_row('if_order', array("if_id`" =>$this->input->post('orderid')), 'if_order.if_id', 'DESC');;
				if($order)
				{
					if($this->mysql->update_data('if_order', array('if_id' => $this->input->post('orderid')), array("if_location"=>$this->input->post('orderShipAddress'))))
						echo 1;
					else
						echo 0;
				}
				else
					echo 500;
			}
			else
				echo 404;
		}
		else
			echo 404;
	}
	public function browser_used()
	{
		$data = $this->db->query('SELECT `if_user_details`.`if_device_type`, COUNT(`if_device_type`) as counts, `totals`.`total`, ROUND((COUNT(`if_device_type`) / `totals`.`total`)*100) AS percent FROM `if_user_details`, ( SELECT COUNT(`if_user_details`.`if_device_type`) AS total FROM `if_user_details` WHERE `if_device_type`!="") AS totals WHERE `if_device_type`!="" GROUP BY `if_user_details`.`if_device_type`')->result_array();
		if($data)
			foreach ($data as $key => $value)
			{
				$response[$key]['label']=strtoupper($value['if_device_type']);
				$response[$key]['value']=$value['percent'];
			}
		else
			$response=[];
		echo json_encode($response);
	}
	public function blockUnblock()
	{
		if($this->input->post('userid') && $this->input->post('datatype'))
		{
			if($this->input->post('datatype')=='Block/Unblock User')
			{
				$user	= $this->mysql->get_row('dw_user_details', array("user_id" => $this->input->post('userid')));

				if($user)
				{
					if($user['is_blocked']==1)
						$result=$this->mysql->update_data('dw_user_details', array("user_id"=>$this->input->post('userid')), array('is_blocked' => false));
					else
						$result=$this->mysql->update_data('dw_user_details', array("user_id"=>$this->input->post('userid')), array('is_blocked' => true));

					if($result)
					{
						// send_mail($user['if_email'], "Your profile is ".$this->input->post('userstatus')."ed", "Hi ".$user['if_username']."\n<br>Your profile is successfully reviewed and ".$this->input->post('userstatus')."ed from admin.\n<br>Contact us to know more or for support.");
						echo 1;
					}
					else
						echo 0;
				}
				else
					echo 500;
			}
			else
				echo 404;
		}
		else
			echo 404;
	}
	public function approveUnapprove()
	{
		if($this->input->post('userid') && $this->input->post('datatype'))
		{
			if($this->input->post('datatype')=='Approve/Unapprove User')
			{
				$user	= $this->mysql->get_row('if_user_login', array("if_id" => $this->input->post('userid')));

				if($user)
				{
					if($user['if_status']==1)
						$result=$this->mysql->update_data('if_user_login', array("if_id"=>$this->input->post('userid')), array('if_status' => false));
					else
					{
						$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
						$pass = array();
						$alphaLength = strlen($alphabet) - 1;
						for ($i = 0; $i < 8; $i++)
						    $pass[] = $alphabet[rand(0, $alphaLength)];

						$psw=implode($pass);
						$result=$this->mysql->update_data('if_user_login', array("if_id"=>$this->input->post('userid')), array('if_status' => true, 'if_password' => md5($psw)));
					}

					if($result)
					{
						if(isset($psw))
							send_mail($user['if_email'], "Your profile is approved", "Hi ".$user['if_username']."\n<br>Your profile is successfully reviewed and approved from admin.\n<br> Please use this password to login to Vaqra with your username.\n<br><pre>$psw</pre>\n<br>Contact us to know more or for support.");
						else
							send_mail($user['if_email'], "Your profile is unapproved", "Hi ".$user['if_username']."\n<br>Your profile is unapproved from admin for some reasons.\n<br>Contact us to know more or for support.");
						echo 1;
					}
					else
						echo 0;
				}
				else
					echo 500;
			}
			else
				echo 404;
		}
		else
			echo 404;
	}
	public function followUnfollow()
	{
		if($this->input->post('userid') && $this->input->post('datatype'))
		{
			if($this->input->post('datatype')=='Following' || $this->input->post('datatype')=='Follower')
			{
				$user1	= $this->mysql->get_row('if_user_login', array("if_id" => $this->input->post('userid')));
				$user2	= $this->mysql->get_row('if_user_login', array("if_id" => $this->input->post('fromuserid')));

				if($user1 && $user2)
				{
					if($this->mysql->update_data('if_follow', array("if_to_user_id"=>$this->input->post('userid'), "if_from_user_id"=>$this->input->post('fromuserid')), array('if_status' => false)))
						echo 1;
					else
						echo 0;
				}
				else
					echo 500;
			}
			else
				echo 404;
		}
		else
			echo 404;
	}
	public function markReportSolved()
	{
		if($this->input->post('reportid') && $this->input->post('reportid') && $this->input->post('tomail') && $this->input->post('fullname') && $this->input->post('message'))
		{
			if($this->input->post('datatype')=='Report Solved')
			{
				$report	= $this->mysql->get_row('if_report', array("if_id" => $this->input->post('reportid')));

				if($report)
				{
					if($this->mysql->update_data('if_report', array("if_id"=>$this->input->post('reportid')), array('if_status' => false)))
					{
						send_mail($this->input->post('tomail'), "Your report is marked as solved", "Hi ".$this->input->post('fullname')."\n<br>Your report regarding \"".$this->input->post('message')."\" is successfully marked as solved.\n<br>We hope you will not get a chance a to report something in future.");
						echo 1;
					}
					else
						echo 0;
				}
				else
					echo 500;
			}
			else
				echo 404;
		}
		else
			echo 404;
	}
	public function convertRole()
	{
		if($this->input->post('role') && $this->input->post('userid'))
		{
			if($this->input->post('datatype')=='Change Role')
			{
				$user	= $this->mysql->get_row('if_user_login', array("if_id" => $this->input->post('userid')));

				if($user)
				{
					if($this->mysql->update_data('if_user_login', array("if_id"=>$this->input->post('userid')), array('if_role' => $this->input->post('role'))))
					{
						send_mail($user['if_email'], "Your request for selling as a Business is successfully approved", "Hi ".$user['if_username']."\n<br>Your request regarding \"I'm selling as a Business\" has been successfully approved.\n<br>And from now on you will be a Brand in Vaqra and will have the access of a Brand.</br>We hope you will enjoy and sell more on Vaqra without any hesitation.<br>Thanks and Regards.<br>Team Vaqra.");
						echo 1;
					}
					else
						echo 0;
				}
				else
					echo 500;
			}
			else
				echo 404;
		}
		else
			echo 404;
	}
}