<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

  public $data = array(
		'api' => 'http://localhost/billyboxbangilapi/'
	);

  public function simpan_sj()
	{
		$id_order = $this->input->post('id_order');
		$no_sj = $this->input->post('no_sj');
		$id_detail_order = $this->input->post('id_detail_order');
		$dikirm = $this->input->post('dikirim');
		$tanggal = date('Y-m-d');

		$lenght = count($id_detail_order);
		$i = 0;

		while($i < $lenght){
			$array[] = array(
				'no_sj' => $no_sj,
				'id_detail_order' => $id_detail_order[$i],
				'dikirim' => $dikirm[$i],
				'tanggal' => $tanggal,
			);
			$i++;
		}
		
		$body = ['surat_jalan' => $array, 'id_order' => $id_order];
    $response = json_decode($this->guzzle_post($this->data['api'],'penagihan/suratjalan',$body),true);
		if($response['status']){
       echo json_encode($response);
    }
	}

	public function inputpembayaran()
	{
		$id = $this->input->post('id_pembayaran');
		$dibayar = $this->input->post('value');

		$body = ['id_pembayaran' => $id, 'dibayar' => $dibayar];
		
		$response = json_decode($this->guzzle_post($this->data['api'],'penagihan/pembayaran',$body),true);
		if($response['status']){
       echo json_encode($response);
    }
	}

	public function notifEmailPemesanan($id_order)
	{
		$data = json_decode($this->guzzle_get($this->data['api'],'pemesanan/'.$id_order),true);
		$this->data['pelanggan'] = $data['pelanggan'];
		$this->data['order'] = $data['order'];
		$this->data['pembayaran'] = $data['pembayaran'];
		$this->data['surat_jalan'] = $data['surat_jalan'];

		$email = $data['pelanggan']['email'];
		$nota = 'Nota '.$data['pelanggan']['nama_pelanggan'].'.pdf';
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

		// Tampilkan pesan sukses atau error
		if ($this->email->send()) {
			echo 'ok';
		} else {
			show_error($this->email->print_debugger());
		}
	}

	public function notaPemesanan()
	{
		$id_order = $this->uri->segment(3);
		$data = json_decode($this->guzzle_get($this->data['api'],'pemesanan/'.$id_order),true);
		$this->data['pelanggan'] = $data['pelanggan'];
		$this->data['order'] = $data['order'];
		$this->data['pembayaran'] = $data['pembayaran'];
		$this->data['surat_jalan'] = $data['surat_jalan'];

		$this->load->view('email/nota_awal',$this->data);
//		echo json_encode($data);
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
}