<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Licence;

class LicenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licences = [
            'A1',
            'A2',
            'B1',
            'B2',
            'C1',
            'C2',
            'D1',
            'D2',
        ];

        foreach ($licences as $licence) {
            $newLicence = new Licence();
            $newLicence->category = $licence;
            $newLicence->save();
        }
    }
}
