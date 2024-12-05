<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Company::where('id', 1)->exists()) {
            Company::create([
                'business_name' => 'Jitte Technology LTDA',
                'national_register_of_legal_entities' => '05882701481',
                'address' => 'Rua Eulália Resende Pereira, 299, Serrotão, Campina Grande - PB',
                'postal_code' => '58434110',
                'site' => 'https://www.jitte.com.br',
                'contact' => '83993348144',
            ]);
        }
    }
}
