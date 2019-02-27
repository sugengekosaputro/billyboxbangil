<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {
  
  public $data = array(
		'content' => 'stok/stok_view',
		'libarang' => 'active',
		'ulbarang' => 'display:block',
		'lidaftarbarang' => 'active',
		'api' => 'http://localhost/billyboxbangilapi/'
  );
  
  public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('username'))){
			redirect(base_url('login'));
		}
  }
  
  public function index()
  {
		$this->data['data'] = json_decode($this->guzzle_get($this->data['api'],'barang'),true);
    $this->load->view('layout/main', $this->data);
  }

  public function updateStok()
  {
    $data = array(
      'stok' => $this->input->post('stok'),
      'id_barang' => $this->input->post('id_barang'),
    );
    
    $response = json_decode($this->guzzle_put($this->data['api'],'barang/stok',$data),true);
		if($response['status']){
			echo json_encode($response);
		}
  }
  
  public function guzzle_get($url,$uri)
	{
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('GET',$uri);
			return $response->getBody();
		}catch(GuzzleHttp\Exception\ClientException $e){
			return null;
		}
  }
  
  public function guzzle_put($url,$uri,$body)
	{
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('PUT',$uri,[
				'form_params' => $body,
			]);
			return $response->getBody()->getContents();
		}catch(GuzzleHttp\Exception\ClientException $e){
			$response = $e->getResponse()->getBody()->getContents();
			return $response;
    }
  }
}