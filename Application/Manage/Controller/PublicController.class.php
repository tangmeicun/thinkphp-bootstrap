<?php
/* * 跨境
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/9/14
 * Time: 9:21
 */
namespace Manage\Controller;
use Think\Controller;

class PublicController extends Controller {

    /* 登录
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function login(){
        if(\Manage\Service\SessionService::isHaveLogin()){
            $this->redirect('index/index');
        }else{
            $this->display();
        }
    }

    public function checklogin(){
        $username = I('request.username','','htmlspecialchars');
        $password = I('request.password','','htmlspecialchars');
        $verify = I('request.verify','','htmlspecialchars');

        $verifyClass = new \Think\Verify();
        if(! $verifyClass->check(strtolower($verify),1)){
            Msg('验证码不正确！');
        }
        if(empty($username)){
            Msg('用户名不能为空！');
        }
        if(empty($password)){
            Msg('用户密码不能为空！');
        }

        $Manager = M("Manager");
        $map = array(
          'status' => '1',
          'username' => $username,
          'password' => md5_zhuniu($password),
        );
        $data = $Manager->where($map)->find();

        if($data){
            \Manage\Service\SessionService::setAdminSess($data);//保存session
            $this->redirect('index/index');
        } else {
            Msg('用户名或密码不正确！');
        }
    }

    /**
     * 验证码
     */
    public function  verify(){
        $Verify = new \Think\Verify(array('useCurve'=>false,'codeSet'=>'0123456789'));
        $Verify->entry(1);
    }

    /**
     * 退出后台
     */
    public function logout(){
        \Manage\Service\SessionService::clearAdminSess();
        $this->redirect('index/index');
    }



}