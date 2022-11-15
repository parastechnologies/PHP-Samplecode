<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Analytics extends Migration
{
    public function up()
    {
          $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'userID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  0
            ],
            'accountID' => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  0
            ],
            'deviceID' => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  0
            ],
            'deviceNumber'  => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'userType'  => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'count' => [
                'type'    => 'INT',
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
        $this->forge->addForeignKey('userID','tbl_users','id','CASCADE','CASCADE');
        $this->forge->createTable('tbl_analytics');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_analytics');
    }
}
