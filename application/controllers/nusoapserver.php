<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nusoapserver extends CI_Controller {

	function __construct()
	{
		parent::__construct();	

		$this->load->library("Nusoap_library");
		$this->load->helper('url');
		$this->nusoap_server = new soap_server(); // SOAP server object

        $nameserver = base_url();
        $this->nusoap_server->configureWSDL("SOAP", $nameserver); // Configure WSDL
		$this->nusoap_server->wsdl->schemaTargetNamespace = $nameserver; // Namespace
	}

	/**
	* Function to get the user information
	*
 	*/
	public function get_user()
	{
		$nameserver = base_url();
		$input_array = array ('auth_key' => "xsd:string",'auth_secret' => "xsd:string",'id' => "xsd:id"); // parameter
		$return_array = array ("user" => "xsd:string");
		$this->nusoap_server->register('get_user_data', $input_array, $return_array, "urn:SOAPServerWSDL", "urn:".$nameserver."/get_users_data", "rpc", "encoded", "Get User Details");
		$this->nusoap_server->service(file_get_contents("php://input")); // reading raw data 
	}

	 /**
	* Function to update the user information
	* 
 	*/
	public function update_user()
	{
		$nameserver = base_url();
		$input_array = array(
							'id' => "xsd:integer",
							'givenname' => "xsd:string",
							'middlename' => "xsd:string",
							'surname' => "xsd:string",
							'email_address' => "xsd:string",
							'birth_date' => "xsd:string",
							'type' => "xsd:string"
							);

		$return_array = array ("user" => "xsd:string");
		$this->nusoap_server->register('update_user_data', $input_array, $return_array, "urn:SOAPServerWSDL", "urn:".$nameserver."/update_user_data", "rpc", "encoded", "Update User Details");
		$this->nusoap_server->service(file_get_contents("php://input")); //reading raw data 
	}

 	/**
	* Function to get the user information
	* @param string $auth_key
	* @param string $auth_secret
	* @param string $id
	* @return array
 	*/
	public function get_users_data($auth_key, $auth_secret, $id)
	{
	 $this->load->model('user_model');
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

	/**
	* Function to update the user information
	* @param string $auth_key
	* @param string $auth_secret
	* @return array
 	*/
	public function update($auth_key, $auth_secret)
	{
	 $data = json_decode(file_get_contents("php://input"), TRUE);
	 log_message('info', 'Update User');
	 log_message('info', 'INPUT : '.json_encode($data));
	 $res =  $this->user_model->update(array('auth_key'=>$auth_key,'auth_secret'=>$auth_secret,'args'=>$data));
	 log_message('info', 'OUTPUT :'.$res);
	 echo $res;
	}
}