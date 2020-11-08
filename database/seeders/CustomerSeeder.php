<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customers')->insert([
            'username'=>'Nishant Jangid',
            'email'=>'nish@gmail.com',
            'password'=>Hash::make('12345'),
            'address'=>'New geeta colony, Ajmer',
            'mobile'=>'7690846594'
        ]);
        
    }
}
