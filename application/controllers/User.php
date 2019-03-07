<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public $data = array(
		'content' => 'user/index_view',
		'liuser' => 'active',
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
		$this->data['data'] = json_decode($this->guzzle_get($this->data['api'],'user'),true);
		$this->load->view('layout/main', $this->data);
		// echo var_dump($this->data);
	}
	
	public function tambah()
	{
		$this->data['content'] = 'user/form_view';
		$this->load->view('layout/main', $this->data);
	}

	public function edit($id)
	{
		$this->data['content'] = 'user/form_update_view';
		$this->data['data'] = json_decode($this->guzzle_get($this->data['api'],'user/'.$id),true);
		$this->load->view('layout/main', $this->data);
		// var_dump($this->data);
	}

	public function simpan()
	{
		if(empty($_FILES['foto_user']['name'])){
			echo 'harus upload bro';
		}else{
			$body = [
				[
					'name' => 'username',
					'contents' => $this->input->post('username'),
				],
				[
					'name' => 'password',
					'contents' => md5($this->input->post('password')),
				],
				[
					'name' => 'email',
					'contents' => $this->input->post('email'),
				],
				[
					'name' => 'foto_user',
					'contents' => fopen($_FILES['foto_user']['tmp_name'], 'r'),
					'filename' => $_FILES['foto_user']['name'],
					'headers' => [
						'content-type' => 'image/jpeg'
					]
				],
				[
					'name' => 'role',
					'contents' => $this->input->post('role'),
				],
			];
			$response = json_decode($this->guzzle_post($this->data['api'],'user',$body));
			if($response->status){
				redirect('user','refresh');
			}
		}
	}

	public function update()
	{
		if(empty($_FILES['foto']['name'])){
			$body = [
				[
					'name' => 'id_user',
					'contents' => $this->input->post('id_user'),
				],
				[
					'name' => 'username',
					'contents' => $this->input->post('username'),
				],
				[
					'name' => 'password',
					'contents' => $this->input->post('password'),
				],
				[
					'name' => 'email',
					'contents' => $this->input->post('email'),
				],
				[
					'name' => 'foto',
					'contents' => $this->input->post('foto_path'),
				],
				[
					'name' => 'role',
					'contents' => $this->input->post('role'),
				],
			];
			$response = json_decode($this->guzzle_put($this->data['api'],'user/update',$body));
			if($response->status){
				redirect('user','refresh');
			}
		}else{
			$body2 = [
				[
					'name' => 'id_user',
					'contents' => $this->input->post('id_user'),
				],
				[
					'name' => 'username',
					'contents' => $this->input->post('username'),
				],
				[
					'name' => 'password',
					'contents' => $this->input->post('password'),
				],
				[
					'name' => 'nama',
					'contents' => $this->input->post('nama'),
				],
				[
					'name' => 'foto',
					'contents' => fopen($_FILES['foto']['tmp_name'], 'r'),
					'filename' => $_FILES['foto']['name'],
					'headers' => [
						'content-type' => 'image/jpeg'
					]
				],
				[
					'name' => 'role',
					'contents' => $this->input->post('role'),
				],
			];
			$response = json_decode($this->guzzle_put($this->data['api'],'user/update',$body2));
			if($response->status == TRUE){
				redirect('user','refresh');
			}
		}
	}

	public function hapus($id_user)
	{
		$body = [
			'id_user' => $id_user,
		];
		$response = json_decode($this->guzzle_delete($this->data['api'],'user/'.$id_user),true);
		if($response['status']){
			redirect('user','refresh');
		}
	}

	public function guzzle_get($url,$uri)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('GET',$uri);
		return $response->getBody();
	}

	public function guzzle_post($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('POST',$uri,[
			'multipart' => $body,
		]);
		return $response->getBody();
	}

	public function guzzle_put($url,$uri,$body)
	{
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('POST',$uri,[
				'multipart' => $body,
			]);
			return $response->getBody()->getContents();
		}catch(GuzzleHttp\Exception\ClientException $e){
			$response = $e->getResponse();
			$responseBodyAsString = $response->getBody()->getContents();
			redirect('user','refresh');
		}
	}

	public function guzzle_delete($url,$uri)
	{
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('DELETE',$uri);
			return $response->getBody()->getContents();
		}catch(GuzzleHttp\Exception\ClientException $e){
			return $e->getResponse()->getBody()->getContents();
		}
	}
}