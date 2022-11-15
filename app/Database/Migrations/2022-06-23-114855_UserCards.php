<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserCards extends Migration
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
            'cardHolderName' => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL,
            ],
            'cardNumber' => [
                    'type'    => 'TEXT',
                    'default' =>  NULL,
            ],
            'expDate' => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  0
            ],
            'cardType' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  0
            ],
            'status' => [
                    'type'    => 'BOOLEAN',
                    'default' =>  0
            ],
            
            'createdDate datetime default current_timestamp',
            'updatedDate datetime default current_timestamp on update current_timestamp', 
        ]);
        $attributes = ['ENGINE' => 'InnoDB','CHARSET' => 'latin1','COLLATE' => 'latin1_swedish_ci'];
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('userID','tbl_users','id','CASCADE','CASCADE');
        $this->forge->createTable('tbl_userCards',TRUE,$attributes);
    }

    public function down()
    {
        $this->forge->createTable('tbl_userCards');
    }
}
