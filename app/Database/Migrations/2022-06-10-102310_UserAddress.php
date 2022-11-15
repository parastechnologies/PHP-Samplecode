<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserAddress extends Migration
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
                'default' =>  NULL
            ],
            'orderID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'companyName' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'firstName' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'lastName' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'phoneNumber' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'countryCode'   => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default' =>  NULL
            ],
            'stateID'   => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'address'  => [
                'type'       => 'TEXT',
                'default' =>  NULL
            ],
            'apartment'   => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'city'       => [
                 'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'zipcode'       => [
                 'type'    => 'VARCHAR',
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
        $this->forge->addForeignKey('orderID','tbl_orders','orderID','CASCADE','CASCADE');
        $this->forge->createTable('tbl_userAddress');
    }

    public function down()
    {
         $this->forge->createTable('tbl_userAddress');
    }
}
