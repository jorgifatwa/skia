<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Galeri extends Admin_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('galeri_model');
	}

	public function index() 
	{
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['content'] = 'admin/galeri/list_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page', $this->data);
	}

	public function create() 
	{
		$this->form_validation->set_rules('gambar', 'Gambar', 'callback_check_file_upload');

		if ($this->form_validation->run() === TRUE) {

			$location_path = "./uploads/gambar/";
			if(!is_dir($location_path))
			{
				mkdir($location_path);
			}

			$tmp = $_FILES["gambar"];
			$uploaded      = uploadFileArray('gambar', $location_path, 'galeri', 1);
			
			if(!empty($uploaded)){
				for ($i=0; $i < count($uploaded); $i++) { 
					$data['gambar'] = str_replace(' ', '_', $uploaded[$i]['file']);	
					$insert = $this->galeri_model->insert($data);
				}
			}

			if ($insert) {
				$this->session->set_flashdata('message', "Gambar Baru Berhasil Disimpan");
				redirect("galeri");
			} else {
				$this->session->set_flashdata('message_error', "Gambar Baru Gagal Disimpan");
				redirect("galeri");
			}
		} else {
			$this->data['content'] = 'admin/galeri/create_v';
			$this->load->view('admin/layouts/page', $this->data);
		}
	}

	function check_file_upload() {
		if (empty($_FILES['gambar']['name'])) {
			$this->form_validation->set_message('check_file_upload', 'Gambar Harus Diisi');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function dataList() 
	{
		$columns = array(
			0 => 'gambar',
			1 => '',
		);

		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$search = array();
		$limit = 0;
		$start = 0;
		$totalData = $this->galeri_model->getCountAllBy($limit, $start, $search, $order, $dir);
		$totalFiltered = $totalData;

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$datas = $this->galeri_model->getAllBy($limit, $start, $search, $order, $dir);

		$new_data = array();
		if (!empty($datas)) {

			foreach ($datas as $key => $data) {

				$delete_url = "";
				if ($this->data['is_can_delete']) {
					$delete_url = "<a href='#'
						url='" . base_url() . "galeri/destroy/" . $data->id . "/" . $data->is_deleted . "'
						class='btn btn-sm btn-danger white delete'>Hapus
						</a>";
				}

				$nestedData['id'] = $start + $key + 1;
				$nestedData['gambar'] = "<img src='uploads/gambar/" . $data->gambar . "' width='200'>";
				$nestedData['action'] = $delete_url;
				$new_data[] = $nestedData;
			}
		}

		$json_data = array(
			"draw" => intval($this->input->post('draw')),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $new_data,
		);

		echo json_encode($json_data);
	}

	public function destroy() 
	{
		$response_data = array();
		$response_data['status'] = false;
		$response_data['msg'] = "";
		$response_data['data'] = array();

		$id = $this->uri->segment(3);
		$is_deleted = $this->uri->segment(4);
		if (!empty($id)) {
			$this->load->model("galeri_model");
			$galeri = $this->galeri_model->getAllById(array("galeri.id" => $id));
			$location_path = "./uploads/gambar/";
			unlink($location_path.$galeri[0]->gambar);

			$update = $this->galeri_model->delete(array("id" => $id));
			$response_data['data'] = $update;
			$response_data['msg'] = "Gambar Berhasil di Hapus";
			$response_data['status'] = true;
		} else {
			$response_data['msg'] = "ID Harus Diisi";
		}

		echo json_encode($response_data);
	}
}
