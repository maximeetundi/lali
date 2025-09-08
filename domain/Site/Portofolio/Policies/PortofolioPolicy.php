<?php

declare(strict_types=1);

namespace Domain\Site\Portofolio\Policies;

use Domain\Access\Admin\Models\Admin;
use Domain\Access\Role\ChecksWildcardPermissions;
use Domain\Site\Portofolio\Models\Portofolio;

class PortofolioPolicy
{
    use ChecksWildcardPermissions;

    public function viewAny(Admin $user): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function create(Admin $user): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function update(Admin $user, Portofolio $portofolio): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function delete(Admin $user, Portofolio $portofolio): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function restore(Admin $user, Portofolio $portofolio): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function forceDelete(Admin $user, Portofolio $portofolio): bool
    {
        return $this->checkWildcardPermissions($user);
    }
}
