<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class isiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'role'=>'admin',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=>'Petugas',
                'email'=>'petugas@gmail.com',
                'role'=>'petugas',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=>'Peminjam',
                'email'=>'peminjam@gmail.com',
                'role'=>'peminjam',
                'password'=>bcrypt('123456')
            ],
            ];

            foreach($userData as $key => $val){
              User::create($val);
            }
    }
    }

