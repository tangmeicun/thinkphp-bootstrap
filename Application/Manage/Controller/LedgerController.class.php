<?php
/* * 跨境
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/9/14
 * Time: 9:21
 */
namespace Manage\Controller;
class LedgerController extends BaseController {
    public function _initialize(){
        parent::_initialize();
//        dump($this->LANG);
    }

    /* 用户管理列表
     * User: Tmc
     * Date: 2017/9/14
     * Time: 9:21
     */
    public function lists(){
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
    public function add(){
        dump('add');
    }

    /* 新增管理员
         * User: Tmc
         * Date: 2017/9/14
         * Time: 9:21
         */
    public function edit(){
        dump('edit');
    }



}