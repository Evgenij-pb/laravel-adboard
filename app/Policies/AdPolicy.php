<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Models\Ad;
class AdPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Ad $ad
     * @return bool
     */
    public function owner(User $user, Ad $ad)
    {
        return $user->id===$ad->user_id;
    }


}
