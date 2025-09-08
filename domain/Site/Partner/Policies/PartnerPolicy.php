<?php

declare(strict_types=1);

namespace Domain\Site\Partner\Policies;

use Domain\Access\Admin\Models\Admin;
use Domain\Access\Role\ChecksWildcardPermissions;
use Domain\Site\Partner\Models\Partner;

class PartnerPolicy
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

    public function update(Admin $user, Partner $partner): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function delete(Admin $user, Partner $partner): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function restore(Admin $user, Partner $partner): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function forceDelete(Admin $user, Partner $partner): bool
    {
        return $this->checkWildcardPermissions($user);
    }
}
