<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Logincheck', 'check');
		if($this->session->vaqra_a_email && $this->session->vaqra_a_username && $this->session->vaqra_a_role)
			redirect('admin');
	}
	public function index()
	{
		$data['title']='Login To DreamWerk';
		if($this->input->post('sign_in_now'))
		{
			if($this->input->post('username') && $this->input->post('pass'))
			{
				$usr=$this->check->check_admin_user($this->input->post('username'), $this->input->post('pass'));
				if($usr)
				{
					$this->session->set_userdata('dw_a_email', $usr['email']);
					$this->session->set_userdata('dw_a_username', $usr['username']);
					$this->session->set_userdata('dw_a_role', $usr['role']);
					$data['success']='Logged in successfully';
				}
				else
					$data['error']='Wrong Username or Password !';
			}
			else
				$data['error']='Please fill all fields !';
		}
		$this->load->view('login/index' ,$data);
		if(isset($data['success']))
			redirect('admin');
	}
}