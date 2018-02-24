<?php
/**
 * database config
 * Created by PhpStorm.
 * User: Tmc
 * Date: 17-9-14
 * Time: 上午10:14
 */
if(APP_DEBUG){
    return
    array(
        'db_type'  => 'mysql',
        'db_host'  => '192.168.2.191',
        'db_name'  => 'xyxjh',
        'db_user'  => 'root',
        'db_pwd'   => '123456',
        'db_port'  => '3306',
        'db_prefix' =>'rs_'
    );
    //测试环境
//    array(
//        'db_type'  => 'mysql',
//        'db_host'  => '127.0.0.1',
//        'db_name'  => 'csxyxjh',
//        'db_user'  => 'jixiangh5',
//        'db_pwd'   => 'X3e%RY1d',
//        'db_port'  => '3306',
//        'db_prefix' =>'rs_'
//    );
}
//线上环境
    return
        array(
        'db_type'  => 'mysql',
        'db_host'  => '127.0.0.1',
        'db_name'  => 'xyxjh',
        'db_user'  => 'xyxjh',
        'db_pwd'   => 'X3e%RY1d',
        'db_port'  => '3306',
        'db_prefix' =>'rs_'
    );