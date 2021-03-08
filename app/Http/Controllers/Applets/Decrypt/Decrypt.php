<?php

namespace App\Http\Controllers\Applets\Decrypt;

use App\Http\Controllers\Applets\Decrypt\WXBizDataCrypt;

class Decrypt
{
    static public function decryptGetUserinfo($session_key, $encryptedData, $iv, $type, $data='')
    {
        if($type == 1){
            $appid = config('appletsCmasPay.AppID');
        }else if($type == 2){
            $appid = config('appletsPlusPay.AppID');
        }

        $pc = new WXBizDataCrypt($appid, $session_key);
        $errCode = $pc->decryptData($encryptedData, $iv, $data);

        if ($errCode == 0) {
           return $data;
        } else {
            return $errCode;
        }
    }
}



