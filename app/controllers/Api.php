<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Api_model', 'mysql');
		$this->load->helper('string');
		header('Content-Type: application/json');
		if ($_SERVER['REQUEST_METHOD'] !== 'POST')
		{
			echo json_encode(array('error' => TRUE, 'message' => 'Request must be Post Type', 'details' => array()));
			die;
		}
		/*if(!$this->session->vaqra_a_email && !$this->session->vaqra_a_username && !$this->session->vaqra_a_role)
			redirect('logout');*/
	}

	// Check if User Exists
	private function userCheck($user_id='', $output=FALSE, $device_token='')
	{
		$user_id	= ($user_id) ? $user_id : (($this->input->post('dw_user_id')) ? $this->input->post('dw_user_id') : 0 );
		$device_token	= ($device_token) ? $device_token : (($this->input->post('dw_device_token')) ? $this->input->post('dw_device_token') : '' );
		if($user_id)
		{
			if($user = $this->mysql->get_row('dw_user_details', "(user_id ='$user_id' OR username ='$user_id' OR email ='$user_id') AND device_token='$device_token'"))
			{
				if($user['is_blocked']==0)
					return $user;
				else
					$response	= array('error' => TRUE, 'message' => 'Sorry!! But you are blocked by admin. Please wait while we are reviewing your profile...', 'details' => array());
			}
			else
				$response	= array('error' => TRUE, 'message' => 'User is not registered in our records...', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'Sorry!! you do not have the access to this page...', 'details' => array());

		if($output==FALSE)
		{
			echo json_encode($response);
			die();
		}
		else
			return $response;
	}

	// Check if Video Exists
	private function videoCheck($video_id=0)
	{
		$video_id	= ($video_id) ? $video_id : (($this->input->post('dw_video_id')) ? $this->input->post('dw_video_id') : 0 );
		if($video_id)
		{
			if($video = $this->mysql->get_row('dw_videos', array('video_id'=> $video_id)))
				return $video;
			else
			{
				echo json_encode(array('error' => TRUE, 'message' => 'This video is not available. Please try a diffrent video.', 'details' => array()));
				die;
			}
		}
		else
		{
			echo json_encode(array('error' => TRUE, 'message' => 'Sorry!! you must provide a video for desired action...', 'details' => array()));
			die;
		}
	}

	// Check if Video Exists
	private function sendMail($to, $sub, $message)
	{
		$this->load->library('email');

		$config = array();
		$config['protocol']	= 'smtp';
		$config['smtp_host']= 'ssl://sg3plcpnl0012.prod.sin3.secureserver.net';
		$config['smtp_user']= 'support@dreamwerk.in';
		$config['smtp_pass']= 'hayabusa6655';
		$config['smtp_port']= 465;
		$config['mailtype']	= 'html';
		$config['charset']	= 'UTF-8';
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$this->email->from('support@dreamwerk.in', 'DreamWerk');
		$this->email->to($to);
		$this->email->subject($sub);
		// $this->email->message("Hi There,\nWelcome to Liberty Passage. You are few steps away to verify your Email. Please use $otp for your one time password to verify your Email.");
		$this->email->message($message);

		$email=$this->email->send(FALSE);
		// print_r($this->email->print_debugger(array('headers','subject','message','body')));
		// var_dump($email);

		// From
		//$headers="from: Nikahwithparentsblessings <support@nikahwithparentsblessings.com>";
		$headers	 = "From: DreamWerk <support@dreamwerk.in>"."\r\n" ;
		$headers	.= "Reply-To: DreamWerk <no-reply@vaqra.com>"."\r\n" ;
		$headers	.= "X-Mailer: PHP/".phpversion();
		$headers	.= "MIME-Version: 1.0 \r\n";
		$headers	.= "Content-type: text/html; charset=iso-8859-1 \r\n";
		// Your message
		// $message.=$message;
		// $message.='<div class="mail_footer_cust">'.$mail_footer['description'].'</div>';
		// send email
		$email = @mail($to, $sub, $message, $headers);
		// if your email succesfully sent
		if($email)
			return TRUE;
		else
			return FALSE;
	}

	// Unique Username Generation
	private function generate_unique_username($string_name="Mike Tyson", $rand_no = 200)
	{
		while(true)
		{
			$username_parts = array_filter(explode(" ", strtolower($string_name)));
			$username_parts = array_slice($username_parts, 0, 2);
		
			$part1 = (!empty($username_parts[0]))?substr($username_parts[0], 0,8):"";
			$part2 = (!empty($username_parts[1]))?substr($username_parts[1], 0,5):"";
			$part3 = ($rand_no)?rand(0, $rand_no):"";
			
			$username = $part1. str_shuffle($part2). $part3;
			
			$username_exist_in_db = $this->mysql->get_count('dw_user_details', array('username' => $username));
			if(!$username_exist_in_db)
				return $username;
		}
	}

	// Add Notifications for User
	private function addNotifications($user_id, $from_user_id, $message, $video_id=0)
	{
		// $this->userCheck($user_id);
		if($this->mysql->insert_data('dw_notifications', array('user_id'=> $user_id, 'video_id'=>$video_id, 'from_user_id'=>$from_user_id, 'message'=>$message)))
			return TRUE;
		else
			return FALSE;
	}

	// Add Notifications for User
	private function getUser($user_id)
	{
		// $this->userCheck($user_id);
		if($user = $this->mysql->get_row('dw_user_details', array("user_id" => $user_id)))
			return $user;
		else
			return array();
	}

	// Get Time Ago
	private function time_Ago($time)
	{
		// Calculate difference between current 
		// time and given timestamp in seconds 
		$diff     = time() - $time; 
		  
		// Time difference in seconds 
		$sec     = $diff; 
		  
		// Convert time difference in minutes 
		$min     = round($diff / 60 ); 
		  
		// Convert time difference in hours 
		$hrs     = round($diff / 3600); 
		  
		// Convert time difference in days 
		$days     = round($diff / 86400 ); 
		  
		// Convert time difference in weeks 
		$weeks     = round($diff / 604800); 
		  
		// Convert time difference in months 
		$mnths     = round($diff / 2600640 ); 
		  
		// Convert time difference in years 
		$yrs     = round($diff / 31207680 ); 
		  
		// Check for seconds 
		if($sec <= 60) { 
			$return= "$sec seconds ago"; 
		} 
		  
		// Check for minutes 
		else if($min <= 60) { 
			if($min==1) { 
				$return= "one minute ago"; 
			} 
			else { 
				$return= "$min minutes ago"; 
			} 
		} 
		  
		// Check for hours 
		else if($hrs <= 24) { 
			if($hrs == 1) {  
				$return= "an hour ago"; 
			} 
			else { 
				$return= "$hrs hours ago"; 
			} 
		} 
		  
		// Check for days 
		else if($days <= 7) { 
			if($days == 1) { 
				$return= "Yesterday"; 
			} 
			else { 
				$return= "$days days ago"; 
			} 
		} 
		  
		// Check for weeks 
		else if($weeks <= 4.3) { 
			if($weeks == 1) { 
				$return= "a week ago"; 
			} 
			else { 
				$return= "$weeks weeks ago"; 
			} 
		} 
		  
		// Check for months 
		else if($mnths <= 12) { 
			if($mnths == 1) { 
				$return= "a month ago"; 
			} 
			else { 
				$return= "$mnths months ago"; 
			} 
		} 
		  
		// Check for years 
		else { 
			if($yrs == 1) { 
				$return= "one year ago"; 
			} 
			else { 
				$return= "$yrs years ago"; 
			} 
		}
		return $return;
	} 
	public function loginCheck()
	{
		$error	= [];
		if(!$this->input->post('dw_username'))
			$error[]	= 'A Username is required to do such action.';
		elseif(!$this->mysql->get_row('dw_user_details', "username	='".$this->input->post('dw_username')."' OR email	='".$this->input->post('dw_username')."' OR phone	='".$this->input->post('dw_username')."'"))
				$error[]	= 'Username does not  exists.';
		if(!$this->input->post('dw_password'))
			$error[]	= 'A Password is required to do such action.';
		if(!$this->input->post('dw_device_token'))
			$error[]	= 'A Device Token is required to do such action.';

		/*if($this->input->post('dw_status'))
			$error[]	= 'Like status required to do such action...';*/

		if(!empty($error)) // If all required parameters are empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			if($user = $this->mysql->get_row('dw_user_details', "(username	='".$this->input->post('dw_username')."' OR email	='".$this->input->post('dw_username')."' OR phone	='".$this->input->post('dw_username')."') AND password='".md5($this->input->post('dw_password'))."' AND role='User'"))
			{
				if($user['is_blocked'])
					$response	= array('error' => TRUE, 'message' => 'User is blocked by admin and has no access to his/her DreamWerk Account.', 'details' => array());
				else
				{
					if($this->mysql->update_data('dw_user_details', array('user_id'=>$user['user_id']), array('device_token'=>$this->input->post('dw_device_token'))))
						$response	= array('error' => FALSE, 'message' => 'Logged in successfully', 'details' => $user);
					else
						$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
				}
			}
			else
				$response	= array('error' => TRUE, 'message' => 'Wrong Username / Password.', 'details' => array());
		}
		echo json_encode($response);
	}
	public function logout()
	{
		$user	= $this->userCheck(); // Check if User exists
		if($this->mysql->update_data('dw_user_details', array('user_id'=>$user['user_id']), array('device_token'=>'')))
			$response	= array('error' => FALSE, 'message' => 'Logged out successfully.', 'details' => $user);
		else
			$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
		echo json_encode($response);
	}
	public function addVideos()
	{
		$user	= $this->userCheck(); // Check if User exists

		// Check Required Parameters 
		$error	= [];
		if(!$this->input->post('dw_title'))
			$error[]	= 'Title is required...';
		if(!$this->input->post('dw_description'))
			$error[]	= 'Description is required...';
		if(!$this->input->post('dw_category'))
			$error[]	= 'Category ID is required...';
		if(!$this->input->post('dw_duration'))
			$error[]	= 'Video Duration is required...';
		if(empty($_FILES['dw_video']['name']))
			$error[]	= 'Video is required...';

		if(!empty($error)) // If all required parameters empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			$config['upload_path']	= 'uploads/videos'; # check path is correct
			$config['max_size']		= '100000';
			$config['overwrite']	= FALSE;
			$config['remove_spaces']= TRUE;
			$config['allowed_types']= '*';
			$video_name = random_string('numeric', 9).time();
			$config['file_name'] = $video_name;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('dw_video'))
				$response	= array('error' => FALSE, 'message' => 'Video is not supported or has errors.', 'details' => $this->upload->display_errors());
			else
			{
				$video_name=$this->upload->data()['file_name'];
				if(!empty($video_name))
				{
					$details['user_id']			= $this->input->post('dw_user_id');
					$details['title']			= $this->input->post('dw_title');
					$details['description']		= $this->input->post('dw_description');
					$details['category']		= $this->input->post('dw_category');
					$details['tags']			= ($this->input->post('dw_tags')) ? $this->input->post('dw_tags') : '';	
					$details['duration']		= $this->input->post('dw_duration');
					$details['mobile_no_upi']	= ($this->input->post('dw_mobile_no_upi')) ? $this->input->post('dw_mobile_no_upi') : '';
					$details['video_url']		= $config['upload_path']."/".$video_name;
					$details['status']			= 0;
					$user = $this->mysql->get_data('dw_user_details', array('user_id' => $details['user_id']));
					// $details['video_thumbnail']	= ($this->input->post('dw_videoPic')) ? $this->input->post('dw_videoPic') : '';

					if(!empty($_FILES['dw_videoPic']['name']))
					{
						$config=[];
						unset($this->upload);
						$config['upload_path']	= 'uploads/video_pictures'; # check path is correct
						$config['max_size']		= '102400';
						$config['overwrite']	= FALSE;
						$config['remove_spaces']= TRUE;
						$config['allowed_types']= 'jpg|jpeg|png|webp|gif|svg';
						$imagename = random_string('numeric', 9).time();
						$config['file_name'] = $imagename;
						$this->load->library('upload', $config);

						if($this->upload->do_upload('dw_videoPic'))
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
								$details['video_thumbnail']	= $thumb_path."/".$uploadedImage;

							$imagename=$this->upload->data()['file_name'];
							if(!empty($imagename))
								$details['video_picture']	= $config['upload_path']."/".$imagename;
							else
								print_r($this->image_lib->display_errors());
						}
						else
							print_r($this->upload->display_errors());
						// $user = $this->mysql->get_data('dw_user_details', array('user_id' => $details['user_id']));
					}
					if($video_id = $this->mysql->insert_data('dw_videos', $details))
					{
						if($subscriptions = $this->mysql->get_data('dw_subcriptions', array('to_user_id'=> $details['user_id'])))
							foreach ($subscriptions as $key => $subscribed)
								if(isset($user['full_name']))
									$this->addNotifications($subscribed['from_user_id'], $details['user_id'], $user['full_name'].' Uploaded a new video you', $video_id);
						/*file_get_contents(base_url('welcome/saveVideoThumbanailHTML/'.$video_id));
						$ch = curl_init(base_url('welcome/saveVideoThumbanailHTML/'.$video_id));echo base_url('welcome/saveVideoThumbanailHTML/'.$video_id);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, array());
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$response = curl_exec($ch);
						sleep(3);
						curl_close($ch);*/
	
						$response	= array('error' => FALSE, 'message' => 'Video successfully uploaded', 'details' => array());
					}
					else
						$response	= array('error' => TRUE, 'message' => 'An error occured!! Please try after some time...', 'details' => array());
				}
			}
		}
		echo json_encode($response);
	}
	public function addUser()
	{
		if($this->input->post('dw_user_id'))
		{
			$this->userCheck();
			// Check Required Parameters 
			$error	= [];
			if(!$this->input->post('dw_full_name'))
				$error[]	= 'Full name is required...';
			if(!$this->input->post('dw_email'))
				$error[]	= 'Email is required...';
			if(!$this->input->post('dw_phone'))
				$error[]	= 'Phone number is required...';
			if(!$this->input->post('dw_device_token'))
				$error[]	= 'Device token is required...';

			if(!empty($error)) // If all required parameters empty...
				$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
			else
			{
				$details['full_name']	= $this->input->post('dw_full_name');
				$details['email']		= $this->input->post('dw_email');
				$details['phone']		= $this->input->post('dw_phone');
				$details['gender']		= ($this->input->post('dw_gender')) ? $this->input->post('dw_gender') : 'Male';
				$details['dob']			= ($this->input->post('dw_dob')) ? $this->input->post('dw_dob') : date('Y-m-d');
				$details['device_token']= $this->input->post('dw_device_token');

				if(!empty($_FILES['dw_profilePic']['name']))
				{
					$config['upload_path']	= 'uploads/profile_pictures'; # check path is correct
					$config['max_size']		= '102400';
					$config['overwrite']	= FALSE;
					$config['remove_spaces']= TRUE;
					$config['allowed_types']= 'jpg|jpeg|png|webp|gif|svg';
					$imagename = random_string('numeric', 9);
					$config['file_name'] = $imagename;
					$this->load->library('upload', $config);

					if($this->upload->do_upload('dw_profilePic'))
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
							$details['profile_thumbnail']	= $thumb_path."/".$uploadedImage;

						$imagename=$this->upload->data()['file_name'];
						if(!empty($imagename))
							$details['profile_picture']	= $config['upload_path']."/".$imagename;
					}
					// $user = $this->mysql->get_data('dw_user_details', array('user_id' => $details['user_id']));
				}

				if(!empty($this->input->post('dw_password')) && $this->input->post('dw_password')!==null && $this->input->post('dw_password')!=="null" && $this->input->post('dw_password')!=="Null")
					$details['password']	= md5($this->input->post('dw_password'));

				$where	= array('user_id' => $this->input->post('dw_user_id'));

				if($this->mysql->update_data('dw_user_details', $where, $details))
					$response	= array('error' => FALSE, 'message' => 'User details updated successfully', 'details' => array(0=>$this->getUser($this->input->post('dw_user_id'))));
				else
					$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
			}
			echo json_encode($response);
		}
		else
		{
			// Check Required Parameters 
			$error	= [];
			if(!$this->input->post('dw_full_name'))
				$error[]	= 'Full name is required...';

			if(!$this->input->post('dw_email'))
				$error[]	= 'Email is required...';
			else
				if(!isset($this->userCheck($this->input->post('dw_email'), TRUE)['error']))
					$error[]= 'Email already exists...';

			if(!$this->input->post('dw_phone'))
				$error[]	= 'Phone number is required...';

			if(!$this->input->post('dw_password'))
				$error[]	= 'Password is required...';

			if(!$this->input->post('dw_device_token'))
				$error[]	= 'Device token is required...';

			if(!empty($error)) // If all required parameters empty...
				$response	= array('error' => TRUE, 'message' => 'Please solve following errors...', 'details' => $error);
			else
			{
				$details['full_name']	= $this->input->post('dw_full_name');
				$details['username']	= $this->generate_unique_username($this->input->post('dw_full_name'));
				$details['email']		= $this->input->post('dw_email');
				$details['phone']		= $this->input->post('dw_phone');
				$details['password']	= md5($this->input->post('dw_password'));
				$details['device_token']= $this->input->post('dw_device_token');

				if(!empty($_FILES['dw_profilePic']['name']))
				{
					$config['upload_path']	= 'uploads/profile_pictures'; # check path is correct
					$config['max_size']		= '102400';
					$config['overwrite']	= FALSE;
					$config['remove_spaces']= TRUE;
					$config['allowed_types']= 'jpg|jpeg|png|webp|gif|svg';
					$imagename = random_string('numeric', 9);
					$config['file_name'] = $imagename;
					$this->load->library('upload', $config);

					if($this->upload->do_upload('dw_profilePic'))
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
							$details['profile_thumbnail']	= $thumb_path."/".$uploadedImage;

						$imagename=$this->upload->data()['file_name'];
						if(!empty($imagename))
							$details['profile_picture']	= $config['upload_path']."/".$imagename;
					}
					// $user = $this->mysql->get_data('dw_user_details', array('user_id' => $details['user_id']));
				}

				if($this->mysql->insert_data('dw_user_details', $details))
					$response	= array('error' => FALSE, 'message' => 'User details added successfully', 'details' => array());
				else
					$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
			}
			echo json_encode($response);
		}
	}
	public function addShares()
	{
		$this->userCheck(); // Check if User exists
		$this->videoCheck(); // Check if Video exists
	}
	// dw_subcriptions
	public function addSubscriptions()
	{
		$user	= $this->userCheck(); // Check if User exists

		// Check Required Parameters 
		$error	= [];
		if(!$this->input->post('dw_to_user_id'))
			$error[]	= 'To user ID is required to do such action...';
		else
			if(!$this->mysql->get_row('dw_user_details', array('user_id'=> $this->input->post('dw_to_user_id'))))
				$error[]	= 'To User is not present in our records...';

		if(!empty($error)) // If all required parameters empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			$details['from_user_id']= $this->input->post('dw_user_id');
			$details['to_user_id']	= $this->input->post('dw_to_user_id');

			if(!$this->mysql->get_row('dw_subcriptions', array('from_user_id'=> $this->input->post('dw_user_id'), 'to_user_id'=> $this->input->post('dw_to_user_id'))))
			{
				if($this->mysql->insert_data('dw_subcriptions', $details))
				{
					$this->addNotifications($details['to_user_id'], $details['from_user_id'], $user['full_name'].' subscribed you');
					$response	= array('error' => FALSE, 'message' => 'User subscribed successfully', 'details' => array());
				}
				else
					$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
			}
			else
			{
				if($this->mysql->delete_data('dw_subcriptions', $details))
					$response	= array('error' => FALSE, 'message' => 'User unsubscribed successfully', 'details' => array());
				else
					$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
			}
		}
		echo json_encode($response);
	}
	public function addViews()
	{
		$this->userCheck(); // Check if User exists
		$this->videoCheck(); // Check if Video exists
		$error	= [];
		if(!$this->input->post('dw_to_user_id'))
			$error[]	= 'To user ID is required to do such action...';
		else
			if(!$this->mysql->get_row('dw_user_details', array('user_id'=> $this->input->post('dw_to_user_id'))))
				$error[]	= 'To User is not present in our records...';

		if(!empty($error)) // If all required parameters empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			$details['user_id']		= $this->input->post('dw_user_id');
			$details['to_user_id']	= $this->input->post('dw_to_user_id');
			$details['video_id']	= $this->input->post('dw_video_id');

			if(!$this->mysql->get_row('dw_views', array('user_id'=> $this->input->post('dw_user_id'), 'to_user_id'=> $this->input->post('dw_to_user_id'), 'video_id'=> $this->input->post('dw_video_id'))))
			{
				if($this->mysql->insert_data('dw_views', $details))
					$response	= array('error' => FALSE, 'message' => 'Views added successfully', 'details' => array());
				else
					$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
			}
			else
				$response	= array('error' => TRUE, 'message' => 'Video views already added for this user...', 'details' => array());
		}
		echo json_encode($response);
	}
	public function addLikes()
	{
		$user	= $this->userCheck(); // Check if User exists
		$video	= $this->videoCheck(); // Check if Video exists
		$error	= [];
		if(!$this->input->post('dw_to_user_id'))
			$error[]	= 'To user ID is required to do such action...';
		else
			if(!$this->mysql->get_row('dw_user_details', array('user_id'=> $this->input->post('dw_to_user_id'))))
				$error[]	= 'To User is not present in our records...';

		/*if($this->input->post('dw_status'))
			$error[]	= 'Like status required to do such action...';*/

		if(!empty($error)) // If all required parameters are empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			$details['user_id']		= $this->input->post('dw_user_id');
			$details['to_user_id']	= $this->input->post('dw_to_user_id');
			$details['video_id']	= $this->input->post('dw_video_id');
			$details['like_status']	= ($this->input->post('dw_status')) ? $this->input->post('dw_status') : 0 ;

			$where	= array('user_id'=> $this->input->post('dw_user_id'), 'to_user_id'=> $this->input->post('dw_to_user_id'), 'video_id'=> $this->input->post('dw_video_id'));

			$data['videos']['likes']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>1))) ? $count : 0;
			$data['videos']['dislikes']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>2))) ? $count2 : 0;
			$data['videos']['i_liked']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>1, 'user_id'=> $details['to_user_id']))) ? $count : 0;
			$data['videos']['i_disliked']= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>2, 'user_id'=> $details['user_id']))) ? $count2 : 0;
			$data['videos']['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $details['video_id'], 'wish_status'=>1, 'user_id'=> $details['user_id']))) ? $count2 : 0;
			$data['videos']['i_subscribed']= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $details['user_id'], 'from_user_id'=> $details['to_user_id']))) ? $count2 : 0;
			if(!$this->mysql->get_row('dw_likes', $where))
			{
				if($this->mysql->insert_data('dw_likes', $details))
				{
					$data['videos']['likes']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>1))) ? $count : 0;
					$data['videos']['dislikes']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>2))) ? $count2 : 0;
					$data['videos']['views']	= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $details['video_id']))) ? $count3 : 0;
					$data['videos']['i_liked']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>1, 'user_id'=> $details['to_user_id']))) ? $count : 0;
					$data['videos']['i_disliked']= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>2, 'user_id'=> $details['to_user_id']))) ? $count2 : 0;
					$data['videos']['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $details['video_id'], 'wish_status'=>1, 'user_id'=> $details['user_id']))) ? $count2 : 0;
					$data['videos']['i_subscribed']= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $details['user_id'], 'from_user_id'=> $details['user_id']))) ? $count2 : 0;
					$data['videos']['subscriptions']= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $details['user_id']))) ? $count2 : 0;

					$this->addNotifications($details['to_user_id'], $details['user_id'], $user['full_name'].' liked your video', $details['video_id']);
					$response	= array('error' => FALSE, 'message' => 'Like / Dislike added successfully', 'details' => $data);
				}
				else
					$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => $data);
			}
			else
			{
				if($this->mysql->update_data('dw_likes', $where, $details))
				{
					$data['videos']['likes']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>1))) ? $count : 0;
					$data['videos']['dislikes']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>2))) ? $count2 : 0;
					$data['videos']['views']	= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $details['video_id']))) ? $count3 : 0;
					$data['videos']['i_liked']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>1, 'user_id'=> $details['to_user_id']))) ? $count : 0;
					$data['videos']['i_disliked']= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $details['video_id'], 'like_status'=>2, 'user_id'=> $details['user_id']))) ? $count2 : 0;
					$data['videos']['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $details['video_id'], 'wish_status'=>1, 'user_id'=> $details['user_id']))) ? $count2 : 0;
					$data['videos']['i_subscribed']= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $details['user_id'], 'from_user_id'=> $details['to_user_id']))) ? $count2 : 0;
					$data['videos']['subscriptions']= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $details['user_id']))) ? $count2 : 0;
					$this->addNotifications($details['to_user_id'], $details['user_id'], $user['full_name'].' '.(($details['like_status']==0) ? 'viewed' : (($details['like_status']==2) ? 'disliked' : 'liked')).' your video', $details['video_id']);
					$response	= array('error' => FALSE, 'message' => 'Like / Dislike updated successfully', 'details' => $data);
				}
				else
					$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => $data);
			}
		}
		echo json_encode($response);
	}
	public function addWishlist()
	{
		$user	= $this->userCheck(); // Check if User exists
		$video	= $this->videoCheck(); // Check if Video exists
		$error	= [];
		if(!$this->input->post('dw_to_user_id'))
			$error[]	= 'To user ID is required to do such action...';
		else
			if(!$this->mysql->get_row('dw_user_details', array('user_id'=> $this->input->post('dw_to_user_id'))))
				$error[]	= 'To User is not present in our records...';

		/*if($this->input->post('dw_status'))
			$error[]	= 'Like status required to do such action...';*/

		if(!empty($error)) // If all required parameters are empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			$details['user_id']		= $this->input->post('dw_user_id');
			$details['to_user_id']	= $this->input->post('dw_to_user_id');
			$details['video_id']	= $this->input->post('dw_video_id');
			$details['wish_status']	= 1 ;

			$where	= array('user_id'=> $this->input->post('dw_user_id'), 'to_user_id'=> $this->input->post('dw_to_user_id'), 'video_id'=> $this->input->post('dw_video_id'));

			if(!$this->mysql->get_row('dw_wishlist', $where))
			{
				if($this->mysql->insert_data('dw_wishlist', $details))
				{
					$this->addNotifications($details['to_user_id'], $details['user_id'], $user['full_name'].' liked your video', $details['video_id']);
					$response	= array('error' => FALSE, 'message' => 'Added in wishlist successfully', 'details' => array());
				}
				else
					$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
			}
			else
			{
				if($this->mysql->delete_data('dw_wishlist', $where, $details))
				{
					$this->addNotifications($details['to_user_id'], $details['user_id'], $user['full_name'].' liked your video', $details['video_id']);
					$response	= array('error' => FALSE, 'message' => 'Removed from wishlist successfully', 'details' => array());
				}
				else
					$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
			}
		}
		echo json_encode($response);
	}
	public function addFeedback()
	{
		$user	= $this->userCheck(); // Check if User exists
		// $video	= $this->videoCheck(); // Check if Video exists
		$error	= [];
		if(!$this->input->post('dw_title'))
			$error[]	= 'A feadback type is required.';

		if(!$this->input->post('dw_description'))
			$error[]	= 'A description is required';

		if(!empty($error)) // If all required parameters are empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			$details['user_id']		= $user['user_id'];
			$details['title']		= $this->input->post('dw_title');
			$details['description']	= $this->input->post('dw_description');
			$details['rating']		= ($this->input->post('dw_rating')) ? $this->input->post('dw_rating') : 0 ;

			if($this->mysql->insert_data('dw_feedback', $details))
				$response	= array('error' => FALSE, 'message' => 'Thank you for your precious feedback. We will try to make it more better to get you a more good Timelines.', 'details' => array());
			else
				$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
		}
		echo json_encode($response);
	}
	public function getVideoCategories()
	{
		$this->userCheck(); // Check if User exists
		$categories	= $this->mysql->get_data('dw_categories', '', 'title');
		if(!empty($categories))
			$response	= array('error' => FALSE, 'message' => 'Categories listing successful.', 'details' => $categories);
		else
			$response	= array('error' => TRUE, 'message' => 'There are no categories available at the moment.', 'details' => array());
		echo json_encode($response);
	}
	public function getVideo()
	{
		$user			= $this->userCheck(); // Check if User exists
		$data['video']	= $this->videoCheck(); // Check if Video exists

		$data['video']['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $data['video']['user_id'])); // Check if User exists
		$data['video']['time_ago']	= $this->time_Ago(strtotime($data['video']['updated_at']));
		$page=($this->input->post('dw_page')) ? $this->input->post('dw_page')*10 : 0;
		if(!isset($data['video']['user']['error']))
		{
			unset($data['video']['user']['username']);
			unset($data['video']['user']['gender']);
			unset($data['video']['user']['dob']);
			unset($data['video']['user']['email']);
			unset($data['video']['user']['phone']);
			unset($data['video']['user']['password']);
			unset($data['video']['user']['role']);
			unset($data['video']['user']['device_token']);
			unset($data['video']['user']['is_blocked']);
			unset($data['video']['user']['updated_at']);
			unset($data['video']['user']['created_at']);
			$data['video']['likes']			= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $data['video']['video_id'], 'like_status'=>1))) ? $count : 0;
			$data['video']['dislikes']		= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $data['video']['video_id'], 'like_status'=>2))) ? $count2 : 0;
			$data['video']['views']			= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $data['video']['video_id']))) ? $count3 : 0;
			$data['video']['i_liked']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $data['video']['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
			$data['video']['i_disliked']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $data['video']['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
			$data['video']['i_saved']		= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $data['video']['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
			$data['video']['i_subscribed']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $data['video']['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;
			$data['video']['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $data['video']['user_id']))) ? $count2 : 0;

			$data['videos']=$this->db->query("SELECT *, IFNULL( (SELECT COUNT(*) FROM `dw_views` WHERE `dw_views`.`video_id`=`dw_videos`.`video_id` GROUP BY `dw_views`.`video_id`), 0) AS views, (SELECT COUNT(*) FROM `dw_likes` WHERE `dw_likes`.`video_id`=`dw_videos`.`video_id` AND `dw_likes`.`like_status`=1 GROUP BY `dw_likes`.`video_id`) AS likes FROM `dw_videos` WHERE MATCH(`tags`) AGAINST('".(!empty($data['video']['tags']) ? $data['video']['tags'].'*': '')."' IN BOOLEAN MODE) AND `dw_videos`.`status`=1 AND `video_id`!='".$data['video']['video_id']."' ORDER BY `views` DESC LIMIT $page, 10")->result_array();

			foreach ($data['videos'] as $key => $video)
			{
				$data['videos'][$key]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $video['user_id'])); // Check if User exists
				$data['videos'][$key]['time_ago']	= $this->time_Ago(strtotime($video['updated_at']));
				if(!isset($data['videos'][$key]['user']['error']))
				{
					unset($data['videos'][$key]['user']['username']);
					unset($data['videos'][$key]['user']['gender']);
					unset($data['videos'][$key]['user']['dob']);
					unset($data['videos'][$key]['user']['email']);
					unset($data['videos'][$key]['user']['phone']);
					unset($data['videos'][$key]['user']['password']);
					unset($data['videos'][$key]['user']['role']);
					unset($data['videos'][$key]['user']['device_token']);
					unset($data['videos'][$key]['user']['is_blocked']);
					unset($data['videos'][$key]['user']['updated_at']);
					unset($data['videos'][$key]['user']['created_at']);
					$data['videos'][$key]['likes']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1))) ? $count : 0;
					$data['videos'][$key]['dislikes']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2))) ? $count2 : 0;
					$data['videos'][$key]['views']		= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $video['video_id']))) ? $count3 : 0;
					$data['videos'][$key]['i_liked']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
					$data['videos'][$key]['i_disliked']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
					$data['videos'][$key]['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $video['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
					$data['videos'][$key]['i_subscribed']= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;
					$data['videos'][$key]['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id']))) ? $count2 : 0;
				}
				else
					unset($data['videos'][$key]);
			}

			if(!empty($data))
				$response	= array('error' => FALSE, 'message' => 'Video listing successful', 'details' => $data);
			else
				$response	= array('error' => TRUE, 'message' => 'This Video is not available at the moment.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'This Video\'s user is no longer connected with us, Video is not available at the moment.', 'details' => array());
		echo json_encode($response);
	}
	public function getChannel()
	{
		$user			= $this->userCheck(); // Check if User exists

		$error	= [];
		if(!$this->input->post('dw_channel_id'))
			$error[]	= 'A channel id is required.';

		if(!empty($error)) // If all required parameters are empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			$data['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $this->input->post('dw_channel_id'))); // Check if User exists
			$page=($this->input->post('dw_page')) ? $this->input->post('dw_page')*10 : 0;
			if(!isset($data['user']['error']))
			{
				unset($data['user']['username']);
				unset($data['user']['gender']);
				unset($data['user']['dob']);
				unset($data['user']['email']);
				unset($data['user']['phone']);
				unset($data['user']['password']);
				unset($data['user']['role']);
				unset($data['user']['device_token']);
				unset($data['user']['is_blocked']);
				unset($data['user']['updated_at']);
				unset($data['user']['created_at']);
				$data['user']['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $data['user']['user_id']))) ? $count2 : 0;
				$data['user']['i_subscribed']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $data['user']['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;

				$data['videos']=$this->db->query("SELECT *, IFNULL( (SELECT COUNT(*) FROM `dw_views` WHERE `dw_views`.`video_id`=`dw_videos`.`video_id` GROUP BY `dw_views`.`video_id`), 0) AS views, (SELECT COUNT(*) FROM `dw_likes` WHERE `dw_likes`.`video_id`=`dw_videos`.`video_id` AND `dw_likes`.`like_status`=1 GROUP BY `dw_likes`.`video_id`) AS likes FROM `dw_videos` WHERE `dw_videos`.`status`=1 AND `user_id`='".$data['user']['user_id']."' ORDER BY `position`, `created_at` DESC LIMIT $page, 10")->result_array();

				foreach ($data['videos'] as $key => $video)
				{
					$data['videos'][$key]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $video['user_id'])); // Check if User exists
					$data['videos'][$key]['time_ago']	= $this->time_Ago(strtotime($video['updated_at']));
					if(!isset($data['videos'][$key]['user']['error']))
					{
						unset($data['videos'][$key]['user']['username']);
						unset($data['videos'][$key]['user']['gender']);
						unset($data['videos'][$key]['user']['dob']);
						unset($data['videos'][$key]['user']['email']);
						unset($data['videos'][$key]['user']['phone']);
						unset($data['videos'][$key]['user']['password']);
						unset($data['videos'][$key]['user']['role']);
						unset($data['videos'][$key]['user']['device_token']);
						unset($data['videos'][$key]['user']['is_blocked']);
						unset($data['videos'][$key]['user']['updated_at']);
						unset($data['videos'][$key]['user']['created_at']);
						$data['videos'][$key]['likes']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1))) ? $count : 0;
						$data['videos'][$key]['dislikes']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2))) ? $count2 : 0;
						$data['videos'][$key]['views']		= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $video['video_id']))) ? $count3 : 0;
						$data['videos'][$key]['i_liked']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
						$data['videos'][$key]['i_disliked']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$key]['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $video['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$key]['i_subscribed']= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$key]['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id']))) ? $count2 : 0;
					}
					else
						unset($data['videos'][$key]);
				}

				if(!empty($data))
					$response	= array('error' => FALSE, 'message' => 'Video listing successful', 'details' => $data);
				else
					$response	= array('error' => TRUE, 'message' => 'This Video is not available at the moment.', 'details' => array());
			}
			else
				$response	= array('error' => TRUE, 'message' => 'This Video\'s user is no longer connected with us, Video is not available at the moment.', 'details' => array());
		}
		echo json_encode($response);
	}
	public function getVideosFeed()
	{
		$user			= $this->userCheck(); // Check if User exists
		// $data['video']	= $this->videoCheck(); // Check if Video exists
		$page=($this->input->post('dw_page')) ? $this->input->post('dw_page')*10 : 0;
		if($page==0)
			$videos=$this->db->query("SELECT *, IFNULL( (SELECT COUNT(*) FROM `dw_views` WHERE `dw_views`.`video_id`=`dw_videos`.`video_id` AND `dw_videos`.`status`=1 GROUP BY `dw_views`.`video_id`), 0) AS views, (SELECT COUNT(*) FROM `dw_likes` WHERE `dw_likes`.`video_id`=`dw_videos`.`video_id` AND `dw_likes`.`like_status`=1 AND `dw_videos`.`status`=1 GROUP BY `dw_likes`.`video_id`) AS likes FROM `dw_videos` WHERE `dw_videos`.`status`=1 AND `dw_videos`.`position`<16 ORDER BY `position` ASC LIMIT $page, 15")->result_array();
		$where="";
		if(!empty($videos))
			foreach ($videos as $key => $value)
			{
				$where.="AND `dw_videos`.`video_id` != {$value['video_id']} ";
				$data['videos'][]=$value;
			}

		$videos2=$this->db->query("SELECT *, IFNULL( (SELECT COUNT(*) FROM `dw_views` WHERE `dw_views`.`video_id`=`dw_videos`.`video_id` AND `dw_videos`.`status`=1 GROUP BY `dw_views`.`video_id`), 0) AS views, (SELECT COUNT(*) FROM `dw_likes` WHERE `dw_likes`.`video_id`=`dw_videos`.`video_id` AND `dw_likes`.`like_status`=1 AND `dw_videos`.`status`=1 GROUP BY `dw_likes`.`video_id`) AS likes FROM `dw_videos` WHERE `dw_videos`.`status`=1 ".((!empty($where)) ? $where : "")." ORDER BY `position`, `created_at` DESC LIMIT $page, 10")->result_array();
		if($videos2)
			foreach ($videos2 as $key => $value)
				$data['videos'][]=$value;

		if(!empty($data['videos']))
		{
			foreach ($data['videos'] as $key => $video)
			{
				$data['videos'][$key]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $video['user_id'])); // Check if User exists
				$data['videos'][$key]['time_ago']	= $this->time_Ago(strtotime($video['updated_at']));
				if(!isset($data['videos'][$key]['user']['error']))
				{
					unset($data['videos'][$key]['user']['username']);
					unset($data['videos'][$key]['user']['gender']);
					unset($data['videos'][$key]['user']['dob']);
					unset($data['videos'][$key]['user']['email']);
					unset($data['videos'][$key]['user']['phone']);
					unset($data['videos'][$key]['user']['password']);
					unset($data['videos'][$key]['user']['role']);
					unset($data['videos'][$key]['user']['device_token']);
					unset($data['videos'][$key]['user']['is_blocked']);
					unset($data['videos'][$key]['user']['updated_at']);
					unset($data['videos'][$key]['user']['created_at']);
					$data['videos'][$key]['likes']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1))) ? $count : 0;
					$data['videos'][$key]['dislikes']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2))) ? $count2 : 0;
					$data['videos'][$key]['views']		= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $video['video_id']))) ? $count3 : 0;
					$data['videos'][$key]['i_liked']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
					$data['videos'][$key]['i_disliked']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
					$data['videos'][$key]['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $video['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
					$data['videos'][$key]['i_subscribed']= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;
					$data['videos'][$key]['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id']))) ? $count2 : 0;
				}
				else
					unset($data['videos'][$key]);
			}
			if(!empty($data))
				$response	= array('error' => FALSE, 'message' => 'Video listing successful', 'details' => $data['videos']);
			else
				$response	= array('error' => TRUE, 'message' => 'This Video is not available at the moment.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'There are no videos available at the moment. Please check after some time.', 'details' => array());
		echo json_encode($response);
	}
	public function searchVideos()
	{
		$user			= $this->userCheck(); // Check if User exists
		// $data['video']	= $this->videoCheck(); // Check if Video exists

		if(!$this->input->post('dw_search'))
			$error[]	= 'Search text is required...';

		if(!empty($error)) // If all required parameters are empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			$page=($this->input->post('dw_page')) ? $this->input->post('dw_page')*10 : 0;
			$data['videos']=$this->db->query("SELECT *, IFNULL( (SELECT COUNT(*) FROM `dw_views` WHERE `dw_views`.`video_id`=`dw_videos`.`video_id` AND `dw_videos`.`status`=1 GROUP BY `dw_views`.`video_id`), 0) AS views, (SELECT COUNT(*) FROM `dw_likes` WHERE `dw_likes`.`video_id`=`dw_videos`.`video_id` AND `dw_likes`.`like_status`=1 AND `dw_videos`.`status`=1 GROUP BY `dw_likes`.`video_id`) AS likes FROM `dw_videos` WHERE MATCH(`title`, `description`, `tags`) AGAINST('{$this->input->post('dw_search')}*' IN BOOLEAN MODE) AND `dw_videos`.`status`=1 ORDER BY `position`, `created_at` DESC LIMIT $page, 10")->result_array();
			if(!empty($data['videos']))
			{
				foreach ($data['videos'] as $key => $video)
				{
					$data['videos'][$key]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $video['user_id'])); // Check if User exists
					$data['videos'][$key]['time_ago']	= $this->time_Ago(strtotime($video['updated_at']));
					if(!isset($data['videos'][$key]['user']['error']))
					{
						unset($data['videos'][$key]['user']['username']);
						unset($data['videos'][$key]['user']['gender']);
						unset($data['videos'][$key]['user']['dob']);
						unset($data['videos'][$key]['user']['email']);
						unset($data['videos'][$key]['user']['phone']);
						unset($data['videos'][$key]['user']['password']);
						unset($data['videos'][$key]['user']['role']);
						unset($data['videos'][$key]['user']['device_token']);
						unset($data['videos'][$key]['user']['is_blocked']);
						unset($data['videos'][$key]['user']['updated_at']);
						unset($data['videos'][$key]['user']['created_at']);
						$data['videos'][$key]['likes']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1))) ? $count : 0;
						$data['videos'][$key]['dislikes']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2))) ? $count2 : 0;
						$data['videos'][$key]['views']		= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $video['video_id']))) ? $count3 : 0;
						$data['videos'][$key]['i_liked']	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
						$data['videos'][$key]['i_disliked']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$key]['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $video['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$key]['i_subscribed']= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$key]['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id']))) ? $count2 : 0;
					}
					else
						unset($data['videos'][$key]);
				}
				if(!empty($data))
					$response	= array('error' => FALSE, 'message' => 'Video listing successful', 'details' => $data['videos']);
				else
					$response	= array('error' => TRUE, 'message' => 'This Video is not available at the moment.', 'details' => array());
			}
			else
				$response	= array('error' => TRUE, 'message' => 'There are no videos available at the moment. Please check after some time.', 'details' => array());
		}
		echo json_encode($response);
	}
	public function getLikedVideos()
	{
		$user			= $this->userCheck(); // Check if User exists
		// $data['video']	= $this->videoCheck(); // Check if Video exists
		$page=($this->input->post('dw_page')) ? $this->input->post('dw_page')*10 : 0;
		$liked=$this->db->query("SELECT * FROM `dw_likes`, `dw_videos` WHERE `dw_likes`.`video_id`=`dw_videos`.`video_id` AND `dw_likes`.`like_status`=1 AND `dw_videos`.`status`=1 AND `dw_likes`.`user_id`='".$user['user_id']."' GROUP BY `dw_likes`.`video_id` ORDER BY `dw_likes`.`updated_at` DESC LIMIT $page, 10")->result_array();
		if(!empty($liked))
		{
			$i=0;
			foreach ($liked as $key => $video)
			{
				if($video= $this->videoCheck($video['video_id']))
				{
					$data['videos'][$i] = $video;
					$data['videos'][$i]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $video['user_id'])); // Check if User exists
					$data['videos'][$i]['time_ago']	= $this->time_Ago(strtotime($video['updated_at']));
					if(!isset($data['videos'][$i]['user']['error']))
					{
						unset($data['videos'][$i]['user']['user_id']);
						unset($data['videos'][$i]['user']['username']);
						unset($data['videos'][$i]['user']['gender']);
						unset($data['videos'][$i]['user']['dob']);
						unset($data['videos'][$i]['user']['email']);
						unset($data['videos'][$i]['user']['phone']);
						unset($data['videos'][$i]['user']['password']);
						unset($data['videos'][$i]['user']['role']);
						unset($data['videos'][$i]['user']['device_token']);
						unset($data['videos'][$i]['user']['is_blocked']);
						unset($data['videos'][$i]['user']['updated_at']);
						unset($data['videos'][$i]['user']['created_at']);
						$data['videos'][$i]['likes']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1))) ? $count : 0;
						$data['videos'][$i]['dislikes']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2))) ? $count2 : 0;
						$data['videos'][$key]['views']		= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $video['video_id']))) ? $count3 : 0;
						$data['videos'][$i]['i_liked']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
						$data['videos'][$i]['i_disliked']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $video['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['i_subscribed']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id']))) ? $count2 : 0;
						$i++;
					}
					else
						unset($data['videos'][$i]);
				}
			}
			if(!empty($data['videos']))
				$response	= array('error' => FALSE, 'message' => 'Video listing successful', 'details' => $data['videos']);
			else
				$response	= array('error' => TRUE, 'message' => 'Add Videos in you liked video list.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'There are no videos available at the moment. Please check after some time.', 'details' => array());
		echo json_encode($response);
	}
	public function getWishlistVideos()
	{
		$user			= $this->userCheck(); // Check if User exists
		// $data['video']	= $this->videoCheck(); // Check if Video exists
		$page=($this->input->post('dw_page')) ? $this->input->post('dw_page')*10 : 0;
		$liked=$this->db->query("SELECT * FROM `dw_videos`, `dw_wishlist` WHERE `dw_wishlist`.`video_id`=`dw_videos`.`video_id` AND `dw_wishlist`.`wish_status`=1 AND `dw_videos`.`status`=1 AND `dw_wishlist`.`user_id`='".$user['user_id']."' GROUP BY `dw_wishlist`.`video_id` ORDER BY `dw_wishlist`.`updated_at` DESC LIMIT $page, 10")->result_array();
		if(!empty($liked))
		{
			$i=0;
			foreach ($liked as $key => $video)
			{
				if($vid= $this->videoCheck($video['video_id']))
				{
					$data['videos'][$i] = $vid;
					$data['videos'][$i]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $vid['user_id'])); // Check if User exists
					$data['videos'][$i]['time_ago']	= $this->time_Ago(strtotime($vid['updated_at']));
					if(!isset($data['videos'][$i]['user']['error']))
					{
						unset($data['videos'][$i]['user']['user_id']);
						unset($data['videos'][$i]['user']['username']);
						unset($data['videos'][$i]['user']['gender']);
						unset($data['videos'][$i]['user']['dob']);
						unset($data['videos'][$i]['user']['email']);
						unset($data['videos'][$i]['user']['phone']);
						unset($data['videos'][$i]['user']['password']);
						unset($data['videos'][$i]['user']['role']);
						unset($data['videos'][$i]['user']['device_token']);
						unset($data['videos'][$i]['user']['is_blocked']);
						unset($data['videos'][$i]['user']['updated_at']);
						unset($data['videos'][$i]['user']['created_at']);
						$data['videos'][$i]['likes']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1))) ? $count : 0;
						$data['videos'][$i]['dislikes']		= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2))) ? $count2 : 0;
						$data['videos'][$key]['views']		= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $video['video_id']))) ? $count3 : 0;
						$data['videos'][$i]['i_liked']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
						$data['videos'][$i]['i_disliked']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['i_saved']		= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $video['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['i_subscribed']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id']))) ? $count2 : 0;
						$i++;
					}
					else
						unset($data['videos'][$i]);
				}
			}
			if(!empty($data['videos']))
				$response	= array('error' => FALSE, 'message' => 'Video listing successful', 'details' => $data['videos']);
			else
				$response	= array('error' => TRUE, 'message' => 'Add some Videos in your wishilist.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'There are no videos available at the moment. Please check after some time.', 'details' => array());
		echo json_encode($response);
	}
	public function getUserVideos()
	{
		$user			= $this->userCheck(); // Check if User exists
		// $data['video']	= $this->videoCheck(); // Check if Video exists
		$page=($this->input->post('dw_page')) ? $this->input->post('dw_page')*10 : 0;
		$liked=$this->db->query("SELECT * FROM `dw_videos` WHERE `dw_videos`.`user_id`='".$user['user_id']."' AND `dw_videos`.`status`=1 ORDER BY `updated_at` DESC LIMIT $page, 10")->result_array();
		if(!empty($liked))
		{
			$i=0;
			foreach ($liked as $key => $video)
			{
				if($video= $this->videoCheck($video['video_id']))
				{
					$data['videos'][$i] = $video;
					$data['videos'][$i]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $video['user_id'])); // Check if User exists
					$data['videos'][$i]['time_ago']	= $this->time_Ago(strtotime($video['updated_at']));
					if(!isset($data['videos'][$i]['user']['error']))
					{
						unset($data['videos'][$i]['user']['user_id']);
						unset($data['videos'][$i]['user']['username']);
						unset($data['videos'][$i]['user']['gender']);
						unset($data['videos'][$i]['user']['dob']);
						unset($data['videos'][$i]['user']['email']);
						unset($data['videos'][$i]['user']['phone']);
						unset($data['videos'][$i]['user']['password']);
						unset($data['videos'][$i]['user']['role']);
						unset($data['videos'][$i]['user']['device_token']);
						unset($data['videos'][$i]['user']['is_blocked']);
						unset($data['videos'][$i]['user']['updated_at']);
						unset($data['videos'][$i]['user']['created_at']);
						$data['videos'][$i]['likes']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1))) ? $count : 0;
						$data['videos'][$i]['dislikes']		= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2))) ? $count2 : 0;
						$data['videos'][$i]['views']		= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $video['video_id']))) ? $count3 : 0;
						$data['videos'][$i]['i_liked']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
						$data['videos'][$i]['i_disliked']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $video['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['i_subscribed']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id']))) ? $count2 : 0;
						$i++;
					}
					else
						unset($data['videos'][$i]);
				}
			}
			if(!empty($data['videos']))
				$response	= array('error' => FALSE, 'message' => 'Video listing successful', 'details' => $data['videos']);
			else
				$response	= array('error' => TRUE, 'message' => 'Add Videos in you liked video list.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'There are no videos available at the moment. Please check after some time.', 'details' => array());
		echo json_encode($response);
	}
	public function getSubscriptionVideos()
	{
		$user			= $this->userCheck(); // Check if User exists
		// $data['video']	= $this->videoCheck(); // Check if Video exists
		$page=($this->input->post('dw_page')) ? $this->input->post('dw_page')*10 : 0;
		$users=$this->db->query("SELECT * FROM `dw_subcriptions` WHERE `dw_subcriptions`.`from_user_id`='".$user['user_id']."' ORDER BY `updated_at` DESC")->result_array();
		$liked=$this->db->query("SELECT * FROM `dw_subcriptions`,`dw_videos` WHERE `dw_subcriptions`.`to_user_id`=`dw_videos`.`user_id` AND `dw_videos`.`status`=1 AND `dw_subcriptions`.`from_user_id`='".$user['user_id']."' ORDER BY `dw_videos`.`updated_at` DESC LIMIT $page, 10")->result_array();
		if(!empty($liked))
		{
			$i=0;
			foreach ($liked as $key => $video)
			{
				if($video= $this->videoCheck($video['video_id']))
				{
					$data['videos'][$i] = $video;
					$data['videos'][$i]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $video['user_id'])); // Check if User exists
					$data['videos'][$i]['time_ago']	= $this->time_Ago(strtotime($video['updated_at']));
					if(!empty($data['videos'][$i]['user']))
					{
						// unset($data['videos'][$i]['user']['user_id']);
						unset($data['videos'][$i]['user']['username']);
						unset($data['videos'][$i]['user']['gender']);
						unset($data['videos'][$i]['user']['dob']);
						unset($data['videos'][$i]['user']['email']);
						unset($data['videos'][$i]['user']['phone']);
						unset($data['videos'][$i]['user']['password']);
						unset($data['videos'][$i]['user']['role']);
						unset($data['videos'][$i]['user']['device_token']);
						unset($data['videos'][$i]['user']['is_blocked']);
						unset($data['videos'][$i]['user']['updated_at']);
						unset($data['videos'][$i]['user']['created_at']);
						$data['videos'][$i]['likes']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1))) ? $count : 0;
						$data['videos'][$i]['dislikes']		= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2))) ? $count2 : 0;
						$data['videos'][$i]['views']		= ($count3=$this->mysql->get_count('dw_views', array('video_id' => $video['video_id']))) ? $count3 : 0;
						$data['videos'][$i]['i_liked']		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
						$data['videos'][$i]['i_disliked']	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['i_saved']	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $video['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['i_subscribed']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;
						$data['videos'][$i]['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id']))) ? $count2 : 0;
						$i++;
					}
					else
						unset($data['videos'][$i]);
				}
			}
		}
		if(!empty($users))
		{
			$i=0;
			foreach ($users as $key => $user)
			{
				$data['users'][$i]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $user['to_user_id'])); // Check if User exists
				if(!empty($data['users'][$i]['user']))
				{
					// unset($data['users'][$i]['user']['user_id']);
					unset($data['users'][$i]['user']['username']);
					unset($data['users'][$i]['user']['gender']);
					unset($data['users'][$i]['user']['dob']);
					unset($data['users'][$i]['user']['email']);
					unset($data['users'][$i]['user']['phone']);
					unset($data['users'][$i]['user']['password']);
					unset($data['users'][$i]['user']['role']);
					unset($data['users'][$i]['user']['device_token']);
					unset($data['users'][$i]['user']['is_blocked']);
					unset($data['users'][$i]['user']['updated_at']);
					unset($data['users'][$i]['user']['created_at']);
					$data['users'][$i]['user']['subscriptions']	= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $user['to_user_id']))) ? $count2 : 0;
					$i++;
				}
				else
					unset($data['users'][$i]);
			}
			if(!empty($data['videos']))
				$response	= array('error' => FALSE, 'message' => 'Listing successful', 'details' => $data);
			else
				$response	= array('error' => TRUE, 'message' => 'Add Videos in you liked video list.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'There are no videos available at the moment. Please check after some time.', 'details' => array());
		echo json_encode($response);
	}
	public function getUserNotifications()
	{
		$user			= $this->userCheck(); // Check if User exists
		// $data['video']	= $this->videoCheck(); // Check if Video exists
		$notifications=$this->db->query("SELECT * FROM `dw_notifications` WHERE `dw_notifications`.`user_id`='".$user['user_id']."' ORDER BY `updated_at` DESC")->result_array();
		if(!empty($notifications))
		{
			$i=0;
			foreach ($notifications as $key => $notification)
			{
				$data['notifications'][$i]				= $notification;
				$data['notifications'][$i]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $notification['from_user_id'])); // Check if User exists
				$data['notifications'][$i]['time_ago']	= $this->time_Ago(strtotime($notification['updated_at']));
				$i++;
			}
			if(!empty($data['notifications']))
				$response	= array('error' => FALSE, 'message' => 'Notifications listing successful', 'details' => $data['notifications']);
			else
				$response	= array('error' => TRUE, 'message' => 'No new notifications.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'There are no Notifications available at the moment. Please check after some time.', 'details' => array());
		echo json_encode($response);
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
	public function deleteVideo($table='dw_videos', $where='')
	{
		$user			= $this->userCheck(); // Check if User exists
		$video	= $this->videoCheck(); // Check if Video exists
		if($this->mysql->get_row('dw_videos', array('user_id'=>$user['user_id'], 'video_id'=>$video['video_id'])))
		{
			if($this->mysql->delete_data('dw_videos', array('user_id'=>$user['user_id'], 'video_id'=>$video['video_id'])))
			{
				$response	= array('error' => FALSE, 'message' => 'Video deleted successfully', 'details' => array());
				if (file_exists($video['video_url']) || file_exists($video['video_picture']))
				{
					@unlink($video['video_url']);
					@unlink($video['video_picture']);
					@unlink($video['video_thumbnail']);
				}
			}
			else
				$response	= array('error' => TRUE, 'message' => 'An error occured while deleting your video. May be this video doesn\'t exist anymore.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'Video does not belongs to you.', 'details' => array());
		echo json_encode($response);
	}
	public function forgotPassword()
	{
		// Check Required Parameters 
		// $this->sendMail("polus628@gmail.com", "test", "message");die();
		$error	= [];
		if(!$this->input->post('dw_username'))
			$error[]	= 'A username is required to do such action...';
		else
			if(!$user=$this->mysql->get_row('dw_user_details', "username = '{$this->input->post('dw_username')}' OR email = '{$this->input->post('dw_username')}'" ))
				$error[]	= 'User does not exists in our records...';

		if(!empty($error)) // If all required parameters empty...
			$response	= array('error' => TRUE, 'message' => 'Details are required...', 'details' => $error);
		else
		{
			$password=random_string('alnum', 8);
			$details['password']	= md5($password);
			$message="Hi {$user['username']},<br><br>We got a forgot password request from you, and we just changed your password so that it will anonymize, secured and only be accessbile by you.<br>Use <h4>$password</h4> as your password for loggin in to your DreamWerk Account and don't forget to change password from your profile settings after you have successfully logged in.<br><br>Thanks for your time,<br>Team DreamWerk.";
			$sub="Your password is changed.";

			if($this->sendMail($user['email'], $sub, $message))
			{
				if($this->mysql->update_data('dw_user_details', array("user_id" => $user['user_id']), $details ))
					$response	= array('error' => FALSE, 'message' => 'An email is successfully forward to your account. Please use password from that mail and login again.', 'details' => array());
				else
					$response	= array('error' => TRUE, 'message' => 'Your password isn\'t changed. Please ingore any mail if you have recieved one.', 'details' => array());
			}
			else
				$response	= array('error' => TRUE, 'message' => 'An error occured !! Please try after some time...', 'details' => array());
		}
		echo json_encode($response);
	}
	public function getTerms()
	{
		$user			= $this->userCheck(); // Check if User exists
		// $data['video']	= $this->videoCheck(); // Check if Video exists
		/*$notifications=$this->db->query("SELECT * FROM `dw_notifications` WHERE `dw_notifications`.`user_id`='".$user['user_id']."' ORDER BY `updated_at` DESC")->result_array();
		if(!empty($notifications))
		{
			$i=0;
			foreach ($notifications as $key => $notification)
			{
				$data['notifications'][$i]				= $notification;
				$data['notifications'][$i]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $notification['from_user_id'])); // Check if User exists
				$data['notifications'][$i]['time_ago']	= $this->time_Ago(strtotime($notification['updated_at']));
			}
			if(!empty($data['notifications']))
				$response	= array('error' => FALSE, 'message' => 'Notifications listing successful', 'details' => $data['notifications']);
			else
				$response	= array('error' => TRUE, 'message' => 'No new notifications.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'There are no Notifications available at the moment. Please check after some time.', 'details' => array());*/

		$response	= array('error' => FALSE, 'message' => 'Terms listing successful', 'details' => array("terms" => "Our terms and conditions will be soon anounced."));
		echo json_encode($response);
	}
	public function getAbout()
	{
		$user			= $this->userCheck(); // Check if User exists
		// $data['video']	= $this->videoCheck(); // Check if Video exists
		/*$notifications=$this->db->query("SELECT * FROM `dw_notifications` WHERE `dw_notifications`.`user_id`='".$user['user_id']."' ORDER BY `updated_at` DESC")->result_array();
		if(!empty($notifications))
		{
			$i=0;
			foreach ($notifications as $key => $notification)
			{
				$data['notifications'][$i]				= $notification;
				$data['notifications'][$i]['user']		= $this->mysql->get_row('dw_user_details', array('user_id' => $notification['from_user_id'])); // Check if User exists
				$data['notifications'][$i]['time_ago']	= $this->time_Ago(strtotime($notification['updated_at']));
			}
			if(!empty($data['notifications']))
				$response	= array('error' => FALSE, 'message' => 'Notifications listing successful', 'details' => $data['notifications']);
			else
				$response	= array('error' => TRUE, 'message' => 'No new notifications.', 'details' => array());
		}
		else
			$response	= array('error' => TRUE, 'message' => 'There are no Notifications available at the moment. Please check after some time.', 'details' => array());*/

		$response	= array('error' => FALSE, 'message' => 'About us listing successful', 'details' => array("terms" => "We will soon anounce ourselves to you."));
		echo json_encode($response);
	}
}
