<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderItems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'itemID'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'orderID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'productID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'colorID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  0
            ],
            'itemPrice' => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
                'default' =>  0.00
            ],
            'itemQty' => [
                'type'       => 'INT',
                'constraint' => '50',
                'default' =>  0
            ],
            'itemQtyPrice' => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
                'default' =>  0.00  
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  0.00  
            ],
             'isCustom' => [
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
        $this->forge->addKey('itemID', true);
        $this->forge->addForeignKey('orderID','tbl_orders','orderID','CASCADE','CASCADE');
        $this->forge->addForeignKey('productID','tbl_products','id','CASCADE','CASCADE');
        $this->forge->createTable('tbl_orderItems');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_orderItems');
    }
}
