<?php
namespace App\Service\User;

use App\Repository\User\ShowDetailRepository;

class DetailUserService
{
    private $detailRepository;

    public function __construct(ShowDetailRepository $detailRepository)
    {
        $this->detailRepository = $detailRepository;
    }
    public function getDetail($id)
    {
        $user = $this->detailRepository->detail($id);
        return $this->refactorDataPushRoleIdFormUser($user);
    }

    public function refactorDataPushRoleIdFormUser($rawData)
    {
        if( ! $rawData){
            return abort(404);
        }

        $user = (array)$rawData[0];
        $listRoleName = [];
        foreach ($rawData as $item){
            $listRoleName[$item->role_id] = $item->role_id;
        }

        $user['role_name'] = $listRoleName;

        return $user;
    }
}
