<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Session_model extends CI_Model
 {
	public function __construct()
	{
     parent::__construct();
	}

	/**
	* Fuction to validate the auth credentials
	* @param string $auth_key
	* @param string $auth_secret
	* @return string company 
	*/
	public function validate_credentials($auth_key, $auth_secret)
	{
	    global $conn;
	    $id = "";
	    $qry = "SELECT id, company FROM authentication WHERE auth_key='$auth_key' and auth_secret='$auth_secret'";
	    $res = $this->db->query($qry);
	    $res = $res->result_array();
	    if(count($res)>0)
	    {
	     $res = $res[0];
	     $id = $res['id'];
	    }
	    if(isset($id)&&$id!= ""){
	        return $res['company'];
	    } else {
	        return "";
	    }
	}
 }
?>
