<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $qty = 20;

        $moeHash = Hash::make('moe');

        Company::create([
            'fantasy_name' => 'Empresa MOE',
            'social_reason' => 'Empresa MOE Ltda.',
            'cnpj' => '01.567.601/0001-43',
            'email' => 'empresa@moe.com',
            'password' => $moeHash,
            'state_id' => 10,
            'city_id' => 1
        ]);

        Company::factory([
            'password' => $moeHash
        ])->count($qty)->create();

    }
}
