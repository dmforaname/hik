<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'      => 'nasi putih',
                'price'     => 5000,
                'is_ready'  => 1,
                'category'  => 'makanan'
            ],
            [
                'name'      => 'ayam goreng',
                'price'     => 18000,
                'is_ready'  => 1,
                'category'  => 'makanan'
            ],
            [
                'name'      => 'ikan mas goreng',
                'price'     => 15000,
                'is_ready'  => 1,
                'category'  => 'makanan'
            ],
            [
                'name'      => 'cah kangkung',
                'price'     => 10000,
                'is_ready'  => 1,
                'category'  => 'makanan'
            ],
            [
                'name'      => 'sayur asem',
                'price'     => 10000,
                'is_ready'  => 1,
                'category'  => 'makanan'
            ],
            [
                'name'      => 'ayam bakar',
                'price'     => 18000,
                'is_ready'  => 1,
                'category'  => 'makanan'
            ],

            [
                'name'      => 'es teh manis',
                'price'     => 5000,
                'is_ready'  => 1,
                'category'  => 'minuman'
            ],
            [
                'name'      => 'es teh tawar',
                'price'     => 2000,
                'is_ready'  => 1,
                'category'  => 'minuman'
            ],
            [
                'name'      => 'es jeruk',
                'price'     => 10000,
                'is_ready'  => 1,
                'category'  => 'minuman'
            ],
            [
                'name'      => 'jeruk hangat',
                'price'     => 10000,
                'is_ready'  => 1,
                'category'  => 'minuman'
            ],
            [
                'name'      => 'teh manis',
                'price'     => 5000,
                'is_ready'  => 1,
                'category'  => 'minuman'
            ],
            [
                'name'      => 'teh tawar',
                'price'     => 2000,
                'is_ready'  => 1,
                'category'  => 'minuman'
            ],


        ];

        foreach ($data as $item) {
            
            Menu::firstOrCreate($item);
        }
    }
}
