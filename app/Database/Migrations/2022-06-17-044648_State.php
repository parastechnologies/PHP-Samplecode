<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class State extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'  => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'name'   => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'countryID' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'countryCode' => [
                'type'  => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'fipsCode' => [
                'type'  => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'iso2' => [
                'type'  => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
             'type' => [
                'type'  => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'latitude' => [
                'type'  => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'longitude' => [
                'type'  => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'flag' => [
                'type'  => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'wikiDataId' => [
                'type'  => 'VARCHAR',
                'constraint' => '255',
                'default' =>  NULL
            ],
            'status' => [
                'type'  => 'BOOLEAN',
                'default' =>  0
            ],
            'createdDate datetime default current_timestamp',
            'updatedDate datetime default current_timestamp on update current_timestamp', 
        ]);
        $attributes = ['ENGINE' => 'InnoDB','CHARSET' => 'utf8','COLLATE' => 'utf8_unicode_ci'];
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_states',TRUE,$attributes);
    }
    public function down()
    {
        $this->forge->createTable('tbl_states');
    }
}
