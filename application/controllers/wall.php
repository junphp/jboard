<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Wall extends CI_Controller {

  function  __construct(){
    parent:: __construct();
    //database autoload
    $this->load->database();
    //autoload global model
    $this->load->model('Jboard_model');
    //autoload pagination library
    $this->load->library('pagination');

    $this->load->helper('text');

    $this->load->helper('cookie');

    $this->load->helper('url');
    date_default_timezone_set('America/New_York');
    }



	function index(){
    //private class call header
      $this->_head();


      //page list
      //total table rows
      //$data['user_nick']=$this->session->userdata('nickname');
      $data['table_name'] =$this->uri->segment(1);

      $data['total']=$this->db->count_all($data['table_name']);
      //how many rows want to show per page
      $data['per_page'] = 10;

      $table_name =$this->uri->segment(1);
      //$data['page_num']=$this->uri->segment(3,0);

      $data['today']=date("m-d-Y");
      //pagination ------------------------------------------------->

      $config['base_url'] = site_url().'/wall/index';
      $config['total_rows'] = $data['total'];
      $config['per_page'] = $data['per_page'];
      //$config['uri_segment']=3;
      $config['num_links'] = 5;
      $config['use_page_numbers']=TRUE;
    //$config['page_query_string'] =TRUE;

      //Adding Enclosing Markup
      $config['full_tag_open'] = '<div><ul class="pagination">';
      $config['full_tag_close'] = '</ul></div><!--pagination-->';

      $config['first_link'] = '&#60;&#60;';
      $config['first_tag_open'] = '<li class="prev page">';
      $config['first_tag_close'] = '</li>';

      $config['last_link'] = '&#62;&#62;';
      $config['last_tag_open'] = '<li class="next page">';
      $config['last_tag_close'] = '</li>';

      $config['next_link'] = '&#62;';
      $config['next_tag_open'] = '<li class="next page">';
      $config['next_tag_close'] = '</li>';

      $config['prev_link'] = '&#60;';
      $config['prev_tag_open'] = '<li class="prev page">';
      $config['prev_tag_close'] = '</li>';

      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';

      $config['num_tag_open'] = '<li class="page">';
      $config['num_tag_close'] = '</li>';
      //$config['page_limit']=10;
      //$config['uri_segment'] = 3;
      $config['anchor_class'] = 'follow_link';


      $this->pagination->initialize($config);

      if($this->uri->segment(3) > 0){
          $offset=($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];

      }else{

        $offset=$this->uri->segment(3);
      }
      //$data['records'] = $this->db->get('jdmain',$config['per_page'],$this->uri->segment(3));

      $data['page_link']=$this->pagination->create_links();
      //<------------------------------------------------------------>

      $data['result'] = $this->Jboard_model->mydata($data['table_name'],$data['per_page'],$offset);

      //view load -->application->view->board_list.php
      $this->load->view('board_list' ,$data,array('returnURL'=>$this->input->get('returnURL')));

      $data['side_bar']=$test= $this->Jboard_model->wbest($data['table_name']);

      $data['latest']=$this->Jboard_model->get_latest($data['table_name']);

      //$vote_like=$like_vote=$this->input->post('like');
      $data['popular']=$this->Jboard_model->get_popular($data['table_name']);

      $this->load->view('list_side',$data);

      $this->_footer();

	   }

//individual page
   function get($id){
      $this->_head();

      $this->load->helper('text');

      $data['table_name']=$this->uri->segment(1,0);
// page cpntants view----------------------------------------------------------->
      $data['result'] = $this->db->get('wall');

      $data['page_num'] = $this->uri->segment(3,0);

      $this->Jboard_model->updateview($data['table_name'],$data['page_num']);

      $data['single_result'] = $this->Jboard_model->singledata($data['table_name'],$data['page_num']);


//-------------------------------------------------------------------------------------------------------------------

      $page_index=$this->input->get('page');

      $data['page_index']=$this->input->get('page');

      $data['total']=$this->db->count_all($data['table_name']);
      //how many rows want to show per page
      $data['per_page'] = 10;
      $config['base_url'] = site_url().'/wall/index/';
      $config['total_rows'] = $data['total'];
      $config['per_page'] = $data['per_page'];
      $config['uri_segment']=3;
      $config['num_links'] = 5;
      $config['use_page_numbers']=TRUE;

      $config['full_tag_open'] = '<div><ul class="pagination">';
      $config['full_tag_close'] = '</ul></div><!--pagination-->';

      $config['first_link'] = '&#60;&#60;';
      $config['first_tag_open'] = '<li class="prev page">';
      $config['first_tag_close'] = '</li>';

      $config['last_link'] = '&#62;&#62;';
      $config['last_tag_open'] = '<li class="next page">';
      $config['last_tag_close'] = '</li>';

      $config['next_link'] = '&#62;';
      $config['next_tag_open'] = '<li class="next page">';
      $config['next_tag_close'] = '</li>';

      $config['prev_link'] = '&#60;';
      $config['prev_tag_open'] = '<li class="prev page">';
      $config['prev_tag_close'] = '</li>';

      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';

      $config['num_tag_open'] = '<li class="page">';
      $config['num_tag_close'] = '</li>';
      //$config['page_limit']=10;
      //$config['uri_segment'] = 3;
      $config['anchor_class'] = 'follow_link';

      if($page_index > 0){
          $offset = ($page_index + 0)*$data['per_page']-$data['per_page'];
      }else{
        $offset = $page_index;
      }

      $this->pagination->initialize($config);

      $data['result']=$this->Jboard_model->mydata($data['table_name'],$data['per_page'],$offset);

      //$page = $this->input->get('page');
      $data['pagination'] = $this->pagination->create_links($page_index);



      //echo $pagenation_list  = $this->pagination($id, $table_name);
      //var_dump($data['result']);

//------------------------------------------------------------------------------------------------------------
/*
comment
*/

    //table name call
      $append= '_comment';
      $search_table=$this->uri->segment(1,0);

      $comment_table = $search_table.$append;

//<---------------------------------------------------->
    //all comment view
      $data['comment_result'] = $this->Jboard_model->comment_data($comment_table,$data['page_num']);
    //total comment per page
      $data['total_comment'] = $this->Jboard_model->total_comments($comment_table,$id);
    //current article call
      $data['latest']=$this->Jboard_model->get_latest($data['table_name']);

      //$vote_like=$like_vote=$this->input->post('like');
      $data['popular']=$this->Jboard_model->get_popular($data['table_name']);


      $data['next']=$this->Jboard_model->nextbtn($id,$data['table_name']);

      $data['pre']=$this->Jboard_model->prebtn($id,$data['table_name']);

      $data['last']=$this->Jboard_model->last($data['table_name']);

      $data['total']=$this->db->count_all($data['table_name']);

      //$data['list_bottom']=$this->Jboard_model->list_bottom($data['table_name'],$data['per_page'],$pageoffset);

      //$query = $this->db->get_where('mytable', array('id' => $id),

      //$data['vote']=$this->Jboard_model->update_vote($vote_like);

      //$data['total_like']=$this->Jboard_model->like_update_vote($id);

      //var_dump($data['total_like']);
      $this->load->view('get',$data);
      //var_dump($mimi);
      $this->load->view('main',$data);
      //$data['list_bottom']=$this->Jboard_model->list_bottom();
      //$this->pagination($do);
      $this->load->view('board_list_bottom',$data);

      //right side banner space


      //$this->view->

      //$this->index();
      $this->_footer();

  }

  function pagination($id){


    $data['table_name']='wall';

    $data['page_num'] = $id;

    //$data['idx_page']=$this->input->get('per_page');

    $data['total']=$this->db->count_all($data['table_name']);
    //how many rows want to show per page
    $data['per_page'] = 10;
    $config['base_url'] = base_url().'/wall/index/';
    $config['total_rows'] = $data['total'];
    $config['per_page'] = $data['per_page'];
    $config['uri_segment']=3;
    $config['num_links'] = 5;
    $config['use_page_numbers']=TRUE;
  //$config['page_query_string'] =TRUE;

    //Adding Enclosing Markup
    $config['full_tag_open'] = '<div><ul class="pagination">';
    $config['full_tag_close'] = '</ul></div><!--pagination-->';

    $config['first_link'] = '&#60;&#60;';
    $config['first_tag_open'] = '<li class="prev page">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = '&#62;&#62;';
    $config['last_tag_open'] = '<li class="next page">';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = '&#62;';
    $config['next_tag_open'] = '<li class="next page">';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '&#60;';
    $config['prev_tag_open'] = '<li class="prev page">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    //$config['page_limit']=10;
    //$config['uri_segment'] = 3;
    $config['anchor_class'] = 'follow_link';


    if($data['page_num'] > 0){
        $offset = ($id + 0)*$data['per_page']-$data['per_page'];
    }else{
      $offset = $id;
    }

    $this->pagination->initialize($config);

    $data['result']=$this->Jboard_model->mydata($data['table_name'],$data['per_page'],$offset);

    //$data['page_link']=$this->pagination->create_links();


    $this->load->view('board_list_bottom',$data);
    //echo $pagenation_list  = $this->pagination($id, $table_name);*/
    //var_dump($data['result']);


  }



//method for new article when user write
  function add($table_name){

    $table_name=$this->uri->segment(1);
    //log in need

    //if not log in pass it to login page redirect
    if(!$this->session->userdata('is_login')){

        redirect('/auth/login?returnURL='.rawurlencode(site_url('/jboard/add')));
        }
        $this->_head();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('title','title','required');
        $this->form_validation->set_rules('description','description','required');
          if($this->form_validation->run()==FALSE){
            $this->load->view('add');
            }
          else {

            $user_info=array(
                          'title'=>$this->input->post('title'),
                          'user_id'=>$this->session->userdata('id'),
                          'user_name'=>$this->session->userdata('nickname'),
                          'description'=>$this->input->post('description')
                            );

            $this->load->model('Jboard_model');
            $topic_id = $this->Jboard_model->add($table_name,$user_info);
            $this->load->helper('url');
            redirect($table_name.'/get/'.$topic_id);
          }
            $this->_footer();
        }

      // add comment to individual article
      function insert_comment($page_id){
        $this->load->helper('date');


        //table name call
          $append= '_comment';
          $search_table=$this->uri->segment(1,0);

          $comment_table = $search_table.$append;

        // session verify true for login in user
        /*if(!$this->session->userdata('is_login')){

            redirect('/auth/login?returnURL='.rawurlencode(site_url('/jboard/get/'.$page_id)));
        }*/

        $this->load->library('form_validation');
        //must input comment content
        $this->form_validation->set_rules('comment_article','description','required');
          if($this->form_validation->run()==FALSE){
            echo 'failed';
              //$this->session->set_flashdata('message','Input comment');

            }else{
      //session store user log in information
        $comment_array=array(
            'board_id'=>$page_id,
            'user_id'=>$this->session->userdata('id'),
            'user_name'=>$this->session->userdata('nickname'),
            'article'=>$this->input->post('comment_article'),

        );

        $this->load->model('jboard_model');

        //$id=$this->input->post('id');
        $this->Jboard_model->add_comment($comment_table,$comment_array);
        //total comment count
        $this->Jboard_model->update_comment($search_table,$page_id);

        //$this->load->helper('url');
        //redirect('jboard/get/'.$page_id);

        /*$comment_array =array(
                  'board_id'=>$this->output->set_output($comment_array['board_id']),
                  'user_id'=>$this->output->set_output($comment_array['user_id']),
                  'user_name'=>$this->output->set_output($comment_array['user_name']),
                  'article'=>$this->output->set_output($comment_array['article']),*/

                  $this->output->set_header('Content-Type: application/json; charset=utf-8');
                  $this->output->set_output(json_encode(array('article' =>nl2br($comment_array['article']),
                                     'user_name'=>$comment_array['user_name'],
                                     'created'=>mdate("%Y-%m-%d %H:%i:%s",now()),
                )));

                  //echo $comment_array;

              //echo $comment_array;
              }


      }

      /*function child_comment($parent_id,$curren_page){

        $this->load->library('form_validation');
        //must input comment content
        $this->form_validation->set_rules('reply_article','reply_article','required');
          if($this->form_validation->run()==FALSE){
            echo 'failed';
              //$this->session->set_flashdata('message','Input comment');

            }else{
      //session store user log in information
        $child_comment_array=array(
            //'parent_id'=>$parent_id,
            'board_id'=>$curren_page,
            'user_id'=>$this->session->userdata('id'),
            'user_name'=>$this->session->userdata('nickname'),
            'article'=>$this->input->post('reply_article'),
        );

        $this->load->model('jboard_model');

        $this->Jboard_model->add_child_comment($child_comment_array,$parent_id);



      }
    }*/

    //show modify view with data
    function update(){

        $this->_head();
        $this->load->helper('text');
        //$data['result'] = $this->Jboard_model->mydata();

        $data['table_name'] =$this->uri->segment(1);

        $data['page_num'] = $this->uri->segment(3,0);


        $data['single_result'] = $this->Jboard_model->singledata($data['table_name'],$data['page_num']);

        $this->load->view('modify',$data);

        $data['latest']=$this->Jboard_model->get_latest($data['table_name']);

        $data['popular']=$this->Jboard_model->get_popular($data['table_name']);

        //right side banner space
        $this->load->view('main',$data);

        $this->_footer();
      }


//modify article processing
      function updatepost(){

            $this->_head();

            $board_name =$this->uri->segment(1);

            $id = $this->uri->segment(3,0);

            $data = array(

                'title'=>$this->input->post('title'),
                'description'=>$this->input->post('description')
            );

            $this->Jboard_model->updatedb($board_name,$id,$data);

            $this->load->helper('url');
            redirect($board_name.'/get/'.$id);

            $this->_footer();
      }


      //remove article for indivisual page
        function delete(){

          $this->_head();
          //call page id want to delete
          $data['id'] = $this->uri->segment(3,0);

          $data['table_name'] =$this->uri->segment(1);

          $this->Jboard_model->del_user_id($data['table_name'],$data['id']);

          redirect($data['table_name']);

          $this->_footer();
        }

      function search(){

        $data['keyword'] = $this->input->post('search-box',TRUE);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('p','p','required|min_length[2]|max_length[10]');


        if($this->form_validation->run()==FALSE){

          $this->_head();
          $this->load->view('search_empty_value');
        }else{


        $data['keyword'] = $this->input->post('p',TRUE);
        if($data['keyword']==TRUE){

        $this->load->model('Jboard_model');
        $data['search_result']=$this->Jboard_model->search($data['keyword']);
        $data['search_total']=$this->Jboard_model->search_record_count($data['keyword']);


        $this->_head();

        $this->load->view('search_result',$data);
      }else{
        $this->load->model('Jboard_model');
        $data['search_result']=$this->Jboard_model->search($data['keyword']=='');

        $this->_head();

        $this->load->view('search_result',$data);

        }
      }
    }


    //file upload with editor not hardle ever use
    function upload_receive(){

      $config['upload_path'] = './static/user';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '5000';
      $config['max_width'] = '3000';
      $config['max_height'] = '3000';

      $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload("user_upload_file"))
  		    {
  			$error = array('error' => $this->upload->display_errors());
  			echo $this->upload->display_errors();
  			//$this->load->view('upload_form', $error);
  		  }else{
    			$data = array('upload_data' => $this->upload->data());

    			//$this->load->view('upload_success', $data);
          echo "success";
          var_dump($data);
  		  }
    }

    // file upload with editor ck
    function upload_receive_from_ck(){
        $config['upload_path'] = './static/user/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '4000';
        $config['max_width'] = '4000';
        $config['max_height'] = '4000';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("upload")){
            //$error = array('error' => $this->upload->display_errors());

            echo "<script>alert('upload failed Please try it! ".$this->upload->display_errors("","")."')</script>";
            //$this->load->view('upload_form', $error);
            }else{

            $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');

            $data=$this->upload->data();
            $filename=$data['file_name'];

            $url='/static/user/'.$filename;

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', 'Image upload success!')</script>";
            //$data = array('upload_data' => $this->upload->data());

            //$this->load->view('upload_success', $data);
            }
    }



    //add like for article
    function up_vote($page_id){
      if(!$this->session->userdata('is_login')){
      //$this->session->set_flashdata('login_message','Please log in to continue');
      $status= 'false';

      echo json_encode($status);
    }else{
            $status ="false";
            $updateRecords = 0;

            $upOrDown =  $this->input->post('votetype');

            $user_data=$this->session->userdata('id');

            //table name call

            $table = $this->uri->segment(1);

            $tableAppend ='_vote';

            $table_name = $table.$tableAppend;

            //table name call end----------------------------->

            $user_info=array('user_id'=>$user_data,'board_id'=>$page_id);

            $test=$this->Jboard_model->is_vote($table_name,$user_data,$page_id);

                if($upOrDown =='like' && $test == FALSE){
                    //$updateRecords = $this->Jboard_model->like_update_vote($page_id);

                    $status= -1;

                    echo json_encode($status);
                    exit;
                }else if($upOrDown =='like'){
                    $updateRecords = $this->Jboard_model->like_update_vote($table,$page_id);
                    $this->Jboard_model->exist_vote($table_name,$user_info);


                }else if($upOrDown =='dislike' && $test==FALSE){
                    //$updateRecords = $this->Jboard_model->dis_like_update_vote($page_id);
                    $status= -1;

                    echo json_encode($status);
                    exit;
                }else{
                  $updateRecords = $this->Jboard_model->dis_like_update_vote($table,$page_id);
                  $this->Jboard_model->exist_vote($table_name,$user_info);

                }

                if($updateRecords > 0){

                    $status=1;
                }
                  echo json_encode($status);

        }

}


          function write(){
              $this->_head();

              $data['table_name'] =$this->uri->segment(1);

              $data['latest']=$this->Jboard_model->get_latest($data['table_name']);


              $data['popular']=$this->Jboard_model->get_popular($data['table_name']);


              $this->load->view('add');

              //right side banner space
              $this->load->view('main',$data);

              $this->_footer();
          }

        //global header
          function _head(){
        //var_dump($this->session->all_userdata());
            $this->load->view('top');
            $this->load->view('head');
          }

        //global footer
           function _footer(){
            $this->load->view('footer');
          }

          function signin(){

            $this->load->view('signin');
          }

}
