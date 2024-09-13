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
class Migration_add_field_to_table_blog extends CI_Migration {


	public function up()
    {
        $field = array(
            'gambar' => [
                'type' => 'TEXT',
            ],
        );
        $this->dbforge->add_column('blog', $field);
    }

    public function down()
    {
        $this->dbforge->drop_column('blog', 'gambar');
    }
}
