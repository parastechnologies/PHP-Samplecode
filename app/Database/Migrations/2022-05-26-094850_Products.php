<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
          $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'description'       => [
                'type'       => 'TEXT',
                'default' =>  NULL
            ],
            'compatibility'       => [
                'type'       => 'TEXT',
                'default' =>  NULL
            ],
            'shipping'       => [
                'type'       => 'TEXT',
                'default' =>  NULL
            ],
            'price'       => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
                'default' =>  0.00
            ],
            'deviceTypeID'          => [
                'type'           => 'INT',
                'constraint'     => 11,
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
        $this->forge->createTable('tbl_products');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_products');
    }
}
