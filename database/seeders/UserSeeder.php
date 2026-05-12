<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            ['name' => 'Director General',  'email' => 'director@cepnira.mx',    'rol' => 'director'],
            ['name' => 'Subdirector',        'email' => 'subdirector@cepnira.mx', 'rol' => 'subdirector'],
            ['name' => 'Secretaria',         'email' => 'secretaria@cepnira.mx',  'rol' => 'secretaria'],
            ['name' => 'Docente Ejemplo',    'email' => 'docente@cepnira.mx',     'rol' => 'docente'],
        ];

        foreach ($usuarios as $u) {
            User::create([...$u, 'password' => Hash::make('cepnira123')]);
        }
    }
}