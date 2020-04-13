<?php

namespace Pingu\Block\Entities\Policies;

use Pingu\Block\Entities\Block;
use Pingu\Entity\Contracts\BundleContract;
use Pingu\Entity\Support\Entity;
use Pingu\Entity\Support\Policies\BaseEntityPolicy;
use Pingu\User\Entities\User;

class BlockPolicy extends BaseEntityPolicy
{
    public function index(?User $user)
    {
        return false;
    }

    public function view(?User $user, Entity $entity)
    {
        $user = $this->userOrGuest($user);
        if (!$entity->active) {
            return false;
        }
        if ($permission = $entity->permission) {
            return $user->hasPermissionTo($permission);
        }
        return true;
    }

    public function edit(?User $user, Entity $entity)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('edit blocks');
    }

    public function delete(?User $user, Entity $entity)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('delete blocks');
    }

    public function create(?User $user, ?BundleContract $bundle = null)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('create blocks');
    }
}