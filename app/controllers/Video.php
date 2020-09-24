<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller
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
		$this->videos();
	}
	public function videos($id='')
	{
		$data['title']	= "Videos List - DW";
		$data['active']	= 'Videos';
		$data['videos']	= $this->mysql->get_data('dw_videos', '', 'video_id');
		$this->loadpage($data, 'admin/video');
	}
	public function pendingVideos($id='')
	{
		$data['title']	= "Pending Videos List - DW";
		$data['active']	= 'pendingVideos';
		$data['videos']	= $this->mysql->get_data('dw_videos', array('status' => 0), 'video_id');
		$this->loadpage($data, 'admin/pendingVideos');
	}
	public function approvePendingVideo($id)
	{
		$data['title']	= "Approving Pending Video... - DW";
		$data['active']	= 'Videos';
		$data['videos']	= $this->mysql->update_data('dw_videos', array('video_id' => $id), array('status' => 1));
		redirect('video/pendingVideos');
	}
	public function edit($id='')
	{
		if(!$id)
			redirect('/video');
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
				if($this->mysql->update_data('dw_videos', array('video_id' => $this->input->post('vid_id')), $update))
					$data['updated']=true;
				else
					$data['updated']=false;
			}
			$data['video']	= $this->mysql->get_row('dw_videos', array('video_id' => $id), 'video_id');
			if(!$data['video'])
				redirect('video');
			$data['title']	= "Videos Details Editor - DW";
			$data['active']	= 'Videos';
			$data['edit']	= $id;
			$data['videos']	= $this->mysql->get_data('dw_videos', '', 'video_id');
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
	public function deletePost()
	{
		if($this->input->post('postid') && $this->input->post('datatype'))
		{
			if($this->input->post('datatype')=='Post Delete')
			{
				$images		= $this->mysql->get_data('if_post_images', array("if_post_id" => $this->input->post('postid')));
				$comments	= $this->mysql->get_data('if_comments', array("if_post_id" => $this->input->post('postid')), 'timestamp', 'DESC');

				if($this->mysql->update_data('if_post', array('if_id' => $this->input->post('postid')), array('if_deleted' => true)) )
				{
					/*$this->mysql->delete_data('if_post_brand_url', array('if_post_id' => $this->input->post('postid')));
					$this->mysql->delete_data('if_post_images', array('if_post_id' => $this->input->post('postid')));
					$this->mysql->delete_data('if_post_views', array('if_post_id' => $this->input->post('postid')));
					$this->mysql->delete_data('if_comments', array('if_post_id' => $this->input->post('postid')));
					foreach ($comments as $key => $comment)
						$this->mysql->delete_data('if_reply', array('If_comment_id' => $comment['if_id']));
					if($images)
						foreach ($images as $key => $image)
							if(file_exists(realpath(APPPATH.'../../fashion_app_api').'/'.$image['if_post_image']))
								unlink(realpath(APPPATH.'../../fashion_app_api').'/'.$image['if_post_image']);*/
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
}