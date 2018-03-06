<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once ("secure_area.php");
class Welcome extends secure_area{

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title']=$this->lang->line('site_name').' :: ADMIN LOGIN :: ';
		$this->load->view('dashboard/certificateMenu', $data);
	}
	
	/*function pdf()
	{
		
		$html = $this->load->view('china/certificateMenu', '', true);

		$pdf_filename  = 'report.pdf';
		$this->load->library('dompdf_lib');
		$this->dompdf_lib->convert_html_to_pdf($html, $pdf_filename, true);
		
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */