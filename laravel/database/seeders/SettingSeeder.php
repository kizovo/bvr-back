<?php

namespace Database\Seeders;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        DB::table('settings')->insert([
            [
                'name'        => 'locale',
                'code'        => 'locale',
                'value'       => 'id',
                'type'        => 'select',
                'option'      => 'en|id',
                'group'       => 'general',
                'is_required' => 0,
                'is_enabled'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ],
            [
                'name'        => 'gender',
                'code'        => 'gender',
                'value'       => '',
                'type'        => 'select',
                'option'      => 'female|male',
                'group'       => 'general',
                'is_required' => 1,
                'is_enabled'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ]
        ]);
    }
}
