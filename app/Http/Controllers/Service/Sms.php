<?php
/**
 *  阿里云短信验证码
 *  created By phpStrom
 *  name 马哥
 *  Time 2019:5:31
 */
namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Sms extends Controller
{
    private static $signName = '管理会计研究';            #签名名称
    private static $appid = 'LTAI4FrLHewtAMPRrN8c7ji6';
    private static $secret = '0ct7rAxXOEHlYo9oHcmMeoC03pjYF2';
    private static $tplid = 'SMS_166781225';            #模板id
    //发送验证码
    public static function send($phone , $code)
    {
        date_default_timezone_set('GMT');

        $tplParam = json_encode(['code' => ''.$code.'']);

        $params = [
            'AccessKeyId' => Sms::$appid,
            'Timestamp'   => date('Y-m-d\TH:i:s\Z'),
            'SignatureMethod'=>'HMAC-SHA1',
            'SignatureVersion'=> '1.0',
            'SignatureNonce'  => uniqid(),//随机码
            'Format'      => 'JSON',
            //业务参数
            'Action'       => 'SendSms',
            'Version'     => '2017-05-25',
            'RegionId'    => 'cn-hangzhou',
            'PhoneNumbers' => $phone,//接收号码
            'SignName'      => Sms::$signName,//签名
            'TemplateCode'  => Sms::$tplid,//模板id
            'TemplateParam' => $tplParam,

        ];
        //排序
        ksort($params);

        $str = '';
        foreach($params as $k => $v){
            $str .= urlencode($k) . '=' . urlencode($v) . '&';
        }
        $str = substr($str,0,-1);
        $str = str_replace(['+','*','%7E'],['%20','%2A','~'],$str );


        $new_str = 'GET&' . urlencode('/') . '&' . urlencode($str);

        $sign = base64_encode(hash_hmac('sha1', $new_str, Sms::$secret . '&',true));

        $sign = urlencode($sign);

        $url = 'http://dysmsapi.aliyuncs.com/?Signature=' . $sign . '&'.  $str;

        //curl  file_get_contents

        $res = file_get_contents($url);

        return  $res;
    }
}
