<?php
/* * 跨境
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/9/14
 * Time: 9:21
 */
namespace Manage\Controller;
class ShejiController extends BaseController {
    public function _initialize(){
        parent::_initialize();
//        dump($this->LANG);
    }

    /* 设计小游戏奖池管理列表
     * User: Tmc
     * Date: 2017/10/18
     * Time: 9:00
     */
    public function prizelist(){
        if(IS_AJAX){
            $ShejiPrizeModel = M("ShejiPrize");
            $map = array();
            $list = $ShejiPrizeModel->where($map)->order('id asc')->select();
            foreach ($list as $key=>$val) {
                $data_list[$key] = $val;
                $data_list[$key]['percent'] = $val['percent'].'%';
                $data_list[$key]['prize'] = $val['prize'].'积分';
                $data_list[$key]['operation'] = '<a class="like J-edt" href="'.U('sheji/prizeedit?id='.$val['id']).'" >编辑</a> | <a href="'.U('sheji/prizedel?id='.$val['id']).'" class="like J-cancle" onclick="javascript:return confirm(\'您确定要删除吗？\')"> 删除 </a>';
            }
            echo json_encode($data_list);
        }else{
            $this->render();
        }
    }

    /* 设计小游戏奖池新增
     * User: Tmc
     * Date: 2017/10/18
     * Time: 9:21
     */
    public function prizeadd(){
        if(IS_POST){
            $data = array(
                'title' => I('post.title','','trim'),
                'description' => I('post.description','','trim'),
                'percent' => I('post.percent','','int'),
                'prize' => I('post.prize','','int'),
            );
            $re = M("ShejiPrize")->add($data);
            if($re){
                Msg('添加奖品成功！',U('sheji/prizelist'));
            } else {
                Msg('添加奖品失败！');
            }
        }else{
            $this->render();
        }
    }

    /* 设计小游戏奖池编辑
         * User: Tmc
         * Date: 2017/10/18
         * Time: 10:00
         */
    public function prizeedit(){
        if(IS_POST){
            $id = I('post.id');
            $data = array(
                'title' => I('post.title','','trim'),
                'description' => I('post.description','','trim'),
                'percent' => I('post.percent','','int'),
                'prize' => I('post.prize','','int'),
            );
            $re = M("ShejiPrize")->where('id='.$id)->save($data);
            if($re){
                Msg('编辑奖品成功！',U('sheji/prizelist'));
            } else {
                Msg('编辑奖品失败！');
            }
        }else{
            $id = I('get.id');
            $info = M("ShejiPrize")->where('id='.$id)->find();

            $data = array(
                'info' => $info,
            );
            $this->assign('data',$data);
            $this->render();
        }
    }


    /* 设计小游戏奖池删除
     * User: Tmc
     * Date: 2017/10/18
     * Time: 10:21
     */
    public function prizedel(){
        $id = I('id');
        if(empty($id)){
            Msg('信息不完整！');
        }
        $result = M("ShejiPrize")->where('id='.$id)->delete();
        if($result){
            Msg('删除成功！',U('sheji/prizelist'));
        } else {
            Msg('删除失败！');
        }
    }

    //winrecord
    /* 用户消费获积分列表
     * User: Tmc
     * Date: 2017/10/18
     * Time: 14:00
     */
    public function recordlist(){
        if(IS_AJAX){
            $ShejiRecordModel = M("ShejiRecord");
            $map = array();
            $list = $ShejiRecordModel->where($map)->order('id desc')->select();
            foreach ($list as $key=>$val) {
                $data_list[$key] = $val;
                $data_list[$key]['status'] = ($val['status'] == 1) ? '<font color="red">扣减</font>' : '<font color="green">获得</font>';
                $data_list[$key]['datetime'] = date('Y-m-d H:i:s',$val['datetime']);
                $data_list[$key]['operation'] = '<a class="like J-edt" href="'.U('sheji/prizeedit?id='.$val['id']).'" >编辑</a> | <a href="'.U('sheji/prizedel?id='.$val['id']).'" class="like J-cancle" onclick="javascript:return confirm(\'您确定要删除吗？\')"> 删除 </a>';
            }
            echo json_encode($data_list);
        }else{
            $this->render();
        }
    }


}