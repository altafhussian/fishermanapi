<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller
{
  public function Users()
  {
	parent :: __construct();
	$this->load->model('user_model');
  }

  public function get_user()
  {
	$auth_key = $this->input->server('HTTP_AUTH_KEY');
	$auth_secret = $this->input->server('HTTP_AUTH_SECRET');
	$id=$this->uri->segment(3);
	if($id > 0)
	{
		 log_message('info', 'Get User');
		 log_message('info', 'INPUT - id:'.$id);
		 $res =  $this->user_model->get(array('id'=>$id,'auth_key'=>$auth_key,'auth_secret'=>$auth_secret));
		 log_message('info', 'OUTPUT :'.$res);
		 echo $res;
	}
	else
	{
		 log_message('info', 'Get User');
		 log_message('info', 'INPUT - id: 0');
		 $res =  $this->user_model->get(array('id'=>0,'auth_key'=>$auth_key,'auth_secret'=>$auth_secret));
		 log_message('info', 'OUTPUT :'.$res);
		 echo $res;
	}
  }

  public function update_user()
  {
	$auth_key = $this->input->server('HTTP_AUTH_KEY');
	$auth_secret = $this->input->server('HTTP_AUTH_SECRET');
	$data = json_decode(file_get_contents("php://input"), TRUE);
	log_message('info', 'Update User');
	log_message('info', 'INPUT : '.json_encode($data));
	$res =  $this->user_model->update(array('auth_key'=>$auth_key,'auth_secret'=>$auth_secret,'args'=>$data));
	log_message('info', 'OUTPUT :'.$res);
	echo $res;
  }
}
?>
