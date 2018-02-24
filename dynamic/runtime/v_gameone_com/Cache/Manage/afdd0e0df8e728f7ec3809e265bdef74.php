<?php if (!defined('THINK_PATH')) exit();?><!--左侧导航start-->
<div class="sidebar-nav">
    <?php if(is_array($menutree)): $i = 0; $__LIST__ = $menutree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#<?php echo ($vo["url"]); ?>" class="nav-header collapsed" data-toggle="collapse"><i class="<?php echo ($vo["icons"]); ?>"></i><?php echo ($vo["name"]); ?></a>
        <?php if(!empty($vo["sonlist"])): ?><ul id="<?php echo ($vo["url"]); ?>" class="nav nav-list collapse <?php if(($vo['menuid'] == $menu_now['parentid'])): ?>in<?php endif; ?>">
                <?php if(is_array($vo["sonlist"])): $i = 0; $__LIST__ = $vo["sonlist"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li <?php if(($vv['menuid'] == $menu_now['menuid'])): ?>class="active"<?php endif; ?>><a href="<?php echo (format_url($vv["url"])); ?>"><?php echo ($vv["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</div>
<!--左侧导航end-->