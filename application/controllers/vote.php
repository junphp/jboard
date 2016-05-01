<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Vote extends CI_Controller {

  function  __construct(){
    parent:: __construct();
    //database autoload
    $this->load->database();
    //autoload global model
    $this->load->model('Jboard_model');
    //autoload pagination library
    $this->load->library('pagination');



    }


    function up_vote($page_id){

        if(!$this->session->userdata('is_login')){
            $this->session->set_flashdata('login_message','Please log in to continue');
            redirect('/auth/login?returnURL='.rawurlencode(site_url('/jboard/get/'.$page_id)));
        }


          $this->input->post('like');

          $this->Jboard_model->like_update_vote($page_id);

          $this->load->helper('url');
          redirect('jboard/get/'.$page_id);
    }

    function down_vote($page_id){

        if(!$this->session->userdata('is_login')){
            redirect('/auth/login?returnURL='.rawurlencode(site_url('/jboard/get/'.$page_id)));
        }


          $this->input->post('unlike');

          $this->Jboard_model->dis_like_update_vote($page_id);

          $this->load->helper('url');
          redirect('jboard/get/'.$page_id);
    }

    function test(){
      header("Content-Type:application/json");
      $data=$this->Jboard_model->test_data();

      var_dump($data);
    }














}
