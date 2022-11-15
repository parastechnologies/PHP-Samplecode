<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTheme extends Migration
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
            'themeID'  => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' =>  0
            ],
            'iconType'  => [
                'type'       => 'ENUM("Rectangular","Rounded")',
                'default' =>  NULL
            ],
            'userType'  => [
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
        $this->forge->addForeignKey('themeID','tbl_themes','id','CASCADE','CASCADE');
        $this->forge->createTable('tbl_userTheme');
    }
    public function down()
    {
        $this->forge->dropTable('tbl_userTheme');
    }
}
