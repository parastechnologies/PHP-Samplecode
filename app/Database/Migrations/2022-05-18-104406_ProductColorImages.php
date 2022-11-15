<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductColorImages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'productID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'colorID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'image' => [
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
        $this->forge->addForeignKey('colorID','tbl_colors','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('productID','tbl_products','id','CASCADE','CASCADE');
        $this->forge->createTable('tbl_productColorImages');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_productColorImages');
    }
}
