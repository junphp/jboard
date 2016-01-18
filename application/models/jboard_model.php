<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Jboard_model extends CI_Model {


  //call the model constructor
  function  __construct(){
    parent:: __construct();

  }
//all article call and store
	 function mydata($limit,$start)
	{
    //$this->db->limit($limit,$start);
    $query = $this->db->query('SELECT*FROM jdmain ORDER BY id desc',$limit,$start);

      if($query->num_rows()>0){

        return  $query->result();
      }else{

        return FALSE;
      }
	}

//total article count
  function totla_data(){

    return $this->db->count_all_results('jdmain');
  }
//single date call and store
  function singledata($id){
    return $this->db->get_where('jdmain',array('id'=>$id))->row();
  }

//new article
  function add($title,$description){
    $this->db->set('created','NOW()',false);
    $this->db->insert('jdmain',array(
      'title'=>$title,
      'description'=>$description,
    ));
    return $this->db->insert_id();
  }

  function updatedb($id,$data){

              $this->db->where('id', $id);
              $this->db->update('jdmain', $data);
       }

//article delete
  function del_user_id($id){
    $this->db->where('id',$id);
    $delete=$this->db->delete('jdmain');
    if($delete){
      return true;
    }else{
      return false;
    }
  }
//article view count
    function updateview($id){
      $this->db->set('view','view + 1',FALSE);
      $this->db->where('id',$id);
      $this->db->update('jdmain');
    }

    function page_cut($limit, $id){

      $this->db->limit($limit);
      $this->db->where('id', $id);
      $query = $this->db->get("jdmain");
      if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}

return $data;
}
return false;
}


}
