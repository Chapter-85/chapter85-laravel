<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            array(
                'name' => 'MG Metals Administrator',
                'email' => 'admin@mg-metals.com',
                'customer_type' => 'corporate',
                'password' => bcrypt('password'),
            )
        );
    }
}
