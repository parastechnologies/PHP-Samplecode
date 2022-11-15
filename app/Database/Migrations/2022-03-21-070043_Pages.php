<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pages extends Migration
{
    public function up()
	{
		 $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'title'          => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'content'          => [
                'type'       => 'TEXT',
                'default' =>  NULL
            ],
            'pageImage' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'type'          => [
                'type'       => 'VARCHAR',
                 'constraint' => '100',
                'default' =>  NULL
            ],
            'status'       => [
                'type'       => 'BOOLEAN',
                'default' =>  0
            ],
                'createdDate datetime default current_timestamp',
                'updatedDate datetime default current_timestamp',
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('tbl_pages');
	}

    public function down()
    {
        $this->forge->dropTable('tbl_pages');
    }
}
