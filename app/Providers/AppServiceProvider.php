<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Crear permisos si no existen
        if (!Permission::where('name', 'admin')->exists()) {
            Permission::create(['name' => 'admin']);
        }

        if (!Permission::where('name', 'entrenador')->exists()) {
            Permission::create(['name' => 'entrenador']);
        }

        if (!Permission::where('name', 'usuario')->exists()) {
            Permission::create(['name' => 'usuario']);
        }

        // Crear roles si no existen y asignar permisos
        if (!Role::where('name', 'admin')->exists()) {
            $roleAdmin = Role::create(['name' => 'admin']);
            $roleAdmin->givePermissionTo('admin'); // Asignar el permiso 'admin'
        }

        if (!Role::where('name', 'entrenador')->exists()) {
            $roleEntrenador = Role::create(['name' => 'entrenador']);
            $roleEntrenador->givePermissionTo('entrenador'); // Asignar el permiso 'entrenador'
        }

        if (!Role::where('name', 'usuario')->exists()) {
            $roleUsuario = Role::create(['name' => 'usuario']);
            $roleUsuario->givePermissionTo('usuario'); // Asignar el permiso 'usuario'
        }
        $authServiceProvider = new AuthServiceProvider($this->app);
        $authServiceProvider->define_gates();
    }
}
