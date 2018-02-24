<?php
/* * 射击游戏
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/9/14
 * Time: 9:21
 */
namespace Home\Controller;
class IndexController extends BaseController {
    public function _initialize(){
        parent::_initialize();

    }

    /* 首页
     * User: Tmc
     * Date: 2017/10/17
     * Time: 9:21
     */
    public function index(){
//        $this -> display();
        dump('index');
    }

    public function abc(){
        $p = I('get.id');
        dump($p);
        dump('abc');
    }





}