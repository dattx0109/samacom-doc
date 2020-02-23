<?php


namespace App\Policies\Role;


class RolePolicy
{
    public function listRole()
    {
        return true;
    }
}