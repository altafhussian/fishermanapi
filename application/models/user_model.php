<?php
 class User_model extends CI_Model
 {

 	/**
	* Function to get the user information
	* @param array $obj
	* @return json array
 	*/
	public function get($obj)
	{
	 $this->load->model('session_model');
	 $company = $this->session_model->validate_credentials($obj['auth_key'],$obj['auth_secret']);
	 if($company != "")
	 {
	 	if($obj['id'] > 0) 
	 	{
	 		$id = $obj['id'];
	 		$sql = "SELECT * FROM user WHERE id = '$id' AND company = '$company'";
	 	}
	 	else
	 	{
	 		$sql = "SELECT * FROM user WHERE company = '$company'";
		}
	 	
	 	$query = $this->db->query($sql);
		$result = $query->result_array();
		if(count($result) > 0)
		{
			$res['msg'] = $result;
			$res['status'] = "Success";
		}
		else
		{
			$res['msg'] = "No user found";
			$res['status'] = "Failure";
		}
	 }
	 else
	 {
		$res['status'] = "Failure";
		$res['msg'] = "Invalid Credentials";
	 }
	 return json_encode($res);
	}

 	/**
	* Function to udpate the user information
	* @param array $obj
	* @return array $res
 	*/
	public function update($obj)
	{
	 $this->load->model('session_model');
	 $company = $this->session_model->validate_credentials($obj['auth_key'],$obj['auth_secret']);
	 if($company != "")
	 {
	  $givenname = $obj['args']['givenname'];
	  $surname = $obj['args']['surname'];
	  $middlename = $obj['args']['middlename'];
	  $email = $obj['args']['email'];
	  $birthdate = $obj['args']['birthdate'];
	  $id = $obj['args']['id'];

	  $qry = "UPDATE user SET  givenname= '$givenname', surname = '$surname', middlename = '$middlename', email = '$email', birthdate = '$birthdate' WHERE id = $id AND company = '$company'";

	  $user_qry = "SELECT id FROM user WHERE id = '$id' AND company = '$company'";
	  $query = $this->db->query($user_qry);
	  $result = $query->result_array();

		  if(count($result) > 0) // Checking current user is in current company
		  {
			  if($this->db->query($qry))
			  {
		        	$res['status'] = "Success";
		        	return json_encode($res);
			  }else {
		        	$res['status'] = "Failure";
		        	$res['error'] = 'Please check inputs';
		        	return json_encode($res);
			  }
		 }
		 else
		 {
		 	$res['status'] = "Failure";
			$res['msg'] = "User not found";
		 }
	 }
	 else
	 {
		$res['status'] = "Failure";
		$res['msg'] = "Invalid Credentials";
	 }
	 return json_encode($res);
	}
 }
?>
