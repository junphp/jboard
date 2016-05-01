<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pagenotfound extends CI_Controller {

      public function __construct() {
      parent::__construct();
      $this->load->library('user_agent');

      $this->load->helper('url');
    }


    function index(){
      $this->output->set_status_header('404'); // setting header to 404
      //$this->load->view('not_found');//loading view

      if ($this->agent->is_referral())
          {
              echo $this->agent->referrer();
          }
    }
}
?>
