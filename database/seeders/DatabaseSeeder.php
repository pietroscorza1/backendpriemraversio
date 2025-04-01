<?php

namespace Database\Seeders;

use App\Models\Clase;
use App\Models\Entrenador;
use App\Models\Membresia;
use App\Models\Tarifa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Clase::truncate();
        Membresia::truncate();
        User::truncate();
        User::factory(10)->create();
        Entrenador::truncate();


        $userWithoutMembresia = User::factory()->create([
            'name' => 'Miquel Agudo',
            'email' => 'nomembresia@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        $userWithoutMembresia->assignRole('usuario');


        $userWithMembresia = User::factory()->create([
            'name' => 'Oscar Fumador',
            'email' => 'membresia@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        $userWithMembresia->assignRole('usuario');

        // Asignar membresía al usuario
        $userWithMembresia->membresia()->create([
            'user_id' => $userWithMembresia->id,
            'fecha_fin' => now()->addYear(),
            'qr_data' =>  Str::uuid()->toString(),
        ]);


        // Crear un administrador
        $admin = User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $admin->assignRole('admin');


        Entrenador::factory(5)->create();
    }
}
