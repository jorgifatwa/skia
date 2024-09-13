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
class Migration_remove_and_add_asal_on_testimoni extends CI_Migration {


	public function up()
    {
        $this->dbforge->drop_column('testimoni', 'gambar');
        $field = array(
            'asal' => [
                'type' => 'TEXT',
            ],
        );
        $this->dbforge->add_column('testimoni', $field);
    }

    public function down()
    {
        $this->dbforge->drop_column('testimoni', 'asal');
    }
}
