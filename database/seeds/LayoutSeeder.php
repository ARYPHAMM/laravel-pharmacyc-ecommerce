<?php

use Illuminate\Database\Seeder;

class LayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_layout')->insert(
            [
                'name' => 'layout-header',
                'group' => 'menu-center',
                'value' => '',
            ]
        );
    }
}
