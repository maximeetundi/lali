<?php

declare(strict_types=1);

namespace Domain\Site\MissionFaq\Policies;

use Domain\Access\Admin\Models\Admin;
use Domain\Access\Role\ChecksWildcardPermissions;
use Domain\Site\MissionFaq\Models\MissionFaq;

class MissionFaqPolicy
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

    public function update(Admin $user, MissionFaq $missionFaq): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function delete(Admin $user, MissionFaq $missionFaq): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function restore(Admin $user, MissionFaq $missionFaq): bool
    {
        return $this->checkWildcardPermissions($user);
    }

    public function forceDelete(Admin $user, MissionFaq $missionFaq): bool
    {
        return $this->checkWildcardPermissions($user);
    }
}
