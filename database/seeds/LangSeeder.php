<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_lang')->insert([
            'title'=>'Tiếng việt',
            'url'=>'vn',
            'thumbnail'=>'upload/',
            'default'=>1
        ]
         );
         DB::table('tbl_lang')->insert([
            'title'=>'English',
            'url'=>'en',
            'thumbnail'=>'upload/',
            'default'=>0,
         ]
         );
    }
}
