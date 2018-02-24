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
        <a class="brand" href="index.html"><span class="first">RS - </span> <span class="second">若水游戏管理系统</span></a>
    </div>
</div>

<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Sign In</p>
            <div class="block-body">
                <form name="form1" method="post" action="/Manage/Public/checklogin" onsubmit="return chk();">
                    <label>用户名</label>
                    <input name="username" type="text" class="span12">
                    <label>密码</label>
                    <input name="password" type="password" class="span12">
                    <label>验证码</label>
                    <input class="verify" type="text" name="verify" id="verify" value="">
                    <img id="img" src="" border="0" alt="看不清楚请点击刷新验证码" style="cursor : pointer;width:111px;height:39px;"
                         onclick="show(this)"/>
                    <input type="submit" value="登录" class="btn btn-primary pull-right" />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#img').trigger('click');
        $('.captcha').focus(function(){
            $('.yzm-box').show();
        });

        $('.captcha').focusout(function(){
            //$('.yzm-box').hide();
        });

        $('#verify').val('');
        $('#adminpwd').val('');

        $('img').src="<?php echo U('public/verify');?>?random="+Math.random();
    });
    function show(obj){
        obj.src="<?php echo U('public/verify');?>?random="+Math.random();
    }
    function chk(){
        if(document.getElementById('AdminName').value==""){
            alert('用户名不能为空!');
            document.getElementById('AdminName').focus();
            return false;
        }
        if(document.getElementById('adminpwd').value==""){
            alert('密码不能为空!');
            document.getElementById('adminpwd').focus();
            return false;
        }
        if(document.getElementById('verify').value==""){
            alert('验证码不能为空!');
            document.getElementById('verify').focus();
            return false;
        }
    }
</script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function () {
        $('.demo-cancel-click').click(function () {
            return false;
        });
    });
</script>

</body>
</html>