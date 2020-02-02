<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/2
 * Time: 17:43
 */

// 应用公共文件
function prompt($msg = '',$code=200, $data = '',$url = null){
    //提示转繁体
    $result = [
        'code'=>$code,
        'msg'=>$msg,
        'url'=>$url,
        'data'=>$data
    ] ;
    return json_encode($result);
}