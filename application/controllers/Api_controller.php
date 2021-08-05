<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_controller extends CI_Controller 
{

	function __construct()
	{
	  parent::__construct();
      $this->load->helper('url'); 
	  $this->load->database(); 
	
	
       
	}


    function insert_newsletter()
	{

		$email=$this->input->post('inputEmail');
        if($this->Main->getDetailedData('n_email ','tbl_newsletter',array('n_email'=>$email)))
        {
			$res = array("msg"=>'Email Already existing');
        }
       else
       {
		$param['n_email']= $email;
		if($this->Main->insert($param,"tbl_newsletter"))
					$res = array("msg"=>'success');
		else
						$res = array("msg"=>'fail');
	    }
		echo json_encode($res);					
	}
}