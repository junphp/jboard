<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//session_start(); //we need to start session in order to access it through CI

class Auth extends CI_Controller {

  function  __construct(){
    parent:: __construct();

    $this->load->database();
    $this->load->model('user_model');
    $this->load->library('form_validation');
    $this->load->helper('text');
      }

      function login(){

        $this->_head();
        $this->load->view('signin',array('returnURL'=>$this->input->get('returnURL')));
        $this->_footer();
      }

      function relogin(){

        $this->load->view('top');
        $this->load->view('login',array('returnURL'=>$this->input->get('returnURL')));

      }

      function resister_view(){
        $this->load->view('top');
        $this->load->view('register',array('returnURL'=>$this->input->get('returnURL')));

      }

      function logout(){

        $this->session->sess_destroy();

        $this->load->helper('url');
        redirect('/');
      }

      function emailcheck($option){

        $this ->db-> where('email',$option);
        $found = $this->db->get('user')->num_rows(); // this returns the number of rows having the same address.

             if ($found!=0)
             {
                 $this->form_validation->set_message('emailcheck','Email Address is already in use');
                 return false;  // more than 0 rows found. the callback fails.
             }
             else
             {
                 return true;   // 0 rows found. callback is ok.
             }


        }




      function register(){

          //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

          $this->form_validation->set_rules('email','email','callback_emailcheck');
          $this->form_validation->set_rules('nickname','username','trim|required|min_length[2]|max_length[15]');
          $this->form_validation->set_rules('password','password','trim|required|min_length[6]|max_length[20]|matches[re_password]');
          $this->form_validation->set_rules('re_password','re_password','trim|required');
          $this->form_validation->set_message('getByEmail','The email address already exist. Please try again');


          if($this->form_validation->run() == FALSE){
              //$this->form_validation->set_message('nickname','must be ');
              //$this->form_validation->set_message('email', 'Error Message');
              //$this->form_validation->set_message('rule', 'Error Message');
              //$this->form_validation->set_message('getByEmail','The email address already exist. Please try again');
              $result = 0;
              echo json_encode(array(
                'result'=>$result,
                'username'=> form_error('nickname'),
                'email'=> form_error('email'),
                'password'=> form_error('password'),
                're_password'=> form_error('re_password'),
              ));
              //$this->load->view('register');

          } else{
              if(!function_exists('password_hash')){
                  $this->load->helper('password');
              }
              $hash=password_hash($this->input->post('password'),PASSWORD_BCRYPT);
              $this->load->model('user_model');
              $this->user_model->add_user(array(
                  'nickname'=>$this->input->post('nickname'),
                  'email'=>$this->input->post('email'),
                  'password'=>$hash
              ));
              $this->load->helper('url');
              $returnURL=$this->input->get('returnURL');
              $result = 1;
              echo json_encode(array('result'=>$result, 'redirect'=>$returnURL));
              //$this->session->set_flashdata('message','register success');
              //$this->load->helper('url');
              //redirect('/auth/login');

          }

      }
      //check for user login process
      function authentication(){

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password','password','required');

        $user=$this->user_model->getByEmail(array('email'=>$this->input->post('email')));
            if(!function_exists('password_hash')){
                $this->load->helper('password');
              }

            if($user == false){

              $result = 0;

              echo json_encode($result);

              /*$this->session->set_flashdata('message', 'login failed');

              $this->load->helper('url');

              redirect('/auth/relogin');*/
            }
            elseif($this->input->post('email')==$user->email && password_verify($this->input->post('password'),$user->password)){

            $sessiondata = array(
                'id'=>$user->id,
                'nickname'=>$user->nickname,
                'email'=>$user->email,
                'is_login'=>TRUE
                );
                $this->session->set_userdata($sessiondata);
                $this->load->helper('url');

                $returnURL=$this->input->get('returnURL');
                  /*if($returnURL == FALSE){
                      $returnURL='/';
                  }
                  redirect($returnURL);*/

                //echo json_encode($returnURL);
                $result = 1;
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('result'=>$result,'redirect' => $returnURL),JSON_UNESCAPED_SLASHES));

        }else{

          $result = 0;

          echo json_encode($result);

          /*$this->session->set_flashdata('message', 'login failed');

          $this->load->helper('url');

          redirect('/auth/relogin');*/

        }

      }

      function user_check(){

        $user = $this->input->post('email');
        $result = $this->user_model->check_user_exist($user);

        if($result){
          $this->form_validation->set_message('user_check','there is exist email already');
          return true;
        }else{
          return false;
        }
      }

      function username_check(){

        $user=$this->input->post('nickname');
        $result=$this->user_model->check_username_exist($user);

        if($result){
          echo json_encode(false);
        }else{
          echo json_encode(true);
        }
      }


      function _head(){
        $this->load->view('top');
        $this->load->view('head');
      }

    //global footer
      public function _footer(){
        $this->load->view('footer');
      }
}
