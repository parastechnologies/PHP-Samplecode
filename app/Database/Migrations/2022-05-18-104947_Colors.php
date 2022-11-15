<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Colors extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'colorName'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'status' => [
                'type'    => 'BOOLEAN',
                'default' =>  0
            ],
            
            'createdDate datetime default current_timestamp',
            'updatedDate datetime default current_timestamp on update current_timestamp', 
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_colors');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_colors');
    }
}
