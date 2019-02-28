<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public $data = array(
		'content' => 'barang/barang_view',
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
	
	public function tambah()
	{
		$this->data['content'] = 'barang/tambah_barang_view';
		$this->data['kategori'] = json_decode($this->guzzle_get($this->data['api'],'kategori'));
		$this->load->view('layout/main', $this->data);
	}

	public function simpan()
	{
		if(empty($_FILES['foto_barang']['name'])){
			echo 'harus upload bro';
		}else{
			$body = [
				[
					'name' => 'id_barang',
					'contents' => $this->input->post('id_barang'),
				],
				[
					'name' => 'id_kategori',
					'contents' => $this->input->post('jenis_barang'),
				],
				[
					'name' => 'nama_barang',
					'contents' => $this->input->post('nama_barang'),
				],
				[
					'name' => 'ukuran',
					'contents' => $this->input->post('ukuran'),
				],
				[
					'name' => 'gramatur',
					'contents' => $this->input->post('gramatur'),
				],
				[
					'name' => 'foto_barang',
					'contents' => fopen($_FILES['foto_barang']['tmp_name'], 'r'),
					'filename' => $_FILES['foto_barang']['name'],
					'headers' => [
						'content-type' => 'image/jpeg'
					]
				],
				[
					'name' => 'harga_beli',
					'contents' => $this->input->post('harga_beli'),
				],
				[
					'name' => 'harga_jual',
					'contents' => $this->input->post('harga_jual'),
				],
			
			];
			$response = json_decode($this->guzzle_post($this->data['api'],'barang',$body));
			if($response->status){
				redirect('barang','refresh');
			}
		}
	}

	public function edit($id)
	{
		$this->data['content'] = 'barang/edit_barang_view';
		$this->data['data'] = json_decode($this->guzzle_get($this->data['api'],'barang/'.$id),true);
		$this->load->view('layout/main', $this->data);
	}

	public function update()
	{
		if(empty($_FILES['foto_barang']['name'])){
			$body = [
				[
					'name' => 'id_barang',
					'contents' => $this->input->post('id_barang'),
				],
				[
					'name' => 'nama_barang',
					'contents' => $this->input->post('nama_barang'),
				],
				[
					'name' => 'ukuran',
					'contents' => $this->input->post('ukuran'),
				],
				[
					'name' => 'gramatur',
					'contents' => $this->input->post('gramatur'),
				],
				[
					'name' => 'foto_barang',
					'contents' => $this->input->post('foto_lama'),
				],
				[
					'name' => 'harga_beli',
					'contents' => $this->input->post('harga_beli'),
				],
				[
					'name' => 'harga_jual',
					'contents' => $this->input->post('harga_jual'),
				],
			];

			$response = json_decode($this->guzzle_put($this->data['api'],'barang/update',$body),true);
			if($response['status']){
				redirect('barang','refresh');
			}
			//var_dump($response);
		}else{
			$body = [
				[
					'name' => 'id_barang',
					'contents' => $this->input->post('id_barang'),
				],
				[
					'name' => 'nama_barang',
					'contents' => $this->input->post('nama_barang'),
				],
				[
					'name' => 'ukuran',
					'contents' => $this->input->post('ukuran'),
				],
				[
					'name' => 'gramatur',
					'contents' => $this->input->post('gramatur'),
				],
				[
					'name' => 'foto_barang',
					'contents' => fopen($_FILES['foto_barang']['tmp_name'], 'r'),
					'filename' => $_FILES['foto_barang']['name'],
					'headers' => [
						'content-type' => 'image/jpeg'
					]
				],
				[
					'name' => 'harga_beli',
					'contents' => $this->input->post('harga_beli'),
				],
				[
					'name' => 'harga_jual',
					'contents' => $this->input->post('harga_jual'),
				],
			];
			
			$response = json_decode($this->guzzle_put($this->data['api'],'barang/update',$body),true);
			//var_dump($response);
			if($response['status']){
				redirect('barang','refresh');
			}
		}
	}

	public function hapus($id)
	{
		$body = [
			'id_barang' => $id,
		];
		$response = json_decode($this->guzzle_delete($this->data['api'],'barang/'.$id),true);
		 if($response['status']){
			redirect('barang','refresh');
		}
	}

	public function cari()
	{
		$keyword = urldecode($this->uri->segment(3));
		$body = [
			[
				'name' => 'keyword',
				'contents' => $keyword,
			]
		];
		echo $this->guzzle_post($this->data['api'],'barang/cari',$body);
	}

	public function cariby()
	{
		$keyword = urldecode($this->uri->segment(3));
		$id_pelanggan = urldecode($this->input->get('id_pelanggan'));
		if(!empty($id_pelanggan)){
			$body = [
				[
					'name' => 'id_pelanggan',
					'contents' => $id_pelanggan,
				],
				[
					'name' => 'keyword',
					'contents' => $keyword,
				]
			];
				echo $this->guzzle_post($this->data['api'],'barang/cariby',$body);
//			echo json_encode($body);
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
			return $responseBodyAsString = $response->getBody()->getContents();
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