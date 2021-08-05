<?php
class Homemodel extends CI_Model
{
    function getSlider ()
    {
      $this->db->where('s_status','1');
      $q = $this->db->get('tbl_slider');
      return $q->result();
    }
    function getAbout ()
    {
      $this->db->where('a_status','1');
      $q = $this->db->get('tbl_aboutus');
      return $q->result();
    }
    function getOffers ()
    {
      $this->db->where('o_status','1');
      $q = $this->db->get('tbl_offers');
      return $q->result();
    }
    function getReviews ()
    {
      $this->db->where('r_status','1');
      $q = $this->db->get('tbl_reviews');
      return $q->result();
    }
    function getLmtdish ()
    {
      $q = $this->db->limit(6); 
      $q = $this->db->get('tbl_dishes');
      
      return $q->result();
    }
    function getOpentimesmodel ()
    {
      $this->db->select("t1.day_id,t1.day,t2.w_status,t2.w_from_time,t2.w_to_time");
      $this->db->from('tbl_days t1');
      $this->db->join('tbl_working_time t2', 't1.day_id = t2.day_id');
      $q =$this->db->get();
      //echo $this->db->last_query();
      return $q->result();
   
      // $this->db->where('status','1');
      // $q = $this->db->get('open_times');
      // return $q->result();
    }
    function getd_main_cat ()
    {
      $this->db->where('status','1');
      $this->db->where('cat_id',NULL);
      $q = $this->db->get('d_category');
      return $q->result();
    }
    function getd_sub_cat ()
    {
      $this->db->where('status','1');
      $this->db->where('cat_id',1);
      $q = $this->db->get('d_category');
      return $q->result();
    }
    function get_one_dish ($dish_id)
    {
      $this->db->where('d_id',$dish_id);
      $q = $this->db->get('tbl_dishes');
      return $q->result();
    }
    function getContactinfomodel ()
    {
      $q = $this->db->get('tbl_main_contact');
      return $q->result();
    }

    function get_user_by_id ($user_id)
    {
      $this->db->where('r_id',$user_id);
      $q = $this->db->get('tbl_register');
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
}