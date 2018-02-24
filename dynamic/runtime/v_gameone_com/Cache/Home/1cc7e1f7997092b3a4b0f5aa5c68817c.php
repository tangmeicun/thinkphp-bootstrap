<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/public/sheji/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/public/sheji/css/cannon.css" />
    <script src="/public/sheji/js/jquery-2.2.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/sheji/js/rem.js" type="text/javascript" charset="utf-8"></script>
    <title>射击</title>
</head>
<body>
<div class="wrap">
    <div class="con1">
        <div class="bj3"></div>
        <div class="con1_nei"></div>
        <div class="man4"></div>
        <div class="cannon"></div>
        <div class="donkey11"></div>
        <div class="donkey12"></div>
        <div class="shell"></div>
        <div class="bz"></div>
    </div>
    <div class="con2"></div>
    <div class="con3"><span class="btn1">发射炮弹</span><span class="btn10">连打十炮</span></div>
    <div class="con4">
        <span>游戏规则</span>
        <ul>

        </ul>
    </div>
</div>
<div class="bg"></div>
<div class="dialog dialog1">
    <p>发射炮弹需要消耗10积分，您确定发射么？</p>
    <span class="sure sure1">是</span><span class="cancel">否</span>
</div>
<div class="dialog dialog10">
    <p>连打十炮需要消耗100积分，您确定发射么？</p>
    <span class="sure sure10">是</span><span class="cancel">否</span>
</div>
<!-- 游戏规则 -->
<div class="dialog rule">
    <h3>游戏规则</h3>
    <p>游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏</p>
    <p>游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏游戏规则游戏</p>
    <span class="cancel close">关闭</span>
</div>
</body>
<script type="text/javascript">
    //获取吉祥卡登录信息
    (function ($) {
        $.getUrlParam = function (name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]); return null;
        }
    })(jQuery);
    //url参数获取
    var callback = $.getUrlParam('callback');
    if(callback != '' && callback != null && callback != 'null'){
        var J_data_login = JSON.parse(callback);
        if(J_data_login.uid){
            $.ajax({
                url: '/sheji/ajax_save_user',
                type: 'POST',
                data: {uid: J_data_login.uid},
                dataType: 'json',
                success: function (rs) {
                    if (rs.status == '1001') {
                        window.location.href = '/sheji/index.html';
                    }
                },
            });
        }
    }

    $(function(){
        //0 发射一枚炮弹需10积分
        //1 打中1个人,获得奖励15积分
        //2 打中2个人,获得奖励20积分
        //3 炮弹掉地上，返还5积分
        //4 打偏，炮弹没了，失去所有积分
        var num = 4;
        var flag = true;
        var timer1,timer2,timer3,timer4;
        $(".btn1").click(function(e){
            if( flag ){
                flag = false;
                $(".bg").show();
                $(".dialog1").show();
                e.stopPropagation();
                e.preventDefault();
            }
        })
        $(".btn10").click(function(e){
            if( flag ){
                flag = false;
                $(".bg").show();
                $(".dialog10").show();
                e.stopPropagation();
                e.preventDefault();
            }
        })
        //1次
        $(".sure1").click(function(e){
            $(".bg").hide();
            $(".dialog").hide();
            $.ajax({
                url: '/sheji/ajax_get_rand',
                type: 'POST',
                data: {},
                dataType:'json',
                success: function(rs){
                    if(rs.status == '1001'){
                        num = rs.prizeclassid;
                        console.log(num);
                        if( num == 1 ){
                            // 打中1个人,获得奖励15积分
                            $(".man4").attr("class","man1");
                            $(".cannon").attr("class","cannon1");
                            setTimeout(function(){
                                $(".cannon1").attr("class","cannon2");
                            },500)
                            setTimeout(function(){
                                $(".shell").animate({
                                    left:'3rem',
                                    top:'1.4rem'
                                },150).animate({
                                    left:'4rem',
                                    top:'1.2rem'
                                },150).animate({
                                    left:'6.5rem',
                                    top:'1.4rem'
                                },150).animate({
                                    left:'8.5rem',
                                    top:'1.8rem'
                                },150,function(){
                                    $(".bz").show();
                                    setTimeout(function(){
                                        $(".bz").hide();
                                        $(".donkey11").css({"transform":"rotate(90deg)","transform-origin":"bottom center"});
                                        $(".donkey12").attr("class","donkey1");
                                    },500)
                                })
                            },600)
                            setTimeout(function(){
                                $(".cannon2").attr("class","cannon");
                                
                            },1000)
                            setTimeout(function(){
                                $(".man1").attr("class","man2");
                            },1400)
                            setTimeout(function(){
                                $(".man2").attr("class","man4");
                                var li = "<li>消灭了一个敌人，您获得15积分奖励！</li>";
                                $(".con4 ul").prepend(li);
                                $(".shell").css({"left":"1.7rem","top":"2rem"});
                                $(".donkey1").attr("class","donkey12");
                                $(".donkey11").css({"transform":"none"});
                                flag = true;
                            },2800)
                        }else if( num == 2 ){
                            // 打中2个人,获得奖励20积分
                            $(".man4").attr("class","man1");
                            $(".cannon").attr("class","cannon1");
                            setTimeout(function(){
                                $(".cannon1").attr("class","cannon2");
                            },500)
                            setTimeout(function(){
                                $(".shell").animate({
                                    left:'3rem',
                                    top:'1.4rem'
                                },150).animate({
                                    left:'4rem',
                                    top:'1.2rem'
                                },150).animate({
                                    left:'5rem',
                                    top:'1.4rem'
                                },150).animate({
                                    left:'8rem',
                                    top:'1.8rem'
                                },150,function(){
                                    $(".bz").show();
                                    setTimeout(function(){
                                        $(".bz").hide();
                                        $(".donkey11").css({"transform":"rotate(90deg)","transform-origin":"bottom center"});
                                        $(".donkey12").css({"transform":"rotate(90deg)","transform-origin":"bottom center"});
                                    },500)
                                })
                            },600)
                            setTimeout(function(){
                                $(".cannon2").attr("class","cannon");
                            },1200)
                            setTimeout(function(){
                                $(".man1").attr("class","man2");
                            },1400)
                            setTimeout(function(){
                                $(".man2").attr("class","man4");
                                var li = "<li>一箭双雕！您获得20积分奖励，再来一局吧！</li>";
                                $(".con4 ul").prepend(li);
                                $(".shell").css({"left":"1.7rem","top":"2rem"});
                                $(".donkey11").css({"transform":"none"});
                                $(".donkey12").css({"transform":"none"});
                                flag = true;
                            },2800)
                        }else if( num == 3 ){
                            // 炮弹掉地上，返还5积分
                            clearTimeout(timer1,timer2,timer3,timer4);
                            $(".shell").removeClass("shell_fail1");
                            timer1 = setTimeout(function(){
                                $(".man4").attr("class","man1");
                                $(".cannon").attr("class","cannon1");
                            },40)
                            timer2 = setTimeout(function(){
                                clearTimeout(timer1);
                                $(".cannon1").attr("class","cannon3");
                            },300)
                            timer3 = setTimeout(function(){
                                clearTimeout(timer2);
                                $(".shell").animate({
                                    left:'2.2rem',
                                    top:'1.6rem'
                                },100).animate({
                                    left:'2.6rem',
                                    top:'2rem'
                                },100).animate({
                                    left:'2.65rem',
                                    top:'2.4rem'
                                },100)
                                $(".cannon3").attr("class","cannon");
                            },700)
                            timer4 = setTimeout(function(){
                                clearTimeout(timer3);
                                $(".man1").attr("class","man3");
                                $(".donkey11").attr("class","donkey2");
                                $(".donkey12").attr("class","donkey24");
                            },1000)
                            setTimeout(function(){
                                $(".man3").attr("class","man4");
                                var li = "<li>火药太少了，炮弹没有发射。返还您5积分，再接再厉吧！</li>";
                                $(".con4 ul").prepend(li);
                                $(".shell").css({"left":"1.7rem","top":"2rem"});
                                $(".donkey2").attr("class","donkey11");
                                $(".donkey24").attr("class","donkey12");
                                flag = true;
                            },2800)
                        }else if ( num == 4 ){
                            // 打偏，炮弹没了，失去所有积分
                            $(".man4").attr("class","man1");
                            $(".cannon").attr("class","cannon1");
                            setTimeout(function(){
                                $(".cannon1").attr("class","cannon2");
                            },500)
                            setTimeout(function(){
                                $(".shell").animate({
                                    left:'3rem',
                                    top:'1.4rem'
                                },100).animate({
                                    left:'4rem',
                                    top:'1rem'
                                },100).animate({
                                    left:'5rem',
                                    top:'0.8rem'
                                },50).animate({
                                    left:'7.5rem',
                                    top:'0.6rem'
                                },100,function(){
                                    setTimeout(function(){
                                        $(".donkey11").attr("class","donkey1")
                                        $(".donkey12").attr("class","donkey13")
                                    },500)
                                })
                            },600)
                            setTimeout(function(){
                                $(".cannon2").attr("class","cannon");
                            },1000)
                            setTimeout(function(){
                                $(".man1").attr("class","man3");
                            },1200)
                            setTimeout(function(){
                                var li = "<li>火药太多，炮弹被怼飞了！真遗憾，再来一局吧！</li>";
                                $(".con4 ul").prepend(li);
                                $(".man3").attr("class","man4");
                                $(".shell").css({"left":"1.7rem","top":"2rem"});
                                $(".donkey1").attr("class","donkey11");
                                $(".donkey13").attr("class","donkey12");
                                flag = true;
                            },2800)
                        }
                    } else {
                        alert(rs.msg);
                    }
                },
            });
            e.stopPropagation();
            e.preventDefault();
        })
        //10次
        $(".sure10").click(function(e){
            $(".bg").hide();
            $(".dialog10").hide();
            //发十枚炮弹
            $.ajax({
                url: '/sheji/ajax_get_rand10',
                type: 'POST',
                data: {},
                dataType:'json',
                success: function(rs){
                    if(rs.status == '1001'){
                        num = rs.prizeclassid;
                        console.log(num);
                        $(".man4").attr("class","man1");
                        $(".cannon").attr("class","cannon1");
                        setTimeout(function(){
                            $(".cannon1").attr("class","cannon2");
                        },500)
                        setTimeout(function(){
                            $(".shell").animate({
                                left:'3rem',
                                top:'1.4rem'
                            },150).animate({
                                left:'4rem',
                                top:'1.2rem'
                            },150).animate({
                                left:'6.5rem',
                                top:'1.4rem'
                            },150).animate({
                                left:'8.5rem',
                                top:'1.8rem'
                            },150,function(){
                                $(".bz").show();
                                setTimeout(function(){
                                    $(".bz").hide();
                                    $(".donkey11").css({"transform":"rotate(90deg)","transform-origin":"bottom center"});
                                    $(".donkey12").attr("class","donkey1");
                                },500)
                            })
                        },600)
                        setTimeout(function(){
                            $(".cannon2").attr("class","cannon");
                            
                        },1000)
                        setTimeout(function(){
                            $(".man1").attr("class","man2");
                        },1400)
                        setTimeout(function(){
                            $(".man2").attr("class","man4");
                            var li = "";
                            for(var i =0; i<rs.msg.length; i++){
                                li += "<li>"+rs.msg[i]+"</li>";
                            }
                            $(".con4 ul").prepend(li);
                            $(".shell").css({"left":"1.7rem","top":"2rem"});
                            $(".donkey1").attr("class","donkey12");
                            $(".donkey11").css({"transform":"none"});
                            flag = true;
                        },2800)
                        
                    } else {
                        alert(rs.msg);
                    }
                },
            });
            e.stopPropagation();
            e.preventDefault();
        })
        $(".dialog .cancel").click(function(){
            $(".bg").hide();
            $(".dialog").hide();
        })
        $(".con4 span").click(function(){
            $(".bg").show();
            $(".dialog").show();
        })
    })

</script>
</html>