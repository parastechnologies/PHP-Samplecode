<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeviceTypes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'typeName'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'icon'   => [
                'type'     => 'VARCHAR',
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
        $this->forge->createTable('tbl_deviceTypes');
    }

    public function down()
    {
        $this->forge->createTable('tbl_deviceTypes');
    }
}
