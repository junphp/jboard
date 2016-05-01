<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_Model {


  //call the model constructor
  function  __construct(){
    parent:: __construct();
  }

  function add_user($option){
      $this->db->set('nickname',$option['nickname']);
      $this->db->set('email',$option['email']);
      $this->db->set('password',$option['password']);
      $this->db->set('created','NOW()',false);
      $this->db->insert('user');
      $result=$this->db->insert_id();
      return $result;
  }

  function login($email,$password){

          $this->db->from('user');
          $this->db->where('email',$email);
          $this->db->where('password',md5($password));
          $login=$this->db->get()->result();
        }

  function read_user_information($email){

      $condition ="email"."'".$email."'";
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where($condition);
      $this->db->limit(1);

      $query=$this->db->get();

      if($query->num_rows()==1){

          return $query->result();
      }else{

        return FALSE;
      }
  }

  function check_user_exist($user){
      $this->db->where('email',$user);
      $query=$this->db->get('user');
      if($query->num_rows()>0){
        return true;
      }else{
        return FALSE;
      }
  }

  function check_username_exist($user){
      $this->db->where('nickname',$user);
      $query=$this->db->get('user');
      if($query->num_rows()>0){
        return true;
      }else{
        return FALSE;
      }
  }

  function getByEmail($option){
    $result = $this->db->get_where('user',array('email'=>$option['email']));

    if($result->num_rows() > 0){
      return $result->row();
    }else{
      //$this->form_validation->set_message('getByEmail','The email address already exist. Please try again');
      return false;
    }


  }
}
