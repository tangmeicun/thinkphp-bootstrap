<?php
/**
 * Author: Tmc 2801151629@qq.com
 * User: Administrator
 * Date: 15-10-27
 * Time: 下午15:00
 */

namespace Manage\Service;


class BaseService {

    protected  $tableName=null;     //表名称
    protected  $dmodel = null;      //大D方法模型

    private  function __construct($type=''){

        if($type==''){
            //初始化大d模型对象
            if(! is_null($this->tableName)){
                $dmodel = D($this->tableName);
                $this->setDmodel($dmodel);
            }
        }else{

            //初始化大d模型对象
            $dmodel = D($this->tableName.$type);
            $this->setDmodel($dmodel);
        }

    }

    public static function  create(){
        return new static();
    }

    public static function createView(){
        return new static('View');
    }

    //设置大d方法模型对象
    private function  setDmodel($dmodel){
        $this->dmodel = $dmodel;
    }


    //获取大d方法模型对象
    public function getDmodel(){
        if(is_null($this->dmodel))
            return false;
        return $this->dmodel;
    }

    //获取多条数据
    public function get_many($map=array(),$filed=true,$limit=0,$order=''){

        $rs = $this->getDmodel()->get_many($map,$filed,$limit,$order);

        return $rs;
    }

    //获取一条数据
    public function get_one($map=array(),$filed=true,$order=''){

        $rs = $this->getDmodel()->get_one($map,$filed,$order);

        return $rs;
    }

    //获取记录数
    public function get_count($map=array()){
        return $this->getDmodel()->get_count($map);
    }

    //保存一条记录
    public function save_one($map,$data){
        return $this->getDmodel()->save_one($map,$data);
    }
}
