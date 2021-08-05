<?php
class Main extends CI_Model
{
	
	public function  getData($table='',$cond=NULL,$limit='0',$start='',$order=array('','asc'))
  {
    $this->db->select('*')->from($table)->order_by($order[0],$order[1]);
    if(!empty($limit))
      $this->db->limit($limit,$start);
    if(!empty($cond))
      $this->db->where($cond);
    $res=$this->db->get();

    if($res->num_rows()>0)
    {
      return $res->result();
    }
    return false;
  }
  public function  getDetailedData($select='*',$table='',$cond=NULL,$limit='0',$start='',$order=array('','asc'),$join=array(),$grp_by=null)
  {
    $this->db->select($select)->from($table);
    if(!empty($order[0]))
      $this->db->order_by($order[0],$order[1]);
    if(!empty($start) || !empty($limit))
    {
      $this->db->limit($limit,$start);
    }
    if(!empty($join))
    {
      foreach($join as $j)
      {
        $this->db->join($j[0],$j[1],$j[2]);
      }
    }
    if(!empty($cond))
      $this->db->where($cond);
    if(!empty($where_in))
      $this->db->where_in($where_in);
    if(!empty($grp_by))
      $this->db->group_by($grp_by);
    $res=$this->db->get();

    if($res->num_rows()>0)
    {
      return $res->result();
    }
    return false;
  }
  public function batch_insert($data,$table)
  {
    return $this->db->insert_batch($table,$data);
  }
  public function insert($data, $table)
  {
    $this->db->insert($table,$data);

    return $this->db->insert_id();
  }
  public function update($data, $table, $cond)
  {
    $this->db->where($cond);
    return $this->db->update($table,$data);
  }
  public function delete($item,$cond)
  {
    $this->db->where($cond);
    return $this->db->delete($item);
  }
  public function grab($dbdata)
  {
    if (!empty($dbdata['distinct']))
    {
      $this->db->distinct();
    }
    if (empty($dbdata['select']))
    {
      $dbdata['select'] = '*';
    }
    if (empty($dbdata['limit']))
    {
      $dbdata['limit'] = NULL;
    }
    if (empty($dbdata['offset']))
    {
      $dbdata['offset'] = NULL;
    }
    if (!empty($dbdata['select']))
    {
      $this->db->select($dbdata['select']);
    }
    if (!empty($dbdata['where']))
    {
      $this->db->where($dbdata['where']);
    }
    if (!empty($dbdata['or_where']))
    {
      $this->db->group_start();
      $this->db->or_where($dbdata['or_where']);
      $this->db->group_end();
    }
    if(!empty($dbdata['where_in']))
    {
      foreach ($dbdata['where_in'] as $key => $value) {
         $this->db->where_in($key,$value);
      }
     
    }
    if(!empty($dbdata['or_where_in']))
    {
      $this->db->or_where_in($dbdata['or_where_in'][0],$dbdata['or_where_in'][1]);
    }
    if(!empty($dbdata['where_not_in']))
    {
      $this->db->group_start();
      $this->db->where_not_in($dbdata['where_not_in'][0],$dbdata['where_not_in'][1]);
      $this->db->group_end();
    }
    if (!empty($dbdata['order_by']))
    {
      $this->db->order_by($dbdata['order_by'][0],$dbdata['order_by'][1]);
    }
    if (!empty($dbdata['like']))
    {
      $this->db->group_start();
      $this->db->like($dbdata['like']);
      $this->db->group_end();
    }
    if (!empty($dbdata['or_like']))
    {
      $this->db->group_start();
      $this->db->or_like($dbdata['or_like']);
      $this->db->group_end();
    }
    if(!empty($dbdata['join_table']))
    {
      $c=count($dbdata['join_table']);
      $jn=$dbdata['join_table'];
      for ($i=0; $i <$c ; $i++)
      {
        if(!empty($jn[$i+2]))
          $this->db->join($jn[$i],$jn[$i+1],$jn[$i+2]);
        else
          $this->db->join($jn[$i],$jn[$i+1]);
        $i=$i+2;
      }
    }
    $result = $this->db->get($dbdata['table'], $dbdata['limit'], $dbdata['offset']);
    if ($result->num_rows() > 0)
    {
      if (!empty($dbdata['object']))
      {
        return $result->result();
      }
      else
      {
        return $result->result_array();
      }
    }
    else
    {
      return FALSE;
    }
  }
  
  
  
  
  
  
  
  
  function checkUser($uname)
  {
    $this->db->where('username',$uname);
    $this->db->where('login_status','1');
    $q = $this->db->get('login');
    return $q->result();
  }

  function checkUser_front($uname)
  {
    $this->db->where('r_email',$uname);
    $this->db->where('r_status','1');
    $this->db->where('user_type','2');
    $q = $this->db->get('tbl_register');
    return $q->result();
  }
  
  


  
  
  //change password
  function checkpassword($upassword,$id)
  {
    $this->db->select('*');    
    $this->db->from('login');
    $this->db->where('password',$upassword);
    $this->db->where('login_id',$id);
    $q = $this->db->get();
    return $q->result();
  }
  function update_password($npassword,$id)
  {
    
    $this->db->where("login_id",$id);
    return $this->db->update("login",array("password"=>$npassword));
  }

  function update_front_user_password($set_newpassword,$user_id)
  {
    
    $this->db->where("r_id",$user_id);
    return $this->db->update("tbl_register",array("r_password"=>$set_newpassword));
  }

  
  
    
    
   


//products
function getProductDetails()
{
$this->db->select('t1.*,t2.*');
$this->db->from('tbl_products t1');
$this->db->join('tbl_category t2','t1.p_category=t2.c_id',"left") ;

$query = $this->db->get();
return $query->result();

}


    }