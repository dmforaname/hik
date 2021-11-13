<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'kasir',],
            ['name' => 'pelayan',],
        ];

        foreach ($data as $item) {
            
            $role = Role::where('name',$item['name'])->first();

            if(!$role)
                Role::firstOrCreate($item);
        }
    }
}
