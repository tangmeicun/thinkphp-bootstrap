<?php
/* * 基类
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/9/14
 * Time: 9:21
 */

namespace Manage\Controller;
use Think\Controller;

class BaseController extends Controller {

    public $LANG = '';
    public function _initialize() {
        header('Content-type:text/html;charset=utf-8;');
        $this->_set_DOMAIN();

        $this->_is_lognin();

        $this->_check_power();
    }

    /*
     * 判断是否登录
     * */
    private function _is_lognin()
    {
        if(!\Manage\Service\SessionService::isHaveLogin()){
            $this->redirect('public/login');
        }
        $username = Session('username');
        $this->assign('username',$username);
        $roleid = Session('roleid');
        $this->assign('roleid',$roleid);
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

    /**
     * render view
     * 模板渲染
     */
    public function render( $view,$data = array())
    {
        $this->display('Common/header');
        if($data && count($data))
        {
            foreach ($data as $key => $value)
            {
                $this->assign($key,$value);
            }
        }
        $this->display( ucfirst($view) );
        $this->display('Common/bottom');
    }


    /*
     * 判断是否有权限
     * */
    private function _check_power()
    {
        $roleid = Session('roleid');
        if($roleid != 1){
            $where = array(
                'url' => strtolower(CONTROLLER_NAME).'-'.ACTION_NAME,
            );
            $menu_now = M('Menu')->field('menuid')->where($where)->order('menuid desc')->find();
            $role_list = M('RoleMenu')->where('roleid='.$roleid)->select();
            if(!empty($role_list)){
                foreach ($role_list as $key => $val){
                    $menuid_list[] = $val['menuid'];
                }
                $menuid_list[] = '1';//首页
            }
            if(!in_array($menu_now['menuid'], $menuid_list)){
                Msg('对不起！您无权访问此管理功能！',U('index/index'));
            }
        }
    }


}
