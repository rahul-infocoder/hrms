<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once ("secure_area.php");
class Noaccess extends secure_area{

	public function index()
	{
	$data['title']=$this->lang->line('site_name').' :: ACCESS DENINED :: ';
	$this->load->view("access/noaccess", $data);
	}

}

/* End of file establishment.php */
/* Location: ./application/controllers/establishment.php */