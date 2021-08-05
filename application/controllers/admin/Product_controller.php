<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_controller extends CI_Controller 
{

	function __construct()
	{
	  parent::__construct();
      $this->load->helper('url'); 
	  $this->load->database(); 
	  checkSess();
    

     
       
	}
	
    function product()
	{
    
       
		$data['records'] =$this->Main->getProductDetails(); 
        $data['breadcrumb'] = array("title"=>"Product","links"=>array("Home"=>"#","Product"=>"#"));
		$this->load->view('admin/product_list',$data); 
	}
	

	public function add_product($id='')
	{ 

        $data['category']=$this->Main->getDetailedData('*','tbl_category',array('c_status'=>'1'));
      
        if($id!='')
		{
         
            $data['records']=$this->Main->getDetailedData('*','tbl_products',array('p_id'=>$id));
			 
		}
         $data['breadcrumb'] = array("title"=>"Add product","links"=>array("Home"=>"#","Add product"=>"#"));
	
		$this->load->view('admin/add_product',$data); 


         
    }
	
    function product_action()
	{
	
        $this->load->library('form_validation');
          
        
        $this->form_validation->set_rules('category','Category','required');
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('sub_title','Sub Title','required');
        $this->form_validation->set_rules('imgname','Image','required');
        $this->form_validation->set_rules('price','Price','required|numeric');
        // $this->form_validation->set_rules('desc','Description','required');
       
      
        
  
        
        if(!$this->form_validation->run())
        {
            
			
			$errors = $this->form_validation->error_array();
			$res = array("res"=>0,"errors"=>$errors);
		
			
		
		}
	
        else
        {
        
		
			    $sId = $this->input->post('cid');
                $param['p_category'] = $this->input->post('category');
                $param['p_title'] = $this->input->post('title');
                $param['p_subtitle'] = $this->input->post('sub_title');
                $param['p_image'] = $this->input->post('imgname');
                $param['p_price'] = $this->input->post('price');
                $param['p_desc'] = $this->input->post('desc');
               
              
        
        
        
				if(empty($sId))
				{
				
					
					if($this->Main->insert($param,"tbl_products"))
						$res = array("res"=>1,"msg"=>'Product Added');
					else
						$res = array("res"=>0,"msg"=>'Failed to add product');
				}
				else
				{
					


					
					if($this->Main->update($param,'tbl_products',array('p_id'=>$sId)))
						$res = array("res"=>1,"msg"=>'Product Edited');
					else
						$res = array("res"=>0,"msg"=>'Failed to edit product');

				}
			
  
			}
			echo json_encode($res);
		}
	
	


   function product_delete()
	{
		 $id = $this->input->post('id');
		
		if(!empty($id))
		{
			
				if($this->Main->delete('tbl_products',array('p_id'=>$id)) )
					$res = array("res"=>1,"msg"=>'Product deleted');
				
				else
					$res = array("res"=>0,"msg"=>'Failed to delete product');
		}
		else
			$res = array("res"=>0,'msg'=>'Id not found');
		echo json_encode($res);
	}

    function image()
	{
		$data = array();
		$filepath ='';
		$this->load->library('image_lib');
			if(!empty($_FILES['file']['name']))
			{ 
			$path = 'assets/front/img/products/';
			$uploadPath = './'.$path;
	        if (!is_dir($uploadPath))
	        {
	            mkdir($uploadPath, 0755, TRUE);
	        }
			
			$config['upload_path'] = $path;
		    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
		    $config['max_size'] = '5024000'; // max_size in kb 
			$config['file_name'] = $_FILES['file']['name'];
			$file_name=$_FILES['file']['name']; 
			$newfile_name= preg_replace('/[^A-Za-z0-9.]/', "", $file_name); 
            $config['file_name'] = $newfile_name;
            $new_name = time().$newfile_name;
            $config['file_name'] = $new_name;
		    // Load upload library 
		    $this->load->library('upload',$config); 
		    // File upload
			    if($this->upload->do_upload('file'))
			    { 
			    	 $fileData = $this->upload->data();
			    	 $this->resize_images($path,$fileData['file_name'],87,87);
			         $data['path'] = $path.$fileData['file_name'];	
			   		 $data['filename'] = $new_name;	
			   		
			    }
			    else
			    { 
			       $data['response'] = 'failed'; 
			    } 
		   }else
		   { 
		    $data['response'] = 'failed'; 
		   } 
		   echo json_encode($data);
	}
	function resize_images($path,$name,$w,$h)
   {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = './'.$path.$name;
        $config['new_image'] = './'.$path.$h.'_'.$w.'_'.$name;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['width']     = $w;
        $config['height']   = $h;
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        
        
   }


   function home_product_status()
   {
   
	  $status= $this->input->post('home_status');
	  $this->Main->update(array('p_home_status'=>'0'),'tbl_products',array('p_home_status'=>'1'));  
	if(count($status) > 0)
	{
		foreach($status as $key=>$value)
		{
			$pid = $key;
			$sts = $value;
			$param['p_home_status'] = $sts;
			if($this->Main->update($param,'tbl_products',array('p_id'=>$pid)))
			{
				$res = array("res"=>1,"msg"=>'Product Status Edited');
			}
	        else
	        {
				$res = array("res"=>0,"msg"=>'Failed to edit product status');
	        }
	
		}
		echo json_encode($res);
	} 
	   
	   
}   
			 
				   


				   
				
 
		 
		
	   
   
	
}

