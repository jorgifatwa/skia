<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class Dashboard extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('transaksi_model');
		$this->load->model('pengeluaran_model');
		$this->load->model('pengeluaran_karyawan_model');
		$this->load->model('biaya_tambahan_model');
		$this->load->model('travel_model');
	}
	public function index() {
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['content'] = 'admin/dashboard';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$currentMonth = date('m'); // Get the current month in the format 'MM'
		$currentYear = date('Y'); // Get the current year in the format 'YYYY'

		// Assuming 'departure_date' is the field representing the departure date
		$transaksi = $this->transaksi_model->getAllById(array(
			'status' => 0,
			'MONTH(tanggal_keberangkatan)' => $currentMonth,
			'YEAR(tanggal_keberangkatan)' => $currentYear
		));
		$total = 0;
		$total_fee_tl = 0;
		if(!empty($transaksi)){
			foreach ($transaksi as $key => $value) {
				$total += $value->harga * $value->jumlah_pax;
				$total_fee_tl += $value->fee_tl;
			}
		}

		$pengeluaran = $this->pengeluaran_model->getAllById(array('MONTH(tanggal)' => $currentMonth,
		'YEAR(tanggal)' => $currentYear));
		$total_pengeluaran = 0;
		if(!empty($pengeluaran)){
			foreach ($pengeluaran as $key => $value) {
				$total_pengeluaran += $value->harga * $value->jumlah;
			}
		}

		$pengeluaran_karaywan = $this->pengeluaran_karyawan_model->getAllById(array('MONTH(tanggal)' => $currentMonth,
		'YEAR(tanggal)' => $currentYear));
		$total_pengeluaran_karaywan = 0;
		if(!empty($pengeluaran_karaywan)){
			foreach ($pengeluaran_karaywan as $key => $value) {
				$total_pengeluaran_karaywan += $value->harga;
			}
		}
		
		$biaya_tambahan = $this->biaya_tambahan_model->getAllById(array('MONTH(tanggal)' => $currentMonth,
		'YEAR(tanggal)' => $currentYear, 'status' => 'Lunas'));

		$total_biaya_tambahan = 0;
		if(!empty($biaya_tambahan)){
			foreach ($biaya_tambahan as $key => $value) {
				$total_biaya_tambahan += $value->fee;
			}
		}
		
		$this->data['total_pendapatan'] = "Rp. ".number_format($total + $total_biaya_tambahan);
		$this->data['total_pengeluaran'] = "Rp. ".number_format($total_pengeluaran + $total_fee_tl + $total_pengeluaran_karaywan);
		$this->data['total_pengeluaran_karyawan'] = "Rp. ".number_format($total_pengeluaran_karaywan);
		$this->data['total_bersih'] = "Rp. ".number_format(($total + $total_biaya_tambahan) - ($total_pengeluaran + $total_fee_tl + $total_pengeluaran_karaywan));


		$this->load->view('admin/layouts/page', $this->data);
	}

	public function grafikPendapatan() {

		$currentYear = date('Y'); // Get the current year in the format 'YYYY'

		// Initialize an array to store monthly data
		$monthlyData = [];

		// Loop through each month (from January to December)
		for ($month = 1; $month <= 12; $month++) {
			// Calculate total income for the current month and year
			// $totalPendapatanQuery = $this->db->query("
			// 	SELECT SUM(harga * jumlah_pax) AS total_pendapatan
			// 	FROM transaksi
			// 	WHERE status = 0
			// 	AND MONTH(tanggal_keberangkatan) = $month
			// 	AND YEAR(tanggal_keberangkatan) = $currentYear
			// ");

			$totalPendapatanQuery = $this->db->query("
				SELECT SUM(harga * jumlah_pax) AS total_pendapatan
				FROM transaksi
				WHERE status = 0
				AND MONTH(tanggal_keberangkatan) = $month
				AND YEAR(tanggal_keberangkatan) = $currentYear
			");

			$totalPendapatanResult = $totalPendapatanQuery->row();
			$totalPendapatan = $totalPendapatanResult->total_pendapatan;
			$totalFeeTl = 0;

			// Calculate total expenditure for the current month and year
			$totalPengeluaranQuery = $this->db->query("
				SELECT SUM(harga * jumlah) AS total_pengeluaran
				FROM pengeluaran
				WHERE MONTH(tanggal) = $month
				AND YEAR(tanggal) = $currentYear
			");

			$totalPengeluaranResult = $totalPengeluaranQuery->row();
			$totalPengeluaran = $totalPengeluaranResult->total_pengeluaran;

			$totalPengeluaranKaryawanQuery = $this->db->query("
				SELECT SUM(harga) AS total_pengeluaran_karyawan
				FROM pengeluaran_karyawan
				WHERE MONTH(tanggal) = $month
				AND YEAR(tanggal) = $currentYear
			");

			$totalPengeluaranKaryawanResult = $totalPengeluaranKaryawanQuery->row();
			$totalPengeluaranKaryawan = $totalPengeluaranKaryawanResult->total_pengeluaran_karyawan;

			// Calculate total income for the current month and year
			$totalBiayaQuery = $this->db->query("
				SELECT SUM(harga * jumlah) AS total_pendapatan
				FROM biaya_tambahan
				WHERE status = 0
				AND MONTH(tanggal) = $month
				AND YEAR(tanggal) = $currentYear
			");

			$totalBiayaResult = $totalBiayaQuery->row();
			$totalBiaya = $totalBiayaResult->total_pendapatan;

			$totalPendapatan = $totalPendapatan + $totalBiaya;
			// Calculate net income for the current month
			$totalBersih = $totalPendapatan - ($totalPengeluaran + $totalPengeluaranKaryawan + $totalFeeTl);

			// Store the data for the current month in the array
			$monthlyData[$month] = [
				'total_pendapatan' => $totalPendapatan,
				'total_pengeluaran' => $totalPengeluaran,
				'total_pengeluaran_karyawan' => $totalPengeluaranKaryawan,
				'total_bersih' => $totalBersih,
			];

	
		}

		if (!empty($monthlyData)) {
			// $return_data['data'] = $datas;
			$return_data['tahun'] = $currentYear;
			$return_data['grafik'] = $monthlyData;
			$return_data['status'] = true;
			$return_data['message'] = "Berhasil mengambil data!";
		} else {
			$return_data['data'] = [];
			$return_data['grafik'] = [];
			$return_data['status'] = false;
			$return_data['message'] = "Gagal mengambil data!";
		}

		echo json_encode($return_data);
	}

	public function grafikPendapatanPerTahun() {
		// Get the current year in the format 'YYYY'
		$currentYear = date('Y');

		// Initialize an array to store yearly data
		$yearlyData = [];

		// Loop through each year (you can adjust the range as needed)
		for ($year = $currentYear - 3; $year <= $currentYear; $year++) {
			// Calculate total income for the current year
			$totalPendapatanQuery = $this->db->query("
				SELECT SUM((harga * jumlah_pax) + fee_tl)  AS total_pendapatan, SUM(fee_tl) as total_fee_tl
				FROM transaksi
				WHERE status = 0
				AND YEAR(tanggal_keberangkatan) = $year
			");

			$totalPendapatanResult = $totalPendapatanQuery->row();
			$totalPendapatan = $totalPendapatanResult->total_pendapatan;
			$totalFeeTl = $totalPendapatanResult->total_fee_tl;

			// Calculate total expenditure for the current year
			$totalPengeluaranQuery = $this->db->query("
				SELECT SUM(harga * jumlah) AS total_pengeluaran
				FROM pengeluaran
				WHERE YEAR(tanggal) = $year
			");

			$totalPengeluaranResult = $totalPengeluaranQuery->row();
			$totalPengeluaran = $totalPengeluaranResult->total_pengeluaran;

			$totalPengeluaranKaryawanQuery = $this->db->query("
				SELECT SUM(harga) AS total_pengeluaran_karyawan
				FROM pengeluaran_karyawan
				WHERE YEAR(tanggal) = $year
			");

			$totalPengeluaranKaryawanResult = $totalPengeluaranKaryawanQuery->row();
			$totalPengeluaranKaryawan = $totalPengeluaranKaryawanResult->total_pengeluaran_karyawan;

			$totalBiayaQuery = $this->db->query("
				SELECT SUM(harga * jumlah) AS total_pendapatan
				FROM biaya_tambahan
				WHERE status = 0
				AND YEAR(tanggal) = $currentYear
			");

			$totalBiayaResult = $totalBiayaQuery->row();
			$totalBiaya = $totalBiayaResult->total_pendapatan;

			$totalPendapatan = $totalPendapatan + $totalBiaya;
			// Calculate net income for the current year
			$totalBersih = $totalPendapatan - ($totalPengeluaran + $totalPengeluaranKaryawan + $totalFeeTl);

			// Store the data for the current year in the array
			$yearlyData[$year] = [
				'total_pendapatan' => $totalPendapatan,
				'total_pengeluaran' => $totalPengeluaran,
				'total_pengeluaran_karyawan' => $totalPengeluaranKaryawan,
				'total_bersih' => $totalBersih,
			];
		}

		if (!empty($yearlyData)) {
			$return_data['grafik'] = $yearlyData;
			$return_data['status'] = true;
			$return_data['message'] = "Berhasil mengambil data!";
		} else {
			$return_data['data'] = [];
			$return_data['grafik'] = [];
			$return_data['status'] = false;
			$return_data['message'] = "Gagal mengambil data!";
		}

		echo json_encode($return_data);
	}

	public function grafikTravel() {
		$currentYear = date('Y'); // Get the current year in the format 'YYYY'
	
		// Get unique travel_id values along with their names from the 'travel' table
		$travelData = $this->db->query("
			SELECT id, nama
			FROM travel
		")->result_array();
	
		// Initialize an array to store monthly data for each travel_id
		$monthlyData = [];
	
		// Loop through each month (from January to December)
		for ($month = 1; $month <= 12; $month++) {
			// Loop through each travel_id
			foreach ($travelData as $travel) {
				$travelId = $travel['id'];
	
				// Count the number of transactions for the current month, year, and travel_id
				$transactionCountQuery = $this->db->query("
					SELECT COUNT(*) AS transaction_count
					FROM transaksi t
					WHERE t.status = 0
					AND MONTH(t.tanggal_keberangkatan) = $month
					AND YEAR(t.tanggal_keberangkatan) = $currentYear
					AND t.travel_id = $travelId
				");
	
				$transactionCountResult = $transactionCountQuery->row();
				$transactionCount = $transactionCountResult->transaction_count;
	
				// Store the transaction count for the current month and travel_id in the array
				$monthlyData[$travel['nama']][$month] = [
					'transaction_count' => $transactionCount,
				];				
			}
		}
	
		if (!empty($monthlyData)) {
			$return_data['tahun'] = $currentYear;
			$return_data['grafik'] = $monthlyData;
			$return_data['status'] = true;
			$return_data['message'] = "Berhasil mengambil data!";
		} else {
			$return_data['data'] = [];
			$return_data['grafik'] = [];
			$return_data['status'] = false;
			$return_data['message'] = "Gagal mengambil data!";
		}
	
		echo json_encode($return_data);
	}
	

	public function dataList() 
	{
		$columns = array(
			0 => 'nomor',
			1 => 'barang.nama',
		);

		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$search = array();
		$where = array('id_gudang' => null);

		$limit = 0;
		$start = 0;
		$totalData = $this->barang_keluar_model->getCountAllByFavorite($limit, $start, $search, $order, $dir, $where);

		if (!empty($this->input->post('search')['value'])) {
			$search_value = $this->input->post('search')['value'];
			$search = array(
				"barang.nama" => $search_value,
			);

			$totalFiltered = $this->barang_keluar_model->getCountAllByFavorite($limit, $start, $search, $order, $dir, $where);
		} else {
			$totalFiltered = $totalData;
		}

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$datas = $this->barang_keluar_model->getAllByFavorite($limit, $start, $search, $order, $dir, $where);

		$new_data = array();
		if (!empty($datas)) {

			foreach ($datas as $key => $data) {

				$nestedData['nomor'] = $start + $key + 1;
				$nestedData['barang_name'] = $data->barang_name;
				$nestedData['total'] = $data->total;
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
}
