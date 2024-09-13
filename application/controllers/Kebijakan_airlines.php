<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Kebijakan_airlines extends Admin_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('kebijakan_airlines_model');
		$this->load->model('kebijakan_model');
	}

	public function index() 
	{
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['content'] = 'admin/kebijakan_airlines/list_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page', $this->data);
	}

	public function create() 
	{
		$this->form_validation->set_rules('name', "Nama Harus Diisi", 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			
			$data = array(
				'nama' => $this->input->post('name'),
				'keterangan' => $this->input->post('description'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->data['users']->id
			);

			$location_path = "./uploads/airlines/";
			if(!is_dir($location_path))
			{
				mkdir($location_path);
			}

			$tmp = $_FILES["gambar"]['name'];
			$ext = ".".pathinfo($tmp, PATHINFO_EXTENSION);
			$uploaded      = uploadFile('gambar', $location_path, 'airlines', $ext);
			
			if($uploaded['status']==TRUE){
				$data['gambar'] = str_replace(' ', '_', $uploaded['message']);	
			}

			$insert = $this->kebijakan_airlines_model->insert($data);

			if(isset($_POST['kebijakan'])){
				for ($i=0; $i < count($_POST['kebijakan']); $i++) { 
					$data2 = array(
						'id_airlines' => $insert,
						'kebijakan' => $_POST['kebijakan'][$i],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->data['users']->id
					);

					$insert = $this->kebijakan_airlines_model->insert_kebijakan($data2);
				}
			}

			if ($insert && $uploaded['status']==TRUE) {
				$this->session->set_flashdata('message', "Kebijakan Airlines Baru Berhasil Disimpan");
				redirect("kebijakan_airlines");
			} else {
				$this->session->set_flashdata('message_error', "Kebijakan Airlines Baru Gagal Disimpan");
				redirect("kebijakan_airlines");
			}
		} else {
			$this->data['content'] = 'admin/kebijakan_airlines/create_v';
			$this->load->view('admin/layouts/page', $this->data);
		}
	}

	public function edit() 
	{
		$this->form_validation->set_rules('name', "Nama Harus Diisi", 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			
			$data = array(
				'nama' => $this->input->post('name'),
				'keterangan' => $this->input->post('description'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->data['users']->id
			);

			$id = $this->input->post('id');

			$location_path = "./uploads/airlines/";
			if(!is_dir($location_path))
			{
				mkdir($location_path);
			}

			if(!empty($_FILES["gambar"]['name'])){
				$tmp = $_FILES["gambar"]['name'];
				$ext = ".".pathinfo($tmp, PATHINFO_EXTENSION);
				$uploaded      = uploadFile('gambar', $location_path, 'airlines', $ext);
				
				if($uploaded['status']==TRUE){
					$data['gambar'] = str_replace(' ', '_', $uploaded['message']);	
				}

				$kebijakan_airlines = $this->kebijakan_airlines_model->getAllById(array("airlines.id" => $id));

				if(!empty($kebijakan_airlines[0]->gambar )){
					unlink($location_path.$kebijakan_airlines[0]->gambar);
				}
			}

			$update = $this->kebijakan_airlines_model->update($data, array("airlines.id" => $id));

			if(isset($_POST['kebijakan'])){
				$where = array('id_airlines' => $id);
				$this->kebijakan_model->delete($where);
				for ($i=0; $i < count($_POST['kebijakan']); $i++) { 
					$data2 = array(
						'id_airlines' => $id,
						'kebijakan' => $_POST['kebijakan'][$i],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->data['users']->id
					);

					$insert = $this->kebijakan_airlines_model->insert_kebijakan($data2);
				}
			}

			if ($update) {
				$this->session->set_flashdata('message', "Kebijakan Airlines Berhasil Diubah");
				redirect("kebijakan_airlines", "refresh");
			} else {
				$this->session->set_flashdata('message_error', "Kebijakan Airlines Gagal Diubah");
				redirect("kebijakan_airlines", "refresh");
			}
		} else {
			if (!empty($_POST)) {
				$id = $this->input->post('id');
				$this->session->set_flashdata('message_error', validation_errors());
				return redirect("kebijakan_airlines/edit/" . $id);
			} else {
				$this->data['id'] = $this->uri->segment(3);
				$kebijakan_airlines = $this->kebijakan_airlines_model->getAllById(array("airlines.id" => $this->data['id']));
				$this->data['kebijakans'] = $this->kebijakan_model->getAllById(array("kebijakan_airlines.id_airlines" => $this->data['id']));
				
				$this->data['id'] 	= (!empty($kebijakan_airlines)) ? $kebijakan_airlines[0]->id : "";
				$this->data['nama'] 	= (!empty($kebijakan_airlines)) ? $kebijakan_airlines[0]->nama : "";
				$this->data['gambar'] 	= (!empty($kebijakan_airlines)) ? $kebijakan_airlines[0]->gambar : "";
				$this->data['description'] = (!empty($kebijakan_airlines)) ? $kebijakan_airlines[0]->keterangan : "";
				$this->data['content'] = 'admin/kebijakan_airlines/edit_v';
				$this->load->view('admin/layouts/page', $this->data);
			}
		}

	}

	public function dataList() 
	{
		$columns = array(
			0 => 'nama',
			1 => 'gambar',
			2 => 'description',
			3 => '',
		);

		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$search = array();
		$limit = 0;
		$start = 0;
		$totalData = $this->kebijakan_airlines_model->getCountAllBy($limit, $start, $search, $order, $dir);

		if (!empty($this->input->post('search')['value'])) {
			$search_value = $this->input->post('search')['value'];
			$search = array(
				"kebijakan_airlines.nama" => $search_value,
				"kebijakan_airlines.description" => $search_value,
			);
			$totalFiltered = $this->kebijakan_airlines_model->getCountAllBy($limit, $start, $search, $order, $dir);
		} else {
			$totalFiltered = $totalData;
		}

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$datas = $this->kebijakan_airlines_model->getAllBy($limit, $start, $search, $order, $dir);

		$new_data = array();
		if (!empty($datas)) {

			foreach ($datas as $key => $data) {

				$edit_url = "";
				$delete_url = "";
				$detail_url = "";

				if ($this->data['is_can_edit'] && $data->is_deleted == 0) {
					$edit_url = "<a href='" . base_url() . "kebijakan_airlines/edit/" . $data->id . "' class='btn btn-sm btn-info white'> Ubah</a>";
				}
				if ($this->data['is_can_delete']) {
					$delete_url = "<a href='#'
						url='" . base_url() . "kebijakan_airlines/destroy/" . $data->id . "/" . $data->is_deleted . "'
						class='btn btn-sm btn-danger white delete'>Hapus
						</a>";
				}

				$detail_url = "<a href='" . base_url() . "kebijakan_airlines/detail/" . $data->id . "' class='btn btn-sm btn-primary white'> Detail</a>";

				$nestedData['id'] = $start + $key + 1;
				$nestedData['nama'] = $data->nama;
				$nestedData['gambar'] = "<img src='uploads/airlines/" . $data->gambar . "' width='50'>";
				$nestedData['description'] = substr(strip_tags($data->keterangan), 0, 50);
				$nestedData['action'] = $detail_url." ".$edit_url . " " . $delete_url;
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
			$this->load->model("kebijakan_airlines_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1) ? 0 : 1,
			);
			$kebijakan_airlines = $this->kebijakan_airlines_model->getAllById(array("airlines.id" => $this->data['id']));
			$location_path = "./uploads/airlines/";
			unlink($location_path.$kebijakan_airlines[0]->gambar);
			$update = $this->kebijakan_airlines_model->update($data, array("id" => $id));
			$update = $this->kebijakan_model->update($data, array("id_airlines" => $id));

			$response_data['data'] = $data;
			$response_data['msg'] = "Kebijakan Airlines Berhasil di Hapus";
			$response_data['status'] = true;
		} else {
			$response_data['msg'] = "ID Harus Diisi";
		}

		echo json_encode($response_data);
	}

	public function detail() 
	{
		$this->form_validation->set_rules('name', "Nama Harus Diisi", 'trim|required');
		$this->data['id'] = $this->uri->segment(3);
		$kebijakan_airlines = $this->kebijakan_airlines_model->getAllById(array("airlines.id" => $this->data['id']));
		$this->data['kebijakans'] = $this->kebijakan_model->getAllById(array("kebijakan_airlines.id_airlines" => $this->data['id']));
		
		$this->data['id'] 	= (!empty($kebijakan_airlines)) ? $kebijakan_airlines[0]->id : "";
		$this->data['nama'] 	= (!empty($kebijakan_airlines)) ? $kebijakan_airlines[0]->nama : "";
		$this->data['gambar'] 	= (!empty($kebijakan_airlines)) ? $kebijakan_airlines[0]->gambar : "";
		$this->data['description'] = (!empty($kebijakan_airlines)) ? $kebijakan_airlines[0]->keterangan : "";
		$this->data['content'] = 'admin/kebijakan_airlines/detail_v';
		$this->load->view('admin/layouts/page', $this->data);
	}
}
