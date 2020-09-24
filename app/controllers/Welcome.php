<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Api_model', 'mysql');
		$this->load->helper('string');
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function saveVideoThumbanailHTML($value='')
	{
		if(!empty($value))
		{
			$data['video_id']=$value;
			$this->load->view('save_video_thumbnail.php', $data);
		}
		else
			echo "Direct access to this page isn't allowed.";
	}
	public function saveVideoThumbanail($value='')
	{
		$video=$this->mysql->get_row('dw_videos',array('video_id'=>$value));
		if(!empty($video))
		{
			$filename =$video['video_id'].'.jpg';

				if (file_get_contents('php://input')){
					// Remove the headers (data:,) part.
					$filteredData=substr(file_get_contents('php://input'), strpos(file_get_contents('php://input'), ",")+1);

					// Need to decode before saving since the data we received is already base64 encoded
					$decodedData=base64_decode($filteredData);

					//create the file
					if($fp = fopen( FCPATH."uploads/video_pictures/".$filename, 'wb' )){
						fwrite( $fp, $decodedData);
						fclose( $fp );
					} else {
						echo "Could not create file.";
					}
			}
			$video=$this->mysql->update_data('dw_videos',array('video_id'=>$value), array('video_picture'=> "uploads/video_pictures/".$filename,'video_thumbnail'=>"uploads/video_pictures/".$filename));
			echo "Created image ".$filename;
			die();
		}
	}
}
