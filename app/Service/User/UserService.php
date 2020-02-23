<?php

namespace App\Service\User;

use App\Repository\User\UserRepository;

class UserService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUser($rawData)
    {
        $listUser =  $this->userRepository->getAllUser($rawData);
        $listUser = $this->refactorDataUser($listUser);
        return $listUser;
    }

    public function refactorDataUser($rawData)
    {
        $rawDataNew = [];
        foreach ($rawData as $item){
            if(isset($rawDataNew[$item->id])){
                $rawDataNew[$item->id]->role = $rawDataNew[$item->id]->role.', '.$item->role;
            }else{
                $rawDataNew[$item->id] = (object)[];
                $rawDataNew[$item->id]->role = $item->role;

            }
            $rawDataNew[$item->id]->name = $item->name;
            $rawDataNew[$item->id]->email = $item->email;
            $rawDataNew[$item->id]->phone = $item->phone;
            $rawDataNew[$item->id]->deleted_by = $item->deleted_by;
            $rawDataNew[$item->id]->id    = $item->id;


        }
        return $rawDataNew;
    }

}
