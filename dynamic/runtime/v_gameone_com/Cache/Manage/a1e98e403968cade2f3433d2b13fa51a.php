<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>若水游戏管理系统</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="若水游戏管理系统">
    <meta name="author" content="若水游戏管理系统">
    <link rel="stylesheet" type="text/css" href="/Public/common/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/Public/common/stylesheets/theme.css">
    <link rel="stylesheet" href="/Public/common/lib/font-awesome/css/font-awesome.css">
    <script src="/Public/common/lib/jquery-1.7.2.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/locale/bootstrap-table-zh-CN.min.js"></script>

    <!-- Demo page code -->
    <style type="text/css">
        #line-chart {
            height: 300px;
            width: 800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand {
            font-family: georgia, serif;
        }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="/Public/common/lib/bootstrap/js/bootstrap.js"></script>
</head>
<!--[if lt IE 7 ]>
<body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]>
<body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]>
<body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]>
<body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body class="">
<!--<![endif]-->

<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav pull-right">

            <li id="fat-menu" class="dropdown">
                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-user"></i><?php echo ($username); ?>
                </a>

                <ul class="dropdown-menu">
                    <!--<li><a tabindex="-1" href="#">管理员信息</a></li>-->
                    <!--<li><a tabindex="-1"   href="#">修改密码</a></li>-->
                    <!--<li class="divider"></li>-->
                    <li><a tabindex="-1" href="<?php echo U('public/logout');?>">Logout</a></li>
                </ul>
            </li>

        </ul>
        <a class="brand" href="index.html"><span class="first">RS - </span> <span class="second">若水游戏管理系统</span></a>
    </div>
</div>
<!--左侧导航start-->
<?php echo W('Menu/lists',array($roleid));?>