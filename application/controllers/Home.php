<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $data = array(
		'content' => 'home/home_view',
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
		$this->data['data'] = json_decode($this->guzzle_get($this->data['api'],'pemesanan'),true);
		$this->load->view('layout/main', $this->data);
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
    
}