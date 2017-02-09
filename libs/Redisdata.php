<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 17/2/9
 * Time: 上午7:39
 */

namespace libs;


class Redisdata
{
    private static $redis;
    public static function getRedis()
    {
        if (!(self::$redis) instanceof \Redis){
            self::$redis = new \Redis();
            self::$redis -> connect('127.0.0.0.1', '6379');
        }
        return self::$redis;
    }
}