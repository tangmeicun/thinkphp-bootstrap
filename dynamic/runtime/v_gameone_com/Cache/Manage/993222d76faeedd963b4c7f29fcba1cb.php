<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">编辑管理员</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="/">Home</a> <span class="divider">/</span></li>
        <li class="active">编辑管理员</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active in" id="home">
                        <form id="tab" method="post">
                            <label>用户名</label>
                            <input type="text" name="username" value="<?php echo ($datalist["Manager"]["username"]); ?>" class="input-xlarge" readonly>
                            <input type="hidden" name="userid" value="<?php echo ($datalist["Manager"]["id"]); ?>" class="input-xlarge">
                            <label>角色</label>
                            <select name="roleid" id="roleid" class="input-xlarge">
                                <?php if(is_array($datalist["role_list"])): $i = 0; $__LIST__ = $datalist["role_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["roleid"]); ?>" <?php if($datalist.Manager.roleid == $vo.roleid): ?>selected="selected"<?php endif; ?>><?php echo ($vo["rolename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo ($datalist["Manager"]["email"]); ?>" class="input-xlarge">
                            <label>Tel</label>
                            <input type="text" name="tel" value="<?php echo ($datalist["Manager"]["tel"]); ?>" class="input-xlarge">
                            <label></label>
                            <button type="submit" class="btn btn-primary"><i class="icon-save"></i>  提交</button>
                        </form>
                    </div>
                </div>
            </div>

            <footer>
                <p class="pull-right">若水游戏管理系统</p>
                <p>&copy; 2017 <a href="/">Home</a></p>
            </footer>

        </div>
    </div>
</div>