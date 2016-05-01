<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Jboard_model extends CI_Model {


  //call the model constructor
  function  __construct(){
    parent:: __construct();

  }
//all article call and store
	 function mydata($table_name,$limit,$offset){

    $this->db->order_by('id','desc');

    $query = $this->db->get($table_name,$limit,$offset);


      if( $query->num_rows() > 0 )
          return $query->result();
      else
          return FALSE;
	  }

    function prebtn($id,$table_name){

      $this->db->order_by('id','desc');
      $this->db->where('id<',$id);
      //$this->db->or_where('id>',0);
      return $query = $this->db->get($table_name,1)->row();

          }

    function nextbtn($id,$table_name){

      //$this->db->order_by('id','desc');
      $this->db->where('id>',$id);
      //$this->db->or_where('id>',0);
      //return $query = $this->db->get($table_name,1)->row();

      $query = $this->db->get($table_name,1);

      if($query->num_rows() > 0){
          return $query->row();
        }else{
          return 0;
        }
      }

    function last($table_name){
        $this->db->order_by('id','desc');
        return $this->db->get($table_name)->row();
    }

//total article count
  function totla_data(){

    return $this->db->count_all_results('jdmain');
  }
//single date call and store
  function singledata($table_name,$id){
    return $this->db->get_where($table_name,array('id'=>$id))->row();
  }
// board list show comment total
  function comment_data($table_name,$id){
    return  $this->db->get_where($table_name,array('board_id'=>$id))->result();
  }

  /*function get_last_id(){
      $this->db->order_by("id", "desc");
      $this->db->select('id');
      $query=$this->db->get('jdmain')->result_array();
      return $query;
  }*/
  /*function child_comment_data($id){
    //$this->db->from('child_comment');
    return $this->db->get_where('child_comment',array('board_id'=>$id))->result_array();
    //$this->db->where(array('parent_id'=>))
    /*$this->db->where('board_id',$board_id);
    $this->db->where('parent_id',$parent_id);
    $query->$this->db->get('child_comment');
    if ($query->num_rows() !== 0) {
      return $query->result_array();
    }else{
      return FALSE;
    }
  }*/



  function total_comments($table_name,$id){

    $this->db->like('board_id',$id);
    $this->db->from($table_name);
    return $this->db->count_all_results();
  }

//current article posted
  function get_latest($table_name){

    $this->db->order_by('id','desc');
    $this->db->limit('5');
    return $query = $this->db->get($table_name)->result();
  }

  //current popular article with higher like vote received
  function get_popular($table_name){

    $this->db->order_by('vote','desc');
    $this->db->limit('5');
    return $query = $this->db->get($table_name)->result();
  }


  //add new article to board
  function add($table_name,$user_info){
    $this->db->set('created','NOW()',false);
    $this->db->insert($table_name,array(
      'title'=>$user_info['title'],
      'user_id'=>$user_info['user_id'],
      'user_name'=>$user_info['user_name'],
      'description'=>$user_info['description']
    ));
    return $this->db->insert_id();
  }
//add comment for indivisual data
  function add_comment($table_name,$comment_array){
    $this->db->set('created','NOW()',false);
    $this->db->insert($table_name,array(
        'board_id'=>$comment_array['board_id'],
        'user_id'=>$comment_array['user_id'],
        'user_name'=>$comment_array['user_name'],
        'article'=>nl2br($comment_array['article']),
    ));
    return  $this->db->insert_id();
  }

//threaded comment
  function add_child_comment($child_comment_array,$parent_id){
      $this->db->set('created','NOW()',false);
      $this->db->insert('child_comment',array(
          'board_id'=>$child_comment_array['board_id'],
          'user_id'=>$child_comment_array['user_id'],
          'user_name'=>$child_comment_array['user_name'],
          'article'=>nl2br($child_comment_array['article']),
          'parent_id'=>$parent_id
      ));
      return  $this->db->insert_id();
  }

  //for indivisual page , total comment count
  function update_comment($table_name,$id){
      $this->db->set('tcomment','tcomment+1',FALSE);
      $this->db->where('id',$id);
      $this->db->update($table_name);

  }


//modify article
  function updatedb($board_name,$id,$data){

              $this->db->where('id',$id);
              $this->db->update($board_name,$data);
       }

//article delete
  function del_user_id($table_name,$id){
    $this->db->where('id',$id);
    $delete=$this->db->delete($table_name);
    if($delete){
      return true;
    }else{
      return false;
    }
  }

//article view count
    function updateview($table_name,$id){
      $this->db->set('view','view + 1',FALSE);
      $this->db->where('id',$id);
      $this->db->update($table_name);
    }


//recived search data
    function search_record_count($terms) {

      $this->db->like('title', $terms);
      $this->db->or_like('description', $terms);
      $this->db->from('jdmain');
      $this->db->from('picture');

      return $this->db->count_all_results();

    }

    function search($terms)
    {
      $this->db->order_by('id','desc');
      $this->db->like('title', $terms);
      $this->db->or_like('description', $terms);
      $query=$this->db->get('wall');

      if($query->num_rows()>0){
        return $query->result();

      }else{
        return false;
      }
    }


    function like_update_vote($table_name,$id){

        $this->db->set('vote','vote + 1',FALSE);
        $this->db->where('id',$id);
        $this->db->update($table_name);
        return $this->db->affected_rows();

    }
//insert row if user not voting yet
    function exist_vote($table_name,$user_info){


        $this->db->insert($table_name,array('user_id'=>$user_info['user_id'], 'board_id'=>$user_info['board_id']));
        return  $this->db->insert_id();
    }
//check table for existing user voting
    function is_vote($table_name,$user_id,$board_id){

        $this->db->where('user_id',$user_id);
        $this->db->where('board_id',$board_id);
        $query=$this->db->get($table_name);

        if($query->num_rows() > 0){
          return FALSE;
        }else{
          return TRUE;
        }
    }

    function dis_like_update_vote($table_name,$id){

        $this->db->set('dis_vote','dis_vote + 1',FALSE);
        $this->db->where('id',$id);
        $this->db->update($table_name);
        return $this->db->affected_rows();
    }

    function main1_data(){
      $this->db->order_by('id','desc');
      $this->db->limit(10);
      $query = $this->db->get('wall');


        if( $query->num_rows() > 0 ){
            return $query->result();
        }else{
            return FALSE;
          }
      }
      function main2_data(){
        $this->db->order_by('id','desc');
        $this->db->limit(10);
        $query = $this->db->get('picture');


          if( $query->num_rows() > 0 ){
              return $query->result();
          }else{
              return FALSE;
            }
        }

        function main3_data(){
          $this->db->order_by('id','desc');
          $this->db->limit(10);
          $query = $this->db->get('info');


            if( $query->num_rows() > 0 ){
                return $query->result();
            }else{
                return FALSE;
              }
          }
      //high vote posting for last week
        function wbest($table_name){

          $this->db->order_by('id','desc');
          $this->db->limit(5);
          $query=$this->db->query("select * from " .$table_name. " where WEEKOFYEAR(created)=WEEKOFYEAR(NOW())-1 ORDER BY id DESC LIMIT 6;");
          return $query->result();

        }

          function list_bottom($table_name,$limit,$offset){
            //$this->db->order_by('id','desc');
            $query = $this->db->get($table_name,$limit,$offset);


              if( $query->num_rows() > 0 )
                  return $query->result();
              else
                  return FALSE;
        	  }

          function count($table_name,$id){

            //$this->db->where('id>=',$id);
            $query = $this->db->query('SELECT * FROM ' .$table_name.' where id <= '.$id)->num_rows();

            //$query->num_rows();

            return $query;
          }

}
