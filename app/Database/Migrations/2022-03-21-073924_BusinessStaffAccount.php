<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BusinessStaffAccount extends Migration
{
    public function up()
        {
            $this->forge->addField([
                'SID'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'auto_increment' => true,
                ],
                'userID'       => [
                    'type'       => 'INT',
                    'constraint' => '11',
                    'default' =>  NULL
                ],
                'BID'       => [
                    'type'       => 'INT',
                    'constraint' => '11',
                    'default' =>  NULL
                ],
                'name'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'email'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'phoneCode'     => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'phoneNumber'   => [
                    'type'     => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'designation'   => [
                    'type'   => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'profileImage'   => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'qrCode'   => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                 'profileLink'   => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'countryCode' => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'status' => [
                    'type'    => 'BOOLEAN',
                    'default' =>  0
                ],
                'isDelete' => [
                    'type'    => 'BOOLEAN',
                    'default' =>  0
                ],
                'createdDate datetime default current_timestamp',
                'updatedDate datetime default current_timestamp on update current_timestamp', 
            ]);
            $this->forge->addKey('SID', true);
            $this->forge->addForeignKey('userID','tbl_users','id','CASCADE','CASCADE');
            $this->forge->addForeignKey('BID','tbl_businessAccount','BID','CASCADE','CASCADE');
            $this->forge->createTable('tbl_businessStaffAccount');
        }

    public function down()
    {
        $this->forge->dropTable('tbl_businessStaffAccount');
    }
}
