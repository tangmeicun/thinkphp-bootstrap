<?php
/**
 * Author: Tmc 2801151629@qq.com
 * User: Administrator
 * Date: 17-3-1
 * Time: 10:00
 */

namespace Manage\Service;

class SessionService {

    /**
     * 设置用户session
     * manage_id
     */
    public static function setAdminSess($data)
    {
        if(!empty($data)){
            session('manage_id',$data['id']);
            session('username',$data['username']);
            session('roleid',$data['roleid']);
        }
    }

    /**
     * 判断用户是否已经登录
     */
    public static function isHaveLogin(){
        return session('?manage_id') ? true : false;
    }

    /**
     * 清楚用户登录信息
     */
    public static function clearAdminSess(){

        if(session('?manage_id')){
            session('manage_id',null);
        }
        if(session('?username')){
            session('username',null);
        }
        if(session('?role')){
            session('role',null);
        }
    }







}
