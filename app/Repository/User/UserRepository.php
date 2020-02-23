<?php


namespace App\Repository\User;


use App\Repository\Role\RoleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    const USER_TABLE = 'users';
    const ITEM_PER_PAGE = 10;
    const USER_ROLE_TABLE = 'user_role';
    const ROLES_TABLE = 'roles';
    /**
     * @param $email
     * @return Model|Builder|object|null
     */
    public function getUserByEmail($email)
    {
        return DB::table(self::USER_TABLE)
            ->where('email', $email)
            ->first()
        ;
    }

    public function getAllUser($rawData)
    {
        $result =   DB::table(self::USER_TABLE)
            ->leftJoin(self::USER_ROLE_TABLE,self::USER_TABLE.'.id','=',self::USER_ROLE_TABLE.'.user_id')
            ->leftJoin(self::ROLES_TABLE,self::ROLES_TABLE.'.id','=',self::USER_ROLE_TABLE.'.role_id')
            ->select(self::USER_TABLE.'.name',self::USER_TABLE.'.email',self::ROLES_TABLE.'.name as role',self::USER_TABLE.'.phone',self::USER_TABLE.'.deleted_by',self::USER_TABLE.'.id')
        ;

        if(isset($rawData['role_id']) && $rawData['role_id']){
            $result->where(self::USER_ROLE_TABLE.'.role_id', $rawData['role_id']);
        }

        return $result->get();
    }

}
