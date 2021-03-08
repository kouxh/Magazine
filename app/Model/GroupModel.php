<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    const TABLE_NAME = 'mz_Group';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @ 查询团号下所有用户的头像与id
     * @param $groupCode
     * @param int $status
     * @return mixed
     */
    static function getGroupCodeUser($groupCode, $status=1)
    {
        return self::where(['mz_Group.G_groupCode' => $groupCode, 'G_status' => $status])
            -> join('mz_users', 'mz_Group.G_uid', '=', 'mz_users.id', 'left')
            -> select('mz_users.id', 'mz_users.photo')
            -> get();
    }

    /**
     * @ 获取团的结束时间
     * @param $groupCode
     * @return mixed
     */
    static function getGroupEndAt($groupCode)
    {
        return self::where('G_groupCode', $groupCode) -> select('G_groupEndAt') -> orderBy('G_groupEndAt') -> first() -> G_groupEndAt;
    }
}
