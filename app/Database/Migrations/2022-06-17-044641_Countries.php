<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Countries extends Migration
{
  public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'  => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'countryName'   => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' =>  NULL
            ],
            'countryCode' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' =>  NULL
            ],
            'dialCode' => [
                'type'  => 'VARCHAR',
                'constraint' => '50',
                'default' =>  NULL
            ],
            'currency' => [
                'type'  => 'VARCHAR',
                'constraint' => '50',
                'default' =>  NULL
            ],
            'currencySymbol' => [
                'type'  => 'VARCHAR',
                'constraint' => '50',
                'default' =>  NULL
            ],
             'currencyCode' => [
                'type'  => 'VARCHAR',
                'constraint' => '50',
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
        $this->forge->createTable('tbl_countries',TRUE,$attributes);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_countries');
    }
}
