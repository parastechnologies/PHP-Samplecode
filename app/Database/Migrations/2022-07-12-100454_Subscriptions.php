<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subscriptions extends Migration
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
            'transactionID' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL,
                'comment' => 'purchaseToken or originalTransactionId'
            ],
            'orderID' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL,
            ],
            'plan'   => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL,
                'comment' => 'yearly,monthly'
            ],
            'source'   => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL,
                'comment' => 'ios or android'
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
        $this->forge->createTable('tbl_subscriptions');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_subscriptions');
    }
}
