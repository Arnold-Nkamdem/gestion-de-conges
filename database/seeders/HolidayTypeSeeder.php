<?php

namespace Database\Seeders;

use App\Models\HolidayType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HolidayTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HolidayType::create([
            'holiday_label' => 'Congé parental',
        ]);
        
        HolidayType::create([
            'holiday_label' => 'Congé de maternité',
        ]);
        
        HolidayType::create([
            'holiday_label' => 'Congé annuel',
        ]);
    }
}
