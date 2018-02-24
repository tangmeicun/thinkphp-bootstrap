<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">设置权限</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?php echo U('index/index');?>">首页</a> <span class="divider">/</span></li>
        <li class="active">设置权限</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <form role="form" action="" method="post">
                    <label>设置 <?php echo ($rolename); ?> 的权限：</label>
                    <input type="hidden" name="roleid" value="<?php echo ($data["roleid"]); ?>"/>
                    <select multiple="" class="form-control" name="menuid[]" style="height:500px; width: 300px;">
                        <?php if(is_array($data["menulist"])): $i = 0; $__LIST__ = $data["menulist"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["menuid"]); ?>" <?php if(in_array($v['menuid'],$data['role_menu_list'])): ?>selected<?php endif; ?>><?php echo ($v["full_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <label></label>
                    <button type="submit" class="btn btn-primary">提交</button>
                    <?php echo ($error); ?>
                </form>
            </div>

            <footer>
    <p>&copy; 2017 若水网络</p>
    <p>作者：Tmc</p>
</footer>
        </div>
    </div>
</div>