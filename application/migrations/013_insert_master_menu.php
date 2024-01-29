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
class Migration_insert_master_menu extends CI_Migration {


	public function up()
	{ 
		// insert function value
		 $data_menu = array(
            array('id'=>1,'module_id'=>1, 'name'=>'root', 'url'=>'#', 'parent_id'=>0, 'icon'=>" ", 'sequence'	=>0),
            array('id'=>2,'module_id'=>1, 'name'=>'Dashboard', 'url'=>'dashboard', 'parent_id'=>1, 'icon'=>"fa fa-tachometer-alt", 'sequence'=>1),
            array('id'=>3,'module_id'=>1, 'name'=>'Kelola Akun', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa fa-users", 'sequence'=>1), 
            array('id'=>4,'module_id'=>1, 'name'=>'User', 'url'=>'user', 'parent_id'=>3, 'icon'=>"a fa-circle-o", 'sequence'=>2),
            array('id'=>5,'module_id'=>1, 'name'=>'Jabatan', 'url'=>'role', 'parent_id'=>3, 'icon'=>"a fa-circle-o", 'sequence'=>3),
            array('id'=>7,'module_id'=>1, 'name'=>'Master Data', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa fa-archive", 'sequence'=>4),
            array('id'=>8,'module_id'=>1, 'name'=>'Karyawan', 'url'=>'karyawan', 'parent_id'=>7, 'icon'=>"fa fa-circle-o", 'sequence'	=>1), 
            array('id'=>9,'module_id'=>1, 'name'=>'Travel', 'url'=>'travel', 'parent_id'=>7, 'icon'=>"fa fa-circle-o", 'sequence'	=>2), 
            array('id'=>10,'module_id'=>1, 'name'=>'Transaksi', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa fa-exchange-alt", 'sequence'=>2),
            array('id'=>11,'module_id'=>1, 'name'=>'Transaksi', 'url'=>'transaksi', 'parent_id'=>10, 'icon'=>"fa fa-circle-o", 'sequence'=>1), 
            array('id'=>12,'module_id'=>1, 'name'=>'Pengeluaran', 'url'=>'pengeluaran', 'parent_id'=>10, 'icon'=>"fa fa-circle-o", 'sequence'=>2),            
            array('id'=>13,'module_id'=>1, 'name'=>'Transaksi Belum Lunas', 'url'=>'transaksi/belum_lunas', 'parent_id'=>10, 'icon'=>"fa fa-circle-o", 'sequence'=>2),            
        );
        $this->db->insert_batch('menu', $data_menu); 
	} 

	public function down()
	{
		
	}

}