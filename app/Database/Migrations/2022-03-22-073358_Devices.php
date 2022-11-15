<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Devices extends Migration
{
    public function up()
    {
            $this->forge->addField([
                'id'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'auto_increment' => true,
                ],
                'deviceName'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'deviceNumber'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'deviceModel'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'deviceURL'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'qrCode'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'deviceType'     => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'icon'   => [
                    'type'     => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'activeStatus' => [
                    'type'    => 'BOOLEAN',
                    'default' =>  0
                ],
                'status' => [
                    'type'    => 'BOOLEAN',
                    'default' =>  0
                ],
                'createdDate datetime default current_timestamp',
                'updatedDate datetime default current_timestamp on update current_timestamp', 
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('tbl_devices');
        }

    public function down()
    {
        //
    }
}
