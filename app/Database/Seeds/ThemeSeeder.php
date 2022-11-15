<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        $data = [
        [        
            'id' => '1',
            'name' => 'Dark Blue',
            'color' => '#303F9F',
            'status' => '1',
        ],
        [
            'id' => '2',
            'name' => 'Brown',
            'color' => '#FF5722',
            'status' => '1',
        ],[
            'id' => '3',
            'name' => 'Black',
            'color' => '#000000',
            'status' => '1',
        ],[
            'id' => '4',
            'name' => 'White',
            'color' => '#FFFFFF',
            'status' => '1',
        ],[
            'id' => '6',
            'name' => 'Grey',
            'color' => '#808080',
            'status' => '1',
        ]
        ];
        $this->db->table('tbl_themes')->insertBatch($data);
        echo $this->db->getLastQuery();
    }
}





