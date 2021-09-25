<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tbl_account')->insert([
           'username'=>'quoctienpham',
           'email'=>'quoctienpham.ptit@gmail.com',
           'thumbnail'=>'upload/',
           'birthday'=>time(),
           'role'=>1,
           'password'=>bcrypt('123456')
        ]);
    }
}
