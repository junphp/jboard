<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Main extends CI_Controller {

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



    $data['wall']=$this->Jboard_model->main1_data();

    $data['picture']=$this->Jboard_model->main2_data();

    $data['info']=$this->Jboard_model->main3_data();

    $this->load->view('home',$data);

    //var_dump($data['wall']);

    $this->_footer();

   }

   //global header
     function _head(){
       $this->load->view('top');
       $this->load->view('head');
     }

   //global footer
      function _footer(){
       $this->load->view('footer');
     }


}
