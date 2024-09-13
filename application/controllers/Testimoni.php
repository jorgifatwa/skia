<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Testimoni extends Admin_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('testimoni_model');
	}

	public function index() 
	{
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['content'] = 'admin/testimoni/list_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page', $this->data);
	}

	public function create() 
	{
		$this->form_validation->set_rules('name', "Nama Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('asal', "Asal Customer Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('testimoni', "Testimoni Harus Diisi", 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			
			$data = array(
				'nama' => $this->input->post('name'),
				'asal' => $this->input->post('asal'),
				'testimoni' => $this->input->post('testimoni'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->data['users']->id
			);

			$insert = $this->testimoni_model->insert($data);

			if ($insert) {
				$this->session->set_flashdata('message', "Testimoni Baru Berhasil Disimpan");
				redirect("testimoni");
			} else {
				$this->session->set_flashdata('message_error', "Testimoni Baru Gagal Disimpan");
				redirect("testimoni");
			}
		} else {
			$this->data['content'] = 'admin/testimoni/create_v';
			$this->load->view('admin/layouts/page', $this->data);
		}
	}

	public function edit() 
	{
		$this->form_validation->set_rules('name', "Nama Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('testimoni', "Testimoni Harus Diisi", 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			
			$data = array(
				'nama' => $this->input->post('name'),
				'asal' => $this->input->post('asal'),
				'testimoni' => $this->input->post('testimoni'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->data['users']->id
			);

			$id = $this->input->post('id');

			$update = $this->testimoni_model->update($data, array("testimoni.id" => $id));

			if ($update) {
				$this->session->set_flashdata('message', "Testimoni Berhasil Diubah");
				redirect("testimoni", "refresh");
			} else {
				$this->session->set_flashdata('message_error', "Testimoni Gagal Diubah");
				redirect("testimoni", "refresh");
			}
		} else {
			if (!empty($_POST)) {
				$id = $this->input->post('id');
				$this->session->set_flashdata('message_error', validation_errors());
				return redirect("testimoni/edit/" . $id);
			} else {
				$this->data['id'] = $this->uri->segment(3);
				$testimoni = $this->testimoni_model->getAllById(array("testimoni.id" => $this->data['id']));
				
				$this->data['id'] 	= (!empty($testimoni)) ? $testimoni[0]->id : "";
				$this->data['nama'] 	= (!empty($testimoni)) ? $testimoni[0]->nama : "";
				$this->data['asal'] 	= (!empty($testimoni)) ? $testimoni[0]->asal : "";
				$this->data['testimoni'] = (!empty($testimoni)) ? $testimoni[0]->testimoni : "";
				$this->data['content'] = 'admin/testimoni/edit_v';
				$this->load->view('admin/layouts/page', $this->data);
			}
		}

	}

	public function dataList() 
	{
		$columns = array(
			0 => 'nama',
			1 => 'asal',
			2 => 'testimoni',
			3 => '',
		);

		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$search = array();
		$limit = 0;
		$start = 0;
		$totalData = $this->testimoni_model->getCountAllBy($limit, $start, $search, $order, $dir);

		if (!empty($this->input->post('search')['value'])) {
			$search_value = $this->input->post('search')['value'];
			$search = array(
				"testimoni.nama" => $search_value,
				"testimoni.asal" => $search_value,
				"testimoni.testimoni" => $search_value,
			);
			$totalFiltered = $this->testimoni_model->getCountAllBy($limit, $start, $search, $order, $dir);
		} else {
			$totalFiltered = $totalData;
		}

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$datas = $this->testimoni_model->getAllBy($limit, $start, $search, $order, $dir);

		$new_data = array();
		if (!empty($datas)) {

			foreach ($datas as $key => $data) {

				$edit_url = "";
				$delete_url = "";

				if ($this->data['is_can_edit'] && $data->is_deleted == 0) {
					$edit_url = "<a href='" . base_url() . "testimoni/edit/" . $data->id . "' class='btn btn-sm btn-info white'> Ubah</a>";
				}
				if ($this->data['is_can_delete']) {
					$delete_url = "<a href='#'
						url='" . base_url() . "testimoni/destroy/" . $data->id . "/" . $data->is_deleted . "'
						class='btn btn-sm btn-danger white delete'>Hapus
						</a>";
				}

				$nestedData['id'] = $start + $key + 1;
				$nestedData['nama'] = $data->nama;
				$nestedData['asal'] = $data->asal;
				$nestedData['testimoni'] = substr(strip_tags($data->testimoni), 0, 50);
				$nestedData['action'] = $edit_url." ".$delete_url;
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
			$this->load->model("testimoni_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1) ? 0 : 1,
			);
			$update = $this->testimoni_model->update($data, array("id" => $id));

			$response_data['data'] = $data;
			$response_data['msg'] = "Testimoni Berhasil di Hapus";
			$response_data['status'] = true;
		} else {
			$response_data['msg'] = "ID Harus Diisi";
		}

		echo json_encode($response_data);
	}
}
