<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<=13; $i++ ) {
        DB::table('units')->insert([
            'unit_no' => 'GL    '.''.$i,
            'floor_no' => 'G',
            'type_of_units' => 'residential',
            'unit_property' => 'North Cambridge',
            'building' => 'Harvard',
            'beds' => '2',
            'monthly_rent' => '6800',
            'status' => 'vacant',
        ]);
        }
    }
}
