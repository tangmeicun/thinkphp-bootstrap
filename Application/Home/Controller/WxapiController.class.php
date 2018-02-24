<?php
/* * 射击游戏
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2018/1/22
 * Time: 17:21
 */
namespace Home\Controller;
use Home\Service\WeixinService;


class WxapiController extends Controller {
    public function _initialize(){
        header('Content-type:text/html;charset=utf-8;');

    }


    /**
     * *ajax 记录用户uid
     */
    public function getuid()
    {

        $uid = I('get.uid','','int');
        //记录session
        if(!empty($uid) and $uid != 'null'){
            exit(toJson(array('status' => '1001', 'msg' => '用户信息同步成功', 'uid'=>$uid )));
        } else {
            exit(toJson(array('status' => '2001', 'msg' => '用户信息同步失败' )));
        }
    }


    /**
     * 获取用户信息并入库
     */
    public function get_openid()
    {
        $code = I('get.code','');
        $re = WeixinService::get_openid($code);

//        //入库日志
//        $WxtestModel = M('Wxtest');
//        $add_data = array(
//            'name' => $weixin,
//            'uid' => '369',
//        );
//        $WxtestModel->add($add_data);//入库
        if(!empty($re['openid'])){
            exit(toJson(array('status' => '2001', 'msg' => '请求用户openid成功', 'data'=>$re  )));
        } else {
            exit(toJson(array('status' => '2001', 'msg' => '请求用户openid失败'  )));
        }


    }






































}