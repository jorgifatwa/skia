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
class Migration_insert_menu_galeri_testimoni extends CI_Migration {


	public function up()
	{ 
		// insert function value
		 $data_menu = array(         
            array('id'=>16,'module_id'=>1, 'name'=>'Galeri', 'url'=>'galeri', 'parent_id'=>7, 'icon'=>"fa fa-circle-o", 'sequence'=>4),            
            array('id'=>17,'module_id'=>1, 'name'=>'Testimoni', 'url'=>'testimoni', 'parent_id'=>7, 'icon'=>"fa fa-circle-o", 'sequence'=>5),            
        );
        $this->db->insert_batch('menu', $data_menu); 
	} 

	public function down()
	{
		
	}

}