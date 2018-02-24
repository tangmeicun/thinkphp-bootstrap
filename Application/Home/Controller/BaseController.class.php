<?php
/* * 基类
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/9/14
 * Time: 9:21
 */

namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {

    public $LANG = '';
    public $s_uid = '';

    public function _initialize() {
        header('Content-type:text/html;charset=utf-8;');

        //活动中心用户
        $this->s_uid = (session('uid')) ? session('uid') : '';
        $this->assign("s_uid",$this->s_uid);


        $this->_set_DOMAIN();
    }

    //设置COOKIE_DOMAIN,HOST
    private function _set_DOMAIN()
    {
        if( I('server.REDIRECT_STATUS') == 200)
        {
            $cur_host = I('server.SERVER_NAME');
            $num = substr_count($cur_host,'.');
            if($num == 1){
                $domain = '.'.$cur_host;
            } else {
                $domain = substr($cur_host,stripos($cur_host,'.'));
            }
            $ret_arr['COOKIE_DOMAIN'] = $domain;
            $ret_arr['HOST'][ 'THIS_HOST']= I('server.HTTP_HOST') ? 'http://'.I('server.HTTP_HOST') : '';
        }
        if(is_array($ret_arr)){
            foreach ($ret_arr as $ke =>$va ){
                if(is_array($va)){
                    foreach ($va as $k=>$v){
                        C($ke.".".$k,$v);
                    }
                }else{
                    C($ke,$va);
                }
            }
        }
    }



}
