
<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_controller extends CI_Controller 
{

	function __construct()
	{
	  parent::__construct();
      $this->load->helper('url'); 
	  $this->load->database(); 
	  checkSess();
    

     
       
	}
	
    function slider()
	{
    
       
        $query = $this->db->get("tbl_slider"); 
        $data['records'] = $query->result();
        $data['breadcrumb'] = array("title"=>"Slider","links"=>array("Home"=>"#","Slider"=>"#"));
		$this->load->view('admin/slider_list',$data); 
	}
	

	public function add_slider($id='')
	{ 

       
      
        if($id!='')
		{
         
            $data['records']=$this->Main->getDetailedData('*','tbl_slider',array('s_id'=>$id));
			 
		}
         $data['breadcrumb'] = array("title"=>"Add slider","links"=>array("Home"=>"#","Add slider"=>"#"));
	
		$this->load->view('admin/add_slider',$data); 


         
    }
	
    function slider_action()
	{
	
        $this->load->library('form_validation');
          
        
        
        $this->form_validation->set_rules('title','Title','required');
       // $this->form_validation->set_rules('imgname','Image','required');
      
       
      
        
  
        
        if(!$this->form_validation->run())
        {
            
			
			$errors = $this->form_validation->error_array();
			$res = array("res"=>0,"errors"=>$errors);
		
			
		
		}
	
        else
        {
        
		
			    $sId = $this->input->post('cid');
                $param['s_title'] = $this->input->post('title');
                $param['s_image'] = $this->input->post('imgname');
              
               
              
        
        
        
				if(empty($sId))
				{
				
					
					if($this->Main->insert($param,"tbl_slider"))
						$res = array("res"=>1,"msg"=>'Slider Added');
					else
						$res = array("res"=>0,"msg"=>'Failed to add slider');
				}
				else
				{
					


					
					if($this->Main->update($param,'tbl_slider',array('s_id'=>$sId)))
						$res = array("res"=>1,"msg"=>'Slider Edited');
					else
						$res = array("res"=>0,"msg"=>'Failed to edit slider');

				}
			
  
			}
			echo json_encode($res);
		}
	
	


   function slider_delete()
	{
		 $id = $this->input->post('id');
		
		if(!empty($id))
		{
			
				if($this->Main->delete('tbl_slider',array('s_id'=>$id)) )
					$res = array("res"=>1,"msg"=>'Slider deleted');
				
				else
					$res = array("res"=>0,"msg"=>'Failed to delete slider');
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
			$path = 'assets/front/img/';
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


 
			 
				   


				   
				
 
		 
		
	   
   
	
}

