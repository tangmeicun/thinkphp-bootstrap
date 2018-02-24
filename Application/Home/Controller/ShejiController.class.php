<?php
/* * 射击游戏
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/9/14
 * Time: 9:21
 */
namespace Home\Controller;
class ShejiController extends BaseController {
    public function _initialize(){
        parent::_initialize();

    }

    /* 首页
     * User: Tmc
     * Date: 2017/10/17
     * Time: 9:21
     */
    public function index()
    {
        $this -> display();
    }

    /**
     * *ajax 记录用户uid
     */
    public function ajax_save_user()
    {
        if(!IS_POST){
            exit(toJson(array('status' => '2001', 'msg' => '访问格式不正确' )));
        }

        $uid = I('post.uid','','int');
        //记录session
        if(!empty($uid) and $uid != 'null'){
            session('uid',$uid);
            exit(toJson(array('status' => '1001', 'msg' => '用户信息同步成功' )));
        } else {
            exit(toJson(array('status' => '2001', 'msg' => '用户信息同步失败' )));
        }
    }

    /* ajax获取中奖项
     * User: Tmc
     * Date: 2017/10/18
     * Time: 11:21
     */
    public function ajax_get_rand()
    {
        $needcodeNum = 10; //每次抽奖消耗的积分数
        if(!IS_POST){
            exit(toJson(array('status' => '2001', 'msg' => '访问格式不正确' )));
        }

        if(empty($this->s_uid)){
            exit(toJson(array('status' => '2002', 'msg' => '请登录' )));
        }

        //积分池扣积分
        $param_n = array(
            'uid' => $this->s_uid,//用户名
            'needcodeNum' => $needcodeNum,//消耗积分数
            'gamename' => '1',//1：射击小游戏
            'description' => '打炮射击小游戏一连发',//说明
        );
        $re_n = curlPost(HOST_JAVA.'/HJTurnTable/rs/othergame/checkusercode',$param_n);
        if($re_n['success'] != 'true'){//是否可以抽奖判断,如果可以积分已扣
            exit(toJson(array('status' => '2003', 'msg' => $re_n['msg'] )));
        }

        $ShejiRecordModel = M('ShejiRecord');
        //入库日志
        $add_data = array(
            'userid' => $this->s_uid,
            'username' => '',
            'prizename' => '发射一枚炮弹需'.$needcodeNum.'积分',
            'prizenum' => $needcodeNum,
            'status' => 1,
            'datetime' => time(),
        );
        $ShejiRecordModel->add($add_data);//入库
        //************************  扣积分结  **************************

        //获取概率
        $prizelist = M("ShejiPrize")->where()->order('id asc')->select();
        if(!empty($prizelist)){
            foreach ($prizelist as $key => $val){
                $p_arr[$key] = $val['percent'];
            }
        }
        $r_id = get_rand($p_arr); //根据概率获取奖项id

        //从积分中获取
        $param_g = array(
            'uid' => $this->s_uid,//用户名
            'getcodeNum' => $prizelist[$r_id]['prize'],//消耗积分数
            'remark' => $re_n['remark'],//java用，唯一标识
        );
        $re_g = curlPost(HOST_JAVA.'/HJTurnTable/rs/othergame/giveUserCodeNum',$param_g);
        if($re_g['success'] != 'true'){//判断是否获得积分成功
            exit(toJson(array('status' => '2004', 'msg' => $re_g['msg'] )));
        }

        $get_data = array(
            'userid' => $this->s_uid,
            'username' => '',
            'prizeclassid' => $prizelist[$r_id]['id'],
            'prizename' => $prizelist[$r_id]['title'],
            'prizenum' => $prizelist[$r_id]['prize'],//中奖数目
            'status' => 2,
            'datetime' => time(),
        );
        $result = $ShejiRecordModel->add($get_data);  //先扣减10积分
        if($result){
            exit(toJson(array('status' => '1001', 'msg' => $prizelist[$r_id]['title'], 'prizeclassid' => $prizelist[$r_id]['id'] )));
        }
    }

    /* 积分池剩余积分
     * User: Tmc
     * Date: 2017/10/18
     * Time: 11:21
     */
    public function show_code_num()
    {
        $result = curlPost(HOST_JAVA.'/HJTurnTable/rs/othergame/getCodeNum');
        dump($result);
    }

    /* ajax连续抽奖10次
     * User: Tmc
     * Date: 2017/10/18
     * Time: 11:21
     */
    public function ajax_get_rand10()
    {
        $needcodeNum = 100; //每次抽奖消耗的积分数
        if(!IS_POST){
            exit(toJson(array('status' => '2001', 'msg' => '访问格式不正确' )));
        }

        if(empty($this->s_uid)){
            exit(toJson(array('status' => '2002', 'msg' => '请登录' )));
        }

        $param_n = array(
            'uid' => $this->s_uid,//用户名
            'needcodeNum' => $needcodeNum,//消耗积分数
            'gamename' => '1',//1：射击小游戏
            'description' => '打炮射击小游戏十连发',//说明
        );
        $re_n = curlPost(HOST_JAVA.'/HJTurnTable/rs/othergame/checkusercode',$param_n);
        if($re_n['success'] != 'true'){//是否可以抽奖判断
            exit(toJson(array('status' => '2003', 'msg' => $re_n['msg'] )));
        }

        $ShejiRecordModel = M('ShejiRecord');
        //先去积分池扣除消耗积分
        $add_data = array(
            'userid' => $this->s_uid,
            'username' => '',
            'prizename' => '发射十枚炮弹需'.$needcodeNum.'积分',
            'prizenum' => $needcodeNum,
            'status' => 1,
            'datetime' => time(),
        );
        $ShejiRecordModel->add($add_data);//入库
        //************************  扣积分结束  **************************

        //获取概率
        $prizelist = M("ShejiPrize")->where()->order('id asc')->select();
        if(!empty($prizelist)){
            foreach ($prizelist as $key => $val){
                $p_arr[$key] = $val['percent'];
            }
        }

        for ($x=0; $x<10; $x++) {
            $r_id = get_rand($p_arr); //根据概率获取奖项id
            $re_yes[] = $prizelist[$r_id]; //中奖项
        }
        if(!empty($re_yes)){
            foreach ($re_yes as $k => $v ){
                $num_arr[$k] = $v['prize'];//获奖加起来总和
                $prizeclassid[$k] = $v['id'];//获奖id
                $msg[$k] = $v['title'];//获奖名称
                //数据入库
                $get_data = array(
                    'userid' => $this->s_uid,
                    'username' => '',
                    'prizeclassid' => $v['id'],
                    'prizename' => $v['title'],
                    'prizenum' => $v['prize'],//中奖数目
                    'status' => 2,
                    'datetime' => time(),
                );
                $ShejiRecordModel->add($get_data);  //先扣减10积分
            }
        }
        $getcodeNum = array_sum($num_arr);//奖励积分和
        //从积分池中获取
        $param_g = array(
            'uid' => $this->s_uid,//用户名
            'getcodeNum' => $getcodeNum,//用户获取的积分数
            'remark' => $re_n['remark'],//java用，唯一标识
        );
        $re_g = curlPost(HOST_JAVA.'/HJTurnTable/rs/othergame/giveUserCodeNum',$param_g);
        if($re_g['success'] != 'true'){//判断是否活动积分成功
            exit(toJson(array('status' => '2004', 'msg' => $re_n['msg'] )));
        } else {
            exit(toJson(array('status' => '1001', 'msg' => $msg, 'prizeclassid' => $prizeclassid )));
        }

    }


}