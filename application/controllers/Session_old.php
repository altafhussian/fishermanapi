<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Session extends CI_Controller
{
  public function Session()
  {
	parent :: __construct();
    	$this->load->model('session_model');
  }

  public function login()
  {
    $auth_key=$this->input->post('auth_key');
    $auth_secret=$this->input->post('auth_secret');
    echo $this->session_model->login(array('auth_key'=>$auth_key,'auth_secret'=>$auth_secret));
  }

  public function logout()
  {
    $accesstoken=$this->input->post('accesstoken');
    $id=$this->uri->segment(3);
    echo $this->session_model->logout(array('id'=>$id,'accesstoken'=>$accesstoken));
  }
}
?>
