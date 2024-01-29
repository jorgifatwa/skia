<?php
/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_create_table_api_limits
 *
 * @property CI_DB_forge         $dbforge
 * @property CI_DB_query_builder $db
 */
class Migration_create_table_transaksi extends CI_Migration {


	public function up()
	{ 
		$table = "transaksi";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],
			'travel_id'          => [
				'type' => 'TINYINT(4)',
			],
			'no_flight'          => [
				'type' => 'VARCHAR(20)',
			],
			'harga'          => [
				'type' => 'INT(11)',
			],
			'jumlah_pax'          => [
				'type' => 'INT(11)',
			],
			'keterangan'      => [
				'type' => 'VARCHAR(100)',
			],
			'keterangan_tambahan'      => [
				'type' => 'TEXT',
			],
			'tanggal_keberangkatan'      => [
				'type' => 'DATE',
			],
			'status'          => [
				'type' => 'INT(1)',
			],
			'created_at'      => [
				'type' => 'DATETIME',
			],
			'updated_at'      => [
				'type' => 'DATETIME',
			],
			'created_by'      => [
				'type' => 'TINYINT(4)',
			],
			'updated_by'      => [
				'type' => 'TINYINT(4)',
			],
			'is_deleted' => [
				'type' => 'TINYINT(4)',
			],
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "transaksi";
		if ($this->db->table_exists($table))
		{
			$this->db->query(drop_foreign_key($table, 'api_key'));
			$this->dbforge->drop_table($table);
		}
	}

}
