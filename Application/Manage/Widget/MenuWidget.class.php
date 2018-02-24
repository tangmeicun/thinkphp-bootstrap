<?php
namespace Manage\Widget;

use Think\Controller;

class MenuWidget extends Controller{

    public static $menuList;
    public static $menu_role_arrs;
    public function lists($roleid)
    {
        //获取权限roleid对应的muneid
        $role_list = M('RoleMenu')->where('roleid='.$roleid)->select();
        if(!empty($role_list)){
            foreach ($role_list as $key => $val){
                $menuid_list[] = $val['menuid'];
            }
        }
        if($roleid == 1){//判断是否超级管理员
            $map['display']  = '1';
        } else {
            $map['menuid']  = array('in',$menuid_list);
        }
        $menu_arr = M('Menu')->where($map)->select();
        $menutree = \Manage\Service\MenuService::getTree($menu_arr);//所有菜单树形结构
        $this->assign('menutree',$menutree);
        $where = array(
            'url' => strtolower(CONTROLLER_NAME).'-'.ACTION_NAME,
        );
        $menu_now = M('Menu')->where($where)->order('menuid desc')->find();
        $this->assign('menu_now',$menu_now);
        $this->display('Common:menu');
    }
}