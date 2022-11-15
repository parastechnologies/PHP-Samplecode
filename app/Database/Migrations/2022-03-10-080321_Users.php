<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		 $this->forge->addField([
                'id'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'auto_increment' => true,
                ],
                'firstName'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'lastName'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'email'   => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'password'  => [
                        'type'       => 'VARCHAR',
                        'constraint' => '255',
                        'default' =>  NULL
                ],
                'userProfile' => [
                        'type'       => 'VARCHAR',
                        'constraint' => '255',
                        'default' =>  NULL
                ],
                'designation' => [
                        'type'       => 'VARCHAR',
                        'constraint' => '255',
                        'default' =>  NULL
                ],
                'description' => [
                        'type'       => 'TEXT',
                        'default' =>  NULL
                ],
                'latitude'  => [
                        'type'       => 'VARCHAR',
                        'constraint' => '255',
                        'default' =>  NULL
                ],
                'longitude'  => [
                        'type'       => 'VARCHAR',
                        'constraint' => '255',
                        'default' =>  NULL
                ],
                'deviceToken'       => [
                        'type'       => 'LONGTEXT',
                        'default' =>  NULL
                ],
                'deviceType'       => [
                        'type'       => 'VARCHAR',
                        'constraint' => '100',
                        'default' =>  NULL
                ],
                'deviceId'  => [
                    'type'  => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'QRCode' => [
                        'type'       => 'VARCHAR',
                        'constraint' => '255',
                        'default' =>  NULL
                ],
                'otp' => [
                        'type'       => 'VARCHAR',
                        'constraint' => '50',
                        'default' =>  NULL
                ],
                'dob' => [
                        'type'       => 'VARCHAR',
                        'constraint' => '255',
                        'default' =>  NULL
                ],
                'isProfile'       => [
                    'type'       => 'INT',
                    'default' =>  0,
                    'comment' => "1 = signup,2= create profile"
                ],
                'status'       => [
                    'type'       => 'BOOLEAN',
                    'default' =>  0,
                    'comment' => "1 = activate,2= deactivate,3 = suspended"
                ],
                'isLoggedIN' => [
                    'type'       => 'BOOLEAN',
                    'default' =>  0,
                ],
                'isDirectLink' => [
                    'type'       => 'BOOLEAN',
                    'default' =>  0,
                ],
                'profileLink'   => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255',
                    'default' =>  NULL
                ],
                'isSkip' => [
                    'type'       => 'BOOLEAN',
                    'default' =>  0,
                ],
                'isSuspended'       => [
                    'type'       => 'BOOLEAN',
                    'default' =>  1,
                    'comment' => "0 = deactivate,1= activate"
                ],
                'isWeb' => [
                    'type'       => 'BOOLEAN',
                    'default' =>  0,
                    'comment' => "0 = APP,1= web"
                ],
                'isLogout' => [
                    'type'       => 'BOOLEAN',
                    'default' =>  0,
                    'comment' => "0 = login,1= logout"
                ],
                
                'language'   => [
                     'type'       => 'ENUM',
                        'constraint' => ['en', 'fr'],
                        'default'    => 'en',
                ],
                'createdDate datetime default current_timestamp',
                'updatedDate datetime default current_timestamp on update current_timestamp', 
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('tbl_users');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_users');
	}
}
