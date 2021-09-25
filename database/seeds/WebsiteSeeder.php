<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_website')->insert(
            [
                'title' => 'Demo TV',
                'lang_id' => '1',
                'logo' => 'upload/'
            ]
        );
        DB::table('tbl_website')->insert(
            [
                'title' => 'Demo English',
                'lang_id' => '2',
                'logo' => 'upload/'
            ]
        );
    }
}
