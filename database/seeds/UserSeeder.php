<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;

class UserSeeder extends Seeder
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
                'name' => 'Kasir',
                'email' => 'kasir@example.com',
                'password' => bcrypt('password'),
                'role' => 'kasir',
            ],
            [
                'name' => 'Pelayan',
                'email' => 'pelayan@example.com',
                'password' => bcrypt('password'),
                'role' => 'pelayan',
            ]
        ];

        foreach ($data as $item) {
            
            $user = User::where('email',$item['email'])->first();

            if(!$user){

                $role = Role::where('name',$item['role'])->first()->id;
                unset($item['role']);
                $user = User::Create($item);
                $user->roles()->attach($role);
            }
                
        }
    }
}
