<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Blog extends Admin_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('blog_model');
	}

	public function index() 
	{
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['content'] = 'admin/blog/list_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page', $this->data);
	}

	public function create() 
	{
		$this->form_validation->set_rules('title', "Title Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('berita', "Berita Harus Diisi", 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			
			$data = array(
				'title' => $this->input->post('title'),
				'berita' => $this->input->post('berita'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->data['users']->id
			);

			$location_path = "./uploads/blog/";
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

			$insert = $this->blog_model->insert($data);

			if ($insert && $uploaded['status']==TRUE) {
				$this->session->set_flashdata('message', "Blog Baru Berhasil Disimpan");
				redirect("blog");
			} else {
				$this->session->set_flashdata('message_error', "Blog Baru Gagal Disimpan");
				redirect("blog");
			}
		} else {
			$this->data['content'] = 'admin/blog/create_v';
			$this->load->view('admin/layouts/page', $this->data);
		}
	}

	public function edit() 
	{
		$this->form_validation->set_rules('title', "Title Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('berita', "Berita Harus Diisi", 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			
			$data = array(
				'title' => $this->input->post('title'),
				'berita' => $this->input->post('berita'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->data['users']->id
			);

			$id = $this->input->post('id');

			$location_path = "./uploads/blog/";
			if(!is_dir($location_path))
			{
				mkdir($location_path);
			}

			if(!empty($_FILES["gambar"]['name'])){
				$tmp = $_FILES["gambar"]['name'];
				$ext = ".".pathinfo($tmp, PATHINFO_EXTENSION);
				$uploaded      = uploadFile('gambar', $location_path, 'blog', $ext);
				
				if($uploaded['status']==TRUE){
					$data['gambar'] = str_replace(' ', '_', $uploaded['message']);	
				}

				$blog = $this->blog_model->getAllById(array("blog.id" => $id));

				if(!empty($blog[0]->gambar )){
					unlink($location_path.$blog[0]->gambar);
				}
			}

			$update = $this->blog_model->update($data, array("blog.id" => $id));

			if ($update) {
				$this->session->set_flashdata('message', "Blog Berhasil Diubah");
				redirect("blog", "refresh");
			} else {
				$this->session->set_flashdata('message_error', "Blog Gagal Diubah");
				redirect("blog", "refresh");
			}
		} else {
			if (!empty($_POST)) {
				$id = $this->input->post('id');
				$this->session->set_flashdata('message_error', validation_errors());
				return redirect("blog/edit/" . $id);
			} else {
				$this->data['id'] = $this->uri->segment(3);
				$blog = $this->blog_model->getAllById(array("blog.id" => $this->data['id']));
				
				$this->data['id'] 	= (!empty($blog)) ? $blog[0]->id : "";
				$this->data['title'] 	= (!empty($blog)) ? $blog[0]->title : "";
				$this->data['gambar'] 	= (!empty($blog)) ? $blog[0]->gambar : "";
				$this->data['berita'] = (!empty($blog)) ? $blog[0]->berita : "";
				$this->data['content'] = 'admin/blog/edit_v';
				$this->load->view('admin/layouts/page', $this->data);
			}
		}

	}

	public function dataList() 
	{
		$columns = array(
			0 => 'title',
			1 => 'gambar',
			2 => 'berita',
			3 => '',
		);

		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$search = array();
		$limit = 0;
		$start = 0;
		$totalData = $this->blog_model->getCountAllBy($limit, $start, $search, $order, $dir);

		if (!empty($this->input->post('search')['value'])) {
			$search_value = $this->input->post('search')['value'];
			$search = array(
				"blog.title" => $search_value,
				"blog.berita" => $search_value,
			);
			$totalFiltered = $this->blog_model->getCountAllBy($limit, $start, $search, $order, $dir);
		} else {
			$totalFiltered = $totalData;
		}

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$datas = $this->blog_model->getAllBy($limit, $start, $search, $order, $dir);

		$new_data = array();
		if (!empty($datas)) {

			foreach ($datas as $key => $data) {

				$edit_url = "";
				$delete_url = "";

				if ($this->data['is_can_edit'] && $data->is_deleted == 0) {
					$edit_url = "<a href='" . base_url() . "blog/edit/" . $data->id . "' class='btn btn-sm btn-info white'> Ubah</a>";
				}
				if ($this->data['is_can_delete']) {
					$delete_url = "<a href='#'
						url='" . base_url() . "blog/destroy/" . $data->id . "/" . $data->is_deleted . "'
						class='btn btn-sm btn-danger white delete'>Hapus
						</a>";
				}

				$nestedData['id'] = $start + $key + 1;
				$nestedData['title'] = $data->title;
				$nestedData['gambar'] = "<img src='uploads/blog/" . $data->gambar . "' width='50'>";
				$nestedData['berita'] = substr(strip_tags($data->berita), 0, 50);
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
			$this->load->model("blog_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1) ? 0 : 1,
			);
			$blog = $this->blog_model->getAllById(array("blog.id" => $id));
			$location_path = "./uploads/blog/";
			unlink($location_path.$blog[0]->gambar);
			$update = $this->blog_model->update($data, array("id" => $id));

			$response_data['data'] = $data;
			$response_data['msg'] = "blog Berhasil di Hapus";
			$response_data['status'] = true;
		} else {
			$response_data['msg'] = "ID Harus Diisi";
		}

		echo json_encode($response_data);
	}
}
