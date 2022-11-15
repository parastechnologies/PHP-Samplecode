<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'orderID'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'userID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'cardID'  => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'shippingAddressID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'bilingAddressID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'orderNumber'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'subTotal'       => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
                'default' =>  0.00
            ],
            'discount'       => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
                'default' =>  0.00
            ],
            'shipping'       => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
                'default' =>  0.00
            ],
            'tax'       => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
                'default' =>  0.00
            ],
            'grandTotal'       => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
                'default' =>  0.00
            ],
            'commission'       => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
                'default' =>  0.00
            ],
            'transactionID'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'deliverDate'       => [
                'type'       => 'DATE',
                'default' =>  NULL
            ],
            'transactionDate'       => [
                'type'       => 'DATE',
                'default' =>  NULL
            ],
           'userStatus' => [
                'type'    => 'INT',
                'constraint' => '11',
                'default' =>  0,
                'comments' => "0 = pending,1=confirm,2=payment success,3=payment failed,4=cancel"
            ],
            'status' => [
                'type'    => 'INT',
                'constraint' => '11',
                'default' =>  0,
                'comments' => "0 = pending,1=confirm/process,2=pickup,3=deliverd,4=cancel,5=refund"
            ],
            
            'createdDate datetime default current_timestamp',
            'updatedDate datetime default current_timestamp on update current_timestamp', 
        ]);
        $this->forge->addKey('orderID', true);
        $this->forge->addForeignKey('userID','tbl_users','id','CASCADE','CASCADE');
        $this->forge->createTable('tbl_orders');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_orders');
    }
}
