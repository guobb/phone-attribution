<?php
/**
 * http请求模块
 * Created by PhpStorm.
 * User: apple
 * Date: 17/2/8
 * Time: 下午11:38
 */

namespace libs;


class HttpRequest
{
    public static function request($url, $params, $method = 'GET'){

        $response = null;
        if($url){
            $method = strtoupper($method);
            if($method == 'POST'){

            } elseif ($method == 'PUT'){

            } elseif ($method == 'DELETE'){

            } else {
               if(is_array($params) and count($params)){
                   if (strrpos($url, '?')){
                       $url = $url . '&' . http_build_query($params);
                   } else {
                       $url = $url . '?' . http_build_query($params);
                   }
                   $response = file_get_contents($url);
               }
            }
        }
        return $response;
    }

}