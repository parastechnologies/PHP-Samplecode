<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserPlateforms extends Migration
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
            'platformID'  => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  0
            ],
            'userType'  => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'phoneCode' => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'countryCode' => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'profileSlug'   => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'profileLink'   => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
            ],
            'order'  => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  0
            ],
            'isDefault' => [
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
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('userID','tbl_users','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('platformID','tbl_plateforms','id','CASCADE','CASCADE');
        $this->forge->createTable('tbl_userPlateforms');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_userPlateforms');
    }
}
