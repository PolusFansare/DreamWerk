<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StatusCode extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		header('content-type:text/html;charset=utf-8');
		if(!$this->session->vaqra_a_email && !$this->session->vaqra_a_username && !$this->session->vaqra_a_role)
			redirect('login');
	}
	public function status_404()
	{
		$this->load->view('admin/404');
	}
}