  <?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Jboard extends CI_Controller {

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

    $this->load->library('form_validation');

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
      $data['per_page'] = 19;


      //$data['page_num']=$this->uri->segment(3,0);


      //pagination ------------------------------------------------->

      $config['base_url'] = site_url().'/jboard/index';
      $config['total_rows'] = $data['total'];
      $config['per_page'] = $data['per_page'];
      $config['uri_segment']=3;
      $config['num_links'] = 2;
      $config['use_page_numbers']=TRUE;
      //$config['page_query_string'] =TRUE;

      //Adding Enclosing Markup
      $config['full_tag_open'] = '<div><ul class="pagination">';
      $config['full_tag_close'] = '</ul></div><!--pagination-->';

      $config['first_link'] = '&laquo; First';
      $config['first_tag_open'] = '<li class="prev page">';
      $config['first_tag_close'] = '</li>';

      $config['last_link'] = 'Last &raquo;';
      $config['last_tag_open'] = '<li class="next page">';
      $config['last_tag_close'] = '</li>';

      $config['next_link'] = 'Nex &rsaquo;';
      $config['next_tag_open'] = '<li class="next page">';
      $config['next_tag_close'] = '</li>';

      $config['prev_link'] = '&lsaquo; Pre';
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

      $this->_footer();

	   }

//individual page
  public function get($id){
      $this->_head();

      $this->load->helper('text');

      $table_name=$this->uri->segment(1,0);
// page cpntants view----------------------------------------------------------->
      $data['result'] = $this->db->get('jdmain');

      $data['page_num'] = $this->uri->segment(3,0);

      $this->Jboard_model->updateview($data['page_num']);

      $data['single_result'] = $this->Jboard_model->singledata($table_name,$data['page_num']);
/*
comment
*/
    //all comment view
      $data['comment_result'] = $this->Jboard_model->comment_data($data['page_num']);
    //total comment per page
      $data['total_comment'] = $this->Jboard_model->total_comments($id);
    //current article call
      $data['latest']=$this->Jboard_model->get_latest();

      //$vote_like=$like_vote=$this->input->post('like');
      $data['popular']=$this->Jboard_model->get_popular();


      //$query = $this->db->get_where('mytable', array('id' => $id),

      //$data['vote']=$this->Jboard_model->update_vote($vote_like);

      //$data['total_like']=$this->Jboard_model->like_update_vote($id);

      //var_dump($data['total_like']);
      $this->load->view('get',$data);
      //right side banner space
      $this->load->view('main',$data);

      //$this->view->

      //$this->index();
      $this->_footer();


  }


//method for new article when user write
  function add($table_name){
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
            //redirect('jboard/get/'.$topic_id);
            redirect($table_name.'/get/'.$topic_id);
          }
            $this->_footer();
        }

      // add comment to individual article
      function insert_comment($page_id){
        $this->load->helper('date');


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
        $this->Jboard_model->add_comment($comment_array);
        //total comment count
        $this->Jboard_model->update_comment($page_id);

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

    //midify article in indivisual page
    function update(){

        $this->load->helper('text');
        //$data['result'] = $this->Jboard_model->mydata();

        $data['page_num'] = $this->uri->segment(3,0);

        $data['single_result'] = $this->Jboard_model->singledata($data['page_num']);

        $this->_head();

        $this->load->view('modify',$data);

        $data['latest']=$this->Jboard_model->get_latest();

        //right side banner space
        $this->load->view('main',$data);

        $this->_footer();
      }


//modify article processing
      function updatepost(){

            $this->_head();

            $this->load->model('Jboard_model');

            $id = $this->input->post('id');

            $data=array(
                'title'=>$this->input->post('title'),
                'description'=>$this->input->post('description')
            );

            $this->Jboard_model->updatedb($id,$data);

            $this->load->helper('url');
            redirect('jboard/get/'.$id);

            $this->_footer();
      }


      //remove article for indivisual page
        function delete(){
          $this->load->model('jboard_model');

          //call page id want to delete
          $data['id'] = $this->uri->segment(3,0);

          $data['result']= $this->jboard_model->del_user_id($data['id']);

          $this->_head();
          $this->load->view('dmessage',$data);
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

//<-------------------file upload config ---------------------------------->
        $config['upload_path'] = './static/user';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $config['remove_spaces'] = TRUE;
//<---------------------end file upload config----------------------------->

        $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("upload")){
            //$error = array('error' => $this->upload->display_errors());

            echo "<script>alert('upload failed Please try it! ".$this->upload->display_errors("","")."')</script>";
            //$this->load->view('upload_form', $error);
            }else{

            $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');

            $data=$this->upload->data();
            $filename=$data['file_name'];
            $test=$this->_create_thumbnail($filename);


            $url='/static/user/'.$filename;

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', 'Image upload success!')</script>";

//var_dump($test);
            //$data = array('upload_data' => $this->upload->data());


            //$this->load->view('upload_success', $data);
            }

    }



    function _create_thumbnail($filename){
      $this->load->library('image_lib');

      $config['image_library']    = "gd2";

      $config['source_image'] = "./static/user/".$filename;

      $config['new_image'] = "./static/thumb";

      $config['create_thumb'] = TRUE;

      $config['maintain_ratio'] = TRUE;

      $config['width'] = "80";

      $config['height'] = "80";
      $this->image_lib->initialize($config);
      $this->load->library('image_lib',$config);
      if ( ! $this->image_lib->resize())
              {
                  echo $this->image_lib->display_errors('<p>','</p>');
                }else{
                  //$src = $config['new_image'];
                  //$data['new_image'] = substr($src,2);
                  //$data['img_src'] = base_url().$data['new_image'];

                  $data=$this->image_lib->resize();

                  return $data;
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

            $user_info=array('user_id'=>$user_data,'board_id'=>$page_id);

            $test=$this->Jboard_model->is_vote($user_data,$page_id);

                if($upOrDown =='like' && $test==FALSE){
                    //$updateRecords = $this->Jboard_model->like_update_vote($page_id);

                    $status= -1;

                    echo json_encode($status);
                    exit;
                }else if($upOrDown =='like'){
                    $updateRecords = $this->Jboard_model->dis_like_update_vote($page_id);
                    $this->Jboard_model->exist_vote($user_info);


                }else if($upOrDown =='dislike' && $test==FALSE){
                    //$updateRecords = $this->Jboard_model->dis_like_update_vote($page_id);
                    $status= -1;

                    echo json_encode($status);
                    exit;
                }else{
                  $updateRecords = $this->Jboard_model->dis_like_update_vote($page_id);
                  $this->Jboard_model->exist_vote($user_info);

                }

                if($updateRecords > 0){

                    $status=1;
                }
                  echo json_encode($status);

        }

}
    /*function vote(){

        $voteId = $this->input->post('voteId');
        $upordown = $this->input0>post('upordown');

        $status = 'FALSE';
        $updaterecords = 0;

        if($upordown=='upvote'){

            $updaterecords = $this->Jboard_model->updateupvote($voteId);
        }else{

            $updaterecords = $this->Jboard_model->updatedownvote($voteId);
        }

        if($updaterecords > 0){
            $status ="true";
        }

    }*/

          function write(){
              $this->_head();

              $data['latest']=$this->Jboard_model->get_latest();


              $data['popular']=$this->Jboard_model->get_popular();


              $this->load->view('add');

              //right side banner space
              $this->load->view('main',$data);

              $this->_footer();
          }


          function send_mail(){

            $this->load->library('email');

            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('subject', 'subject', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('message', 'message', 'trim|required|min_length[2]');
            if ($this->form_validation->run() == FALSE) {
              $result = 0;
              echo json_encode(array(
                'result'=>$result,
                'name'=> form_error('name'),
                'email'=> form_error('email'),
                'subject'=> form_error('subject'),
                'message'=> form_error('message'),
              ));
            } else {

              //get the form data
              $name = $this->input->post('name');
              $from_email = $this->input->post('email');
              $subject = $this->input->post('subject');
              $message = $this->input->post('message');

              //set to_email id to which you want to receive mails
              $to_email = 'gom3572@gmail.com';


              //configure email settings
              $config['protocol'] = 'smtp';
              $config['smtp_host'] = 'ssl://smtp.gmail.com';
              $config['smtp_port'] = '465';
              $config['smtp_user'] = 'gom3572@gmail.com'; // email id
              $config['smtp_pass'] = 'sungho0980'; // email password
              $config['mailtype'] = 'html';
              $config['wordwrap'] = TRUE;
              $config['charset'] = 'iso-8859-1';
              $config['newline'] = "\r\n"; //use double quotes here
              $this->email->initialize($config);
              $this->load->library('email',$config);

              //send mail
              $this->email->from($from_email, $name);
              $this->email->to($to_email);
              $this->email->subject($subject);
              $this->email->message($message);
              if ($this->email->send())
              {

                  // mail sent\
                  $result = 1;
                  echo json_encode($result);
                  //$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
                  //redirect('contactform/index');
              }
              else
              {
                  //error
                  $result = 2;
                  echo json_encode($result);
                  echo 'error';
                  //$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
                  //redirect('contactform/index');
              }
          }
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
