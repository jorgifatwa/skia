<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('galeri_model');
		$this->load->model('blog_model');
		$this->load->model('kebijakan_model');
		$this->load->model('kebijakan_airlines_model');
		$this->load->model('testimoni_model');
	}
	public function index()
	{
		$this->data['content'] = 'user/home';
		$this->data['galeris'] = $this->galeri_model->getAllById();   
		$this->data['blogs'] = $this->blog_model->getAllById();   
		$this->data['testimonis'] = $this->testimoni_model->getAllById();   
		$this->load->view('user/layouts/page',$this->data); 
    } 
    
	public function detail()
	{
		$this->data['content'] = 'user/detail';   

		$this->load->view('user/layouts/page',$this->data); 
    } 
	public function target()
	{
		$this->data['content'] = 'user/target';   

		$this->load->view('user/layouts/page',$this->data); 
    } 

	public function cek_kebijakan(){
		$kebijakan = $this->input->post('kebijakan');
		$data_airline = $this->kebijakan_model->getAirlineByName(array('nama' => $kebijakan));

		print_r(json_encode($data_airline));
		return json_encode($data_airline);
	}

	public function lihat_kebijakan(){
		$id = $this->uri->segment(3);
		$this->data['content'] = 'user/kebijakan_airline';   

		$this->data['data_airline'] = $this->kebijakan_airlines_model->getAllById(array('id' => $id));

		$this->data['data_kebijakan'] = $this->kebijakan_model->getAllById(array('id_airlines' => $id));

		$this->load->view('user/layouts/page',$this->data); 
	}

	public function detail_berita(){
		$id = $this->uri->segment(3);
		$this->data['content'] = 'user/detail_berita';   

		$this->data['data_berita'] = $this->blog_model->getAllById(array('id' => $id));

		$this->load->view('user/layouts/page',$this->data); 
	}
    
    
}
