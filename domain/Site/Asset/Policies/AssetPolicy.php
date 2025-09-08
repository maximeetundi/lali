<?php

declare(strict_types=1);

namespace Domain\Site\Asset\Policies;

use Domain\Access\Admin\Models\Admin;
use Domain\Access\Role\ChecksWildcardPermissions;
use Domain\Site\Asset\Models\Asset;

class AssetPolicy
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

    public function update(Admin $user, Asset $asset): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function delete(Admin $user, Asset $asset): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function restore(Admin $user, Asset $asset): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function forceDelete(Admin $user, Asset $asset): bool
    {
        return $this->checkWildcardPermissions($user);
    }
}
