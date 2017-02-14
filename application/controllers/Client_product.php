<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client_product extends CI_Controller
{
	public function index()
	{
		error_reporting(E_ALL & ~E_NOTICE);
		$this->load->view('client_product');
	}

	public function insert()
	{
		$data = array(
		'company' => $this->input->post('company'),
		'product_key' => $this->input->post('product_key'),
		'brand_name' => $this->input->post('brand_name'),
		'color' => $this->input->post('color'),
		'barcode' => $this->input->post('barcode')
        );

		$data = json_encode($data);
		// Create a stream
		$opts = array(
		  'http'=>array(
		    'method'=>"POST",
		    'header'=>"Connection: close\r\n".
                      "Content-type: application/xwww-form-urlencoded\r\n".
                      "Content-Length: ".strlen($data)."\r\n".
                      "User-Agent:MyAgent/1.0\r\n".
		    	      "auth-key: test\r\n" .
		              "auth-secret: test\r\n",
		   'content'=> $data
		  )
		);

		$context = stream_context_create($opts);

		// Open the file using the HTTP headers set above
		$file = file_get_contents('http://localhost/api/rest/insert_product', false, $context);

		print_r(json_decode($file));
		}
}