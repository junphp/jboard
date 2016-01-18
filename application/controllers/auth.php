<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller {

  function  __construct(){
    parent:: __construct();
      }

      function login(){

        $this->load->view('head');
        $this->load->view('signin',array('returnURL'=>$this->input->get('returnURL')));

      }

      function logout(){
        $this->session->sess_destroy();
        $this->load->helper('url');
        redirect('/jboard');
      }

      function register(){
          $this->_head();

          $this->load->library('form_validation');

          $this->form_validation->set_rules('email','email address','required|valid_email|is_unique[user.email]');
          $this->form_validation->set_rules('nickname','nick name','required|min_length[5]|max_length[20]');
          $this->form_validation->set_rules('password','password','required|min_length[6]|max_length[30]|matches[re_password]');
          $this->form_validation->set_rules('re_password','confirm password','required');

          if($this->form_validation->run()==FALSE){

              $this->load->view('register');

          } else{
              if(!function_exists('password_hash')){
                  $this->load->helper('password');
              }
              $hash=password_hash($this->input->post('password'),PASSWORD_BCRYPT);
              $this->load->model('user_model');
              $this->user_model->add_user(array(
                  'email'=>$this->input->post('email'),
                  'password'=>$hash,
                  'nickname'=>$this->input->post('nickname')
              ));
              $this->session->set_flashdata('message','register success');
              $this->load->helper('url');
              redirect('/auth/login');
          }

      }

      function authentication(){
        $this->load->model('user_model');
        $user = $this->user_model->getByEmail(array('email'=>$this->input->post('email')));
        if(
            $this->input->post('email') == $user->email &&
            password_verify($this->input->post('password'),$user->password)

        ){
            $this->session->set_userdata('is_login',true);
            $this->load->helper('url');
            $returnURL = $this->input->get('returnURL');
            if($returnURL === false){
                $returnURL = '/jboard';
            }
            redirect($returnURL);

        } else{
          $this->session->set_flashdata('message','password incorrect');
          $this->load->helper('url');
          redirect('/auth/login');
        }
      }
      function _head(){

        $this->load->view('head');
      }

    //global footer
      public function _footer(){
        $this->load->view('footer');
      }
}
