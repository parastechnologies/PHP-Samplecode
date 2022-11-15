<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SocialLinks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'icon'  => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'link'  => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'type'  => [
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
        $this->forge->createTable('tbl_socialLinks');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_socialLinks');
    }
}
