<?php

/**
 * Created by PhpStorm.
 */

namespace Home\Service;

define( "WX_APPID" , 'wx71f2b2c4780368e1' );
define( "WX_APPSECRET" , '9f0b1dbb56ac16c96a49d8874624cc4a' );

class WeixinService extends BaseService {

    public function __construct() {
        parent::__construct();

    }
    /**
     * 获取用户openid
     *
     */
    public static function get_openid($jscode)
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.WX_APPID.'&secret='.WX_APPSECRET.'&js_code='.$jscode.'&grant_type=authorization_code';
        return curlGet($url);
    }
}
