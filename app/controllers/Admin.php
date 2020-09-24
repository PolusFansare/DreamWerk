<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
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
		$data['title']	= 'Dashboard - DW';
		$data['active']	= 'Home';

		/* Counters */
		$data['users_count']		= $this->mysql->get_count('dw_user_details', array("role"=>'User'));
		$data['posts_count']		= $this->mysql->get_count('dw_videos', "");
		$data['likes_count']		= $this->mysql->get_count('dw_likes', array("like_status" => 1));
		$data['dislikes_count']		= $this->mysql->get_count('dw_likes', array("like_status" => 2));
		$data['subscriptions_count']= $this->mysql->get_count('dw_subcriptions', array());
		$data['wishlist_count']		= $this->mysql->get_count('dw_wishlist', array('wish_status' => 1));


		/* Registrations Counter and Graph */
		$data['today_registrations']	= $this->mysql->get_count('dw_user_details', "role='User' AND UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-0 Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".strtotime(date("Y-m-d")."--1 Day")."'" );
		$data['yesterday_registrations']= $this->mysql->get_count('dw_user_details', "role='User' AND UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-1 Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".time()."'");
		$data['weak_registrations']		= $this->mysql->get_count('dw_user_details', "role='User' AND UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-15 Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".strtotime(date("Y-m-d")."--1 Day")."'");
		$data['month_registrations']	= $this->mysql->get_count('dw_user_details', "role='User' AND UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-30 Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".time()."'");
		for ($i=30; $i >= 0; $i--)
			$data["weak_users_reg".$i]	= $this->mysql->get_count('dw_user_details', "role='User' AND UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-".($i)." Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".strtotime(date("Y-m-d")."-".($i-1)." Day")."'");

		/* Hash Counter */
		$data["top_hashes"]		= $this->db->select('*, COUNT(`tags`) AS hash_count')->group_by('tags')->order_by('hash_count', 'DESC')->limit(8,0)->get('dw_videos')->result_array();

		/* Posts Counter and Graph */
		$data['today_posts']	= $this->mysql->get_count('dw_videos', "UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-0 Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".strtotime(date("Y-m-d")."--1 Day")."'" );
		$data['yesterday_posts']= $this->mysql->get_count('dw_videos', "UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-1 Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".strtotime(date("Y-m-d")."--1 Day")."'");
		$data['weak_posts']		= $this->mysql->get_count('dw_videos', "UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-15 Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".time()."'");
		$data['month_posts']	= $this->mysql->get_count('dw_videos', "UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-30 Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".time()."'");
		for ($i=30; $i >= 0; $i--)
			$data["weak_users_posts".$i]= $this->mysql->get_count('dw_videos', "UNIX_TIMESTAMP(`created_at`) >= '".strtotime(date("Y-m-d")."-".($i)." Day")."' AND UNIX_TIMESTAMP(`created_at`) <= '".strtotime(date("Y-m-d")."-".($i-1)." Day")."'");

		/* Orders Processing Report */
		$data["users"]		= $this->db->select('*, (SELECT COUNT(*) FROM `dw_subcriptions` WHERE `dw_subcriptions`.`to_user_id` = `dw_user_details`.`user_id` GROUP BY `dw_subcriptions`.`to_user_id`) AS most_subscribed')->order_by('most_subscribed', 'DESC')->limit(10,0)->get('dw_user_details')->result_array();

		$this->loadpage($data, 'admin/index');
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