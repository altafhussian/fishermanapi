<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Session_model extends CI_Model
 {
	public function __construct()
	{
     parent::__construct();
	}

	/**
	* Fuction to handle login operation based on the auth_key and auth_secret
	* @param array $obj
	* @return json array with accesstoken
	*/
	public function login($obj)
	{
	 $result = "select id from authentication where auth_secret='".$obj['auth_secret']."' and auth_key='".$obj['auth_key']."'";
	 $result = $this->db->query($result);
	 $result = $result->result_array();
	 if(count($result)>0)
	 {
	  $result = $result[0];
	  $res['status'] = "Success";
	  $result['accesstoken'] = $this->generate_accesstoken();
	  $res['msg'] = $result;
	  $company = $obj['company'];
	  $accesstoken = $result['accesstoken'];
	  $delete = "delete from session where company='$company'";
	  $this->db->query($delete);
	  $session_ins = "INSERT INTO session(company,created_at,expiry_at,access_token) VALUES($company,NOW(),DATE_ADD(NOW(), INTERVAL 1 HOUR),'$accesstoken')";
	  if($this->db->query($session_ins))
	  return json_encode($res);
	  else
	   {
	    $res['status'] = "Failure";
	    $res['msg'] = "Error in Session Creation";
	    return json_encode($res);
	   }
	 }
	 else
	 {
	   $res['status'] = "Failure";
	   $res['msg'] = "Invalid Credentials";
	   return json_encode($res);
	 }
	}

	/**
	* Fuction to generate access token 
	* @return accesstoken
	*/
	public function generate_accesstoken($length=16)
	{
	    global $conn;
	    $characters = "abcdefghijklmnopqrstuvwxyzABCDERFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    $randomString = "";
	    for ($i = 0; $i < $length; $i++) {
	      $randomString .= $characters[mt_rand(0, strlen($characters)-1)];
	    }
	    $qry = "SELECT id FROM session WHERE accesstoken='$randomString'";
	    $res = $this->db->query($qry);
	    $res = $res->result_array();
	    if(count($res) > 0){
		$res = $res[0];
	        $id = $res['id'];
	    }
	    return $randomString;
	}

	/**
	* Fuction to validate the accesstoken
	* @param string $accesstoken
	* @return boolen
	*/
	public function validate_accesstoken($accesstoken)
	{
	    global $conn;
	    $id = "";
	    $qry = "SELECT id FROM session WHERE access_token='$accesstoken' AND (NOW() BETWEEN created_at AND expiry_at)";
	    $res = $this->db->query($qry);
	    $res = $res->result_array();
	    if(count($res)>0)
	    {
	     $res = $res[0];
	     $id = $res['id'];
	    }
	    if(isset($id)&&$id!= ""){
	        return true;
	    } else {
	        return false;
	    }
	}

	/**
	* Fuction to delete the accesstoken
	* @param string $company
	* @param string $accesstoken
	* @return boolen
	*/
	public function delete_accesstoken($company,$accesstoken)
	{
	    global $conn;
	    $s = "DELETE FROM session WHERE company='$company' AND accesstoken='$accesstoken'";
	    if ($this->db->query($s)){
	        return true;
	    }else {
	        return false;
	    }
	}

	/**
	* Fuction to logout the user
	* @param array $obj
	* @return boolen
	*/
	public function logout($obj)
	{
	 if($this->validate_accesstoken($obj['accesstoken']))
	 {
	  if($this->delete_accesstoken($obj['company'],$obj['accesstoken']))
	  {
           $result['status'] = "Success";
           $result['msg'] = "Deleted";
	  }
	  else
	  {
           $result['status'] = "Failure";
           $result['msg'] = "Session not resetted";
	  }
	 }
	 else
	 {
          $result['status'] = "Failure";
          $result['msg'] = "Session Expired";
	 }
	 return json_encode($result);
	}
 }
?>
