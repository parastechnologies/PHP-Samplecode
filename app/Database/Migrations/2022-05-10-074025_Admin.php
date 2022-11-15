<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
	{
		$this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'password'   => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'phoneNumber'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'profileImage'  => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'address'       => [
                'type'       => 'TEXT',
                'default' =>  NULL
            ],
            'status' => [
                'type'    => 'BOOLEAN',
                'default' =>  0
            ],
            'expDate' =>[
                'type'    => 'datetime',
                'default' =>  NULL
            ],
            'createdDate datetime default current_timestamp',
            'updatedDate datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_admin');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_mi_admin');
	}
}