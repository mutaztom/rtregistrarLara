<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Model\Staffuser;

class StaffuserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //insert into database admin user
        Staffuser::create(['name' => 'admin', 'email' => 'admin@example.com','password'=>Hash::make('mezopass'),
        'photo' => 'nophoto.png']);
    
    }
}
