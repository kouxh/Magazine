<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Logistics extends Controller
{
    static  $host = "https://jisukdcx.market.alicloudapi.com";
    static  $path = "/express/query";
    static  $method = "GET";
    static  $appcode = "0a6e4188ad6e464391571fcbafffc55a";
    static  $headers = array();

    /**
     * @查询物流信息
     */
    static public function GetLogisticsInfo($mobile, $number, $type)
    {

        array_push(self::$headers, "Authorization:APPCODE " . self::$appcode);
        $querys = "mobile=$mobile&number=$number&type=".self::Dictionaries($type);
        $bodys = "";
        $url = self::$host . self::$path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, self::$method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, self::$headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".self::$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
       return curl_exec($curl);
    }


    /**
     * @ 物流字典
     * @return array
     */
    static public function Dictionaries($type)
    {
         $arr = [
            "SFEXPRESS" => "顺丰",
            "STO" => "申通",
            "YTO" => "圆通",
            "ZTO" => "中通",
            "HTKY" => "汇通快递",
            "YUNDA" => "韵达",
            "JD" => "京东",
            "EMS" => "EMS",
            "ZTO56" => "中通快运",
            "AAEWEB" => "AAE",
            "ARAMEX" => "Aramex",
            "DHL" => "内件	DHL",
            "DPEX" => "DPEX",
            "DEXP" => "D速",
            "EWE" => "EWE",
            "FEDEX" => "FedEx",
            "FEDEXIN" => "FedEx国际",
            "PCA" => "PCA",
            "TNT" => "TNT",
            "UPS" => "UPS",
            "ANJELEX" => "安捷",
            "ANE" => "安能",
            "ANEEX" => "安能快递",
            "ANXINDA" => "安信达",
            "EES" => "百福东方",
            "HTKY" => "百世快递",
            "BSKY" => "百世快运",
            "FLYWAYEX" => "程光",
            "DTW" => "大田",
            "DEPPON" => "德邦",
            "GCE" => "飞洋",
            "PHOENIXEXP" => "凤凰",
            "FTD" => "富腾达",
            "GSD" => "共速达",
            "GTO" => "国通",
            "BLACKDOG" => "黑狗",
            "HENGLU" => "恒路",
            "HYE" => "鸿远",
            "HQKY" => "华企",
            "JOUST" => "急先达",
            "TMS" => "加运美",
            "JIAJI" => "佳吉",
            "JIAYI" => "佳怡",
            "KERRY" => "嘉里物流",
            "HREX" => "锦程快递",
            "PEWKEE" => "晋越",
            "KKE" => "京广",
            "JIUYESCM" => "九曳",
            "KYEXPRESS" => "跨越速运",
            "FASTEXPRESS" => "快捷",
            "BLUESKY" => "蓝天",
            "LTS" => "联昊通",
            "LBEX" => "龙邦",
            "YIMIDIDA" => "壹米滴答",
            "RRS" => "日日顺物流",
            "YXWL" => "宇鑫物流",
            "DJ56" => "东骏快捷",
            "FEDEX_GJ" => "联邦快递国际",
            "AYCA" => "澳邮专线",
            "CITY100" => "城市100",
            "D4PX" => "递四方速递",
            "GTSD" => "广通",
            "HYLSD" => "好来运快递",
            "JTKD" => "捷特快递",
            "MB" => "民邦快递",
            "MLWL" => "明亮物流",
            "PANEX" => "泛捷快递",
            "QXT" => "全信通",
            "SAD" => "赛澳递",
            "SDWL" => "上大物流",
            "STWL" => "速腾快递",
            "WJK" => "万家康",
            "ZENY" => "增益快递",
            "CAE" => "民航",
            "ND56" => "能达",
            "DHL" => "际件	DHL_EN",
            "EFSPOST" => "平安快递",
            "CHINZ56" => "秦远物流",
            "QCKD" => "全晨",
            "QFKD" => "全峰",
            "APEX" => "全一",
            "RFD" => "如风达",
            "SFC" => "三态",
            "SFWL" => "盛丰",
            "SHENGHUI" => "盛辉",
            "SDEX" => "顺达快递",
            "SUNING" => "苏宁",
            "SURE" => "速尔",
            "HOAU" => "天地华宇",
            "TTKDEX" => "天天",
            "VANGEN" => "万庚",
            "WANJIA" => "万家物流",
            "EWINSHINE" => "万象",
            "GZWENJIE" => "文捷航空",
            "XBWL" => "新邦",
            "XFEXPRESS" => "信丰",
            "BROADASIA" => "亚风",
            "YIEXPRESS" => "宜送",
            "QEXPRESS" => "易达通",
            "ETD" => "易通达",
            "UC56" => "优速",
            "CHINAPOST" => "邮政包裹",
            "YFHEX" => "原飞航",
            "YADEX" => "源安达",
            "YCGWL" => "远成",
            "YFEXPRESS" => "越丰",
            "YTEXPRESS" => "运通",
            "ZJS" => "宅急送",
            "ZMKMEX" => "芝麻开门",
            "COE" => "中国东方",
            "CRE" => "中铁快运",
            "ZTKY" => "中铁物流",
            "CNPL" => "中邮",
            "PJKD" => "品骏快递",
            "INTMAIL" => "邮政国际包裹",
            "FEDEX" => "联邦快递",
            "PEISI" => "配思航宇",
            "BDT" => "八达通",
            "CJKD" => "城际快递",
            "FKD" => "飞康达",
            "HQSY" => "环球速运",
            "JAD" => "捷安达",
            "JGWL" => "景光物流",
            "MK" => "美快",
            "PADTF" => "平安达腾飞快递",
            "QRT" => "全日通快递",
            "RFEX" => "瑞丰速递",
            "SAWL" => "圣安物流",
            "ST" => "速通物流",
            "SUBIDA" => "速必达物流",
            "XJ" => "新杰物流",
            "ZYWL" => "中邮物流",
        ];

        return array_search($type, $arr);
    }
}
