<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	public function index()
	{
		$this->session->unset_userdata('vaqra_a_email');
		$this->session->unset_userdata('vaqra_a_username');
		$this->session->unset_userdata('vaqra_a_role');
		redirect('login');
	}
}