<?php
/* * 基类
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/2/16
 * Time: 9:21
 */

namespace Home\Controller;
use Think\Controller;

class EmptysController  extends Controller  {
    function _empty(){
        header("HTTP/1.1 404 Not Found");
        $this -> display();        //会自动调用配置里的 404 页面设置
    }
    function index() {
        header("HTTP/1.1 404 Not Found");
        $this -> display();        //会自动调用配置里的 404 页面设置
    }

    public function j_error()
    {
        $param_daohang = array(
            'languageType' => $this->LANG,
        );
        $result_daohang = curlPost(C('j_index_systemcategory_findAll'),$param_daohang);
        if($result_daohang['result']){
            $this->redirect('index/index');
        } else {
            $this->display('Public:j_error');
        }
    }

    function upgrade() {
        header("HTTP/1.1 404 Not Found");
        $this -> display('Public:404');        //会自动调用配置里的 404 页面设置
    }
}
