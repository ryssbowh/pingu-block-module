<?php

namespace Pingu\Block\Entities\Policies;

use Pingu\Block\Entities\Block;
use Pingu\Core\Support\Policy;
use Pingu\Entity\Entities\Entity;
use Pingu\User\Entities\User;

class BlockPolicy extends Policy
{
    protected function userOrGuest(?User $user)
    {
        return $user ? $user : \Permissions::guestRole();
    }

    public function index(?User $user)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('view '. Block::friendlyNames());
    }

    public function view(?User $user, Entity $entity)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('view '.$entity::friendlyNames());
    }

    public function edit(?User $user, Entity $entity)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('edit '.$entity::friendlyNames());
    }

    public function delete(?User $user, Entity $entity)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('delete '.$entity::friendlyNames());
    }

    public function create(?User $user)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('create '. Block::friendlyNames());
    }
}