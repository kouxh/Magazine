<?php

namespace App\Http\Controllers\Pc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use App\Model\ColumnModel;
use App\Http\Controllers\Service\PublicColumn;

class SpecialController extends BaseController
{

    public function specialList()
    {
        #获取column的id
        $data['column'] = ColumnModel::column('rw');
        #获取其他栏目
        $data = PublicColumn::getPublicColumn($data);

        return view('Pc/Special/list') -> with('data', $data);
    }
}
