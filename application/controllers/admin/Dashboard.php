<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
 {

	
	function __construct() 
	{
        parent::__construct();
        checkSess();
    }
	public function index()
	{
		// $q = $this->db->get('tbl_services');
		// $data['count_services'] =$q->num_rows();
	
		
		// $reviews = $this->db->get('tbl_faq');
		// $data['count_faq'] =$reviews->num_rows();
		
		
		// $offers = $this->db->get('tbl_choose_us');
		// $data['count_choose'] =$offers->num_rows();	
	
	
		$data['breadcrumb'] = array("title"=>"Dashboard","links"=>array("Dashboard"=>"#"));
		 $this->load->view('admin/dashboard',$data);
		
	}
}