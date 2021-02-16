<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EnterprisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enterprises')->insert([
            [
                'id' => 1,
                'rut' => '123456789',
                'bussiness_name' => 'rznsocial',
                'bussiness' => 'giro',
                'bussiness_code' => 'acteco',
                'address' => 'address',
                'commune' => 'comuna',
                'city' => 'city'
            ],
            [
                'id' => 2,
                'rut' => '987456321',
                'bussiness_name' => 'Laboratorio Suzio',
                'bussiness' => 'Laboratorio',
                'bussiness_code' => 'Farmacia',
                'address' => 'Siempre viva #432',
                'commune' => 'Santiago',
                'city' => 'Santiago'
            ],
        ]);
    }
}
