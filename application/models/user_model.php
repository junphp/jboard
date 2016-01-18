<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_Model {


  //call the model constructor
  function  __construct(){
    parent:: __construct();
  }

  function add_user($option){
      $this->db->set('email',$option['email']);
      $this->db->set('password',$option['password']);
      $this->db->set('created','NOW()',false);
      $this->db->insert('user');
      $result=$this->db->insert_id();
      return $result;
  }

  function getByEmail($option){
    $result = $this->db->get_where('user',array('email'=>$option['email']))->row();
    return $result;

  }
}
