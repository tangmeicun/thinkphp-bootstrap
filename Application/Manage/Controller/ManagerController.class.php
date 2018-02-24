<?php
/* * 跨境
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/9/14
 * Time: 9:21
 */
namespace Manage\Controller;
class ManagerController extends BaseController {
    public function _initialize(){
        parent::_initialize();
//        dump($this->LANG);
    }

    /* 用户管理列表
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function userlist(){
        if(IS_AJAX){
            $Manager = M("Manager");
            $map = array(
            );
            $list = $Manager
                ->join('LEFT JOIN rs_role ON rs_manager.roleid = rs_role.roleid')
                ->where($map)
                ->order('rs_manager.id asc')
                ->select();
            foreach ($list as $key=>$val) {
                $data_list[$key] = $val;
                $url = U('manager/useredit?id='.$val['id']);
                $data_list[$key]['operation'] = '<a class="like J-edt" href="'.$url.'" title="编辑" data-id="'.$val['id'].'">编辑</a> | <a href="'.U('manager/userdel?id='.$val['id']).'" class="like J-cancle" onclick="javascript:return confirm(\'您确定要删除吗？\')"> 删除 </a>';
            }
            echo json_encode($data_list);
        }else{
            $this->render();
        }
    }

    /* 新增管理员
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function useradd(){
        if(IS_POST){
            $data = array(
                'username' => I('post.username','','trim'),
                'password' => md5_zhuniu(I('post.password','','trim')),
                'roleid' => I('post.roleid','','trim'),
                'email' => I('post.email','','email'),
                'tel' => I('post.tel','','trim'),
                'addtime' => time(),
            );
            $re = M("Manager")->add($data);
            if($re){
                Msg('添加管理员成功！',U('manager/userlist'));
            } else {
                Msg('添加管理员失败！',U('manager/useradd'));
            }
        }else{
            $role_list = M("Role")->select();
            $this->assign('role_list',$role_list);
            $this->render();
        }
    }

    /* 修改管理员
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function useredit(){
        if(IS_POST){
            $userid = I('post.userid','','trim');
            $data = array(
                'roleid' => I('post.roleid','','trim'),
                'email' => I('post.email','','email'),
                'tel' => I('post.tel','','trim'),
            );
            $re = M("Manager")->where('id='.$userid)->save($data);
            if($re){
                Msg('编辑管理员成功！',U('manager/userlist'));
            } else {
                Msg('编辑管理员失败！');
            }
        }else{
            $userid = I('get.id');
            $role_list = M("Role")->select();
            $Manager = M("Manager")->where('id='.$userid)->find();
            $datalist = array(
                'role_list' => $role_list,
                'Manager' => $Manager,
            );
            $this->assign('datalist',$datalist);
            $this->render();
        }
    }

    /* 删除管理员
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function userdel(){
        $id = I('id');
        if(empty($id)){
            Msg('信息不完整！');
        }
        $Manager = M("Manager");
        $result = $Manager->where('id='.$id)->delete();
        if($result){
            Msg('删除成功！',U('manager/userlist'));
        } else {
            Msg('删除失败！');
        }
    }

    /* 角色管理列表
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function rolelist(){
        $pageIndex = I('get.p',1,'int');//第几页
        $limit = 20;
        $start = ($pageIndex-1)*$limit;
        $Role = M("Role");
        $map = array(
        );
        $list = $Role->where($map)->limit($start,$limit)->select();
        $list_num = $Role->where($map)->count();
        $Page = new \Think\Page($list_num,$limit);// 实例化分页类 传入总记录数和每页显示的记录数
        $page_show  = $Page->show();// 分页显示输出
        $data = array(
            'list' => $list,
            'page' => $page_show,
        );
        $this->assign('data',$data);
        $this->render();
    }

    /* 新增角色
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function roleadd(){
        if(IS_POST){
            $data = array(
                'rolename' => I('post.rolename','','trim'),
                'description' => I('post.description','','trim'),
            );
            $re = M("Role")->add($data);
            if($re){
                Msg('新增角色成功！',U('manager/rolelist'));
            } else {
                Msg('新增角色失败！',U('manager/roleadd'));
            }
        }else{
            $this->render();
        }
    }

    /* 修改角色
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function roleedit(){
        if(IS_POST){
            $roleid = I('post.roleid','','trim');
            $data = array(
                'rolename' => I('post.rolename','','trim'),
                'description' => I('post.description','','trim'),
            );
            $re = M("Role")->where('roleid='.$roleid)->save($data);
            if($re){
                Msg('编辑角色成功！',U('manager/rolelist'));
            } else {
                Msg('编辑角色失败！');
            }
        }else{
            $roleid = I('get.roleid');
            $role_list = M("Role")->where('roleid='.$roleid)->find();
            $this->assign('role_list',$role_list);
            $this->render();
        }
    }

    /* 删除角色
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function roledel(){
        $roleid = I('roleid');
        if(empty($roleid)){
            Msg('信息不完整！');
        }
        $Role = M("Role");
        $result = $Role->where('roleid='.$roleid)->delete();
        if($result){
            Msg('删除成功！',U('manager/rolelist'));
        } else {
            Msg('删除失败！');
        }
    }

    /* 权限设置
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function roleset()
    {
        if (IS_POST) {
            $roleid = I('post.roleid', 0, 'intval');
            $menuid_arr = I('post.menuid', '', 'trim');
            if(!empty($menuid_arr)){
                foreach ($menuid_arr as $key => $val){
                    $dataList[] = array('roleid'=>$roleid,'menuid'=>$val);
                }
                $RoleMenu = M('RoleMenu');
                $RoleMenu->where('roleid='.$roleid)->delete();//先删除
                $re = $RoleMenu->addAll($dataList);
                if($re){
                    Msg('权限设置成功！',U('manager/rolelist'));
                } else {
                    Msg('权限设置失败！',U('manager/roleadd'));
                }
            }
        } else {
            $roleid = I('get.roleid', 0,'intval');
            $menuList = \Manage\Service\MenuService::getMenuTrees();//所有菜单树形结构
            $role_menu_re = M('RoleMenu')->where('roleid='.$roleid)->select();
            if (!empty($role_menu_re)){
                foreach ($role_menu_re as $key => $val){
                    $role_menu_list[] = $val['menuid'];
                }
            }
            $data = array(
                'roleid' => $roleid,
                'menulist' => $menuList,
                'role_menu_list' => $role_menu_list,
            );
            $this->assign('data', $data);
            $this->render();
        }
    }


    /* 组织构架
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function deplist(){
        if(IS_AJAX){
            $parent_id = I('post.id',1,'intval');
            $user_id = I('post.user_id','','intval');

            $depart_arr = [];
            $depart_arr = M ( "Department" )->field ( "departmentid as id,name,isparent,parentid" )->where ( "disabled='0' and departmentid>1 and parentid=" . $parent_id )->order ( 'listorder asc,departmentid asc' )->select ();
            //编辑用户使用
            if($user_id)
            {
                $depart_arrs = M('Department_user')->field('department_id')->where('user_id='.$user_id)->select();
                $tmp_arr = array();
                foreach ($depart_arrs as $v)
                {
                    $tmp_arr[] = $v['department_id'];
                }
            }
            foreach ($depart_arr as $k=>$v)
            {
                $depart_arr[$k]['isParent'] = $v['isparent']?true:false;
                if($user_id)
                {
                    if(in_array($v['id'],$tmp_arr))
                    {
                        $depart_arr[$k]['checked'] = true;
                    }else{
                        unset($depart_arr[$k]['checked']) ;
                    }
                }

            }
            $this->ajaxReturn($depart_arr,'json');
        } else {
            $this->render();
        }
    }

    /* 菜单管理
    * User: Tmc
    * Date: 2017/9/14
    * Time: 9:21
    */
    public function menulist(){
        if(IS_AJAX){
            $Menu = M("Menu");
            $map = array();
            $list = $Menu->where($map)->select();
            $list = \Manage\Service\MenuService::getMenuTrees();
            foreach ($list as $key=>$val) {
                $data_list[$key] = $val;
                if( $val['status'] == 1){
                    $data_list[$key]['operation'] = '<a class="like J-edt" href="'.U('manager/menuedit?menuid='.$val['menuid']).'" >编辑</a> | <a href="'.U('manager/menudel?menuid='.$val['menuid']).'" class="like J-cancle" onclick="javascript:return confirm(\'您确定要删除吗？\')"> 删除 </a>';
                }else{
                    $data_list[$key]['operation'] = '<a class="like J-edt" href="'.U('manager/menuedit?menuid='.$val['menuid']).'" >编辑</a> | <a href="'.U('manager/menudel?menuid='.$val['menuid']).'" class="like J-cancle" onclick="javascript:return confirm(\'您确定要删除吗？\')"> 删除 </a>';
                }
            }
            echo json_encode($data_list);
        }else{
            $this->render();
        }
    }

   /* 添加菜单
   * User: Tmc
   * Date: 2017/9/14
   * Time: 9:21
   */
    public function menuadd(){
        if(IS_POST){
            $data = array(
                'name' => I('post.name','','trim'),
                'parentid' => I('post.parentid','','trim'),
                'url' => I('post.url','','email'),
                'icons' => I('post.icons','','trim'),
            );
            $re = M("Menu")->add($data);
            if($re){
                Msg('添加菜单成功！',U('manager/menulist'));
            } else {
                Msg('添加菜单失败！');
            }
        }else{
            $menuList = \Manage\Service\MenuService::getMenuTrees();//所有菜单树形结构
            $data = array(
                'menuList' => $menuList,
            );
            $this->assign('data',$data);
            $this->render();
        }
    }

   /* 编辑菜单
   * User: Tmc
   * Date: 2017/9/14
   * Time: 9:21
   */
    public function menuedit(){
        if(IS_POST){
            $menuid = I('post.menuid');
            $data = array(
                'name' => I('post.name','','trim'),
                'parentid' => I('post.parentid','','trim'),
                'url' => I('post.url','','email'),
                'icons' => I('post.icons','','trim'),
            );
            $re = M("Menu")->where('menuid='.$menuid)->save($data);
            if($re){
                Msg('编辑菜单成功！',U('manager/menulist'));
            } else {
                Msg('编辑菜单失败！');
            }
        }else{
            $menuid = I('get.menuid');
            $menuinfo = M("Menu")->where('menuid='.$menuid)->find();
            $menuList = \Manage\Service\MenuService::getMenuTrees();//所有菜单树形结构
            $data = array(
                'menuList' => $menuList,
                'menuinfo' => $menuinfo,
            );
            $this->assign('data',$data);
            $this->render();
        }
    }

    /* 删除菜单
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function menudel(){
        $menuid = I('menuid');
        if(empty($menuid)){
            Msg('信息不完整！');
        }
        $result = M("Menu")->where('menuid='.$menuid)->delete();
        if($result){
            Msg('删除成功！',U('manager/menulist'));
        } else {
            Msg('删除失败！');
        }
    }


}