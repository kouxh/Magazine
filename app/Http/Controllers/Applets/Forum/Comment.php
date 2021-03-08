<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\ClassroomCommentModel;

class Comment extends CheckParameter
{

    /**
     * @ 评论列表
     * @param int $parent_id
     * @param array $result
     * @return array
     */
    protected function getCommlist($parent_id = 0,&$result = array()){
        $arr = ClassroomCommentModel::where('com_pid',  $parent_id) -> select('com_id', 'com_comment') -> orderBy("com_crea_at", 'desc') -> get();

        if(empty($arr)){
            return array();
        }
        foreach ($arr as $cm) {
            $thisArr = &$result[];
            $cm["children"] = $this -> getCommlist($cm["com_id"],$thisArr);
            $thisArr = $cm;
        }
        return $result;
    }

}
