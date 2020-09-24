<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('string');
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
		$this->userlist();
	}
	public function userlist($user='user-list', $post='', $username='', $userid=0, $updated="")
	{
		$data['title']			= ucfirst(explode("-", $user)[0])."s - DW";
		$data['active']			= $user;
		if($this->input->post('username'))
			$data['users']			= $this->mysql->get_data('dw_user_details', "username LIKE '%".$this->input->post('username')."%' OR full_name LIKE '%".$this->input->post('username')."%' OR email LIKE '%".$this->input->post('username')."%'");
		else
			$data['users']			= $this->mysql->get_data('dw_user_details', "");

		$this->loadpage($data, 'admin/user-list');
	}
	public function profile($username='', $userid=0, $updated="")
	{
		if($this->input->post('userid') && $this->input->post('username') && $this->input->post('email') && $this->input->post('updateProfile'))
		{
			// $user=$this->mysql->get_row('dw_user_details', "username = '".$this->input->post('username')."' OR email = '".$this->input->post('email')."'");
			$user=$this->mysql->get_row('dw_user_details', "email = '".$this->input->post('email')."'");
			if(!$user)
			{
				$update1 = array(
					'username'	=> $this->input->post('username'),
					'email'		=> $this->input->post('email')
				);
				$this->mysql->update_data('dw_user_details', array('user_id' => $this->input->post('userid')), $update1);
			}
				// $data['error']="Username or User email is already attached with a diffrent Vaqra account";

			$update2 = array(
				'full_name'		=> $this->input->post('fullname'),
				'dob'			=> $this->input->post('dob'),
				'gender'		=> $this->input->post('gender'),
				'phone'			=> $this->input->post('phonenumber')
			);
			if(!empty($_FILES['profilepic']['name']))
			{
				$config['upload_path']	= 'uploads/profile_pictures'; # check path is correct
				$config['max_size']		= '102400';
				$config['overwrite']	= FALSE;
				$config['remove_spaces']= TRUE;
				$config['allowed_types']= 'jpg|jpeg|png|webp|gif|svg';
				$imagename = random_string('numeric', 9);
				$config['file_name'] = $imagename;
				$this->load->library('upload', $config);

				if($this->upload->do_upload('profilepic'))
				{
					$uploadData		= $this->upload->data(); 
					$uploadedImage	= $uploadData['file_name']; 
					$org_image_size	= $uploadData['image_width'].'x'.$uploadData['image_height']; 
					 
					$source_path	= $config['upload_path']."/".$uploadedImage; 
					$thumb_path		= $config['upload_path'].'/thumb'; 
					$thumb_width	= 280; 
					$thumb_height	= 175; 
					 
					// Image resize config 
					$config['image_library']	= 'gd2'; 
					$config['source_image']		= $source_path; 
					$config['new_image']		= $thumb_path; 
					$config['maintain_ratio']	= TRUE; 
					$config['width']			= $thumb_width; 
					$config['height']			= $thumb_height; 
					 
					// Load and initialize image_lib library 
					$this->load->library('image_lib', $config); 
					 
					// Resize image and create thumbnail 
					if($this->image_lib->resize())
						$update2['profile_thumbnail']	= $thumb_path."/".$uploadedImage;

					$imagename=$this->upload->data()['file_name'];
					if(!empty($imagename))
						$update2['profile_picture']	= $config['upload_path']."/".$imagename;
				}
				// $user = $this->mysql->get_data('dw_user_details', array('user_id' => $details['user_id']));
			}
			if($this->mysql->update_data('dw_user_details', array('user_id' => $this->input->post('userid')), $update2))
				$data['updated']=true;
			else
				$data['updated']=false;
			// redirect('user/profile/'.$this->input->post('username')."/".$this->input->post('userid')."/successfull");
		}
		elseif($this->input->post('userid') && $this->input->post('updatePassword'))
		{
			if($this->input->post('newPassword')==$this->input->post('newPasswordConfirm'))
			{
				$update1 = array(
					'password'	=> md5($this->input->post('newPassword'))
				);
				if($this->mysql->update_data('dw_user_details', array('user_id' => $this->input->post('userid')), $update1))
					$data['updated2']=true;
				else
					$data['updated2']=false;
			}
			else
				$data['error2']="Passwords do not match. Please try again.";
		}
		$username=urldecode($username);

		$data['title']		= "@".$username." Profile - VAQRA";
		$data['active']		= 'profile';
		$data['post']		= 'view';
		$data['username']	= $username;
		$data['userid']		= $userid;
		if($updated)
			$data['updated']=$updated;
		$userLoggedIn		= $this->mysql->get_row("dw_user_details", array("user_id"=>$userid, "username"=>$username));
		$data['profile']	= $userLoggedIn;
		//->join('if_stylist_details', 'if_stylist_details.if_user_id=if_user_login.if_id')
		// echo $this->db->last_query();die();

		$data['vid_views']		= $this->mysql->get_data('dw_views', array("to_user_id"=> $userid));
		$data['vid_saved']		= $this->mysql->get_data('dw_wishlist', array("to_user_id"=> $userid, "wish_status"=> 1));
		$data['vid_likes']		= $this->mysql->get_data('dw_likes', array("to_user_id"=> $userid, "like_status"=> 1));
		$data['vid_dislikes']	= $this->mysql->get_data('dw_likes', array("to_user_id"=> $userid, "like_status"=> 2));
		$data['followings']		= $this->mysql->get_data('dw_subcriptions', array("to_user_id"=> $userid));
		$data['videos']			= $this->mysql->get_data('dw_videos', array("user_id"=> $userid), 'video_id', 'DESC');
		$this->loadpage($data, 'admin/profile');

			// print_r($this->db->last_query());
			// $data['profile']	= $this->mysql->get_row("if_user_login", ));
	}
	public function videos($edit='', $id='')
	{
		if($this->input->post('html_id') && $this->input->post('html_name') && $this->input->post('html_content'))
		{
			$update = array(
					'if_name'		=> $this->input->post('html_name'),
					'if_content'	=> $this->input->post('html_content'),
					'if_language'	=> $this->input->post('html_language'),
				);
			if($this->mysql->update_data('dw_videos', array('if_id' => $this->input->post('html_id')), $update))
				$data['updated']=true;
			else
				$data['updated']=false;
		}
		if($edit=='edit' && !empty($id))
		{
			$data['title']	= "Videos List - DW";
			$data['active']	= 'Videos';
			$data['edit']	= $id;
			$data['videos']	= $this->mysql->get_data('dw_videos', '', 'video_id');
			$this->loadpage($data, 'admin/app-html');
		}
		else
		{
			$data['title']	= "Videos List - DW";
			$data['active']	= 'Videos';
			$data['videos']	= $this->mysql->get_data('dw_videos', '', 'video_id');
			$this->loadpage($data, 'admin/app-html');
		}
	}
	public function delete($table='', $where='')
	{
		if($this->input->post('datatype') && $this->input->post('dataid'))
		{
			if($this->mysql->delete_data($this->input->post('datatype'), array('if_id' => $this->input->post('dataid'))))
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