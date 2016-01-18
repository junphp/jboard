<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Jboard extends CI_Controller {

  function  __construct(){
    parent:: __construct();
    //database autoload
    $this->load->database();
    $this->load->model('Jboard_model');
    }

//main page contents
	function index(){

      $this->_head();
      $this->load->helper('date');
    //call data from model
      $data['total']=$this->db->get('jdmain')->num_rows();

      $data['per_page'] = 5;

      $data['page_num']=$this->uri->segment(3,0);

      $data['result']=$this->Jboard_model->mydata($data['per_page'],$data['page_num']);

    //pagination ------------------------------------------------->
      $this->load->library('pagination');
      //$this->load->library('table');

      $config['base_url'] = base_url().'index.php/jboard/index/';
      $config['total_rows'] =$data['total'];
      $config['per_page'] = $data['per_page'];
      //$config['use_page_numbers']=TRUE;
      //$config['page_limit']=10;
      //$config['uri_segment'] = 3;
      //$config['num_links']=3;

      $this->pagination->initialize($config);

      //$data['records'] = $this->db->get('jdmain',$config['per_page'],$this->uri->segment(3));

      $data['page_link']=$this->pagination->create_links();
    //<------------------------------------------------------------>
      $this->load->view('board_list',$data);
      //$this->load->view('test',$config);
      $this->_footer();

	   }

//board list contents
  public function get(){
      $this->_head();
      $this->load->helper('date');

      $data['result'] = $this->Jboard_model->mydata();

      $data['page_num'] = $this->uri->segment(3,0);

      $this->Jboard_model->updateview($data['page_num']);

      $data['single_result'] = $this->Jboard_model->singledata($data['page_num']);

      $this->load->view('get',$data);
      $this->load->view('main');
      $this->load->view('board_list_bottom',$data);
      $this->_footer();
  }

//method for new article when user write
  function add(){
    //log in need

    //if not log in pass it to login page redirect
    if(!$this->session->userdata('is_login')){
        $this->load->helper('url');
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
            $this->load->model('Jboard_model');
            $topic_id = $this->Jboard_model->add($this->input->post('title'),$this->input->post('description'));
            $this->load->helper('url');
            redirect('jboard/get/'.$topic_id);
          }
            $this->_footer();
        }

    function update(){

      //$data['result'] = $this->Jboard_model->mydata();

      $data['page_num'] = $this->uri->segment(3,0);

      $data['single_result'] = $this->Jboard_model->singledata($data['page_num']);

      $this->_head();

      $this->load->view('modify',$data);
      //}
      $this->_footer();
      }

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

    function delete(){
          $this->load->model('jboard_model');

          //call page id want to delete
          $data['id'] = $this->uri->segment(3,0);

          $data['result']= $this->jboard_model->del_user_id($data['id']);

          $this->_head();
          $this->load->view('dmessage',$data);
          $this->_footer();
        }

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
		}
		else{
			$data = array('upload_data' => $this->upload->data());

			//$this->load->view('upload_success', $data);
      echo "success";
      var_dump($data);
		  }
    }

function upload_receive_from_ck(){
  $config['upload_path'] = './static/user';
  $config['allowed_types'] = 'gif|jpg|png';
  $config['max_size'] = '5000';
  $config['max_width'] = '3000';
  $config['max_height'] = '3000';

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

    function upload_form(){
          $this->_head();
          $this->load->view('upload_form');
          $this->_footer();

    }


//global header
  function _head(){

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
