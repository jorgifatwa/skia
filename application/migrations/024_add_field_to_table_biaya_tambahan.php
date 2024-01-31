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
class Migration_add_field_to_table_biaya_tambahan extends CI_Migration {


	public function up()
    {
        $field = array(
            'fee' => [
                'type' => 'INT(50)', 
				'default' => 0// Change the type accordingly
                // Add any other configuration options as needed
            ],
        );
        $this->dbforge->add_column('biaya_tambahan', $field);
    }

    public function down()
    {
        $this->dbforge->drop_column('biaya_tambahan', 'fee');
    }
}
