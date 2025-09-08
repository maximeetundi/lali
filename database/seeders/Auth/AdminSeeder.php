<?php

declare(strict_types=1);

namespace Database\Seeders\Auth;

use Domain\Access\Admin\Database\Factories\AdminFactory;
use Domain\Access\Role\Models\Permission;
use Domain\Access\Role\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminHashPassword = Hash::make('secret');

        if (blank($superAdminHashPassword)) {
            $this->command->getOutput()->error('SUPER_ADMIN_PASSWORD_HASH not defined in .env file.');
            exit();
        }

        $role = app(PermissionRegistrar::class)->getRoleClass();

        $rol = Role::where('name', 'super_admin')->first();
        $rol->givePermissionTo(Permission::all());

        AdminFactory::new()
            ->createOne([
                'admin_id' => null,
                'name' => 'usera',
                'email' => 'eemf4865@gmail.com',
                'password' => $superAdminHashPassword,
            ])
            ->assignRole($role::findByName(config('domain.access.role.super_admin'), 'admin'));


           
        unset($superAdminHashPassword);

        // AdminFactory::new()
        //     ->createOne([
        //         'name' => 'System',
        //         'email' => 'system@ecommerce.com',
        //     ])
        //     ->assignRole($role::findByName(config('domain.access.role.admin'), 'admin'));

        AdminFactory::new()
            ->createOne([
                'name' => 'Admin',
                'email' => 'admin@ecommerce.com',
                'password' => Hash::make('secret'),
            ])
            ->assignRole($role::findByName(config('domain.access.role.admin'), 'admin'));

        // AdminFactory::new()
        //     ->createOne([
        //         'name' => 'Employee',
        //         'email' => 'employee@ecommerce.com',
        //     ])
        //     ->assignRole($role::findByName('employee', 'admin'));

        // AdminFactory::new()
        //     ->createOne([
        //         'name' => 'Employee 2',
        //         'email' => 'employee2@ecommerce.com',
        //     ])
        //     ->assignRole($role::findByName('employee', 'admin'));

        // AdminFactory::new()
        //     ->createOne([
        //         'name' => 'Demo',
        //         'email' => self::demoEmail(),
        //         'password' => self::demoPassword(),
        //     ])
        //     ->assignRole($role::findByName('demo', 'admin'));

        // AdminFactory::new()
        //     ->createOne([
        //         'name' => 'No Role',
        //         'email' => 'no-reles@ecommerce.com',
        //     ]);
    }

    // public static function demoEmail(): string
    // {
    //     return 'demo@ecommerce.com';
    // }

    public static function demoPassword(): string
    {
        return app()->isLocal() ? 'secret' : 'K5D@P^y#Z9v778v7DX9u3#T@mNfVmS';
    }
}
