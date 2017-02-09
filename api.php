<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 17/2/8
 * Time: 下午9:55
 */

require_once "autoload.php";

$params = $_POST;

$phone = isset($_POST['tel']) ? $_POST['tel']:null;

$info = app\QueryPhone::query('13987654320');

$data = [];

if ($info) {
    $data = $info;
    $data['code'] = 200;
} else {
    $data['msg'] = '号码不正确';
    $data['code'] = 400;
}

echo json_encode($data);

