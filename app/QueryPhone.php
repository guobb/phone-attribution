<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 17/2/8
 * Time: 下午10:31
 */

namespace app;

use libs\HttpRequest;
use libs\Redisdata;

class QueryPhone
{
    const TAOBAO_API = 'https://tcc.taobao.com/cc/json/mobile_tel_segment.htm';
    const CACHE_KEY = 'PHONE:INFO';

    /**
     * 查询手机号码归属地
     * @param $phone
     */
    public static function query ($phone){
        $ret = [];
        if(self::verifyPhone($phone)){
            $redisKey = substr($phone, 0, 7);
            $phoneInfo = HttpRequest::getRedis()->hGet(self::CACHE_KEY, $redisKey);
            if($phoneInfo){
                $ret = json_decode($phoneInfo, true);
                $ret['msg'] = 'shuju';
            }else {
                $response = HttpRequest::request(self::TAOBAO_API, ['tel' => $phone]);
                $data = self::formatData($response);
                if($data){
                    $json = json_encode($data);
                    Redisdata::getRedis() -> hSet(self::CACHE_KEY, $redisKey, $json);
                    $ret = $data;
                }
            }
            return $ret;
        }
    }

    /**
     * 校验手机合法性
     * @param null $phone
     * @return bool
     */
    public static function verifyPhone($phone = null)
    {
        $ret = false;
        if ($phone){
            if (preg_match('/^1[34578]{1}\d{9}$/', $phone)){
               $ret = true;
            }
        }
        return $ret;
    }

    public static function formatData($data = null)
    {
        $res = false;
        if($data) {
            preg_match_call("/(\w+):'([^'])/", $data, $res);
            $items = array_combine($res[1],$res[2]);
            foreach ($items as $key => $val){
                $res[$key] = iconv('GB2312', 'UTF-8', $val);
            }
        }
        return $res;
    }
}