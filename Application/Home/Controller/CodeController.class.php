<?php
/* * 射击游戏
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/9/14
 * Time: 9:21
 */
namespace Home\Controller;
class CodeController extends BaseController {
    public function _initialize(){
        parent::_initialize();

    }

     public function exchange(){

//         'type=1 AND status=1'
         //388623
         $DrawrecordsModel = M("Drawrecords");
         $list = $DrawrecordsModel->field('*')->where('drawtime > "2018-01-16 20:55:15" AND  drawtime < "2018-01-17 15:55:15" AND  (usecodeNum=100 OR usecodeNum=200)  ')->order()->limit(1)->select();
//         dump($list);
//         exit;
         if(!empty($list)){
             foreach ($list as $k => $v){
                 if($v['is_kou'] != 1){//判断是否已经扣积分
                     //扣积分
                     $param_n = array(
                         'uid' => $v['uid'],//用户名
                         'needcodeNum' => $v['getcodenum'],//消耗积分数
                         'gamename' => '9',//1：手动扣积分
                         'description' => '手动扣积分',//说明
                     );
                     $re_n = curlPost(HOST_JAVA.'/HJTurnTable/rs/othergame/checkusercode',$param_n);
                     dump(HOST_JAVA.'/HJTurnTable/rs/othergame/checkusercode');
                     dump($re_n);
                     exit;
                     if($re_n['success'] == 'true'){//扣积分成功
                         //更新数据库
                         $data['is_kou'] = 1;
                         $DrawrecordsModel->where('uid='.$v['uid'])->save($data);
                         //送积分
                         $param_g = array(
                             'uid' => $v['uid'],//用户名
                             'getcodeNum' => ($v['usecodenum']/10),//用户获取的积分数
                             'remark' => '手动送积分',//java用，唯一标识
                         );
                         $re_g = curlPost(HOST_JAVA.'/HJTurnTable/rs/othergame/giveUserCodeNum',$param_g);
                         if($re_g['success'] == 'true'){//判断是否送积分成功
                             //更新数据库
                             $data['is_song'] = 1;
                             $DrawrecordsModel->where('uid='.$v['uid'])->save($data);
                             echo $v['uid']."扣除积分：".$v['getcodenum']."；赠送积分：".($v['usecodenum']/10).'成功<br>\r\n';
                         }
                     }
                 } else {
                     continue;
                 }

             }
         }




     }


}