<?php
 class Product_model extends CI_Model
 {

 	/**
	* Function to insert the product information
	* @param array $obj
	* @return array $res
 	*/
	public function insert($obj)
	{
	 $this->load->model('session_model');
	 $company = $this->session_model->validate_credentials($obj['auth_key'],$obj['auth_secret']);
	 if($company != "")
	 {
	  $product_key = (int)$obj['args']['product_key'];
	  $brand_name = $obj['args']['brand_name'];
	  $color = $obj['args']['color'];
	  $barcode = json_encode($obj['args']['barcode']);

	  $qry = "INSERT INTO products(product_key,brandname,color,barcode,company) VALUES ($product_key , '$brand_name', '$color', $barcode, $company)";
	  
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
		$res['msg'] = "Invalid Credentials";
	 }
	 return json_encode($res);
	}
 }
?>
