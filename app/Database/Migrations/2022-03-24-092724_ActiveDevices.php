<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ActiveDevices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'userID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'profileID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'deviceID' => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'deviceNumber' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'userType' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'deviceType' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'deviceName' => [
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
        $this->forge->addForeignKey('userID','tbl_users','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('deviceID','tbl_devices','id','CASCADE','CASCADE');
        $this->forge->createTable('tbl_activeDevices');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_activeDevices');
    }
}
