<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\UserModel;
use App\Model\ClassroomCommentModel;
use App\Model\SignUpModel;
use App\Model\CheckTellModel;
use App\Model\AddressModel;
use App\Model\InvoiceModel;
use App\Model\AppletsMailModel;

class upAppletsActicle extends CheckParameter
{
    static $appid = 'wx96cdee008744178e';
    static $secret = '61e842f005720f32b7c7374abcea66ba';

     function getAccessToken()
     {
         $getAccessTokenUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.self::$appid.'&secret='.self::$secret;
         $accessToken = file_get_contents($getAccessTokenUrl);
         $data = $this -> jsonToArr($accessToken);
         return $data['access_token'];
     }

     function getActicleInfo()
     {
         $access_token = $this -> getAccessToken();
         $url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$access_token;
         $json = '{
            "type":"news",
            "offset":40,
            "count":40';

         $data = $this -> curlRequest($url, $json);
         $data = $this -> jsonToArr($data);
//         dd($data['item'][4]);
//         dd($data['item'][4]['content']['news_item'][0]['content']);

         $info = '{
            "media_id":"KWdL6ulg2x6w1S_df6j9gKz4Ek1wjEPeSLGKUs9-e2U",
            "index":0,
            "articles": {
                "title": "刘勤|智能财务的发展体系及其核心环节探索",
                "thumb_media_id": "KWdL6ulg2x6w1S_df6j9gCyeoAasa1wIx5HunNKExnc",
                "author": "管理会计研究",
                "digest": "更多精彩内容，尽在管理会计研究",
                "show_cover_pic": 0,
                "content":"'.$data['item'][4]['content']['news_item'][0]['content'].'",
                "content_source_url": "https://app.ma.scrmtech.com/meetings-api/sapIndex/SapSourceData?pf_uid=11983_1599&sid=17197&source=2&pf_type=3&channel_id=2587&channel_name=%E8%AE%A2%E9%98%85%E5%8F%B7&tag_id=b4dd87bea346e4bd"
            }
          }';

         return $info;
     }

     function upActicle()
     {
         $data = $this -> getActicleInfo();
//         dd($data);
         $access_token = $this -> getAccessToken();

         $url = 'https://api.weixin.qq.com/cgi-bin/material/update_news?access_token='.$access_token;

         $reg = $this -> curlRequest($url, $data);

         dd($reg);
     }

}