<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_controller extends CI_Controller 
{

	function __construct()
	{
	  parent::__construct();
      $this->load->helper('url'); 
	  $this->load->database(); 
	  checkSess();
    

     
       
	}
	
    function contact()
	{
        
        $query = $this->db->get("tbl_contact"); 
        $data['records'] = $query->result();
		$data['breadcrumb'] = array("title"=>"Contact Us","links"=>array("Home"=>"#","Contact Us"=>"#"));
		$this->load->view('admin/contact_list',$data); 
	}
	

	
	
    


   function contact_delete()
	{
		 $id = $this->input->post('id');
		
		if(!empty($id))
		{
			
				if($this->Main->delete_contact($id))
					$res = array("res"=>1,"msg"=>'Contact Details deleted');
				
				else
					$res = array("res"=>0,"msg"=>'Failed to delete Contact Details');
		}
		else
			$res = array("res"=>0,'msg'=>'Id not found');
		echo json_encode($res);
	}

    
	
	
    function view_contact()
	{
		$id = $this->input->post('id');
		if(!empty($id))
		{
		
			$cat = $this->Main->getDetailedData('*','tbl_contact',array('c_id'=>$id));
			
        
      
            if(!empty($cat))
            {
                
                print('<table class="table table-stripped singlesearch" id="singlesearch">');
                print('<tr>');
                print('<td>Name</td><td>:</td><td>'.$cat[0]->c_name.'</td>');
				print('</tr>');
                print('<tr>');
                print('<td>Phone No</td><td>:</td><td>'.$cat[0]->c_phone.'</td>');
                print('</tr>');
                print('<tr>');
                print('<td>Email</td><td>:</td><td>'.$cat[0]->c_email.'</td>');
                print('</tr>');
                print('<tr>');
                print('<td>Message</td><td>:</td><td>'.$cat[0]->c_msg.'</td>');
                print('</tr>');
               
	            }
            }
	}


   

   

	
}

