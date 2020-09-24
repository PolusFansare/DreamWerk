<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Admin_model', 'mysql');
		header('content-type:text/html;charset=utf-8');
		if(!$this->session->dw_a_email && !$this->session->dw_a_username && !$this->session->dw_a_role)
			redirect('logout');
	}
	public function loadheader($data)
	{
		if(!isset($data['title']))
			$data['title']='Dashboard - DW';
		if(!isset($data['active']))
			$data['title']='Home';
		$this->load->view('admin/common/head', $data);
		$this->load->view('admin/common/loader', $data);
		$this->load->view('admin/common/search-bar', $data);
		$this->load->view('admin/common/top-bar', $data);
		$this->load->view('admin/common/sidebar', $data);
	}
	public function loadfooter($data)
	{
		$this->load->view('admin/common/footer', $data);
	}
	public function loadpage($data, $path)
	{
		$this->loadheader($data);
		$this->load->view($path, $data);
		$this->loadfooter($data);
	}
	public function index()
	{
		$this->feedbacks();
	}
	public function feedbacks($id='')
	{
		$data['title']	= "Feedbacks List - DW";
		$data['active']	= 'Feedbacks';
		$data['feedbacks']	= $this->mysql->get_data('dw_feedback', '', 'created_at', 'DESC');
		foreach ($data['feedbacks'] as $key => $feedback)
			$data['feedbacks'][$key]['user']= $this->mysql->get_row('dw_user_details', array("user_id" => $feedback['user_id']));
		$this->loadpage($data, 'admin/feedbacks');
	}
	public function edit($id='')
	{
		if(!$id)
			redirect('/Feedback');
		else
		{
			if($this->input->post('vid_id') && $this->input->post('vid_title') && $this->input->post('vid_desc'))
			{
				$update = array(
						'title'			=> $this->input->post('vid_title'),
						'description'	=> $this->input->post('vid_desc'),
						'category'		=> $this->input->post('vid_cat'),
						'tags'			=> $this->input->post('vid_tags'),
						'position'		=> $this->input->post('vid_pos'),
						'mobile_no_upi'	=> $this->input->post('vid_upi_no'),
					);
				if($this->mysql->update_data('dw_feedback', array('video_id' => $this->input->post('vid_id')), $update))
					$data['updated']=true;
				else
					$data['updated']=false;
			}
			$data['video']	= $this->mysql->get_row('dw_feedback', array('video_id' => $id), 'video_id');
			if(!$data['video'])
				redirect('video');
			$data['title']	= "Videos Details Editor - DW";
			$data['active']	= 'Videos';
			$data['edit']	= $id;
			$data['videos']	= $this->mysql->get_data('dw_feedback', '', 'video_id');
			$data['categories']	= $this->mysql->get_data('dw_categories', '', 'category_id');
			$this->loadpage($data, 'admin/video');
		}
	}
	public function delete($table='', $where='')
	{
		if($this->input->post('datatype') && $this->input->post('dataid') && $this->input->post('colname'))
		{
			if($this->mysql->delete_data($this->input->post('datatype'), array($this->input->post('colname') => $this->input->post('dataid'))))
				echo 1;
			else
				echo 500;
		}
		else
			echo 404;
	}
}