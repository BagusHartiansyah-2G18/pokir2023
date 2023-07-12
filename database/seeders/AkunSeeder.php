<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =[
            [
                'username'  => '@ding',
                'name'      => 'Admin',
                'email'     => '',
                'kdJaba'    => '2',
                'password'  => bcrypt('0a0s0d'),
            ],[
                'username'  => '@mik',
                'name'      => 'Admin',
                'email'     => '',
                'kdJaba'    => '2',
                'password'  => bcrypt('a0a9a8'),
            ],
        ];

        foreach ($user as $key => $v){
            User::create($v);
        }
    }
}
