<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller
{
  public function products()
  {
	parent :: __construct();
	$this->load->model('product_model');
  }

  public function insert_product()
  {
	$auth_key = $this->input->server('HTTP_AUTH_KEY');
	$auth_secret = $this->input->server('HTTP_AUTH_SECRET');
	$data = json_decode(file_get_contents("php://input"), TRUE);
	log_message('info', 'Insert Product');
	log_message('info', 'INPUT : '.json_encode($data));
	$res =  $this->product_model->insert(array('auth_key'=>$auth_key,'auth_secret'=>$auth_secret,'args'=>$data));
	log_message('info', 'OUTPUT :'.$res);
	echo $res;
  }
}
?>
