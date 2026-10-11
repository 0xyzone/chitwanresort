<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\RoomCategory;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class RoomCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:RoomCategory');
    }

    public function view(AuthUser $authUser, RoomCategory $roomCategory): bool
    {
        return $authUser->can('View:RoomCategory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:RoomCategory');
    }

    public function update(AuthUser $authUser, RoomCategory $roomCategory): bool
    {
        return $authUser->can('Update:RoomCategory');
    }

    public function delete(AuthUser $authUser, RoomCategory $roomCategory): bool
    {
        return $authUser->can('Delete:RoomCategory');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:RoomCategory');
    }

    public function restore(AuthUser $authUser, RoomCategory $roomCategory): bool
    {
        return $authUser->can('Restore:RoomCategory');
    }

    public function forceDelete(AuthUser $authUser, RoomCategory $roomCategory): bool
    {
        return $authUser->can('ForceDelete:RoomCategory');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:RoomCategory');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:RoomCategory');
    }

    public function replicate(AuthUser $authUser, RoomCategory $roomCategory): bool
    {
        return $authUser->can('Replicate:RoomCategory');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:RoomCategory');
    }
}
