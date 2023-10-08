<?php

namespace Domain\PrintedDesigns\Policies;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrintedDesignPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, PrintedDesign $printedDesign): bool
    {
        return $user->id === $printedDesign->user_id;
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, PrintedDesign $printedDesign): bool
    {
        return $user->id === $printedDesign->user_id;
    }

    public function delete(User $user, PrintedDesign $printedDesign): bool
    {
        return $user->id === $printedDesign->user_id;
    }

    public function restore(User $user, PrintedDesign $printedDesign)
    {
        //
    }

    public function forceDelete(User $user, PrintedDesign $printedDesign)
    {
        //
    }
}
