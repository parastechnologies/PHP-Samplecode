<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BusinessAccount extends Migration
{
   public function up()
    {
        $this->forge->addField([
            'BID'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'userID'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  NULL
            ],
            'businessName' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'businessDescription'  => [
                'type'       => 'TEXT',
                'default' =>  NULL
            ],
            'businessProfile'   => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'qrCode'   => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
            ],
             'isDirectLink' => [
                    'type'       => 'BOOLEAN',
                    'default' =>  0,
            ],
            'profileLink' => [
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
        $this->forge->addKey('BID', true);
        $this->forge->addForeignKey('userID','tbl_users','id','CASCADE','CASCADE');
        $this->forge->createTable('tbl_businessAccount');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_businessAccount');
    }
}
