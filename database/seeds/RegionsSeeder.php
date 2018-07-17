<?php

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          'Nordjylland',
          'Midtjylland',
          'Syddanmark',
          'Hovedstaden',
          'Sjælland'
        ];
        foreach ($data as $row) {
            $obj = new Region();
            $obj->name = $row;
            $obj->save();
        }
//        Region::Create($data);
    }
}
