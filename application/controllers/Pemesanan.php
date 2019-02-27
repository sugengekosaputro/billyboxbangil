<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

	public $data = array(
		'content' => 'pemesanan/pemesanan_view',
		'lipemesanan' => 'active',
		'ulpemesanan' => 'display:block',
		'lidaftarpesanan' => 'active',
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

	public function detail()
	{
		$id_order = $this->uri->segment(3);
		$data = json_decode($this->guzzle_get($this->data['api'],'pemesanan/'.$id_order),true);
		$this->data['pelanggan'] = $data['pelanggan'];
		$this->data['order'] = $data['order'];
		$this->data['pembayaran'] = $data['pembayaran'];
		$this->data['surat_jalan'] = $data['surat_jalan'];

		$this->data['content'] = 'pemesanan/detail_view';
		$this->load->view('layout/main', $this->data);
	}

	public function surat_jalan()
	{
		$id_order = $this->uri->segment(3);
		$data = json_decode($this->guzzle_get($this->data['api'],'pemesanan/'.$id_order),true);
		$this->data['order_list'] = $data['order']['detail_order'];
		$this->data['content'] = 'pemesanan/surat_jalan_view';
		$this->load->view('layout/main', $this->data);
	}
	
	public function tambah()
	{
		$this->data['content'] = 'pemesanan/tambah_pemesanan';
		$this->load->view('layout/main', $this->data);
	}

	public function simpan()
	{
		$data = $this->input->post('obj');

		$response = json_decode($this->guzzle_post($this->data['api'],'pemesanan',$data),true);
		if($response['status']){
			echo json_encode($response);
		}
//		$this->notifEmailPemesanan($response['id_order']);
	}

	public function edit($id)
	{
		$this->data['content'] = 'barang/edit_barang_view';
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','barang/'.$id));
		$this->load->view('layout/main', $this->data);
	}

	public function update_status_order($id_order)
	{
		$status_order = $this->input->post('status_order');
		$body = [
			'status_order' => $status_order,	
		];

		$response = json_decode($this->guzzle_put($this->data['api'],'pemesanan/statusorder/'.$id_order,$body),true);
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

	public function guzzle_delete($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('DELETE',$uri,[
			'form_params' => $body,
		]);
		return $response->getBody()->getContents();
	}

	public function notifEmailPemesanan_ori()
	{
		$id_order = $this->input->post('id_order');
		$data = json_decode($this->guzzle_get($this->data['api'],'pemesanan/'.$id_order),true);
		$this->data['pelanggan'] = $data['pelanggan'];
		$this->data['order'] = $data['order'];
		$this->data['pembayaran'] = $data['pembayaran'];
		$this->data['surat_jalan'] = $data['surat_jalan'];

		$email = $data['pelanggan']['email'];
		$nota = 'Nota_Pemesanan_'.$data['order']['id_order'].'_'.$data['order']['tanggal_order'].'.pdf';
		$view = $this->load->view('email/nota_awal',$this->data);
		$html = $this->output->get_output($view);

		$this->load->library('pdf');
		# code...
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A4','portrait');
		// Render the HTML as PDF
		$this->dompdf->render();
		$output= $this->dompdf->output();

		// Konfigurasi email
		$config = Array(
			'protocol'  => 'smtp',
			'mailpath'  => '/usr/sbin/sendmail',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'fabinurcahyo@gmail.com',
			'smtp_pass' => 'fabiituindah8888', 
			'mailtype'	=> 'html',
			'charset'   => 'utf-8',
			'newline'	=> "\r\n",
			'wordwrap' => TRUE
		);
		$filename = base_url('assets/upload/telunjuk.png');
			// Load library email dan konfigurasinya
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->attach($output,'application/pdf',$nota,false);

		// Email dan nama pengirim
		$this->email->from('fabinurcahyo@gmail.com','Gudang BBB');
		
		// Email penerima
		$this->email->to($email);
		
		// Subject email
		$this->email->subject('UD. BILLY BOX BANGIL');
		
		// Isi email
		$body = $this->load->view('email/email_view',$this->data);
		$this->email->message($body,"inline");
		$this->email->send();

		// Tampilkan pesan sukses atau error
		// if ($this->email->send()) {
		// 	echo 'ok';
		// } else {
		// 	show_error($this->email->print_debugger());
		// }
	}

	public function notifEmailPemesanan($kode)
	{
		//awal
		if($kode == 1){
			$nota = 'nota_pembelian_'.$data['order']['id_order'].'_'.$data['order']['tanggal_order'].'.pdf';
			$template = 'email/nota_awal';
			$subject_email = 'Nota Pemesanan Barang UD. BILLY BOX BANGIL';
		}else if($kode == 2){
			$nota = 'nota_pembelian_'.$data['order']['id_order'].'_'.$data['order']['tanggal_order'].'.pdf';
			$template = 'email/nota_akhir';
			$subject_email = 'Nota Tagihan Barang UD. BILLY BOX BANGIL';
		}

		$id_order = $this->input->post('id_order');
		$data = json_decode($this->guzzle_get($this->data['api'],'pemesanan/'.$id_order),true);
		$this->data['pelanggan'] = $data['pelanggan'];
		$this->data['order'] = $data['order'];
		$this->data['pembayaran'] = $data['pembayaran'];
		$this->data['surat_jalan'] = $data['surat_jalan'];

		$email = $data['pelanggan']['email'];
		$view = $this->load->view($template,$this->data);
		$html = $this->output->get_output($view);

		$this->load->library('pdf');
		# code...
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A4','portrait');
		// Render the HTML as PDF
		$this->dompdf->render();
		$output= $this->dompdf->output();

		// Konfigurasi email
		$config = Array(
			'protocol'  => 'smtp',
			'mailpath'  => '/usr/sbin/sendmail',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'fabinurcahyo@gmail.com',
			'smtp_pass' => 'fabiituindah8888', 
			'mailtype'	=> 'html',
			'charset'   => 'utf-8',
			'newline'	=> "\r\n",
			'wordwrap' => TRUE
		);
		$filename = base_url('assets/upload/telunjuk.png');
			// Load library email dan konfigurasinya
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->attach($output,'application/pdf',$nota,false);

		// Email dan nama pengirim
		$this->email->from('fabinurcahyo@gmail.com','UD. BILLY BOX BANGIL');
		
		// Email penerima
		$this->email->to($email);
		
		// Subject email
		$this->email->subject($subject_email);
		
		// Isi email
		$body = $this->load->view('email/email_view',$this->data);
		$this->email->message($body,"inline");
		$this->email->send();

		// Tampilkan pesan sukses atau error
		// if ($this->email->send()) {
		// 	echo 'ok';
		// } else {
		// 	show_error($this->email->print_debugger());
		// }
	}
}