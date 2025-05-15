<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    public function run(): void
    {
        $specializations = [
            'eyes',
            'head',
            'body',
        ];

        foreach ($specializations as $name) {
            Specialization::firstOrCreate(['name' => $name]);
        }
    }
}
