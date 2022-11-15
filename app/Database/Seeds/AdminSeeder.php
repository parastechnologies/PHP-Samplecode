<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
                [
                'id' => 1,
                'name' => 'admin',
                'email' => 'amandeep.parastechnologies@gmail.com',
                'password' => '$2y$10$dPfxL5sY7ApDXjN5eHwAp.mCXyYevOVWpucAu9G83eZtxZ5lvBsCS',
                'phoneNumber' => '+919638527410',
                'profileImage' => '',
                'address' => '#123,Mohali',
                'status' => '1',
            ],
        ];
        $this->db->table('tbl_admin')->insertBatch($data);
    }
}
