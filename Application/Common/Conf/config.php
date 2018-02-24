<?php
return array(
	//'配置项'=>'配置值'
    'MODULE_ALLOW_LIST'          => array('Home','Manage'),
    'DEFAULT_MODULE'             => 'Home',
    'URL_CASE_INSENSITIVE'  =>  true,//url不区分大小写
    'URL_MODEL' => 2, //url兼容模式
    'DEFAULT_FILTER'  => 'strip_tags', //过滤
//    'TMPL_EXCEPTION_FILE'   => APP_PATH.'/Home/View/Public/404.html',
    'LOAD_EXT_CONFIG' => 'database',
);