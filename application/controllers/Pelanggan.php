<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
	
	public $data = array(
		'content' => 'pelanggan/pelanggan_view',
		'lipelanggan' => 'active',
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
		$this->data['data'] = json_decode($this->guzzle_get($this->data['api'],'pelanggan'),true);
		$this->load->view('layout/main', $this->data);
	}
	
	public function tambah()
	{
		$this->data['content'] = 'pelanggan/tambah_pelanggan_view';
		$this->load->view('layout/main', $this->data);
	}

	public function simpan()
	{
		$body = [
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),			
			'alamat' => $this->input->post('alamat'),			
			'nomor_telepon' => $this->input->post('nomor_telepon'),			
			'email' => $this->input->post('email'),
		];

		$response = json_decode($this->guzzle_post($this->data['api'],'pelanggan',$body),true);
		if($response['status']){
			redirect('pelanggan','refresh');
		}
	}

	public function edit($id)
	{
		$this->data['content'] = 'pelanggan/edit_pelanggan_view';
		$this->data['data'] = json_decode($this->guzzle_get($this->data['api'],'pelanggan/'.$id),true);
		$this->load->view('layout/main', $this->data);
	}

	public function update($id)
	{
		$body = [
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),            
			'alamat' => $this->input->post('alamat'),            
			'nomor_telepon' => $this->input->post('nomor_telepon'),            
			'email' => $this->input->post('email'),            
		];
			
		$response = json_decode($this->guzzle_put($this->data['api'],'pelanggan/'.$id,$body),true);
		if($response['status']){
			redirect('pelanggan','refresh');
		}
	}

	public function hapus($id)
	{
		$response = json_decode($this->guzzle_delete($this->data['api'],'pelanggan/'.$id),true);
		 if($response['status']){
			redirect('pelanggan','refresh');
		}
	}

	public function cari()
	{
		$keyword = $this->uri->segment(3);
		$body = [
			'keyword'=> $keyword,
		];
		echo $this->guzzle_post($this->data['api'],'pelanggan/cari',$body);
	}


	// controller harga jual pelanggan
	
	public function harga($id)
	{
		$this->data['content'] = 'pelanggan/harga_pelanggan_view';
		$this->data['data'] = json_decode($this->guzzle_get($this->data['api'],'pelanggan/'.$id),true);
		$this->load->view('layout/main', $this->data);
	}

	public function update_laba()
	{
		$id_master_jual = $this->uri->segment(3);
		$id_pelanggan = $this->input->post('id_pelanggan');

		$body = [
			'laba'					 => $this->input->post('laba'),	
		];

		$response = json_decode($this->guzzle_put($this->data['api'],'jual/'.$id_master_jual,$body),true);
		if($response['status']){
			redirect('pelanggan/harga/'.$id_pelanggan,'refresh');
		}
	}

	public function tambah_harga($id)
	{
		$this->data['content'] = 'pelanggan/tambah_harga_view';
		$this->data['nama'] = json_decode($this->guzzle_get($this->data['api'],'pelanggan/'.$id),true);
		$this->load->view('layout/main', $this->data);
	}

	public function simpan_harga()
	{
		$id_pelanggan = $this->input->post('id_pelanggan');
		$body = [
			'id_pelanggan' => $id_pelanggan,
			'id_barang' => $this->input->post('id_barang'),
			'laba' => $this->input->post('laba'),
    ];
		$response = json_decode($this->guzzle_post($this->data['api'],'jual',$body),true);
		if($response['status']){
			redirect('pelanggan/harga/'.$id_pelanggan,'refresh');
		}
	}

	public function hapus_harga($id_master_jual,$id_pelanggan)
	{
		$response = json_decode($this->guzzle_delete($this->data['api'],'jual/'.$id_master_jual),true);
		 if($response['status']){
			redirect('pelanggan/harga/'.$id_pelanggan,'refresh');
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

	public function guzzle_post($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('POST',$uri,[
			'form_params' => $body,
		]);
		return $response->getBody();
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

	public function guzzle_delete($url,$uri)
	{
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('DELETE',$uri);
			return $response->getBody();
		}catch(GuzzleHttp\Exception\ClientException $e){
			return $e->getResponse()->getBody()->getContents();
		}
	}
}