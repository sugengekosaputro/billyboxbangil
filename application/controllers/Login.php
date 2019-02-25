<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public $data = array(
		'api' => 'http://localhost/billyboxbangilapi/'
	);

    public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
		$cookie = get_cookie('billyboxbangil');
		if ($this->session->userdata('username')){
			redirect('home');
		}else if($cookie <> '') {
			// cek cookie
			$body = [
				[
					'name' => 'cookie',
					'contents' => $cookie
				],
	
			];
            $cek = json_decode($this->guzzle_post($this->data['api'],'login/cookieget',$body));
            if ($cek->result==TRUE) {
                $getUser = array(
					'id_user' => $cek->id_user,
					'username' => $cek->username,
					'email' => $cek->email,
					'password' => $cek->password,
					'foto' => $cek->foto,
					'role' => $cek->role,
				);
				$this->session->set_userdata($getUser);
				$this->load->view('home');
            } else {
                $this->session->set_flashdata("failed","<div class=\"alert alert-danger alert-dismissible\">
				<a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				masukan email dan password
				</div>");
			   $this->load->view('login');    
            }
        }else{
			$this->load->view('login');
		}
	}

	public function login()
	{
		$key = random_string('alnum', 64);

		$body = [
			[
				'name' => 'email',
				'contents' => $this->input->post('email')
			],
			[
				'name' => 'password',
				'contents' => $this->input->post('password')
			],
			[
				'name' => 'remember',
				'contents' => $this->input->post('remember')
			],
			[
				'name' => 'cookie',
				'contents' => $key
			],

		];

		$remember = $this->input->post('remember');		
		$cek = json_decode($this->guzzle_post($this->data['api'],'login',$body));

		if($cek->status == TRUE){
			if ($remember){
				$updatecookie = [
					[
						'name' => 'id',
						'contents' => $cek->id_user
					],
					[
						'name' => 'cookie',
						'contents' => $key
					],
		
				];
				json_decode($this->guzzle_post($this->data['api'],'login/cookieupdate',$updatecookie));
				set_cookie('billboxbangil', $key, 3600*24*30);
				
			}
			$getUser = array(
							'id_user' => $cek->id_user,
							'username' => $cek->username,
							'email' => $cek->email,
							'password' => $cek->password,
							'foto' => $cek->foto,
							'role' => $cek->role,
			);
			$this->session->set_userdata($getUser);
			redirect('home');
		}else{
			$this->session->set_flashdata("failed","<div class=\"alert alert-danger alert-dismissible\">
			<a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
			email atau password salah
			</div>");
			redirect('login');
		}
		
	}

	public function logout()
	{
		delete_cookie('billyboxbangil');
		$this->session->sess_destroy();
		redirect('Login');
		# code...
	}
	

	public function guzzle_post($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('POST',$uri,[
			'multipart' => $body,
		]);
		return $response->getBody();
	}


}