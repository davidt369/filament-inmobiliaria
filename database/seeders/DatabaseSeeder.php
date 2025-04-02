<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Feature;
use App\Models\Location;
use App\Models\Owner;
use App\Models\Price;
use App\Models\Property;
use App\Models\Report;
use App\Models\Service;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'vendedor', 'guard_name' => 'web']);
        Role::create(['name' => 'cliente', 'guard_name' => 'web']);

        // Crear usuario administrador
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Asegúrate de cambiar esto en producción
        ]);
        
        // Asignar rol de admin
        $admin->assignRole($adminRole);

        // Crear los registros para cada modelo
        Category::factory(10)->create();
        Feature::factory(100)->create();
        Location::factory(100)->create();
        Owner::factory(100)->create();
        Price::factory(100)->create();
        Type::factory(20)->create();
        Service::factory(14)->create();
        
        // Crear 100 propiedades después de tener los otros registros
        Property::factory(100)->create();

        // Crear usuarios adicionales y asignarles rol de cliente
        User::factory(100)->create()->each(function ($user) {
            $user->assignRole('cliente');
        });

        // Crear clientes y reportes
        Client::factory(50)->create();
        Report::factory(200)->create();
    }
}
