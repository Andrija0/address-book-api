<?php

namespace App\Policies;

use App\Agency;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgencyPolicy
{
    use HandlesAuthorization;

    public function any($user) {
        return $user->isAdmin();
    }
}
