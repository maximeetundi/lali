<?php

declare(strict_types=1);

namespace Database\Seeders\Auth;

use Domain\Access\Role\Support;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Commands\CreateRole;
use Spatie\Permission\Contracts\Permission as PermissionContract;

class RoleSeeder extends Seeder
{
    public function __construct(
        private readonly PermissionContract $permissionContract,
    ) {
    }

    public function run(): void
    {
        foreach (config('domain.access.role') as $roleName) {
            Artisan::call(CreateRole::class, [
                'name' => $roleName,
                'guard' => 'admin',
                'permissions' => 'admin' === $roleName
                    ? $this->permissionContract
                        ->where('guard_name', 'admin')
                        ->pluck('name')
                        ->implode('|')
                    : null,
            ]);
        }

        Artisan::call(CreateRole::class, [
            'name' => 'employee',
            'guard' => 'admin',
            'permissions' => 'panel.admin|order|customer',
        ]);

        Artisan::call(CreateRole::class, [
            'name' => 'branch',
            'guard' => 'admin',
            'permissions' => 'product.viewAny|order|skuStock',
        ]);

        Artisan::call(CreateRole::class, [
            'name' => 'demo',
            'guard' => 'admin',
            'permissions' => implode('|', [
                'panel',
                'admin.viewAny',
                'role.viewAny',
                'order',
                'customer',
                'activity',
                'category',
                'brand',
                'product',
                'attribute',
                'skuStock',
                Support::WIDGETS,
                Support::PAGES,
            ]),
        ]);

    }
}
