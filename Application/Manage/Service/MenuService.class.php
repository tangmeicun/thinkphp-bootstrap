<?php
/*
 * Author: Tmc 2801151629@qq.com
 * User: Administrator
 * Date: 17-3-1
 * Time: 10:00
 */

namespace Manage\Service;
use Think\Controller;
class MenuService {

    /*
     * 获取所有菜单
     */
    public static function getMenuTree()
    {
        $menu_list = M('Menu')->select();
        $tree = self::getTree($menu_list);
        return $tree;
    }

    /*
     * 获取树形结构
     */
    public static function getTree($arr,$pid = 0)
    {
        if(!empty($arr)){
            foreach ($arr as $key => $val){
                if($val['parentid'] == $pid){
                    $val['sonlist'] = self::getTree($arr,$val['menuid']);
                    $tree[] = $val;
                }
            }
        }
        return $tree;
    }

    /*
     * 获取所有菜单
     *
     */
    public static function getMenuTrees()
    {
        $menu_list = M('Menu')->select();
        $tree = self::_get_tree($menu_list);
        return $tree;
    }

    public function _get_tree($arr, $pid = 0, $level = 0, $str = '─', $firstStr = '├', $endStr = '└') {
        $tree = array();
        foreach ($arr as $k => $v) {
            if ($v['parentid'] == $pid) {
                $v['level'] = $level + 1;
                if ($level == 0) {
                    $v['full_name'] = $v['name'];
                } else {
                    $v['full_name'] = str_repeat('&nbsp;&nbsp;&nbsp;', $level) . $firstStr . $str . $v['name'];
                }
                $tree[] = $v;
                $tree = array_merge($tree, self::_get_tree($arr, $v['menuid'], $level + 1));
            }
        }
        return $tree;
    }















}
